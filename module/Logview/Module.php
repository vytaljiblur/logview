<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Logview;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

use Logview\Service\ErrorHandling as ErrorHandlingService;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream as LogWriterStream;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $app = $e->getApplication();
        $sm  = $app->getServiceManager();

        // we get the configs
        $config = $sm->get('Config');
        $auth = $config['user'];

        // we attaching our event to filter
        $eventManager->attach('dispatch', function($e) use ($auth){

            $match = $e->getRouteMatch();
            $name = $match->getMatchedRouteName();
            $request = $e->getRequest();

            $cookies = $request->getCookie();
            $posts = $request->getPost();
            $server = $request->getServer();

            $response = $e->getResponse();

            if (!( ($cookies['login'] == $auth['login']) && ($cookies['password'] == $auth['password']) )) { // check if user entered the combination of user/pass correctly

                // if it login then we are not need to redirect
                if ( ($name == 'login') && (($posts['login'] == null) || ($posts['login'] == null)) ) {
                    return;
                }

                if ( ($name == 'login') && (($posts['login'] == $auth['login']) || ($posts['password'] == $auth['password'])) ) {


                    setcookie("login", $_POST['login']);
                    setcookie("password", $_POST['password']);

                    $response->getHeaders()->addHeaderLine('Location', $posts['url']);
                    $response->setStatusCode(302);
                    return;
                }

                // Redirect to the user login page, if not correct
                $router   = $e->getRouter();
                $url = $server['REQUEST_URI'];
                $response = $e->getResponse();
                $response->getHeaders()->addHeaderLine('Location', '/login?url='.$url);
                $response->setStatusCode(302);

                return $response;
            } else {
                $response->getHeaders()->addHeaderLine('Location', $posts['url']);
                $response->setStatusCode(302);
                return;
            }


        });


    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

}

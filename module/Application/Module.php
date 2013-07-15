<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

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
/*        $eventManager->attach('dispatch', function($e) use ($auth){

            $match = $e->getRouteMatch();
            $name = $match->getMatchedRouteName();

            // if it login then we are not need to redirect
            if (strpos($name,'login') !== false) {
                return;
            }

            if ( !(($auth['login'] == $_POST['login']) && ( $auth['pass'] == $_POST['pass'] )) ) { // check if user entered the combination of user/pass correctly
                // Redirect to the user login page, if not correct
                $router   = $e->getRouter();
                $url      = $router->assemble(array(), array(
                    'name' => '/login'
                ));


                $response = $e->getResponse();
                $response->getHeaders()->addHeaderLine('Location', $url);
                $response->setStatusCode(302);

                return $response;
            }


        });*/


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

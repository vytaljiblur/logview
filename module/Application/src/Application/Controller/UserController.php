<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\Login;

class UserController extends AbstractActionController
{

    protected $loginForm;

    public function loginAction()
    {
    	return new ViewModel();
    }


    public function setLoginForm(Form $loginForm)
    {
        $this->loginForm = $loginForm;

//        $loginForm = $this->loginForm;
    }

    public function getLoginForm()
    {
        if (!$this->loginForm) {
            $this->setLoginForm(new Login());
        }
        return $this->loginForm;
    }


}

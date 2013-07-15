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

class IndexController extends AbstractActionController
{
 
    public function indexAction()
    {
    	return new ViewModel();
    }

    public function readnumAction()
    {
        //php_info();

        $num = $this->params()->fromRoute('num');

        $view_model = new ViewModel();

        if ($num > 50) {

            $view_model->setVariables(array(
                'error'  => "Error: The biggest number is 50",
            ));

            return $view_model;
        }

        $config = $this->getServiceLocator()->get('Config');
        $text = '';
        $file = file($config['logfile']); // Where to put errors? like opening and etc.
        for ($i = count($file)-1; $i >= count($file)-$num; $i--) {
            echo $text . $file[$i] . "<br>";
        }


        $view_model->setVariables(array(
            'text'  => $text,
        ));

        return $view_model;
    }

    public function timecapsuleAction()
    {
        $date = $this->params()->fromRoute('date');

        preg_match('/(\d{4})(\d{2})(\d{2})/',  $date, $data_values); //extract year month day from entered date from url

        $config = $this->getServiceLocator()->get('Config');
        $text = '';
        $file = file($config['logfile']); // Where to put errors? like opening and etc.
        for ($i = count($file)-1; $i >= 0; $i--) {
            preg_match('/(\d{4})\-(\d{2})\-(\d{2})/',  $file[$i], $line_data_values); // //extract year month day from every line of log file

            //check year month and day with entered from url with year month and day from each line from the log file
            if (
                ($data_values[1] == $line_data_values[1]) &&
                ($data_values[2] == $line_data_values[2]) &&
                ($data_values[3] == $line_data_values[3])
            ) {
                $text = $text . $file[$i] . "<br>";
            }

        }

        $view_model = new ViewModel();
        $view_model->setVariables(array(
            'text'  => $text
        ));

        return $view_model;
    }

    public function deleteAction()
    {
        $config = $this->getServiceLocator()->get('Config');
        $file = file($config['logfile']); // Where to put errors? like opening and etc.

        unlink($config['logfile']);

        return new ViewModel();
    }
}

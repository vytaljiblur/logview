<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array (

        'logfile' => getcwd()."/samplelog.log", // our log file

        'user' => array(
            'login' => 'admin',
            'password' => 'blur'
        ),

		'router' => array (
				'routes' => array (

                        'login' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '/login',
                                'defaults' => array(
                                    'controller' => 'Index',
                                    'action' => 'login'
                                )
                            )
                        ),

						'home' => array(
								'type' => 'literal',
								'options' => array(
										'route' => '/',
										'defaults' => array(
												'controller' => 'Index',
												'action' => 'index'
										)
								)
						),


						'readnum' => array (
								'type' => 'segment',
								'options' => array (
										'route' => '/log[/:num]/read.htm',
										'defaults' => array (
												'controller' => 'Index',
												'action' => 'readnum'
										),
                                        'constraints' => array(
                                            'num' => '[0-9]+'
                                        )
								) 
						),
						'timecapsule' => array (
                                'type' => 'regex',
								'options' => array (
										'regex' => '/log/timecapsule_(?<date>[0-9]{8})?.htm',
										'defaults' => array (
												'controller' => 'Index',
												'action' => 'timecapsule'
										),
                                        'spec'  => '/timecapsule_%date%'
								),

						),


/*                        'full-name' => array(
                            'type' => 'regex',
                            'options' => array(
                                // look here how I changed the regex in a way that the last parameter is optional
                                'regex' => '/Customer/(?<firstname>[a-zA-Z0-9_-]+)/(?<middlename>[a-zA-Z0-9_-]+)/*(?<lastname>[a-zA-Z0-9_-]*)',
                                'defaults' => array(
                                    'controller' => 'Application\Controller\Customers',
                                    'action'     => 'index',
                                    'lastname'   => false, // add some default value to the optional parameter
                                ),
                                'spec'  => '/%firstname%/%middlename%/%lastname%'
                            )
                        ),*/




                        'delete' => array (
                            'type' => 'literal',
                            'options' => array (
                                'route' => '/log/delete.htm',
                                'defaults' => array (
                                    'controller' => 'Index',
                                    'action' => 'delete'
                                )
                            )
                        )
				) 
		),
		'service_manager' => array (
				'abstract_factories' => array (
						'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
						'Zend\Log\LoggerAbstractServiceFactory'
				),
				'aliases' => array (
						'translator' => 'MvcTranslator'
				)
		),
		'controllers' => array (
				'invokables' => array (
						'Index' => 'Logview\Controller\IndexController'
				)
		),
		'view_manager' => array (
				'display_not_found_reason' => true,
				'display_exceptions' => true,
				'doctype' => 'HTML5',
				'not_found_template' => 'error/404',
				'exception_template' => 'error/index',
				'template_map' => array (
						'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
						'error/404' => __DIR__ . '/../view/error/404.phtml',
						'error/index' => __DIR__ . '/../view/error/index.phtml'
				),
				'template_path_stack' => array (
						__DIR__ . '/../view' 
				) 
		),

);

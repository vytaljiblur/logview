<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array (

        'logfile' => "/home/vitaliji/Desktop/logview/samplelog.log", // our log file

        'user' => array(
            'login' => 'admin',
            'password' => 'blur'
        ),

		'router' => array (
				'routes' => array (

                        'login' => array(
                            'type' => 'literal',
                            'options' => array(
                                'route' => '/login',
                                'defaults' => array(
                                    'controller' => 'User',
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
                                'type' => 'segment',
								'options' => array (
										'route' => '/log/timecapsule_[:date].htm',
										'defaults' => array (
												'controller' => 'Index',
												'action' => 'timecapsule'
										),
                                        'constraints' => array(
                                            'date' => '[0-9]{8}'
                                        )
								)
						),
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
						'Index' => 'Application\Controller\IndexController',
                        'User' => 'Application\Controller\UserController'
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

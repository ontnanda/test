<?php
return array( 
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Test',
                        'action' => 'index',
                    ),
                ),
            ),
            'api' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/api/[:id/][:n/]',
                    'constraints' => array(
                        'lang'   => '[a-zA-Z]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                        'n' => '[0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Test',
                        'action' => 'api',
                        'id' => '',
                        'n' => '',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            //add controller
            'Application\Controller\Test' => 'Application\Controller\TestController',
            //'Application\Controller\Xxx' => 'Application\Controller\XxxController',
        ),
    ),
     
    'view_manager' => array(
        'base_path' => '/',
        'doctype' => 'HTML5',
        'template_map' => array(
            #index
            'application/test/index' => __DIR__ . '/../view/index/index.phtml',
            'application/test/api' => __DIR__ . '/../view/index/api.phtml',
            #layout
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
			#404
			'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        /*
        'strategies' => array(
            'ViewJsonStrategy', // register JSON renderer strategy
            'ViewFeedStrategy', // register Feed renderer strategy
        ),*/
    ),
    
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    //DB
    //'Zend\Db',
    'Db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=nrru_db;host=nrrudb.cflaqvv1n1fo.ap-southeast-1.rds.amazonaws.com',   
        'driver_options' => array( 
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
        'username' => 'nrru_db',
        'password' => 'nrru6969', 
    ),
    'service_manager' => array( 
        'factories' => array(
            'translator' => 'Zend\\I18n\\Translator\\TranslatorServiceFactory',
            'Zend\\Db\\Adapter\\Adapter' => 'Zend\\Db\\Adapter\\AdapterServiceFactory',
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
        ),
        'abstract_factories' => [
        \Zend\Db\Adapter\AdapterAbstractServiceFactory::class,
        ],
    ),
    'memcached' => array(
        'server' => array('localhost', 11211)
    ),
    'language' => array(    
        '1' =>['code'=>'en','name'=>'English','label'=>'English'],   
        '2' =>['code'=>'th','name'=>'Thai','label'=>'ภาษาไทย'],
    ),
); 
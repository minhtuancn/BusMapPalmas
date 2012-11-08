<?php

namespace Map;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:controller[/:action]]',
                    'defaults' => array(
                        'action' => 'index',
                    ),
                ),
            ),
            'routes' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:controller[/:action]]',
                    'defaults' => array(
                        'action' => 'index',
                    ),
                ),
            ),
            'buses' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:controller[/:action]]',
                    'defaults' => array(
                        'action' => 'index',
                    ),
                ),
            ),
            'point' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:controller[/:action]]',
                    'defaults' => array(
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'home'   => 'Map\Controller\IndexController',
            'point'  => 'Routes\Controller\PointController',
            'routes'  => 'Routes\Controller\RouteController',
            'buses'   => 'Routes\Controller\BusController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'map/index/index' => __DIR__ . '/../view/map/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    // Doctrine config
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    )
);

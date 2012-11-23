<?php

namespace Map;

use Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent,
    Doctrine\ORM\EntityManager,
    Map\Service\Point as PointService,
    Map\Service\Bus as BusService,
    Map\Service\BusPoint as BusPointService,
    Map\Service\Connection as ConnectionService;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    'Routes' => __DIR__ . '/src/Routes',
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Map\Service\Point' => function($service) {
                    return new PointService($service->get('Doctrine\ORM\EntityManager'));
                },
                'Map\Service\Bus' => function($service) {
                    return new BusService($service->get('Doctrine\ORM\EntityManager'));
                },
                'Map\Service\BusPoint' => function($service) {
                    return new BusPointService($service->get('Doctrine\ORM\EntityManager'));
                },
                'Map\Service\Connection' => function($service) {
                    return new ConnectionService($service->get('Doctrine\ORM\EntityManager'));
                }
            ),
        );
    }

}

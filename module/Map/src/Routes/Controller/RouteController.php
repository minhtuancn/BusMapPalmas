<?php

namespace Routes\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class RouteController extends AbstractActionController {

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function indexAction() {
        $buses = $this->getEntityManager()
                ->getRepository('Map\Entity\Bus')
                ->findAll();
        
        return new ViewModel(array(
            'buses'  => $buses,
        ));
    }

    public function insertAction() {
        $request = $this->getRequest();

        $buses = $this->getEntityManager()
                ->getRepository('Map\Entity\Bus')
                ->findAll();

        $points = $this->getEntityManager()
                ->getRepository('Map\Entity\Point')
                ->findAll();

        if ($request->isPost()) {
            $elements = $request->getPost()->toArray();
            
            try {
                $service = $this->getServiceLocator()->get('Map\Service\BusPoint');
                
                foreach ($elements['points'] as $elem) :
                    $service->insert( array(
                                        'bus'    => $elements['bus'],
                                        'point'  =>  $elem
                                 ));
                endforeach;
                
            } catch (Exception $e) {
                throw $e;
            }
            return $this->redirect()->toRoute('routes', array('controller' => 'routes'));
        }

        return new ViewModel(array(
                    'buses' => $buses,
                    'points' => $points,
                ));
    }

}

<?php

namespace Routes\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\View\Model\JsonModel;

;

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
                    'buses' => $buses,
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

        $result = false;

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();

            try {
                $service = $this->getServiceLocator()->get('Map\Service\BusPoint');

                $service->insert(array(
                    'bus' => $post['idbus'],
                    'point' => $post['idpoint']
                ));

                $result = true;
            } catch (Exception $e) {
                
            }

            return new JsonModel(array(
                        'success' => $result,
                    ));
        }

        return new ViewModel(array(
                    'buses' => $buses,
                    'points' => $points,
                ));
    }

    public function getRouteAction() {
        $request = $this->getRequest();
        $result = false;

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();

            try {
                $bus = $this->getEntityManager()
                        ->getRepository('Map\Entity\Bus')
                        ->find($post['idbus']);

                $points = array();
                $count = 0; // representa a ordem
                foreach ($bus->getPoints() as $elem) :

                    $points[$count]['order'] = $count;
                    $points[$count]['idpoint'] = $elem->getIdPoint();
                    $points[$count]['label'] = $elem->getLabel();
                    $points[$count]['latitude'] = $elem->getLatitude();
                    $points[$count]['longitude'] = $elem->getLongitude();
                    $points[$count]['qnt_bus'] = $elem->getQntBus();
                    $points[$count]['obs'] = $elem->getObs();
                    $count++;
                endforeach;

                $result = new JsonModel(array(
                            'success' => true,
                            'points' => $points
                        ));

                return $result;
            } catch (Exception $e) {
                throw $e;
            }
        }

        return $result;
    }

    public function saveConnectionPointsAction() {
        $request = $this->getRequest();
        $result = false;

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();

            $distance = split(" km", $post['distance']);
            $post['distance'] = $distance[0];
            
            try {
                $service = $this->getServiceLocator()->get('Map\Service\Connection');
                $service->insert($post);

                return new JsonModel(array(
                            'success' => true,
                        ));

            } catch (Exception $e) {
                throw $e;
            }
        }

        return $result;
    }
}

?>
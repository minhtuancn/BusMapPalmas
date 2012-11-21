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

    function sort_arr_of_obj($array, $sortby, $direction = 'asc') {

        $sortedArr = array();
        $tmp_Array = $array;

        if ($direction == 'asc') {
            asort($tmp_Array);
        } else {
            arsort($tmp_Array);
        }

        foreach ($tmp_Array as $k => $tmp) {
            $sortedArr[] = $array[$k];
        }

        return $sortedArr;
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
                    $service->insert(array(
                        'bus' => $elements['bus'],
                        'point' => $elem
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
                            'points' => $points
                        ));

                return $result;
            } catch (Exception $e) {
                throw $e;
            }
        }

        return $result;
    }

}

?>
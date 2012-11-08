<?php

namespace Routes\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\View\Model\JsonModel,
    Map\Form\FormPoint;

class PointController extends AbstractActionController {

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

        $points = $this->getEntityManager()
                ->getRepository('Map\Entity\Point')
                ->findAll();

        return new ViewModel(array(
                    'points' => $points
                ));
    }

    public function newAction() {
        $form = new FormPoint();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get('Map\Service\Point');
                $service->insert($request->getPost()->toArray());

                return $this->redirect()->toRoute('routes', array('controller' => 'point'));
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function getPointsAction() {
        $points = $this->getEntityManager()
                ->getRepository('Map\Entity\Point')
                ->findAll();

        $latlng = array();
        $i = 0;

        foreach ($points as $element) :
            $latlng[$i]['latitude'] = $element->getLatitude();
            $latlng[$i]['longitude'] = $element->getLongitude();
            $latlng[$i]['label'] = $element->getLabel();
            $latlng[$i]['obs'] = $element->getObs();
            $i++;
        endforeach;

        $result = new JsonModel(array(
                    'latlng' => $latlng,
                    'success' => true,
                ));

        return $result;
    }

    public function insertAction() {
        $request = $this->getRequest();
        $result = false;

        if ($request->isPost()) {

            try {
                $service = $this->getServiceLocator()->get('Map\Service\Point');
                $service->insert($request->getPost()->toArray());

                $result = true;
            } catch (Exception $e) {
                $result = false;
            }
        }

        $json = new JsonModel(array(
                    'success' => $result,
                ));

        return $json;
    }

    public function getStartEndLatLngAction() {
        $request = $this->getRequest();
        $result = false;

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            
            try {
                $point1 = $this->getEntityManager()
                        ->getRepository('Map\Entity\Point')
                        ->findOneByLabel($post['label1']);

                $point2 = $this->getEntityManager()
                        ->getRepository('Map\Entity\Point')
                        ->findOneByLabel($post['label2']);
                
                $result = new JsonModel(array(
                    'latLngStart' => array('lat' => $point1->getLatitude(),
                                            'lng' => $point1->getLongitude()),
                    'latLngEnd' => array('lat' => $point2->getLatitude(),
                                            'lng' => $point2->getLongitude()),
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
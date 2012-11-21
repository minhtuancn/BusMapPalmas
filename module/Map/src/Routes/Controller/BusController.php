<?php

namespace Routes\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\View\Model\JsonModel,
    Doctrine\ORM\EntityRepository,
    Map\Form\FormBus;

class BusController extends AbstractActionController {

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
        $form = new FormBus();

        $routes = $this->getEntityManager()
                ->getRepository('Map\Entity\Bus')
                ->findAll();

        return new ViewModel(array(
                    'routes' => $routes,
                    'form' => $form
                ));
    }
    
    public function insertAction() {
        $form = new FormBus();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get('Map\Service\Bus');
                $service->insert($request->getPost()->toArray());

                return $this->redirect()->toRoute('routes', array('controller' => 'buses'));
            }
        }
    }
}
?>


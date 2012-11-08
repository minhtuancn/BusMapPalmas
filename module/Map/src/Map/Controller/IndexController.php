<?php

namespace Map\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

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
        $routes = $this->getEntityManager()
                ->getRepository('Map\Entity\Bus')
                ->findAll();

        return new ViewModel(array(
                    'routes' => $routes
                ));
    }
}

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BusService
 *
 * @author herinson
 */

namespace Map\Service;

use Doctrine\ORM\EntityManager,
        Map\Entity\Bus as BusEntity;

class Bus {
    /**
     * @var EntityManager
     */
    protected $em;
            
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function insert(array $data) {
        $entity = new BusEntity($data);
        
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
}

?>

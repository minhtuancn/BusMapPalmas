<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractService
 *
 * @author herinson
 */

namespace Map\Entity;

use Doctrine\ORM\EntityManager;

abstract class AbstractService {
    /**
     * @var EntityManager
     */
    
    protected $em;
    protected $entity;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
}

?>

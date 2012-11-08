<?php

namespace DoctrineORMModule\Proxy\__CG__\Map\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Point extends \Map\Entity\Point implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function getBuses()
    {
        $this->__load();
        return parent::getBuses();
    }

    public function getIdPoint()
    {
        $this->__load();
        return parent::getIdPoint();
    }

    public function setIdPoint($idpoint)
    {
        $this->__load();
        return parent::setIdPoint($idpoint);
    }

    public function getLabel()
    {
        $this->__load();
        return parent::getLabel();
    }

    public function setLabel($label)
    {
        $this->__load();
        return parent::setLabel($label);
    }

    public function getLatitude()
    {
        $this->__load();
        return parent::getLatitude();
    }

    public function setLatitude($latitude)
    {
        $this->__load();
        return parent::setLatitude($latitude);
    }

    public function getLongitude()
    {
        $this->__load();
        return parent::getLongitude();
    }

    public function setLongitude($longitude)
    {
        $this->__load();
        return parent::setLongitude($longitude);
    }

    public function getQntBus()
    {
        $this->__load();
        return parent::getQntBus();
    }

    public function setQntBus($qnt_bus)
    {
        $this->__load();
        return parent::setQntBus($qnt_bus);
    }

    public function getObs()
    {
        $this->__load();
        return parent::getObs();
    }

    public function setObs($obs)
    {
        $this->__load();
        return parent::setObs($obs);
    }

    public function __toString()
    {
        $this->__load();
        return parent::__toString();
    }

    public function toArray()
    {
        $this->__load();
        return parent::toArray();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'idpoint', 'label', 'latitude', 'longitude', 'qnt_bus', 'obs', 'buses');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}
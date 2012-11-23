<?php

namespace Map\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Commom\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="buspoint")
 * @property int $id
 * @property int $point
 * @property int $bus
 */
class BusPoint {

    public function __construct($options = null) {
        //Configurator::configure($this, $options);
        $this->setBus($options['bus']);
        $this->setPoint($options['point']);
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     * @var int $id
     */
    private $id;

    /**
     * @ORM\Column(name="bus", type="integer")
     * @var int $bus
     */
    private $bus;

    /**
     * @ORM\Column(name="point", type="integer")
     * @ORM\JoinColumn(name="point", referencedColumnName="idpoint")
     * @var int $point
     */
    private $point;

    public function getBus() {
        return $this->bus;
    }

    public function setBus($bus) {
        $this->bus = $bus;
    }

    public function getPoint() {
        return $this->point;
    }

    public function setPoint($point) {
        $this->point = $point;
    }

    public function getId() {
        return $this->id;
    }

    public function toArray() {
        return array(
            'id' => $this->getId(),
            'bus' => $this->getBus(),
            'point' => $this->getPoint()
        );
    }

}

?>
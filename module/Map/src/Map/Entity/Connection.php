<?php

namespace Map\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Commom\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="connection")
 * @property int $idconnection
 * @property int $point1
 * @property int $point2
 * @property decimal $distance
 */
class Connection {

    public function __construct($options = null) {
        Configurator::configure($this, $options);
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idconnection", type="integer")
     * @var int $idconnection
     */
    protected $idconnection;

    /**
     * @ORM\Column(name="point1", type="integer")
     * @var int $point1
     */
    protected $point1;

    /**
     * @ORM\Column(name="point2", type="integer")
     * @var int $point2
     */
    protected $point2;

    /**
     * @ORM\Column(name="distance", type="decimal")
     * @var double $distance
     */
    protected $distance;

    public function getIdConnection() {
        return $this->idconnection;
    }

    public function setIdConnection($idconnection) {
        $this->idconnection = $idconnection;
    }

    public function getPoint1() {
        return $this->point1;
    }

    public function setPoint1($point1) {
        $this->point1 = $point1;
    }

    public function getPoint2() {
        return $this->point2;
    }

    public function setPoint2($point2) {
        $this->point2 = $point2;
    }

    public function getDistance() {
        return $this->distance;
    }

    public function setDistance($distance) {
        $this->distance = $distance;
    }

    public function toArray() {
        return array(
            'idconnection' => $this->getIdConnection(),
            'point1' => $this->getPoint1(),
            'point2' => $this->getPoint2(),
            'distance' => $this->getDistance(),
        );
    }

}

?>

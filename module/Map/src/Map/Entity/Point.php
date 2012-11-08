<?php

namespace Map\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Commom\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="point")
 * @ORM\Entity(repositoryClass="Map\Entity\PointRepository")
 * @ORM\Table(name="Point")
 * @property int $idpoint
 * @property string $label
 * @property decimal $latitude 
 * @property decimal $longitude
 * @property int $qnt_bus
 * @property string $obs
 */
class Point {

    public function __construct($options = null) {
        Configurator::configure($this, $options);
        $this->buses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idpoint", type="integer")
     * @var int $idpoint
     */
    protected $idpoint;

    /**
     * @ORM\Column(name="label", type="text")
     * @var string $label
     */
    protected $label;

    /**
     * @ORM\Column(name="latitude", type="decimal")
     * @var double $latitude
     */
    protected $latitude;

    /**
     * @ORM\Column(name="longitude", type="decimal")
     * @var double $longitude
     */
    protected $longitude;

    /**
     * @ORM\Column(name="qnt_bus", type="integer")
     * @var int $qnt_bus
     */
    protected $qnt_bus;

    /**
     * @ORM\Column(name="obs", type="string")
     * @var string $obs
     */
    protected $obs;

    /**
     * @ORM\ManyToMany(targetEntity="Bus", mappedBy="points", cascade={"ALL"})
     */
    protected $buses;

    public function getBuses() {
        return $this->buses;
    }

    public function getIdPoint() {
        return $this->idpoint;
    }

    public function setIdPoint($idpoint) {
        $this->idpoint = $idpoint;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }

    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    public function getQntBus() {
        return $this->qnt_bus;
    }

    public function setQntBus($qnt_bus) {
        $this->qnt_bus = $qnt_bus;
    }

    public function getObs() {
        return $this->obs;
    }

    public function setObs($obs) {
        $this->obs = $obs;
    }

    public function __toString() {
        return $this->label;
    }

    public function toArray() {
        return array(
            'idpoint' => $this->getIdPoint(),
            'label' => $this->getLabel(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'qnt_bus' => $this->getQntBus()
        );
    }

}

?>

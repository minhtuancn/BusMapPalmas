<?php

namespace Map\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Commom\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="bus")
 * @property int $idbus
 * @property string $description
 * @property int $qnt_points
 */
class Bus {

    public function __construct($options = null) {
        Configurator::configure($this, $options);
        $this->points = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\Column(name="idbus", type="integer")
     * @ORM\GeneratedValue(strategy="NONE")
     * @var int $idbus
     */
    protected $idbus;

    /**
     * @ORM\Column(name="description", type="text")
     * @var string $description
     */
    protected $description;

    /**
     * @ORM\Column(name="qnt_points", type="integer")
     * @var int $qnt_points
     */
    protected $qnt_points;

    /**
     * @ORM\ManyToMany(targetEntity="Point", inversedBy="buses", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="buspoint",
     *  joinColumns={@ORM\JoinColumn(name="bus", referencedColumnName="idbus")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="point", referencedColumnName="idpoint")})
     */
    protected $points;

    public function getPoints() {
        return $this->points->toArray();
    }

    public function getIdBus() {
        return $this->idbus;
    }

    public function setIdBus($idbus) {
        $this->idbus = $idbus;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getQntPoints() {
        return $this->qnt_points;
    }

    public function setQntPoints($qnt_points) {
        $this->qnt_points = $qnt_points;
    }

    public function __toString() {
        return $this->description;
    }

    public function toArray() {
        return array(
            'idbus' => $this->getIdBus(),
            'description' => $this->getDescription(),
            'qnt_points' => $this->getQntPoints()
        );
    }

}

?>

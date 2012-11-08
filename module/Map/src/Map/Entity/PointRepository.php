<?php

namespace Map\Entity;

use Doctrine\ORM\EntityRepository;

class PointRepository extends EntityRepository {
    
    public function getLatLng() {
        $points = $this->_em->findAll();
        $array = array();

        foreach ($this->points as $key => $value) :
            if (strcmp($key, 'latitude') == 0) :
                $array['latitute'] = $value;
            endif;
            if (strcmp($key, 'longitude') == 0) :
                $array['longitude'] = $value;
            endif;
        endforeach;

        return $array;
    }

}

?>

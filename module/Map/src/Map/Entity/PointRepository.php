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

    /**
     * Algoritmo de Dijkstra
     * @param array $graph O array com os pontos do grafo
     * @param type $start Ponto de partida da rota
     * @param type $end Ponto de chegada da rota
     */
    public static function dijkstra(array $graph, $start, $end = null) {
        $d = array();
        $p = array();
        $q = array(0 => $start);

        foreach ($q as $v) {
            $d[$v] = $q[$v];
            if ($v == $end)
                break;

            foreach ($graph[$v] as $w) {
                $vw = $d[$v] + $g[$v][$w];

                if (in_array($w, $d)) {
                    if ($vw < $d[$w])
                        throw new Exception('Dijkstra: found better path to already-final vertex');
                }
                elseif ($vw < $q[$w]) {
                    $q[$w] = $vw;
                    $p[$w] = $v;
                }
            }

            return array($d, $p);
        }
    }

    /**
     * Calcula o caminho mais próximo no grafo usando o algoritmo de Dijkstra
     * @param array $graph Array com o grafo
     * @param type $start Ponto de partida
     * @param type $end Ponto de chegada
     * @return Array Os pontos da rota mínima traçada
     */
    public static function shortestPath(array $graph, $start, $end) {
        list( $d, $p ) = dijkstra($graph, $start, $end);
        $path = array();
        while (true) {
            $path[] = $end;
            if ($end == $start)
                break;
            $end = $p[$end];
        }

        array_reverse($path);

        return $path;
    }

}

?>

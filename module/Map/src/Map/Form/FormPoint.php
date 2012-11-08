<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TraceRoute
 *
 * @author herinson
 */

namespace Map\Form;

use Zend\Form\Form;

class FormPoint extends Form {
    
    public function __construct($name = null) {
        parent::__construct('point');
        
        $this->setAttribute('method', 'post');
        
        $this->add( array(
           'name' => 'idpoint',
            'attributes' => array(
                'type' => 'hidden'
            )
        ));
        
        $this->add( array(
           'name' => 'label',
            'options' => array(
                'type' => 'text',
                'label' => 'Identifica&ccedil;&atilde;o'
            ),
            'attributes' => array(
                'id' => 'label'
            )
        ));
        
        $this->add( array(
           'name' => 'latitude',
            'options' => array(
                'type' => 'text',
                'label' => 'Latitude'
            ),
            'attributes' => array(
                'id' => 'latitude'
            )
        ));
        
        $this->add( array(
           'name' => 'longitude',
            'options' => array(
                'type' => 'text',
                'label' => 'Longitude'
            ),
            'attributes' => array(
                'id' => 'longitude'
            )
        ));
        
        $this->add( array(
           'name' => 'qnt_bus',
            'options' => array(
                'type' => 'text',
                'label' => 'Qtde. &ocirc;nibus'
            ),
            'attributes' => array(
                'id' => 'qnt_bus'
            )
        ));
        
        $this->add( array(
           'name' => 'obs',
            'options' => array(
                'type' => 'textarea',
                'label' => 'Observa&ccedil;&atilde;o'
            ),
            'attributes' => array(
                'id' => 'obs'
            )
        ));
        
        $this->add( array(
           'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'id' => 'submit',
                'value' => 'Salvar'
            )
        ));
    }
}

?>

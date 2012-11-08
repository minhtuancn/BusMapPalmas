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

class FormBus extends Form {
    
    public function __construct($name = null) {
        parent::__construct('bus');
        
        $this->setAttribute('method', 'post');
        
        $this->add( array(
           'name' => 'idbus',
            'options' => array(
                'type' => 'text',
                'label' => 'N&uacute;mero do &ocirc;nibus'
            ),
            'attributes' => array(
                'id' => 'idbus'
            )
        ));
        
        $this->add( array(
           'name' => 'description',
            'options' => array(
                'type' => 'text',
                'label' => 'Identifica&ccedil;&atilde;o'
            ),
            'attributes' => array(
                'id' => 'description'
            )
        ));
        
        $this->add( array(
           'name' => 'qnt_points',
            'options' => array(
                'type' => 'text',
                'label' => 'Qtde. pontos'
            ),
            'attributes' => array(
                'id' => 'qnt_points'
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

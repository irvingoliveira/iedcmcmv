<?php

namespace Application\Form\Cadastro;

use Zend\Form\Form;

class TitularForm extends Form{
    
    public function init() {
        parent::__construct('cadastro-form');
        
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '/application/index/cadastro');
        
        $this->add(array(
            'name' => 'Titular',
            'type' => 'TitularFieldset',
            'options' => array(
                'use_as_base_fieldset' => true,
                'label' => 'Formulário de cadastro',
            )
        ));
       
        $this->add(array(
            'name' => 'IdentidadeTitular',
            'type' => 'IdentidadeTitularFieldset',
            'options' => array(
                'label' => 'Identidade do titular',
            ),
        ));
        
        $this->add(array(
            'name' => 'Conjuge',
            'type' => 'ConjugeFieldset',
            'options' => array(
                'label' => 'Conjuge',
            ),
        ));
        
        $this->add(array(
            'name' => 'IdentidadeConjuge',
            'type' => 'IdentidadeConjugeFieldset',
            'options' => array(
                'label' => 'Identidade do conjuge',
            ),
        ));
        
        $this->add(array(
            'name' => 'Endereco',
            'type' => 'EnderecoFieldset',
            'options' => array(
                'label' => 'Endereço',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'dependentes',
            'options' => array(
                'label' => 'Dependetes',
                'count' => 0,
                'should_create_template' => true,
                'template_placeholder' => '__placeholder__',
                'allow_add' => true,
                'target_element' => array(
                    'type' => 'DependenteFieldset'
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Button',
            'name' => 'adicionarDependente',
            'options' => array(
                'label' => 'Adicionar Dependente'
            ),
            'attributes' => array(
                'onclick' => 'return add_dependente()',
                'value' => 'adicionarDependente',
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Enviar'
            )
        ));
    }
}
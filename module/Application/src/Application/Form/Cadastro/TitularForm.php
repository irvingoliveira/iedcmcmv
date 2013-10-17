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
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'telefones',
            'options' => array(
                'label' => 'Telefones',
                'count' => 3,
                'should_create_template' => false,
                'template_placeholder' => '__telefone__',
                'allow_add' => true,
                'target_element' => array(
                    'type' => 'TelefoneFieldset'
                ),
            ),
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
                'label' => 'Dados familiares',
                'count' => 0,
                'should_create_template' => true,
                'template_placeholder' => '__index__',
                'allow_add' => true,
                'target_element' => array(
                    'type' => 'DependenteFieldset'
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'countDependentes',
            'type' => 'Zend\Form\Element\Hidden',
            'attributes' => array(
                'id' => 'countDependentes',
                'value' => 0,
            )
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
                'id' => 'adicionarDependente',
                'onMouseOver' => 'helpDependente()',
                'onMouseOut' => 'helpDependenteOut()',
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Enviar',
                'id' => 'submit',
            )
        ));
    }
}
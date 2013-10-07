<?php

namespace Application\Form\Cadastro;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class IdentidadeTitularFieldset extends Fieldset implements InputFilterProviderInterface{

    public function __construct(ObjectManager $objectManager) {
        parent::__construct('IdentidadeFieldset');
        
        $this->setHydrator(new DoctrineHydrator($objectManager, 
                                                'Application\Entity\Identidade'));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'numero',
                'options'   =>  array(
                    'label' =>  'Número da identidade:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'identidadeTitularNumero',
                    'size' => '12',
                    'maxlength' => '12',
                )
        ));
        
        $this->add(array(
        'type'  =>  'Zend\Form\Element\Date',
                'name'  =>  'dataEmissao',
                'options'   =>  array(
                    'label' =>  'Data de Emissão:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'identidadeTitularDataEmissao',
                )
        ));
        
        $this->add(array(
        'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'orgaoEmissor',
                'options'   =>  array(
                    'label' =>  'Orgão Emissor:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'identidadeTitularOrgaoEmissor',
                    'size' => '50',
                    'maxlength' => '200',
                )
        ));
        
    }

    public function getInputFilterSpecification() {
        return array(
            
            'numero' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Numero da identidade" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 12,
                            'max' => 12,
                            'messages' => array(
                                'stringLengthTooShort' => 'O campo "Número da identidade" deve ter entre exatamente 12 caracteres!', 
                                'stringLengthTooLong' => 'O campo "Número da identidade" deve ter entre exatamente 12 caracteres!', 
                            ),
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            
            'dataEmissao' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Date',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\Date::FALSEFORMAT => 'O campo "Data de emissão" foi preenchido de forma inválida.',
                                \Zend\Validator\Date::INVALID => 'O campo "Data de emissão" foi preenchido de forma inválida.',
                            ),
                        ),
                    ),
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Data de emissão" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 10,
                            'max' => 10,
                            'messages' => array(
                                'stringLengthTooShort' => 'Campos de data devem ter exatamente 10 caracteres!', 
                                'stringLengthTooLong' => 'Campos de data devem ter exatamente 10 caracteres!' 
                            ),
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            
            'orgaoEmissor' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Orgão emissor" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 3,
                            'max' => 200,
                            'messages' => array(
                                'stringLengthTooShort' => 'O campo "Orgão emissor" deve ter entre 3 e 200 caracteres!', 
                                'stringLengthTooLong' => 'O campo "Orgão emissor" deve ter entre 3 e 200 caracteres!' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'Alpha',
                        'options' => array(
                            'messages' => array(
                                \Zend\I18n\Validator\Alpha::NOT_ALPHA => 'Não são permitidos números no campo "Nome"',
                            ),
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StringToUpper'),
                ),
            ),
        );
    }
}
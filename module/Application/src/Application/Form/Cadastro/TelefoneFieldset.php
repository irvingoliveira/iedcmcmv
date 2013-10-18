<?php

namespace Application\Form\Cadastro;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class TelefoneFieldset extends Fieldset implements InputFilterProviderInterface{
    
    private $objectManager;

    public function __construct(ObjectManager $objectManager) {
        parent::__construct("TelefoneFieldset");
        
        $this->objectManager = $objectManager;
        
        $this->setHydrator(new DoctrineHydrator($objectManager, 
                                                'Application\Entity\Dependente'));
        
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'tipoTelefone',
            'options' => array(
                'label' =>  'Tipo de telefone:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha um tipo de telefone ---',
                'target_class'   => 'Application\Entity\TipoTelefone',
                'property'       => 'descricao',
                'is_method'      => true,
                'find_method'    => array(
                    'name'   => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy'  => array('descricao' => 'ASC'),
                    ),
                ),

            ),
            'attributes'    =>  array(
                'class'    =>  'telefoneTipo',
                'onBlur' => 'validarTipoTelefone()',
                'onFocus' => 'helpTipoTelefone()',
            ),
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'numero',
                'options'   =>  array(
                    'label' =>  'Numero:',
                ),
                'attributes'    =>  array(
                    'class'    =>  'telefoneNumero',
                    'size' => '14',
                    'maxlength' => '14',
                    'onClick' => 'add_telefone()',
                    'onKeyDown' => 'validarTelefoneNumero()',
                    'onFocus' => 'helpTelefoneNumero()',
                )
        ));
    }
    
    public function getInputFilterSpecification() {
        return array(
            'tipoTelefone' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Tipo de telefone" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'DoctrineModule\Validator\ObjectExists',
                        'options' => array(
                            'object_repository' => $this->objectManager->getRepository('Application\Entity\TipoTelefone'),
                            'fields' => 'codigoTipoTelefone',
                            'messages' => array(
                                \DoctrineModule\Validator\ObjectExists::ERROR_NO_OBJECT_FOUND => 'Opção de tipo de telefone inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'numero' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Numero" do telefone não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 13,
                            'max' => 14,
                            'messages' => array(
                                'stringLengthTooShort' => 'O numero de telefone deve ter entre 13 e 14 caracteres!', 
                                'stringLengthTooLong' => 'O numero de telefone deve ter entre 13 e 14 caracteres!' 
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
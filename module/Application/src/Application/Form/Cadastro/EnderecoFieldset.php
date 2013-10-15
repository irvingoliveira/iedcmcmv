<?php

namespace Application\Form\Cadastro;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class EnderecoFieldset extends Fieldset implements InputFilterProviderInterface{
    
    private $objectManager;

    public function __construct(ObjectManager $objectManager) {
        parent::__construct('EnderecoFieldset');
        
        $this->objectManager = $objectManager;
        
        $this->setHydrator(new DoctrineHydrator($objectManager, 
                                                'Application\Entity\Endereco'));

        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'tipoLogradouro',
            'options' => array(
                'label' =>  'Tipo de logradouro:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha um tipo de logradouro ---',
                'target_class'   => 'Application\Entity\TipoLogradouro',
                'property'       => 'nome',
                'is_method'      => true,
                'find_method'    => array(
                    'name'   => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy'  => array('nome' => 'ASC'),
                    ),
                ),

            ),
            'attributes'    =>  array(
                'id'    =>  'enderecoTipoLogradouro',
            ),
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'nomeLogradouro',
                'options'   =>  array(
                    'label' =>  'Nome do logradouro:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'enderecoNomeLogradouro',
                    'size' => '50',
                    'maxlength' => '200',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'numero',
                'options'   =>  array(
                    'label' =>  'Numero:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'enderecoNumero',
                    'size' => '10',
                    'maxlength' => '10',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'complemento',
                'options'   =>  array(
                    'label' =>  'Complemento:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'enderecoComplemento',
                    'size' => '50',
                    'maxlength' => '200',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'bairro',
                'options'   =>  array(
                    'label' =>  'Bairro:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'enderecoBairro',
                    'size' => '50',
                    'maxlength' => '200',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'comunidade',
                'options'   =>  array(
                    'label' =>  'Comunidade:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'enderecoComunidade',
                    'size' => '50',
                    'maxlength' => '200',
                )
        ));
        
        
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'distrito',
            'options' => array(
                'label' =>  'Distrito:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha um distrito ---',
                'target_class'   => 'Application\Entity\Distrito',
                'property'       => 'nome',
                'is_method'      => true,
                'find_method'    => array(
                    'name'   => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy'  => array('codigoDistrito' => 'ASC'),
                    ),
                ),

            ),
            'attributes'    =>  array(
                'id'    =>  'enderecoDistrito',
            ),
        ));
        
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'cep',
                'options'   =>  array(
                    'label' =>  'CEP:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'enderecoCep',
                    'size' => '9',
                    'maxlength' => '9',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Radio',
                'name'  =>  'areaDeRisco',
                'options'   =>  array(
                    'label' =>  'É área de risco?',
                    'value_options' => array(
                        '0' => 'Não',
                        '1' => 'Sim'
                    )
                ),
                'attributes'    =>  array(
                    'id'    =>  'enderecoAreaDeRisco',
                    'value' =>  '0',
                )
        ));
        
    }
    
    public function getInputFilterSpecification() {
        return array(
            'tipoLogradouro' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Tipo de logradouro" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'DoctrineModule\Validator\ObjectExists',
                        'options' => array(
                            'object_repository' => $this->objectManager->getRepository('Application\Entity\TipoLogradouro'),
                            'fields' => 'codigoTipoLogradouro',
                            'messages' => array(
                                \DoctrineModule\Validator\ObjectExists::ERROR_NO_OBJECT_FOUND => 'Opção de logradouro inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'nomeLogradouro' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Nome do logradouro" não pode ser vazio.' 
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
                                'stringLengthTooShort' => 'O campo "Nome do logradouro" deve ter entre 3 e 200 caracteres!', 
                                'stringLengthTooLong' => 'O campo "Nome do logradouro" deve ter entre 3 e 200 caracteres!' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'Alnum',
                        'options' => array(
                            'messages' => array(
                                \Zend\I18n\Validator\Alnum::INVALID => 'Existem caracteres inválidos no campo "Nome do logradouro"!',
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
            
            'numero' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Numero" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 0,
                            'max' => 10,
                                'messages' => array(
                                'stringLengthTooShort' => 'O campo "Numero" deve ter exatamente 10 caracteres!', 
                                'stringLengthTooLong' => 'O campo "Numero" deve ter exatamente 10 caracteres!',
                            ),
                        ),
                    ),
                    array(
                        'name' => 'Int',
                        'options' => array(
                            'messages' => array(
                                \Zend\I18n\Validator\Int::NOT_INT => 'Só são permitidos números inteiros no campo "Numero"!',
                            ),
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            
            'complemento' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'max' => 200,
                            'messages' => array(
                                'stringLengthTooLong' => 'O campo "Complemento" deve ter no máximo 200 caracteres!' 
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
            
            'bairro' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Bairro" não pode ser vazio.' 
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
                                'stringLengthTooShort' => 'O campo "Bairro" deve ter entre 3 e 200 caracteres!', 
                                'stringLengthTooLong' => 'O campo "Bairro" deve ter entre 3 e 200 caracteres!' 
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
            
            'comunidade' => array(
              'required' => false,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'max' => 200,
                            'messages' => array(
                                'stringLengthTooLong' => 'O campo "Comunidade" deve ter no máximo 200 caracteres!' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'Alnum',
                        'options' => array(
                            'messages' => array(
                                \Zend\I18n\Validator\Alnum::INVALID => 'Existem caracteres inválidos no campo "Comunidade"!',
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
            
            'distrito' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Distrito" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'DoctrineModule\Validator\ObjectExists',
                        'options' => array(
                            'object_repository' => $this->objectManager->getRepository('Application\Entity\Distrito'),
                            'fields' => 'codigoDistrito',
                            'messages' => array(
                                \DoctrineModule\Validator\ObjectExists::ERROR_NO_OBJECT_FOUND => 'Opção de distrito inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'cep' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Cep" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 9,
                            'max' => 9,
                            'messages' => array(
                                'stringLengthTooShort' => 'O campo "CEP" deve ter entre 3 e 200 caracteres!', 
                                'stringLengthTooLong' => 'O campo "CEP" deve ter entre 3 e 200 caracteres!' 
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
            
            'areaDeRisco' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "É área de risco?" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'InArray',
                        'options' => array(
                            'haystack'  => array('0','1'),
                            'messages' => array(
                                \Zend\Validator\InArray::NOT_IN_ARRAY => 'Opção do campo "É área de risco?" inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
        );
    }
}
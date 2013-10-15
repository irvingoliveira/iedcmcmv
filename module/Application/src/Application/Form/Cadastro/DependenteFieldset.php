<?php

namespace Application\Form\Cadastro;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class DependenteFieldset extends Fieldset implements InputFilterProviderInterface{
    
    private $objectManager;

    public function __construct(ObjectManager $objectManager) {
        parent::__construct("DependendeFieldset");
        
        $this->objectManager = $objectManager;
        
        $this->setHydrator(new DoctrineHydrator($objectManager, 
                                                'Application\Entity\Dependente'));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'nome',
                'options'   =>  array(
                    'label' =>  'Nome:',
                ),
                'attributes'    =>  array(
                    'class'    =>  'dependenteNome',
                    'size' => '50',
                    'maxlength' => '200',
                    'onBlur' => 'validarDependenteNome()',
                    'onFocus' => 'helpDependenteNome()',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'cpf',
                'options'   =>  array(
                    'label' =>  'Cpf:',
                ),
                'attributes'    =>  array(
                    'class'    =>  'dependenteCpf',
                    'size' => '14',
                    'maxlength' => '14',
                    'onBlur' => 'validarDependenteCpf()',
                    'onFocus' => 'helpDependenteCpf()',
                )
        ));
        
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'grauDeParentesco',
            'options' => array(
                'label' =>  'Grau de parentesco:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha um grau de parentesco ---',
                'target_class'   => 'Application\Entity\TipoGrauDeParentesco',
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
                'class'    =>  'dependenteGrauDeParentesco',
                'onBlur' => 'validarDependenteGrauDeParentesco()',
                'onFocus' => 'helpDependenteGrauDeParentesco()',
            ),
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Date',
                'name'  =>  'dataNascimento',
                'options'   =>  array(
                    'label' =>  'Data de nascimento:',
                ),
                'attributes'    =>  array(
                    'class'    =>  'dependenteDataNascimento',
                    'onChange' => 'validarDependenteDataNascimento()',
                    'onFocus' => 'helpDependenteDataNascimento()',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Radio',
                'name'  =>  'acolhimentoInstitucional',
                'options'   =>  array(
                    'label' =>  'O familiar se encontra em acolhimento institucional?',
                    'value_options' => array(
                        '0' => 'Não',
                        '1' => 'Sim'
                    )
                ),
                'attributes'    =>  array(
                    'class'    =>  'dependenteAcolhimentoInstitucional',
                    'value' => '0',
                    'onMouseOver' => 'helpDependenteAbrigoInstitucional()',
                    'onMouseOut' => 'helpDependenteAbrigoInstitucionalOut()',
                    'onBlur' => 'validarDependenteAbrigoInstitucional()',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Radio',
                'name'  =>  'deficienteFisico',
                'options'   =>  array(
                    'label' =>  'Possui algum tipo de deficiência?',
                    'value_options' => array(
                        '0' => 'Não',
                        '1' => 'Sim'
                    )
                ),
                'attributes'    =>  array(
                    'class'    =>  'dependenteDeficienteFisico',
                    'value' =>  '0',
                    'onBlur' => 'validarDependenteDeficienteFisico()',
                    'onMouseOver' => 'helpDependenteDeficienteFisico()',
                    'onMouseOut' => 'helpDependenteDeficienteFisicoOut()',
                )
        ));
        
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'renda',
                'options'   =>  array(
                    'label' =>  'Renda:',
                ),
                'attributes'    =>  array(
                    'class'    =>  'dependenteRenda',
                    'onBlur' => 'validarDependenteRenda()',
                    'onFocus' => 'helpDependenteRenda()',
                    'size' => '10',
                    'maxlength' => '10',
                )
            )
        );
    }
    
    public function getInputFilterSpecification() {
        return array(
            'nome' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Nome" não pode ser vazio.' 
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
                                'stringLengthTooShort' => 'O nome deve ter entre 3 e 200 caracteres!', 
                                'stringLengthTooLong' => 'O nome deve ter entre 3 e 200 caracteres!' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'Alpha',
                        'options' => array(
                            'allowWhiteSpace' => true,
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
            
            'cpf' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Cpf" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 14,
                            'max' => 14,
                                'messages' => array(
                                'stringLengthTooShort' => 'O campo "cpf" deve ter exatamente 14 caracteres!', 
                                'stringLengthTooLong' => 'O campo "cpf" deve ter exatamente 14 caracteres!',
                            ),
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            
            'grauDeParentesco' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Grau de parentesco" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'DoctrineModule\Validator\ObjectExists',
                        'options' => array(
                            'object_repository' => $this->objectManager->getRepository('Application\Entity\TipoGrauDeParentesco'),
                            'fields' => 'codigoTipoGrauDeParentesco',
                            'messages' => array(
                                \DoctrineModule\Validator\ObjectExists::ERROR_NO_OBJECT_FOUND => 'Opção de grau de parentesco inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'dataNascimento' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Date',
                        'options' => array(
                            'format' => 'd/m/Y',
                            'messages' => array(
                                \Zend\Validator\Date::FALSEFORMAT => 'O campo "Data de nascimento" foi preenchido de forma inválida.',
                                \Zend\Validator\Date::INVALID => 'O campo "Data de nascimento" foi preenchido de forma inválida.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Data de nascimento" não pode ser vazio.' 
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
            
            'acolhimentoInstitucional' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "O familiar se encontra em acolhimento institucional?" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'InArray',
                        'options' => array(
                            'haystack' => array('0','1'),
                            'messages' => array(
                                \Zend\Validator\InArray::NOT_IN_ARRAY => 'Opção do campo "O familiar se encontra em acolhimento institucional?" inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'deficienteFisico' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Possui algum tipo de deficiência?" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'InArray',
                        'options' => array(
                            'haystack' => array('0','1'),
                            'messages' => array(
                                \Zend\Validator\InArray::NOT_IN_ARRAY => 'Opção do campo "Possui algum tipo de deficiência?" inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'renda' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Renda" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 10,
                            'messages' => array(
                                'stringLengthTooShort' => 'O campo "Renda" deve ter entre 1 e 10 dígitos!', 
                                'stringLengthTooLong' => 'O campo "Renda" deve ter entre 1 e 10 dígitos!' 
                            ),
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
        );
    }
}
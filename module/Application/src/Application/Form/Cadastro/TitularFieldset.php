<?php

namespace Application\Form\Cadastro;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class TitularFieldset extends Fieldset implements InputFilterProviderInterface{
    
    private $objectManager;
    
    public function __construct(ObjectManager $objectManager) {
        parent::__construct('TitularFieldset');
        
        $this->objectManager = $objectManager;
        
        $this->setHydrator(new DoctrineHydrator($objectManager, 
                                                'Application\Entity\Titular'));
               
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'nome',
                'options'   =>  array(
                    'label' =>  'Nome:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'titularNome',
                    'size' => '50',
                    'maxlength' => '200',
                )
            )
        );
        
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'dataInscricao',
                'options'   =>  array(
                    'label' =>  'Data de inscrição:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'titularDataInscricao',
                    'value' => date("d/m/Y"),
                    'readonly' => 'readonly',
                )
            )
        );
        
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'cpf',
                'options'   =>  array(
                    'label' =>  'CPF:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'titularCpf',
                    'size' => '14',
                    'maxlength' => '14',
                )
            )
        );
        
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Date',
                'name'  =>  'dataNascimento',
                'options'   =>  array(
                    'label' =>  'Data de nascimento:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'titularDataNascimento',
                )
            )
        );
        
         $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'estadoCivil',
            'options' => array(
                'label' =>  'Estado civil:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha um estado civil ---',
                'target_class'   => 'Application\Entity\TipoEstadoCivil',
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
                'id'    =>  'titularEstadoCivil',
            ),
        ));
        
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'nis',
                'options'   =>  array(
                    'label' =>  'NIS:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'titularNis',
                    'size' => '12',
                    'maxlength' => '12',
                )
            )
        );
        
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'naturalidade',
            'options' => array(
                'label' =>  'Naturalidade:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha uma cidade ---',
                'target_class'   => 'Application\Entity\Cidade',
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
                'id'    =>  'titularNaturalidade',
            ),
        ));
        
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'tipoSexo',
            'options' => array(
                'label' =>  'Sexo:',
                'object_manager' => $objectManager,
                'empty_option'    => '--- Escolha um sexo ---',
                'target_class'   => 'Application\Entity\TipoSexo',
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
                'id'    =>  'titularSexo',
            ),
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Radio',
                'name'  =>  'mulherChefeDeFamilia',
                'options'   =>  array(
                    'label' =>  'Você é mulher chefe de família com dependentes?',
                    'value_options' => array(
                        '0' => 'Não',
                        '1' => 'Sim'
                    )
                ),
                'attributes'    =>  array(
                    'class'    =>  'titularMulherChefeDeFamilia',
                    'value' => '0',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Radio',
                'name'  =>  'acolhimentoInstitucional',
                'options'   =>  array(
                    'label' =>  'Se encontra em acolhimento institucional?',
                    'value_options' => array(
                        '0' => 'Não',
                        '1' => 'Sim'
                    )
                ),
                'attributes'    =>  array(
                    'class'    =>  'titularAcolhimentoInstitucional',
                    'value' => '0',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Radio',
                'name'  =>  'bolsaFamilia',
                'options'   =>  array(
                    'label' =>  'O solicitante possui Bolsa Familia?',
                    'value_options' => array(
                        '0' => 'Não',
                        '1' => 'Sim'
                    )
                ),
                'attributes'    =>  array(
                    'class'    =>  'titularBolsaFamilia',
                    'value' => '0',
                )
        ));
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Radio',
                'name'  =>  'imovel',
                'options'   =>  array(
                    'label' =>  'Você tem imóvel(terreno, casa, apartamento) no seu nome?',
                    'value_options' => array(
                        '0' => 'Não',
                        '1' => 'Sim'
                    )
                ),
                'attributes'    =>  array(
                    'class'    =>  'titularImovel',
                    'value' => '0',
                )
        ));
        
        $this->add(array(
            'type'  =>  'Zend\Form\Element\Radio',
                'name'  =>  'financiamentoCasa',
                'options'   =>  array(
                    'label' =>  'Você já tem ou teve financiamento de casa/apartamento?',
                    'value_options' => array(
                        '0' => 'Não',
                        '1' => 'Sim'
                    )
                ),
                'attributes'    =>  array(
                    'class'    =>  'titularFinanciamentoCasa',
                    'value' => '0',
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
                    'class'    =>  'titularDeficienteFisico',
                    'value' => '0',
                )
        ));
        
        $this->add(array(
                'type'  =>  'Zend\Form\Element\Text',
                'name'  =>  'renda',
                'options'   =>  array(
                    'label' =>  'Renda:',
                ),
                'attributes'    =>  array(
                    'id'    =>  'titularRenda',
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
            
            'dataInscricao' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Date',
                        'options' => array(
                            'format' => 'd/m/Y',
                            'messages' => array(
                                \Zend\Validator\Date::FALSEFORMAT => 'O campo "Data de inscricao" foi preenchido de forma inválida.',
                                \Zend\Validator\Date::INVALID => 'O campo "Data de inscrição" foi preenchido de forma inválida.' ,
                            ),
                        ),
                    ),
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Data de inscrição" não pode ser vazio.' 
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
                                'stringLengthTooShort' => 'O campo "cpf" deve ter exatamente 10 caracteres!', 
                                'stringLengthTooLong' => 'O campo "cpf" deve ter exatamente 10 caracteres!',
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
            
            'dataNascimento' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Date',
                        'options' => array(
                            'format' => 'd/m/Y',
                            'messages' => array(
                                \Zend\Validator\Date::FALSEFORMAT => 'O campo "Data de nascimento" foi preenchido de forma inválida.',
                                \Zend\Validator\Date::INVALID => 'O campo "Data de nascimento" foi preenchido de forma inválida.' ,
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
            
            'estadoCivil' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Estado civil" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'DoctrineModule\Validator\ObjectExists',
                        'options' => array(
                            'object_repository' => $this->objectManager->getRepository('Application\Entity\TipoEstadoCivil'),
                            'fields' => 'codigoTipoEstadoCivil',
                            'messages' => array(
                                \DoctrineModule\Validator\ObjectExists::ERROR_NO_OBJECT_FOUND => 'Opção de estado civil inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'nis' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 12,
                            'max' => 12,
                            'messages' => array(
                                'stringLengthTooShort' => 'O campo "Nis" deve ter exatamente 12 caracteres!', 
                                'stringLengthTooLong' => 'O campo "Nis" deve ter exatamente 12 caracteres!' 
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
            
            'naturalidade' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo naturalidade não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'DoctrineModule\Validator\ObjectExists',
                        'options' => array(
                            'object_repository' => $this->objectManager->getRepository('Application\Entity\Cidade'),
                            'fields' => 'codigoCidade',
                            'messages' => array(
                                \DoctrineModule\Validator\ObjectExists::ERROR_NO_OBJECT_FOUND => 'Opção de naturalidade inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'tipoSexo' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Sexo" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'DoctrineModule\Validator\ObjectExists',
                        'options' => array(
                            'object_repository' => $this->objectManager->getRepository('Application\Entity\TipoSexo'),
                            'fields' => 'codigoTipoSexo',
                            'messages' => array(
                                \DoctrineModule\Validator\ObjectExists::ERROR_NO_OBJECT_FOUND => 'Opção de sexo inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'mulherChefeDeFamilia' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Você é mulher chefe de família?" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'InArray',
                        'options' => array(
                            'haystack'  => array('0','1'),
                            'messages' => array(
                                \Zend\Validator\InArray::NOT_IN_ARRAY => 'Opção do campo "Você é mulher chefe de família?" inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'acolhimentoInstitucional' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Se encontra em acolhimento institucional?" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'InArray',
                        'options' => array(
                            'haystack'  => array('0','1'),
                            'messages' => array(
                                \Zend\Validator\InArray::NOT_IN_ARRAY => 'Opção do campo "Se encontra em acolhimento institucional?" inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'bolsaFamilia' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "O solicitante possui Bolsa Familia?" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'InArray',
                        'options' => array(
                            'haystack'  => array('0','1'),
                            'messages' => array(
                                \Zend\Validator\InArray::NOT_IN_ARRAY => 'Opção do campo "O solicitante possui Bolsa Familia?" inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'imovel' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Você tem imóvel(terreno, casa, apartamento) no seu nome?" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'InArray',
                        'options' => array(
                            'haystack'  => array('0','1'),
                            'messages' => array(
                                \Zend\Validator\InArray::NOT_IN_ARRAY => 'Opção do campo "Você tem imóvel(terreno, casa, apartamento) no seu nome?" inválida!' ,
                            ),
                        ),
                    ),
                ),
            ),
            
            'financiamentoCasa' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Você já tem ou teve financiamento de casa/apartamento?" não pode ser vazio.' 
                            ),
                        ),
                    ),
                    array(
                        'name' => 'InArray',
                        'options' => array(
                            'haystack'  => array('0','1'),
                            'messages' => array(
                                \Zend\Validator\InArray::NOT_IN_ARRAY => 'Opção do campo "Você já tem ou teve financiamento de casa/apartamento?" inválida!' ,
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
                            'haystack'  => array('0','1'),
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
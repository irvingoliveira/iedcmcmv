<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\MappedSuperclass
 */
abstract class Pessoa {

    /**
     * @var string
     * 
     * @ORM\Column(type="string",length=200)
     */
    private $nome;
    
    /**
     *
     * @var Identidade
     * 
     * @ORM\OneToOne(targetEntity="Identidade", inversedBy="pessoa")
     * @ORM\JoinColumn(name="codigoIdentidade", referencedColumnName="codigoIdentidade",nullable=FALSE)
     */
    private $identidade;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string",length=14, unique=TRUE)
     */    
    private $cpf;
    
    /**
     * @var DateTime
     * 
     * @ORM\Column(type="date")
     */
    
    private $dataNascimento;
    
    /**
     *
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    
    private $deficienteFisico;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string",length=12,nullable=TRUE, unique=TRUE)
     */    

    private $nis;
    
    /**
     *
     * @var TipoSexo
     * 
     * @ORM\ManyToOne(targetEntity="TipoSexo", inversedBy="pessoas")
     * @ORM\JoinColumn(name="codigoTipoSexo", referencedColumnName="codigoTipoSexo", nullable=FALSE)
     */
    private $tipoSexo;
    
    /**
     *
     * @var Cidade
     * 
     * @ORM\ManyToOne(targetEntity="Cidade", inversedBy="pessoas")
     * @ORM\JoinColumn(name="naturalidade", referencedColumnName="codigoCidade", nullable=FALSE)
     */
    private $naturalidade;
    
    /**
     * @var float
     * 
     * @ORM\Column(type="float")
     */
    private $renda;
    
    function __construct() {
        
    }
    
    public function getCodigoPessoa() {
        return $this->codigoPessoa;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getIdentidade() {
        return $this->identidade;
    }

    public function setIdentidade(Identidate $identidade) {
        $this->identidade = $identidade;
    }
    
    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function getDeficienteFisico() {
        return $this->deficienteFisico;
    }

    public function setDeficienteFisico(bolean $deficienteFisico) {
        $this->deficienteFisico = $deficienteFisico;
    }
    
    public function getNis() {
        return $this->nis;
    }

    public function setNis($nis) {
        $this->nis = $nis;
    }

    public function getRenda() {
        return $this->renda;
    }

    public function setRenda($renda) {
        $this->renda = $renda;
    }

    public function getTipoSexo() {
        return $this->tipoSexo;
    }

    public function setTipoSexo(TipoSexo $tipoSexo) {
        $this->tipoSexo = $tipoSexo;
    }
    
    public function getNaturalidade() {
        return $this->naturalidade;
    }

    public function setNaturalidade(Cidade $naturalidade) {
        $this->naturalidade = $naturalidade;
    }

}
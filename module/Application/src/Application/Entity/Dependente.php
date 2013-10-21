<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Dependente")
 */
class Dependente {

    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoDependente;

    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=200)
     */
    private $nome;

    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=14,unique=TRUE,nullable=TRUE)
     */
    private $cpf;

    /**
     *
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
     *
     * @var float
     * 
     * @ORM\Column(type="float")
     */
    private $renda;

    /**
     *
     * @var Titular
     * 
     * @ORM\ManyToOne(targetEntity="Titular", inversedBy="dependentes")
     * @ORM\JoinColumn(name="codigoTitular", referencedColumnName="codigoTitular", nullable=FALSE)
     */
    private $titular;

    /**
     *
     * @var TipoGrauDeParentesco
     * 
     * @ORM\ManyToOne(targetEntity="TipoGrauDeParentesco", inversedBy="dependentes")
     * @ORM\JoinColumn(name="codigoTipoGrauDeParentesco", referencedColumnName="codigoTipoGrauDeParentesco", nullable=FALSE)
     */
    private $tipoGrauDeParentesco;

    /**
     *
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    private $acolhimentoInstitucional;

    function __construct() {
        
    }

    public function getCodigoDependente() {
        return $this->codigoDependente;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
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

    public function setDataNascimento(\DateTime $dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function getDeficienteFisico() {
        return $this->deficienteFisico;
    }

    public function setDeficienteFisico($deficienteFisico) {
        $this->deficienteFisico = $deficienteFisico;
    }

    public function getRenda() {
        return $this->renda;
    }

    public function setRenda($renda) {
        $this->renda = $renda;
    }

    public function getTitular() {
        return $this->titular;
    }

    public function setTitular(Titular $titular) {
        $this->titular = $titular;
    }

    public function getTipoGrauDeParentesco() {
        return $this->tipoGrauDeParentesco;
    }

    public function setTipoGrauDeParentesco(TipoGrauDeParentesco $tipoGrauDeParentesco) {
        $this->tipoGrauDeParentesco = $tipoGrauDeParentesco;
    }

    public function getAcolhimentoInstitucional() {
        return $this->acolhimentoInstitucional;
    }

    public function setAcolhimentoInstitucional($acolhimentoInstitucional) {
        $this->acolhimentoInstitucional = $acolhimentoInstitucional;
    }

}
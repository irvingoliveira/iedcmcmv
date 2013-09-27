<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Titular")
 */
class Titular extends Pessoa{
    
    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoTitular;
    
    /**
     *
     * @var int
     * 
     * @ORM\Column(type="integer",unique=TRUE)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $protocolo;
    
    /**
     * @var DateTime
     * 
     * @ORM\Column(type="date")
     */
    private $dataInscricao;
    
    /**
     *
     * @var TipoEstadoCivil
     * 
     * @ORM\ManyToOne(targetEntity="TipoEstadoCivil", inversedBy="titular")
     * @ORM\JoinColumn(name="codigoTipoEstadoCivil", referencedColumnName="codigoTipoEstadoCivil", nullable=FALSE)
     */
    private $estadoCivil;

    /**
     *
     * @var Endereco
     * 
     * @ORM\OneToOne(targetEntity="Endereco", inversedBy="titular")
     * @ORM\JoinColumn(name="codigoEndereco", referencedColumnName="codigoEndereco", nullable=FALSE)
     */
    private $endereco;

    /**
     *
     * @var array
     * 
     * @ORM\ManyToMany(targetEntity="Telefone", inversedBy="titulares")
     * @ORM\JoinTable(name="TitularTemTelefone",
     *                joinColumns={
     *                      @ORM\JoinColumn(name="codigoTitular", 
     *                                  referencedColumnName="codigoTitular")},
     *                inverseJoinColumns={
     *                      @ORM\JoinColumn(name="codigoTelefone",
     *                                  referencedColumnName="codigoTelefone")}
     * )
     */
    private $telefones;
    
    /**
     *
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    private $membroFamiliaPreso;
    
    /**
     *
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    private $membroFamiliaIdoso;
    
    /**
     *
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    private $imovel;
    
    /**
     *
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    private $financiamentoCasa;
    
    /**
     *
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    private $bolsaFamilia;
    
    /**
     *
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    private $mulherChefeDeFamilia;
    
    /**
     *
     * @var Conjuge
     * 
     * @ORM\OneToOne(targetEntity="Conjuge", mappedBy="titular")
     */
    private $conjuge;
    
    /**
     *
     * @var array
     * 
     * @ORM\OneToMany(targetEntity="Dependente", mappedBy="titular")
     */
    private $dependentes;
            
    function __construct() {
        parent::__construct();
    }

    public function getProtocolo() {
        return $this->protocolo;
    }

    public function getDataInscricao() {
        return $this->dataInscricao;
    }

    public function setDataInscricao(DateTime $dataInscricao) {
        $this->dataInscricao = $dataInscricao;
    }
   
    public function getCodigoTitular() {
        return $this->codigoTitular;
    }
   
    public function getEstadoCivil() {
        return $this->estadoCivil;
    }

    public function setEstadoCivil(TipoEstadoCivil $estadoCivil) {
        $this->estadoCivil = $estadoCivil;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco(Endereco $endereco) {
        $this->endereco = $endereco;
    }

    public function getTelefones() {
        return $this->telefones;
    }

    public function setTelefones($telefones) {
        $this->telefones = $telefones;
    }

    public function getMembroFamiliaPreso() {
        return $this->membroFamiliaPreso;
    }

    public function setMembroFamiliaPreso($membroFamiliaPreso) {
        $this->membroFamiliaPreso = $membroFamiliaPreso;
    }

    public function getMembroFamiliaIdoso() {
        return $this->membroFamiliaIdoso;
    }

    public function setMembroFamiliaIdoso($membroFamiliaIdoso) {
        $this->membroFamiliaIdoso = $membroFamiliaIdoso;
    }

    public function getImovel() {
        return $this->imovel;
    }

    public function setImovel($imovel) {
        $this->imovel = $imovel;
    }

    public function getFinanciamentoCasa() {
        return $this->financiamentoCasa;
    }

    public function setFinanciamentoCasa($financiamentoCasa) {
        $this->financiamentoCasa = $financiamentoCasa;
    }

    public function getBolsaFamilia() {
        return $this->bolsaFamilia;
    }

    public function setBolsaFamilia($bolsaFamilia) {
        $this->bolsaFamilia = $bolsaFamilia;
    }

    public function getMulherChefeDeFamilia() {
        return $this->mulherChefeDeFamilia;
    }

    public function setMulherChefeDeFamilia($mulherChefeDeFamilia) {
        $this->mulherChefeDeFamilia = $mulherChefeDeFamilia;
    }
    
    public function getConjuge() {
        return $this->conjuge;
    }

    public function setConjuge(Conjuge $conjuge) {
        $this->conjuge = $conjuge;
    }
    
    public function getDependentes() {
        return $this->dependentes;
    }

    public function setDependentes($dependentes) {
        $this->dependentes = $dependentes;
    }

}
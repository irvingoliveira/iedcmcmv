<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Endereco")
 */
class Endereco {
    
    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoEndereco;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=200)
     */
    private $nomeLogradouro;
    
    /**
     *
     * @var TipoLogradouro
     * 
     * @ORM\ManyToOne(targetEntity="TipoLogradouro", inversedBy="enderecos")
     * @ORM\JoinColumn(name="codigoTipoLogradouro", referencedColumnName="codigoTipoLogradouro", nullable=FALSE)
     */
    private $tipoLogradouro;

    /**
     *
     * @var int
     * 
     * @ORM\Column(type="integer",length=10,nullable=TRUE)
     */
    private $numero;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=200,nullable=TRUE)
     */
    private $complemento;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=200)
     */
    private $bairro;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=200,nullable=TRUE)
     */
    private $comunidade;

    /**
     *
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    private $areaDeRisco;
    
    /**
     *
     * @var Distrito
     * 
     * @ORM\ManyToOne(targetEntity="Distrito", inversedBy="enderecos")
     * @ORM\JoinColumn(name="codigoDistrito", referencedColumnName="codigoDistrito", nullable=FALSE)
     */
    private $distrito;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=9)
     */
    private $cep;
    
    /**
     *
     * @var Titular
     * 
     * @ORM\OneToOne(targetEntity="Titular", mappedBy="endereco")
     */
    private $titular;
    
    function __construct() {
        
    }
    
    public function getCodigoEndereco() {
        return $this->codigoEndereco;
    }

    public function getNomeLogradouro() {
        return $this->nomeLogradouro;
    }

    public function setNomeLogradouro($nomeLogradouro) {
        $this->nomeLogradouro = $nomeLogradouro;
    }

    public function getTipoLogradouro() {
        return $this->tipoLogradouro;
    }

    public function setTipoLogradouro(TipoLogradouro $tipoLogradouro) {
        $this->tipoLogradouro = $tipoLogradouro;
    }
   
    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getComunidade() {
        return $this->comunidade;
    }

    public function setComunidade($comunidade) {
        $this->comunidade = $comunidade;
    }
    
    public function getAreaDeRisco() {
        return $this->areaDeRisco;
    }

    public function setAreaDeRisco($areaDeRisco) {
        $this->areaDeRisco = $areaDeRisco;
    }
    
    public function getDistrito() {
        return $this->distrito;
    }

    public function setDistrito(Distrito $distrito) {
        $this->distrito = $distrito;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getTitular() {
        return $this->titular;
    }

    public function setTitular(Titular $titular) {
        $this->titular = $titular;
    }

}
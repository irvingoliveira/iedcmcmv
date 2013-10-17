<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Telefone")
 */
class Telefone {
    
    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoTelefone;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=14,unique=TRUE)
     */
    private $numero;
    
    /**
     *
     * @var Titular
     * 
     * @ORM\ManyToOne(targetEntity="Titular", inversedBy="telefones")
     * @ORM\JoinColumn(name="codigoTitular", referencedColumnName="codigoTitular")
     */
    private $titular;
    
    /**
     *
     * @var TipoTelefone
     * 
     * @ORM\ManyToOne(targetEntity="TipoTelefone", inversedBy="telefones")
     * @ORM\JoinColumn(name="codigoTipoTelefone", referencedColumnName="codigoTipoTelefone", nullable=FALSE)
     */
    private $tipo;
    
    function __construct() {
        
    }

    public function getCodigoTelefone() {
        return $this->codigoTelefone;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getTitular() {
        return $this->titular;
    }

    public function setTitular(Titular $titular) {
        $this->titular = $titular;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo(TipoTelefone $tipo) {
        $this->tipo = $tipo;
    }

}
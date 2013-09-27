<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="TipoEstadoCivil")
 */
class TipoEstadoCivil {
    
    /**
     *
     * @var type 
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoTipoEstadoCivil;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=50,unique=TRUE)
     */
    private $descricao;
    
    /**
     *
     * @var Titular
     * 
     * @ORM\OneToMany(targetEntity="Titular", mappedBy="estadoCivil")
     */
    private $titular;
    
    function __construct() {
        
    }
    
    public function getCodigoTipoEstadoCivil() {
        return $this->codigoTipoEstadoCivil;
    }

    public function setCodigoTipoEstadoCivil(type $codigoTipoEstadoCivil) {
        $this->codigoTipoEstadoCivil = $codigoTipoEstadoCivil;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getTitular() {
        return $this->titular;
    }

    public function setTitular(Titular $titular) {
        $this->titular = $titular;
    }

}
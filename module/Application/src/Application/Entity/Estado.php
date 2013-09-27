<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Estado")
 */
class Estado {
    
    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoEstado;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=200,unique=TRUE)
     */
    private $nome;
    
    /**
     *
     * @var array
     * 
     * @ORM\OneToMany(targetEntity="Cidade", mappedBy="estado")
     */
    private $cidades;
    
    function __construct() {
        
    }
    
    public function getCodigoEstado() {
        return $this->codigoEstado;
    }

    public function setCodigoEstado($codigoEstado) {
        $this->codigoEstado = $codigoEstado;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCidades() {
        return $this->cidades;
    }

    public function setCidades($cidades) {
        $this->cidades = $cidades;
    }

}
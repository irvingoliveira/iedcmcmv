<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="TipoLogradouro")
 */
class TipoLogradouro {
    
    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoTipoLogradouro;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=50, unique=TRUE)
     */
    private $nome;
    
    /**
     *
     * @var array
     * 
     * @ORM\OneToMany(targetEntity="Endereco", mappedBy="tipoLogradouro")
     */
    private $enderecos;
    
    function __construct() {
        
    }
    
    public function getCodigoTipoLogradouro() {
        return $this->codigoTipoLogradouro;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEnderecos() {
        return $this->enderecos;
    }

    public function setEnderecos($enderecos) {
        $this->enderecos = $enderecos;
    }

}
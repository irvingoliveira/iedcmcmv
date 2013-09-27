<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Cidade")
 */
class Cidade {
    
    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoCidade;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=200)
     */
    private $nome;

    /**
     *
     * @var Estado
     * 
     * @ORM\ManyToOne(targetEntity="Estado", inversedBy="cidades")
     * @ORM\JoinColumn(name="codigoEstado", referencedColumnName="codigoEstado", nullable=FALSE)
     */
    private $estado;
    
    /**
     *
     * @var array
     * 
     * @ORM\OneToMany(targetEntity="Pessoa", mappedBy="naturalidade")
     */
    private $pessoas;
            
    function __construct() {
        
    }

    public function getCodigoCidade() {
        return $this->codigoCidade;
    }

    public function setCodigoCidade($codigoCidade) {
        $this->codigoCidade = $codigoCidade;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado(Estado $estado) {
        $this->estado = $estado;
    }
    
    public function getPessoas() {
        return $this->pessoas;
    }

    public function setPessoas($pessoas) {
        $this->pessoas = $pessoas;
    }

}
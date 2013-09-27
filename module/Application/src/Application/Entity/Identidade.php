<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Identidade")
 */
class Identidade {
    
    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoIdentidade;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=14,unique=TRUE)
     */
    private $numero;
    
    /**
     *
     * @var DateTime
     * 
     * @ORM\Column(type="date")
     */
    private $dataEmissao;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string",length=200)
     */
    private $orgaoEmissor;
    
    /**
     *
     * @var Pessoa
     * 
     * @ORM\OneToOne(targetEntity="Pessoa", mappedBy="identidade")
     */
    private $pessoa;
    
    function __construct() {
        
    }
    
    public function getCodigoIdentidade() {
        return $this->codigoIdentidade;
    }

    public function setCodigoIdentidade($codigoIdentidade) {
        $this->codigoIdentidade = $codigoIdentidade;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getDataEmissao() {
        return $this->dataEmissao;
    }

    public function setDataEmissao(DateTime $dataEmissao) {
        $this->dataEmissao = $dataEmissao;
    }

    public function getOrgaoEmissor() {
        return $this->orgaoEmissor;
    }

    public function setOrgaoEmissor($orgaoEmissor) {
        $this->orgaoEmissor = $orgaoEmissor;
    }

    public function getPessoa() {
        return $this->pessoa;
    }

    public function setPessoa(Pessoa $pessoa) {
        $this->pessoa = $pessoa;
    }
    
}
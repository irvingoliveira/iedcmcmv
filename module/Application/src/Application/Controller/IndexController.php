<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Titular;
use Application\Entity\Conjuge;
use Application\Entity\Identidade;
use Application\Entity\Endereco;
use Application\Entity\Dependente;

class IndexController extends AbstractActionController
{
    private $objectManager;
    
    public function getObjectManager() {
        if(!$this->objectManager)
            $this->objectManager = $this->getServiceLocator()->get('ObjectManager');
        return $this->objectManager;
    }

    public function indexAction()
    {
        
        return new ViewModel();
    }
    
    public function cadastroAction()
    {
        $request = $this->getRequest();
        $formManager = $this->serviceLocator->get('FormElementManager');
        $form = $formManager->get('Application\Form\Cadastro\TitularForm');
        
        if(!$request->isPost()){
            return array('form' =>  $form);
            
        }  else {
            $postData = $request->getPost();
            $form->setData($postData);
            
            if($form->isValid()){
                $titular = new Titular();
                $data = $form->getData();
                $objectManager = $this->getObjectManager();
                var_dump($data);
                
                //die();
                
                $titular->setAcolhimentoInstitucional($data['Titular']['acolhimentoInstitucional']);
                $titular->setBolsaFamilia($data['Titular']['bolsaFamilia']);
                $titular->setCpf($data['Titular']['cpf']);
                
                $dataInscricao = new \DateTime("now");
                $dataInscricao->format('d/m/Y');
                
                $titular->setDataInscricao($dataInscricao);
                
                $dataNascimento = new \DateTime();
                $dataNascimento->format('d/m/Y');
                $dataNascimentoVals = explode("/", $data['Titular']['dataNascimento']);
                
                $titular->setDataNascimento($dataNascimento->setDate($dataNascimentoVals[2],$dataNascimentoVals[1],$dataNascimentoVals[0]));
                
                $titular->setDeficienteFisico($data['Titular']['deficienteFisico']);
              
                $estadoCivil = $objectManager->getRepository('Application\Entity\TipoEstadoCivil')
                                             ->findOneBy(array('codigoTipoEstadoCivil' => $data['Titular']['estadoCivil']));
                $titular->setEstadoCivil($estadoCivil);
                
                $titular->setFinanciamentoCasa($data['Titular']['financiamentoCasa']);
                $titular->setImovel($data['Titular']['imovel']);
                $titular->setMulherChefeDeFamilia($data['Titular']['mulherChefeDeFamilia']);
                
                $naturalidadeTitular = $objectManager->getRepository('Application\Entity\Cidade')
                                             ->findOneBy(array('codigoCidade' => $data['Titular']['naturalidade']));
                $titular->setNaturalidade($naturalidadeTitular);

                $titular->setNis($data['Titular']['nis']);
                $titular->setNome($data['Titular']['nome']);
                $titular->setRenda($data['Titular']['renda']);
                
                $tipoSexoTitular = $objectManager->getRepository('Application\Entity\TipoSexo')
                                             ->findOneBy(array('codigoTipoSexo' => $data['Titular']['tipoSexo']));
                $titular->setTipoSexo($tipoSexoTitular);
                
                $identidadeTitular = new Identidade();

                $dataEmissaoIdentidadeTitular = new \DateTime();
                $dataEmissaoIdentidadeTitular->format('d/m/Y');
                $dataEmissaoVals = explode("/", $data['IdentidadeTitular']['dataEmissao']);
                
                $identidadeTitular->setDataEmissao($dataEmissaoIdentidadeTitular->setDate($dataEmissaoVals[2], $dataEmissaoVals[1], $dataEmissaoVals[0]));
                $identidadeTitular->setNumero($data['IdentidadeTitular']['numero']);
                $identidadeTitular->setOrgaoEmissor($data['IdentidadeTitular']['orgaoEmissor']);
                
                $titular->setIdentidade($identidadeTitular);
                
                
                if($data['Conjuge']['cpf']){
                    $conjuge = new Conjuge();
                
                    $conjuge->setAcolhimentoInstitucional($data['Conjuge']['acolhimentoInstitucional']);
                    $conjuge->setCpf($data['Conjuge']['cpf']);
                    
                    $dataNascimentoConjuge = new \DateTime();
                    $dataNascimentoConjuge->format('d/m/Y');
                    $dataNascimentoConjugeVals = explode("/", $data['Conjuge']['dataNascimento']);
                
                    $conjuge->setDataNascimento($dataNascimentoConjuge->setDate($dataNascimentoConjugeVals[2], $dataNascimentoConjugeVals[1], $dataNascimentoConjugeVals[0]));
                    $conjuge->setDeficienteFisico($data['Conjuge']['deficienteFisico']);
                
                    $naturalidadeConjuge = $objectManager->getRepository('Application\Entity\Cidade')
                                             ->findOneBy(array('codigoCidade' => $data['Conjuge']['naturalidade']));
                    $conjuge->setNaturalidade($naturalidadeConjuge);
                
                    $conjuge->setNis($data['Conjuge']['nis']);
                    $conjuge->setNome($data['Conjuge']['nome']);
                    $conjuge->setRenda($data['Conjuge']['renda']);
                    
                    $tipoSexoConjuge = $objectManager->getRepository('Application\Entity\TipoSexo')
                                             ->findOneBy(array('codigoTipoSexo' => $data['Conjuge']['tipoSexo']));
                    $conjuge->setTipoSexo($tipoSexoConjuge);
                
                    $identidadeConjuge = new Identidade();
                
                    $dataEmissaoIdentidadeConjuge = new \DateTime();
                    $dataEmissaoIdentidadeConjuge->format('d/m/Y');
                    $dataEmissaoConjugeVals = explode("/", $data['IdentidadeConjuge']['dataEmissao']);
                
                    $identidadeConjuge->setDataEmissao($dataEmissaoIdentidadeConjuge->setDate($dataEmissaoConjugeVals[2], $dataEmissaoConjugeVals[1], $dataEmissaoConjugeVals[0]));
                
                    $identidadeConjuge->setNumero($data['IdentidadeConjuge']['numero']);
                    $identidadeConjuge->setOrgaoEmissor($data['IdentidadeConjuge']['orgaoEmissor']);
                
                    $conjuge->setIdentidade($identidadeConjuge);
                
                    $titular->setConjuge($conjuge);
                }
                
                $endereco = new Endereco();
                
                $endereco->setAreaDeRisco($data['Endereco']['areaDeRisco']);
                $endereco->setBairro($data['Endereco']['bairro']);
                $endereco->setCep($data['Endereco']['cep']);
                $endereco->setComplemento($data['Endereco']['complemento']);
                $endereco->setComunidade($data['Endereco']['comunidade']);
                
                $distrito = $objectManager->getRepository('Application\Entity\Distrito')
                                          ->findOneBy(array("codigoDistrito" => $data['Endereco']['distrito']));
                $endereco->setDistrito($distrito);
                
                $endereco->setNomeLogradouro($data['Endereco']['nomeLogradouro']);
                $endereco->setNumero($data['Endereco']['numero']);
                
                $tipoLogradouro = $objectManager->getRepository('Application\Entity\TipoLogradouro')
                                          ->findOneBy(array("codigoTipoLogradouro" => $data['Endereco']['tipoLogradouro']));
                $endereco->setTipoLogradouro($tipoLogradouro);
                
                $titular->setEndereco($endereco);
                
                foreach ($data['dependentes'] as $dataDependente){
                    
                    $dependente = new Dependente();
                    
                    $dependente->setAcolhimentoInstitucional($dataDependente['acolhimentoInstitucional']);
                    $dependente->setCpf($dataDependente['cpf']);
                    
                    $dataNascimentoDependente = new \DateTime();
                    $dataNascimentoDependente->format('d/m/Y');
                    $dataNascimentoDependenteVals = explode("/", $dataDependente['dataNascimento']);
                    
                    $dependente->setDataNascimento($dataNascimentoDependente->setDate($dataNascimentoDependenteVals[2], $dataNascimentoDependenteVals[1], $dataNascimentoDependenteVals[0]));

                    $dependente->setDeficienteFisico($dataDependente['deficienteFisico']);
                    $dependente->setNome($dataDependente['nome']);
                    $dependente->setRenda($dataDependente['renda']);
                    
                    $gParentesco = $objectManager->getRepository('Application\Entity\TipoGrauDeParentesco')
                                                 ->findOneBy(array("codigoTipoGrauDeParentesco" => $dataDependente['grauDeParentesco']));
                    $dependente->setTipoGrauDeParentesco($gParentesco);
                    $dependente->setTitular($titular);
                    $titular->addDependente($dependente);
                }
                
                
                $objectManager->persist($titular);
                $objectManager->flush();
                
            }else 
               die(var_dump ($form->getMessages()));
        }
    }
}

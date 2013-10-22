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
use Application\Entity\Telefone;

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
                
                $titular->setAcolhimentoInstitucional($data['Titular']['acolhimentoInstitucional']);
                $titular->setBolsaFamilia($data['Titular']['bolsaFamilia']);
                
                if(self::validaCpf($data['Titular']['cpf']))
                    $titular->setCpf($data['Titular']['cpf']);
                else 
                    return array('err_msg' => 'Cpf do títular inválido!');
                
                
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

                if($data['Titular']['nis'] != "")
                    $titular->setNis($data['Titular']['nis']);
                
                $titular->setNome($data['Titular']['nome']);
                $titular->setRenda($data['Titular']['renda']);
                
                $tipoSexoTitular = $objectManager->getRepository('Application\Entity\TipoSexo')
                                             ->findOneBy(array('codigoTipoSexo' => $data['Titular']['tipoSexo']));
                $titular->setTipoSexo($tipoSexoTitular);
                
                foreach ($data['telefones'] as $dataTelefone){
                    if($dataTelefone['numero']){
                        $telefone = new Telefone();
                    
                        $tipoTelefone = $objectManager->getRepository('Application\Entity\TipoTelefone')
                                                  ->findOneBy(array('codigoTipoTelefone' => $dataTelefone['tipoTelefone']));

                        $telefone->setTipoTelefone($tipoTelefone);
                        $telefone->setNumero($dataTelefone['numero']);
                        $telefone->setTitular($titular);
                        
                        $titular->addTelefone($telefone);
                        
                    }
                }

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
                    
                    if(self::validaCpf($data['Conjuge']['cpf']))
                        $conjuge->setCpf($data['Conjuge']['cpf']);
                    else
                        return array('err_msg' => 'Cpf do conjuge inválido!');
                        
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
                
                    $identidadeConjuge->setDataEmissao($dataEmissaoIdentidadeConjuge->setDate(
                                                                                        $dataEmissaoConjugeVals[2], 
                                                                                        $dataEmissaoConjugeVals[1], 
                                                                                        $dataEmissaoConjugeVals[0]));
                
                    $identidadeConjuge->setNumero($data['IdentidadeConjuge']['numero']);
                    $identidadeConjuge->setOrgaoEmissor($data['IdentidadeConjuge']['orgaoEmissor']);
                
                    $conjuge->setIdentidade($identidadeConjuge);
                    $conjuge->setTitular($titular);
                    
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
                    
                    if(!$dataDependente['cpf']=="")
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
                
                try{
                    $objectManager->persist($titular);
                    $objectManager->flush();
                    
                    $this->gerarCsv($titular);
                }  catch (\Exception $e){
                    return array('excpt' => $e->getMessage());
                }
                
                $query = $objectManager->createQuery(
                 "SELECT t.protocolo FROM Application\Entity\Titular t WHERE t.codigoTitular = {$titular->getCodigoTitular()}");

                $result = $query->getResult();
                
                return array(
                    'sucesso' => 1,
                    'protocolo' => $result[0]['protocolo']
                        );
            }else 
               return array('err_msg' => $form->getMessages());
        }               
    }
    
     private function gerarCsv(Titular $titular){
         $objectManager = $this->getObjectManager();
         
         $query = $objectManager->createQuery(
                 "SELECT t.protocolo FROM Application\Entity\Titular t WHERE t.codigoTitular = {$titular->getCodigoTitular()}");

         $result = $query->getResult();
         
         $naturalidade = $objectManager->getRepository('Application\Entity\Cidade')
                                       ->findOneBy(array('codigoCidade' => $titular->getNaturalidade()));
         
         if($titular->getConjuge() instanceof Conjuge){
             $conjuge = $titular->getConjuge();
             $naturalidadeConjuge = $objectManager->getRepository('Application\Entity\Cidade')
                                                  ->findOneBy(array('codigoCidade' => $conjuge->getNaturalidade()));
         }
         
         $telefones = $titular->getTelefones();
         
         $rendaTotal = 0;
         
         if($titular->getDependentes()){
            foreach ($titular->getDependentes() as $dependente){
                 $rendaTotal += $dependente->getRenda();
             }
         }
         
         $rendaTotal += $titular->getRenda();
         
         $rendaTotal+= (isset($conjuge))? $conjuge->getRenda(): 0;
         
         /** Busca por deficientes**/
         
         $deficiente = FALSE;
         if($titular->getDependentes()){
            foreach ($titular->getDependentes() as $dependente){
                if($dependente->getDeficienteFisico()){
                    $deficiente = TRUE;
                    break;
                }
            }
         }
         
         $conjugeDeficiente = (isset($conjuge))? 
                 $conjuge->getDeficienteFisico():
                 NULL;
         
         if($conjugeDeficiente || $titular->getDeficienteFisico())
             $deficiente = TRUE;
         
         /** Busca por acolhimento institucional**/
         $acolhimento = FALSE;
         if($titular->getDependentes()){
            foreach ($titular->getDependentes() as $dependente){
             if($dependente->getAcolhimentoInstitucional()){
                 $acolhimento = TRUE;
                 break;
             }
            }
         }
         
         $conjugeAcolhimentoInst = (isset($conjuge))? 
                 $conjuge->getAcolhimentoInstitucional():
                 NULL;
         
         if($conjugeAcolhimentoInst || $titular->getAcolhimentoInstitucional())
             $acolhimento = TRUE;
         
         /** Busca por idosos **/
         $idoso = FALSE;
         if($titular->getDependentes()){
            foreach ($titular->getDependentes() as $dependente){
                $dataNascDependente = $dependente->getDataNascimento();
                $intervalo = $dataNascDependente->diff(new \DateTime());
                $idadeDependente = (int)$intervalo->format('%Y');
                if($idadeDependente > 60){
                    $idoso = TRUE;
                    break;
                }
            }
         }
         
         $dataNascTitular = $titular->getDataNascimento();
         $intervalo = $dataNascTitular->diff(new \DateTime());
         $idadeTitular = (int)$intervalo->format('%Y');
         
         if(isset($conjuge)){
            $dataNascConjuge = $conjuge->getDataNascimento();
            $intervalo = $dataNascConjuge->diff(new \DateTime());
            $idadeConjuge = (int)$intervalo->format('%Y');
         }else
             $idadeConjuge = 0;
         
         if($idadeConjuge > 60 || $idadeTitular > 60)
             $idoso = TRUE;
         
         $data = array(
             $result[0]['protocolo'],
             $titular->getCodigoTitular(),
             NULL,
             $titular->getDataInscricao()->format('d/m/Y'),
             $titular->getNome(),
             $titular->getDataNascimento()->format('d/m/Y'),
             $naturalidade->getNome(),
             $naturalidade->getEstado()->getNome(),
             $titular->getEstadoCivil()->getDescricao(),
             $titular->getTipoSexo()->getNome(),
             $titular->getIdentidade()->getNumero(),
             $titular->getIdentidade()->getDataEmissao()->format('d/m/Y'),
             $titular->getIdentidade()->getOrgaoEmissor(),
             $titular->getCpf(),
             $titular->getNis(),
             (isset($conjuge))?
                $conjuge->getNome(): NULL,
             (isset($conjuge))?
                $conjuge->getDataNascimento()->format('d/m/Y'): NULL,
             (isset($conjuge))?
                $naturalidadeConjuge->getNome() : NULL,
             (isset($conjuge))?
                $naturalidadeConjuge->getEstado()->getNome() : NULL,
             (isset($conjuge))?
                $conjuge->getTipoSexo()->getNome() : NULL,
             (isset($conjuge))?
                $conjuge->getIdentidade()->getNumero() : NULL,
             (isset($conjuge))?
                $conjuge->getIdentidade()->getDataEmissao()->format('d/m/Y') : NULL,
             (isset($conjuge))?
                $conjuge->getIdentidade()->getOrgaoEmissor() : NULL,
             (isset($conjuge))?
                $conjuge->getCpf() : NULL,
             (isset($conjuge))?
                $conjuge->getNis() : NULL,
             $titular->getEndereco()->getTipoLogradouro()->getNome(),
             $titular->getEndereco()->getNomeLogradouro(),
             $titular->getEndereco()->getNumero(),
             $titular->getEndereco()->getComplemento(),
             $titular->getEndereco()->getComunidade(),
             $titular->getEndereco()->getBairro(),
             "Duque de Caxias",
             "RJ",
             $titular->getEndereco()->getDistrito()->getNome(),
             $titular->getEndereco()->getCep(),
             ($telefones[0] instanceof Telefone)? $telefones[0]->getNumero() : NULL,
             ($telefones[1] instanceof Telefone)? $telefones[1]->getNumero() : NULL,
             ($telefones[2] instanceof Telefone)? $telefones[2]->getNumero() : NULL,
             NULL,
             $titular->getRenda(),
             (isset($conjuge))?$conjuge->getRenda():NULL,
             NULL,
             NULL,
             NULL,
             $rendaTotal,
             $titular->getEndereco()->getAreaDeRisco(),
             $titular->getMulherChefeDeFamilia(),
             $deficiente,
             $acolhimento,
             $idoso,
             $titular->getImovel(),
             $titular->getFinanciamentoCasa(),
             $titular->getBolsaFamilia(),
         );
         
         $titularCsv = fopen("dados/titular.csv", "a+");
         fputcsv($titularCsv, $data, ";");
         fclose($titularCsv);
         
         if($titular->getDependentes()){
             foreach ($titular->getDependentes() as $dependente){
                 $dataDependente = array(
                     $dependente->getTitular()->getCodigoTitular(),
                     $dependente->getNome(),
                     $dependente->getTipoGrauDeParentesco()->getDescricao(),
                     ($dependente->getCpf())? $dependente->getCpf() : 0,
                     $dependente->getDataNascimento()->format("d/m/Y"),                     
                 );
             }
             
            $dependentesCsv = fopen("dados/dependente.csv", "a+");
            fputcsv($dependentesCsv, $dataDependente, ";");
            fclose($dependentesCsv);
         }
     }
     
     public function cpfUnicoAction(){
         $request = $this->getRequest();
         
         if($request->isPost()){
             $cpf = $request->getPost('cpf');
             $objectManager = $this->getObjectManager();
             $titular = $objectManager->getRepository('Application\Entity\Titular')
                                      ->findOneBy(array('cpf' => $cpf));
             
             if($titular instanceof Titular){
                 echo '1';
                 die();
             }
         }    
         
         $this->redirect()->toUrl(
                   'http://iedcmcmv.local/application/index/cadastro'
                    );  
     }
     
     public static function validaCpf($cpf){
         $cpf = str_pad(preg_replace('#[^0-9]#', '', $cpf), 11, '0', STR_PAD_LEFT);
	
	// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
	{
            return false;
        }
	else
	{   // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }

                $d = ((10 * $d) % 11) % 10;

                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }
}
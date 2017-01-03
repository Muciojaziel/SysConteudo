<?php
    //conexao
    require_once ("controller/conectar_PDO.php");
    
    //
    require_once "model/PojoConfiguracaoSite.php";
    require_once "controller/DAOConfiguracaoSite.php";
    //
    require_once "model/PojoUsuario.php";
    require_once "controller/DAOUsuario.php";
    //
    require_once "model/PojoPostagemSimples.php";
    require_once "controller/DAOPostagemSimples.php";
    //
    require_once "model/PojoArtigos.php";
    require_once "controller/DAOArtigos.php";
    //
    require_once "model/PojoAgenda.php";
    require_once "controller/DAOAgenda.php";

    $DAOConfiguracaoSite = new DAOConfiguracaoSite();
    $ConfiguracaoDoSite = $DAOConfiguracaoSite->Buscar();

    $Tem_artigo = $ConfiguracaoDoSite->getArtigos();
    $Tem_galeria = $ConfiguracaoDoSite->getGaleria();
    $Tem_postagemSimples = $ConfiguracaoDoSite->getPostagemSimples();
    $Tem_agenda = $ConfiguracaoDoSite->getAgenda();

//====================================================
if (isset($_POST["salvar"])) {
  //instancia um novo objeto do pojoCdoSite
  $config = new PojoConfiguracaodoSite();
  
  //  
  @$VerArtigo;
  if (isset($_POST["verArtigo"])) {
        $VerArtigo = $_POST["verArtigo"];
    }
    if ($VerArtigo == "on")
        $VerArtigo = "0";
    else
        $VerArtigo = "1";
    //
    $config->setArtigos($VerArtigo);   
    
  //
  @$VerPostSimples; //= "";
  if (isset($_POST["verPostagem"])) {
  $VerPostSimples = $_POST["verPostagem"];
  }
  if ($VerPostSimples == "on")
  $VerPostSimples = "0";
  else
  $VerPostSimples = "1";
  
  $config->setPostagemSimples($VerPostSimples); 
   
  //
  @$VerAgenda; //= "";
  if (isset($_POST["verAgenda"])) {
  $VerAgenda = $_POST["verAgenda"];
  }
  if ($VerAgenda == "on")
  $VerAgenda = "0";
  else
  $VerAgenda = "1"; 

  $config->setAgenda($VerAgenda); 
  
  $up = $DAOConfiguracaoSite->editarView($config);
  if($up){
?>
    <div class="alert alert-success">Configurações alteradas com sucesso!</div>
<?php
 } else{
     ?>
     <div class="alert alert-warning">Nenhuma das Configurações foram alteradas!</div>
<?php 
     }
}
//===============================DADOS PARA ARTIGOS===========================================
//instanciando objeto DAOArtigo 
$DAOArtigos = new DAOArtigos();
//buscando método que está no objeto criado e jogando para variaveis os getters do PojoArtigo
$consultaArt = $DAOArtigos->Buscar();

foreach ($consultaArt as $linha){
    $pojoArtigo = $DAOArtigos->populaArtigos($linha);
    $tituloArtigo = $pojoArtigo->getTituloArtigo();
    //$DescricaoArtigo = $pojoArtigo->getDescricaoArtigo();
}

//================================DADOS PARA CONTAR ARTIGOS====================================
//Buscando o método contar linhas dos artigos;
$contarArtigos = $DAOArtigos->ConteArtigos();

//================================DADOS AGENDA==================================================
$DAOAgenda = new DAOAgenda();
 
$buscaAgenda = $DAOAgenda->Buscar();
//Pegando valores que está no Pojo e jogando numa variavel local $descricaoAgenda
foreach ($buscaAgenda as $linhaAgenda){
    $pojoAgn = $DAOAgenda->populaAgenda($linhaAgenda);
    $descAgenda = $pojoAgn->getDescricao();
    $dataHora = $pojoAgn->getDataHoraEvento($DataHoraEvento);
}
/*$DescricaoAgenda = $buscaAgenda->getDescricao();
 
$DataHoraEvento = $buscaAgenda->getDataHoraEvento();*/

?>
<form method="POST">
    <div class="floating">
        <div  class="panel panel-info" id="painelSite">
            <div class="panel-heading">O que você deseja mostrar no site?</div>
            <div class="panel-body">
                <div>
                    <ul class="list-group">
                        <li class="list-group-item"><input type="checkbox" name="verArtigo" <?php if ($Tem_artigo == "0") echo "checked"; ?>> Artigos</li>
                        <li class="list-group-item"><input type="checkbox" name="verPostagem" <?php if ($Tem_postagemSimples == "0") echo "checked"; ?>> Postagem Simples</li>
                        <li class="list-group-item"><input type="checkbox" name="verAgenda" <?php if ($Tem_agenda == "0") echo "checked"; ?>> Agenda</li>
                    </ul>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                    <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="floating">
        <div class="panel panel-success" id="painelRelatorio">
            <div class="panel-heading">Informações Artigos</div>
            <div class="panel-body">
                <div class="panel panel-success">
                    <div class="panel-heading">Publicados:
                        <ul class="list-group">
                            <li class="list-group-item"><?php echo $contarArtigos; ?></li>
                        </ul> 
                    </div>                    
                </div>
            </div>
            <div class="panel-body">
                <div class="panel panel-success">
                    <div  class="panel-heading">Último publicado:
                        <ul class="list-group">
                            <li id="publicado" class="list-group-item" ><?php echo $tituloArtigo; ?></li>
                        </ul>
                    </div>							
                </div>
            </div>
        </div>
    </div> 
    <div class="floating">
        <div class="panel panel-warning" id="painelAgenda">
            <div class="panel-heading">Seu último evento cadastrado foi:</div>        	
            <ul class="list-group">
                <li class="list-group-item"><?php echo $descAgenda; ?></li>
                <li class="list-group-item"><?php echo $dataHora; ?></li>
            </ul>  
            <div id="indexAgendaFooter"class="panel-footer"><a href="">Prev</a> || <a name="next" href="administracao.php?id='.$idAgenda.'">Next</a></div>
        </div>
    </div>
</form> 		

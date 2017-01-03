<?php
session_start();
?>

<!DOCTYPE html>
<!-- saved from url=(0043)http://getbootstrap.com/examples/jumbotron/ -->
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php
       //conexão
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
       
        $TituloDoSite = $ConfiguracaoDoSite->getTituloDoSite();
        $BannerPrincipal = $ConfiguracaoDoSite->getBannerPrincipal();
        $Tem_artigo = $ConfiguracaoDoSite->getArtigos();
        //$Tem_galeria = $ConfiguracaoDoSite->getGaleria();
        $Tem_postagemSimples = $ConfiguracaoDoSite->getPostagemSimples();
        $Tem_agenda = $ConfiguracaoDoSite->getAgenda();
        $textoRodape = $ConfiguracaoDoSite->getTextoRodape();
            
        if (isset($_POST["entrar"])){
		 $email = addslashes($_POST["usuario"]);
		 $senha = addslashes($_POST["senha"]);
		 
                 $DAOUsuario = new DAOUsuario();
                 $validarUser = $DAOUsuario->Validar($email,$senha);
                 
                 if($validarUser->getEmail() == NULL && $validarUser->getSenha() ==NULL){
               
                     echo "<div class='alert alert-danger'> Usuário ou senha - não existem ou inválidos!";
                     echo "</div>";
                 } else{
                    header("location:header.php");
                 }    		 
	}
      
    ?>
    <title><?php echo $TituloDoSite; ?></title>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="views/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">   
   
    <!--link para a font-awesome-->
    <link href="views/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   
    <!-- Alterações para o formulário -->
    <link href="views/css/blog.css" rel="stylesheet" type="text/css"/>
    
    <!-- Bootstrap core CSS -->
    <link href="views/css/bootstrap.min.css" rel="stylesheet">
   
    <!-- Barra de navegação -->
    <link href="views/css/justified-nav.css" rel="stylesheet" type="text/css"/>
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="views/css/ie10-viewport-bug-workaround.css" rel="stylesheet" type="text/css"/>
   
    <!-- Custom styles for this template -->
    <link href="views/css/jumbotron.css" rel="stylesheet" type="text/css"/>
    
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="views/js/ie-emulation-modes-warning.js.download"></script>
    
    <script src="views/js/ie10-viewport-bug-workaround.js" type="text/javascript"></script>
    <script src="views/js/ie10-viewport-bug-workaround.js" type="text/javascript"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://getbootstrap.com/examples/jumbotron/#"><?php echo $TituloDoSite; ?></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <form class="navbar-form navbar-right"  method="POST">
                    <div class="form-group">
                        <input type="text" placeholder="Email" name="usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Senha" name="senha" class="form-control">
                    </div>
                    <button type="submit" name="entrar" class="btn btn-success">Entrar</button>
                </form>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>
    <?php
    if($Tem_postagemSimples == "0"){//se tem postagem simples, mostra, caso contrario não mostrará}
        $DAOPSimples = new DAOPostagemSimples();
        $buscaPost = $DAOPSimples->Buscar();
        foreach($buscaPost as $linha){
            $pojoPost = $DAOPSimples->populaPostagem($linha);
            $descricaoPS = $pojoPost->getDescricao();
    ?>	
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <p><?php echo $descricaoPS ?></p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Ver mais...</a></p>
        </div>
    </div>
<?php
        }
    }
    if($Tem_artigo == "0"){//se tem artigo, mostra, caso contrario não mostrará}
        $DAOArtigo = new DAOArtigos();
        $buscaArtigo = $DAOArtigo->buscarComLimit();
        foreach ($buscaArtigo as $linha){
            $pojoArtigo = $DAOArtigo->populaArtigos($linha);
            $TituloArtigo = $pojoArtigo->getTituloArtigo();
            $DescricaoArtigo = $pojoArtigo->getDescricaoArtigo();
?>
    <div id="indexArtigo" class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-4">
                <h2><?php echo $TituloArtigo; ?></h2>
                <p><?php echo $DescricaoArtigo; ?></p>
                <p><a class="btn btn-default" href="#" role="button">Ver mais »</a></p>
            </div>
<?php
        }   
  }
   
if($Tem_agenda == "0"){
      
    $DAOAgenda = new DAOAgenda();
    //$buscaAgenda = $DAOAgenda->Buscar();
    
    $buscaAgenda = $DAOAgenda->buscarComLimit();
        foreach ($buscaAgenda as $linha){
            $pojoAgenda = $DAOAgenda->populaAgenda($linha);
            $idAgenda = $pojoAgenda->getIdAgenda();
            $descricaoEvento = $pojoAgenda->getDescricao();
            $dataHoraEvento = $pojoAgenda->getDataHoraEvento();
?>
                <div class="col-md-4">
                    <div class="panel panel-warning" id="indexAgenda">
                        <div class="panel-heading"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp; Agenda </div>
                        <ul class="list-group">
                            <li class="list-group-item"><?php echo $descricaoEvento; ?></li>
                            <li class="list-group-item"><?php echo $dataHoraEvento; ?></li>
                        </ul>  
                        <div id="indexAgendaFooter" class="panel-footer"><a href=""><< Prev</a> || <a href="">Next >> </a></div>
                    </div>
                </div>
    </div>
<?php
}
}
?>
        <hr>
        <footer id="footer">
            <p><?php echo utf8_encode($textoRodape); ?></p>
        </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript<script src="views/css/bootstrap.min.js.download"></script>
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="views/css/jquery.min.js.download"></script>
    <script>window.jQuery || document.write('<script src="views/css/jquery.min.js.download"><\/script>')</script>
    <script src="views/css/bootstrap.min.js.download"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="views/css/ie10-viewport-bug-workaround.js.download"></script>


</body></html>
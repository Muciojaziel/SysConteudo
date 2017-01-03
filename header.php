<?php
session_start();
ini_set('display_errors', 0); error_reporting(0);
?>

<!DOCTYPE html>
<!-- saved from url=(0048)http://getbootstrap.com/examples/justified-nav/# -->
<html lang="pt_br, pt-br, PT_BR"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php
        require_once ("controller/conectar_PDO.php");
        require_once "model/PojoConfiguracaoSite.php";
        require_once "controller/DAOConfiguracaoSite.php";
        require_once "model/PojoArtigos.php";
        require_once "controller/DAOArtigos.php";

        //instanciando objeto DAOArtigo //buscando e atribuindo busca a variaveis locais
        $DAOConfiguracaoSite = new DAOConfiguracaoSite();
        $ConfiguracaoDoSite = $DAOConfiguracaoSite->Buscar();
        $TituloDoSite = $ConfiguracaoDoSite->getTituloDoSite();
        $BannerPrincipal = $ConfiguracaoDoSite->getBannerPrincipal();
        $textoRodape = $ConfiguracaoDoSite->getTextoRodape();

        ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="http://getbootstrap.com/favicon.ico">

        <!--link para a font-awesome-->
        <link href="views/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <title>Painel Administrativo</title>
        <!-- Alterações para o formulário -->
        <link href="views/css/blog.css" rel="stylesheet" type="text/css"/>
        
        <!-- Bootstrap core CSS -->
        <link href="views/css/bootstrap.min.css" rel="stylesheet">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="views/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="views/css/justified-nav.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="views/css/ie-emulation-modes-warning.js.download"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <!-- The justified navigation menu is meant for single line per list item.
              Multiple lines will require custom code not provided by Bootstrap. -->
            <div class="masthead">
                <h3 class="text-muted"><?php echo $TituloDoSite ?></h3>
                <nav>
                    <ul class="nav nav-justified">
                        <li class="active"><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i>&nbsp; Home</a></li>
                        <li><a href="header.php?pag=administracao.php"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp; Administração</a></li>
                        <li><a href="header.php?pag=artigos.php"><i class="fa fa-book" aria-hidden="true"></i>&nbsp; Artigos</a></li>
                        <li><a href="header.php?pag=postagemsimples.php"><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp; Postagem simples</a></li>
                        <li><a href="header.php?pag=agenda.php"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp; Agenda</a></li>
                        <li><a href="header.php?pag=suporte.php"><i class="fa fa-life-ring" aria-hidden="true"></i>&nbsp; Suporte Sistema</a></li>
                    </ul>
                </nav>
            </div>
        </div>         
        </br>
        </br>
        <div class="container">
                 <?php
            if (isset($_GET["pag"])) {
                require_once($_GET["pag"]);
            } else {
                ?>
                <div class="starter-template" align="center">
                    <h2>PAINEL GERENCIADOR</h2>
                    <p class="lead">Área restrita do administrator. Aqui você gerencia informações em seu site.</p>
                </div>
                <?php
            }
            ?>
        </div>
        <!-- Site footer -->
        <footer class="footer">
            <p><?php echo $textoRodape ?></p>
        </footer>
    </div> <!-- /container -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="index/ie10-viewport-bug-workaround.js.download"></script>
</body></html>
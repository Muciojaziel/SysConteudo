<?php
        require_once ("controller/conectar_PDO.php");
        require_once "model/PojoArtigos.php";
        require_once "controller/DAOArtigos.php";

        //instanciando objeto DAOArtigo //buscando e atribuindo busca a variaveis locais
        $DAOArtigos = new DAOArtigos();

            if (isset($_GET["tp"])) {
                //Vindo por GET
                if ($_GET["tp"] == "editar") {
                    //pega o Id
                    $id = $_GET["id"];

                    //Pega o método de $DAOArtigos que já ta instanciado na página
                    $SelecionarId = $DAOArtigos->buscarPorId($id);

                    //Testa se existe valor usando o método ou buscando por ele getidartigos
                    if ($SelecionarId->getidArtigos() == NULL) {
                        echo "<div class='alert alert-danger'>Erro: Não existe valor no Id selecionado " . $SelecionarId->getidArtigos() . "</div>";
                    } else {
                        // se existir valor, vai armazenar nas variaveis abaixo
                        $cmpTituloArtigo = $SelecionarId->getTituloArtigo();
                        $cmpDescricaoArtigo = $SelecionarId->getDescricaoArtigo();
                    }
                }
                //Vindo por POST
                if (isset($_POST["salvar"])) {
                    //se o usuário clicar em salvar, os valores virão por post do form, e pega os campos e armazena numa var e a Id tbm
                    $tituloArticle = $_POST['titulo'];
                    $descricaoArticle = $_POST['artigotexto'];
                    $id = $_POST["id"];

                    /* testa as variaveis pra retornar true ( se as variaveis tem valor) e deve ser true! 
                     * poderia usar o @ aqui pra sobrescrever caso seja false!
                     */
                    if (!empty($tituloArticle) && !empty($descricaoArticle)) {

                        //Instanciando o objeto de pojoartigos
                        $editarArticle = new PojoArtigos();
                        /* pegando os métodos que vem de pojoartigos com $editarArticle e passando as variaveis setadas pra pojo
                         * lá no DAOArtigos ele vai instanciar um objeto e pegar via Getter do pojoartigo 
                         * instanciado (tem um método lá populaartigos pra isso) */
                        $editarArticle->setTituloArtigo($tituloArticle);
                        $editarArticle->setDescricaoArtigo($descricaoArticle);
                        $editarArticle->setidArtigos($id);

                        //chamar o método EDITAR de DAOARTIGOS
                        $update = $DAOArtigos->Editar($editarArticle);
                        //Testa SE $update foi setado e mostra mensagem
                        if ($update) {
                            ?>
                            <div class="alert alert-success">Artigo de número <?php echo $id; ?> ATUALIZADO com sucesso!</div>
                            <?php
                        } else {
                            ?>
                            <div class="alert alert-danger">Erro: <?php echo $update; ?></div>
                            <?php
                        }
                    }
                }
            } else if (isset($_POST["salvar"])) { //se nenhuma condição aceita funcionar o fluxo é direcionado pra cá e pega
                //atribui as variaveis vindo do form por POST
                $InsTitulo = addslashes($_POST["titulo"]);
                $InsArtigo = addslashes($_POST["artigotexto"]);
                //echo "<br/>";
                //testa se as var estão setadas
                if (!empty($InsTitulo) && !empty($InsArtigo)) {
                    //instancia objeto de pojoartigos
                    $inserirArtigo = new PojoArtigos();

                    //pega os métodos vindos do pojoartigos
                    $inserirArtigo->setTituloArtigo($InsTitulo);
                    $inserirArtigo->setDescricaoArtigo($InsArtigo);

                    //usa o método de daoartigos pra inserir as variaveis
                    $insert = $DAOArtigos->Inserir($inserirArtigo);

                    //Testa SE $insert foi setado e mostra mensagem!
                    if ($insert) {
                        ?>
                        <div class="alert alert-success">Artigo de número INSERIDO com sucesso!</div>
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-danger">Erro: <?php echo $insert; ?></div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-danger">
                        Para salvar, Os campos TÍTULO e DESCRIÇÃO não podem estar vazios!
                    </div>
        <?php
    }
}
/* Instrução DELETE pode ficar isolado irá respeitar o fluxo,
 * o simbolo @ sobreescreve a variavel caso ela nao tenha valor inicial e passa pra
 * a próxima instrução abaixo!
 */
if (@$_GET["tp"] == NULL) {
//Acima faço a negação da variavel TP, caso contrário quando clico em 
//Editar ele deleta, pq ID tbm terá valor e a condição tbm será aceita, nesse caso deletando!
//Conta pra ver se tem artigos é um método o objeto já instanciado vindo de DAOArtigos
        $contarArtigos = $DAOArtigos->ConteArtigos();
         if ($contarArtigos == NULL) {
            ?>
                        <div class="alert alert-warning">
                        <?php echo "Não existe artigos Cadastrados! Insira artigo e clique em salvar"; ?>
                        </div>
                            <?php
                        } else {
                            
                            if (isset($_GET["id"])) {
                                $id = $_GET["id"];
                                //instancia objeto de pojoartigos
                                $deletarArtigos = new PojoArtigos();

                                //usa método do pojo pra passar a id setando-a
                                $deletarArtigos->setidArtigos($id);

                                //usa objeto ja instanciado DAOArtigos com método deletar - passando a variavel pra deletar
                                $deletar = $DAOArtigos->Deletar($deletarArtigos);
                                if ($deletar) {
                            ?>
                            <div class="alert alert-success">Artigo de número <?php echo $id; ?> DELETADO com sucesso!</div>
                            <?php
                        } else {
                            ?>
                            <div class="alert alert-danger">Erro: <?php echo $deletar; ?></div>
                            <?php
                        }
                                //redireciona o fluxo da página e atualiza pois o get só funciona após o up da página!
                               // echo "<script>location.href='artigos.php';</script>";
                             //   exit;
                            }
                        }
                    }
                
                ?>      
            <div>
                <form method="POST" >
                    <div class="form-group">
                        <label for="exampleTextarea">Insira o título do seu Artigo (Título):</label>
                        <input class="form-control" name="titulo" value="<?php echo @$cmpTituloArtigo; ?>"></br>
                        <label for="exampleTextarea">Escreva seu Artigo (Descrição):</label>
                        <textarea class="form-control" name="artigotexto" id="ps" rows="3" ><?php echo @$cmpDescricaoArtigo; ?></textarea>
                    </div>
                    <input type="hidden" name="id" value="<?php echo @$id; ?>"/>
                    <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
                </form>
            </div>
<?php ?>
            <br/>    
            </br>
            <div class="panel panel-success">
                <!-- Default panel contents -->
                <div class="panel-heading">Últimas Postagens</div>
                <div class="panel-body">
                    <!--Table-->
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>Título do Artigo</td>
                            <td>Conteúdo</td>
                            <td>Gerenciar Artigo</td>
                        </tr>
<?php
//chamando o método que vai mandar para o POJO e de lá recupero a informação com os Getters abaixo
$buscar = $DAOArtigos->Buscar();

//faz busca e atribui a $lista
foreach ($buscar as $lista) {
    $PojoArtigo = $DAOArtigos->populaArtigos($lista);
    ?>
                            <tr>
                                <td><?php echo $PojoArtigo->getidArtigos(); ?></td>
                                <td><?php echo $PojoArtigo->getTituloArtigo(); ?></td>
                                <td><?php echo $PojoArtigo->getDescricaoArtigo(); ?></td>
                                <td>
                                    <a href="header.php?pag=artigos.php&id=<?= $PojoArtigo->getidArtigos(); ?>&tp=editar">Editar</a> ||
                                    <a href="header.php?pag=artigos.php&id=<?= $PojoArtigo->getidArtigos(); ?>">Deletar</a></td>
                            </tr>
<?php } ?>
                    </table>
                </div>
            </div>

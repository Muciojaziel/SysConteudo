<?php
        require_once ("controller/conectar_PDO.php");
        require_once "model/PojoPostagemSimples.php";
        require_once "controller/DAOPostagemSimples.php";

        //instanciando objeto DAOArtigo //buscando e atribuindo busca a variaveis locais
        $DAOpostSimples = new DAOPostagemSimples();

            if (isset($_GET["tp"])) {
                //Vindo por GET
                if ($_GET["tp"] == "editar") {
                    //pega o Id
                    $id = $_GET["id"];

                    //Pega o método de $DAOArtigos que já ta instanciado na página
                    $SelecionarId = $DAOpostSimples->buscarPorId($id);

                    //Testa se existe valor usando o método ou buscando por ele getidartigos
                    if ($SelecionarId->getIdPostagem() == NULL) {
                        echo "<div class='alert alert-danger'>Erro: Não existe valor no Id selecionado " . $SelecionarId->getIdPostagem() . "</div>";
                    } else {
                        // se existir valor, vai armazenar nas variaveis abaixo
                        $cmpDescricao = $SelecionarId->getDescricao();
                    }
                }
                //Vindo por POST
                if (isset($_POST["salvar"])) {
                    //se o usuário clicar em salvar, os valores virão por post do form, e pega os campos e armazena numa var e a Id tbm
                    $descricaoPostagem = $_POST['descricaotexto'];
                    $id = $_POST["id"];

                    /* testa as variaveis pra retornar true ( se as variaveis tem valor) e deve ser true! 
                     * poderia usar o @ aqui pra sobrescrever caso seja false!
                     */
                    if (!empty($descricaoPostagem)) {

                        //Instanciando o objeto de pojoartigos
                        $editarPostagem = new PojoPostagemSimples();
                        /* pegando os métodos que vem de pojoartigos com $editarArticle e passando as variaveis setadas pra pojo
                         * lá no DAOArtigos ele vai instanciar um objeto e pegar via Getter do pojoartigo 
                         * instanciado (tem um método lá populaartigos pra isso) */
                        $editarPostagem->setDescricao($descricaoPostagem);
                        $editarPostagem->setIdPostagem($id);

                        //chamar o método EDITAR de DAOARTIGOS
                        $update = $DAOpostSimples->Editar($editarPostagem);
                        //Testa SE $update foi setado e mostra mensagem
                        if ($update) {
                            ?>
                            <div class="alert alert-success">Postagem de número <?php echo $id; ?> ATUALIZADA com sucesso!</div>
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
                $InsDescricao = addslashes($_POST["descricaotexto"]);
                //echo "<br/>";
                //testa se as var estão setadas
                if (!empty($InsDescricao)) {
                    //instancia objeto de pojoartigos
                    $inserirPostagem = new PojoPostagemSimples();

                    //pega os métodos vindos do pojoPostagemsimples
                    $inserirPostagem->setDescricao($InsDescricao);

                    //usa o método de daoartigos pra inserir as variaveis
                    $insert = $DAOpostSimples->Inserir($inserirPostagem);

                    //Testa SE $insert foi setado e mostra mensagem!
                    if ($insert) {
                        ?>
                        <div class="alert alert-success">Postagem Simples INSERIDA com sucesso!</div>
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-danger">Erro: <?php echo $insert; ?></div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-danger">
                        Para salvar, O campo DESCRIÇÃO não podem estar vazio!
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

        //Conta pra ver se tem postagem é um método o objeto já instanciado vindo de DAOArtigos
        $contarPost = $DAOpostSimples->contePostagem();
        
//Primeiro testa pra ver se tem algo na base de dados, se tiver passa o fluxo pra receber o ID vindo por GET deleta e atualiza a página
        if ($contarPost == NULL) {
            ?>
                        <div class="alert alert-warning">
                        <?php echo "Não existe postagens Cadastradas! Insira postagem e clique em salvar"; ?>
                        </div>
                            <?php
                        } else {
                            if (isset($_GET["id"])) {
                                $id = $_GET["id"];
                                //instancia objeto de pojopostagemsimples
                                $deletarPost = new PojoPostagemSimples();

                                //usa método do pojo pra passar a id setando-a
                                $deletarPost->setIdpostagem($id);

                                //usa objeto ja instanciado DAOPostagem com método deletar - passando a variavel pra deletar
                                $deletar = $DAOpostSimples->Deletar($deletarPost);
                                if ($deletar) {
                            ?>
                            <div class="alert alert-success">Postagem de número <?php echo $id; ?> DELETADA com sucesso!</div>
                            <?php
                        } else {
                            ?>
                            <div class="alert alert-danger">Erro: <?php echo $deletar; ?></div>
                            <?php
                        }
                                //redireciona o fluxo da página e atualiza pois o get só funciona após o up da página!
                               // echo "<script>location.href='header.php?pag=postagemsimples.php';</script>";
                             //   exit;
                            }
                        }
                    }
                
                ?>      
            <div>
                <form method="POST" >
                    <div class="form-group">
                        <label for="exampleTextarea">Escreva sua Postagem (Descrição):</label>
                        <textarea class="form-control" name="descricaotexto" id="ps" rows="3" ><?php echo @$cmpDescricao; ?></textarea>
                    </div>
                    <input type="hidden" name="id" value="<?php echo @$id; ?>"/>
                    <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
                </form>
            </div>
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
                            <td>Conteúdo</td>
                            <td>Gerenciar Postagem</td>
                        </tr>
<?php
//chamando o método que vai mandar para o POJO e de lá recupero a informação com os Getters abaixo
$buscar = $DAOpostSimples->Buscar();

//faz busca e atribui a $lista
foreach ($buscar as $lista) {
    $PojoPostagem = $DAOpostSimples->populaPostagem($lista);
    ?>
                            <tr>
                                <td><?php echo $PojoPostagem->getIdPostagem(); ?></td>
                                <td><?php echo $PojoPostagem->getDescricao(); ?></td>
                                <td>
                                    <a href="header.php?pag=postagemsimples.php&id=<?= $PojoPostagem->getIdPostagem(); ?>&tp=editar">Editar</a> ||
                                    <a href="header.php?pag=postagemsimples.php&id=<?= $PojoPostagem->getIdPostagem(); ?>">Deletar</a></td>
                            </tr>
<?php } ?>
                    </table>
                </div>
            </div>

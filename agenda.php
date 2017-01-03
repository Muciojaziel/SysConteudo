<?php
    require_once ("controller/conectar_PDO.php");
    require_once "model/PojoAgenda.php";
    require_once "controller/DAOAgenda.php";

        //instanciando objeto DAOAgenda //buscando e atribuindo busca a variaveis locais
        $DAOAgenda = new DAOAgenda();

            if (isset($_GET["tp"])) {
                //Vindo por GET
                if ($_GET["tp"] == "editar") {
                    //pega o Id
                    $id = $_GET["id"];

                    //Pega o método de $DAOAgenda que já ta instanciado na página
                    $SelecionarId = $DAOAgenda->buscarPorId($id);

                    //Testa se existe valor usando o método ou buscando por ele getidartigos
                    if ($SelecionarId->getIdAgenda() == NULL) {
                        echo "<div class='alert alert-danger'>Erro: Não existe valor no Id selecionado " . $SelecionarId->getIdAgenda() . "</div>";
                    } else {
                        // se existir valor, vai armazenar nas variaveis abaixo
                        $cmpDescricaoAgenda = $SelecionarId->getDescricao();
                    }
                }
                //Vindo por POST
                if (isset($_POST["salvar"])) {
                    //se o usuário clicar em salvar, os valores virão por post do form, e pega os campos e armazena numa var e a Id tbm
                    $data = $_POST['dataHora'];
                    $descricao = $_POST['descricaotexto'];
                    $id = $_POST["id"];

                    /* testa as variaveis pra retornar true ( se as variaveis tem valor) e deve ser true! 
                     * poderia usar o @ aqui pra sobrescrever caso seja false!
                     */
                    if (!empty($data) && !empty($descricao)) {

                        //Instanciando o objeto de pojoartigos
                        $editarAgenda = new PojoAgenda();
                        /* pegando os métodos que vem de pojoartigos com $editarArticle e passando as variaveis setadas pra pojo
                         * lá no DAOArtigos ele vai instanciar um objeto e pegar via Getter do pojoartigo 
                         * instanciado (tem um método lá populaartigos pra isso) */
                        $editarAgenda->setDataHoraEvento($data);
                        $editarAgenda->setDescricao($descricao);
                        $editarAgenda->setIdAgenda($id);

                        //chamar o método EDITAR de DAOARTIGOS
                        $update = $DAOAgenda->Editar($editarAgenda);
                        //Testa SE $update foi setado e mostra mensagem
                        if ($update) {
                            ?>
                            <div class="alert alert-success">Agendamento de número <?php echo $id; ?> ATUALIZADO com sucesso!</div>
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
                $InsDtHora = addslashes($_POST["dataHora"]);
                $InsAgenda = addslashes($_POST["descricaotexto"]);
                //echo "<br/>";
                //testa se as var estão setadas
                if (!empty($InsAgenda)) {
                    //instancia objeto de pojoartigos
                    $inserirAgenda = new PojoAgenda();

                    //pega os métodos vindos do pojoagenda
                    $inserirAgenda->setDescricao($InsAgenda);
                    $inserirAgenda->setDataHoraEvento($InsDtHora);

                    //usa o método de daoartigos pra inserir as variaveis
                    $insert = $DAOAgenda->Inserir($inserirAgenda);

                    //Testa SE $insert foi setado e mostra mensagem!
                    if ($insert) {
                        ?>
                        <div class="alert alert-success">Agendamento feito com com sucesso!</div>
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
 //Conta pra ver se tem artigos é um método o objeto já instanciado vindo de DAOArtigos
        $contarAgenda = $DAOAgenda->conteAgenda();

//Primeiro testa pra ver se tem algo na base de dados, se tiver passa o fluxo pra receber o ID vindo por GET deleta e atualiza a página
        if ($contarAgenda == NULL) {
            ?>
                        <div class="alert alert-warning">
                        <?php echo "Não existe agendamentos Cadastrados! Insira um agendamento e clique em salvar"; ?>
                        </div>
                            <?php
                        } else {
                            if (isset($_GET["id"])) {
                                $id = $_GET["id"];
                                //instancia objeto de pojoartigos
                                $deletarAgenda = new PojoAgenda();

                                //usa método do pojo pra passar a id setando-a
                                $deletarAgenda->setIdAgenda($id);

                                //usa objeto ja instanciado DAOArtigos com método deletar - passando a variavel pra deletar
                                $deletar = $DAOAgenda->Deletar($deletarAgenda);
                                if ($deletar) {
                            ?>
                            <div class="alert alert-success">Agendamento de número <?php echo $id; ?> DELETADO com sucesso!</div>
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
                        <label for="exampleTextarea">Data e Hora:</label>
                        <input  type="datetime-local" class="form-control" name="dataHora" value="<?php echo @$cmpDataHora; ?>"/>
                        <label for="exampleTextarea">Faça seu Agendamento(Descrição):</label>
                        <textarea class="form-control" name="descricaotexto" id="ps" rows="3" ><?php echo @$cmpDescricaoAgenda; ?></textarea>
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
                            <td>Descrição</td>
                            <td>Gerenciar Agenda</td>
                        </tr>
<?php
//chamando o método que vai mandar para o POJO e de lá recupero a informação com os Getters abaixo
$buscar = $DAOAgenda->Buscar();

//faz busca e atribui a $lista
foreach ($buscar as $lista) {
    $PojoAgenda = $DAOAgenda->populaAgenda($lista);
    ?>
                            <tr>
                                <td><?php echo $PojoAgenda->getIdAgenda(); ?></td>
                                <td><?php echo $PojoAgenda->getDescricao(); ?></td>
                                <td>
                                    <a href="header.php?pag=agenda.php&id=<?= $PojoAgenda->getIdAgenda(); ?>&tp=editar">Editar</a> ||
                                    <a href="header.php?pag=agenda.php&id=<?= $PojoAgenda->getIdAgenda(); ?>">Deletar</a></td>
                            </tr>
<?php } ?>
                    </table>
                </div>
            </div>

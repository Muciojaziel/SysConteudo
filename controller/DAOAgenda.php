<?php

class DAOAgenda {

    public static $instance;

    public function __construct() {
        // 
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new DAOAgenda();
        return self::$instance;
    }

    //
    public function Editar(PojoAgenda $agenda) {
        try {
            $sql = "UPDATE agenda SET Descricao = :descricao, DataHoraEvento=:DataHoraEvento WHERE idAgenda=:idAgenda";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":idAgenda", $agenda->getIdAgenda());
            $p_sql->bindValue(":descricao", $agenda->getDescricao());
            $p_sql->bindValue(":DataHoraEvento", $agenda->getDataHoraEvento());

            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOConfiguracaoSite-Editar";
        }
    }

    public function Buscar() {
        try {
            $sql = "SELECT * FROM agenda";

            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();
            return $linha = $p_sql->fetchAll();
            //return $this->populaAgenda($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOAgenda-Editar";
        }
    }

    public function buscarComLimit() {
        try {
            $sql = "SELECT * FROM agenda ORDER BY DataHoraEvento DESC LIMIT 2";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();

            return $linha = $p_sql->fetchAll();
            // return $this->populaArtigos($p_sql->fetch(PDO::FETCH_ASSOC));
            // print_r($linha);
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOArtigos-Buscar";
        }
    }

    public function buscarPorId($idAgenda) {
        try {
            $sql = "SELECT * FROM agenda WHERE idAgenda=:idAgenda";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":idAgenda", $idAgenda);

            $p_sql->execute();

            //return $linha = $p_sql->fetchAll();
            return $this->populaAgenda($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOArtigos-Buscar Por ID";
        }
    }

    public function conteAgenda() {
        try {
            $sql = "SELECT * FROM agenda";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();
            $count = $p_sql->rowCount();

            return $count;
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOArtigos-ConteArtigos";
        }
    }

    public function Inserir(PojoAgenda $agenda) {
        try {
            $sql = "INSERT INTO agenda(Descricao) VALUES (:Descricao)";
            $p_sql = conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":Descricao", $agenda->getDescricao());
           
            return $p_sql->execute();

            // return $this->populaArtigos($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar inserir dados no Banco de dados, tente novamente. DAOArtigos-Inserir";
        }
    }

    public function Deletar(PojoAgenda $agenda) {
        try {

            $sql = "DELETE FROM agenda WHERE idAgenda = :idAgenda";
            $p_sql = conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":idAgenda", $agenda->getIdAgenda());
            return $p_sql->execute();
            //return $this->populaArtigos($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar DELETAR do Banco de dados, tente novamente. DAOArtigos-Deletar";
        }
    }

    public function populaAgenda($row) {
        $pojo = new PojoAgenda();
        $pojo->setIdAgenda($row['idAgenda']);
        $pojo->setDescricao($row['Descricao']);
        $pojo->setDataHoraEvento($row['DataHoraEvento']);
        
        return $pojo;
    }

}

?>
<?php

class DAOArtigos {

    public static $instance;

    public function __construct() {
        // 
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new DAOArtigos();
        return self::$instance;
    }

    public function Editar(PojoArtigos $Artigos) {
        try {
            $sql = "UPDATE artigos SET TituloArtigo= :TituloArtigo, DescricaoArtigo= :DescricaoArtigo,  DataHoraPublicacao= :DataHoraPublicacao, Comentarios= :Comentarios WHERE idArtigos=:idArtigos";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":idArtigos", $Artigos->getidArtigos());
            $p_sql->bindValue(":TituloArtigo", $Artigos->getTituloArtigo());
            $p_sql->bindValue(":DescricaoArtigo", $Artigos->getDescricaoArtigo());
            $p_sql->bindValue(":DataHoraPublicacao", $Artigos->getDataHoraPublicacao());
            $p_sql->bindValue(":Comentarios", $Artigos->getComentarios());
            //
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOArtigos-Editar";
        }
    }

    public function Buscar() {
        try {
            $sql = "SELECT * FROM artigos";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();    
            
            return $linha = $p_sql->fetchAll();
           // return $this->populaArtigos($p_sql->fetch(PDO::FETCH_ASSOC));
          // print_r($linha);
          } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOArtigos-Buscar";
        }
    }
    public function buscarComLimit() {
        try {
            $sql = "SELECT * FROM artigos ORDER BY DataHoraPublicacao DESC LIMIT 2";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();    
            
            return $linha = $p_sql->fetchAll();
           // return $this->populaArtigos($p_sql->fetch(PDO::FETCH_ASSOC));
          // print_r($linha);
          } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOArtigos-Buscar";
        }
    }
    
    public function buscarPorId($idArtigos) {
        try {
            $sql = "SELECT * FROM artigos WHERE idArtigos=:idArtigos";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":idArtigos", $idArtigos);
           
            $p_sql->execute();    
            
           //return $linha = $p_sql->fetchAll();
           return $this->populaArtigos($p_sql->fetch(PDO::FETCH_ASSOC));
            
          } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOArtigos-Buscar Por ID";
        }
    }
    
    public function ConteArtigos() {
        try {
            $sql = "SELECT * FROM artigos";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();
            $count = $p_sql->rowCount();
            
            return $count;
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOArtigos-ConteArtigos";
        }
    }
    
    public function Inserir(PojoArtigos $artigos) {
        try {
            $sql = "INSERT INTO artigos (TituloArtigo, DescricaoArtigo) VALUES (:TituloArtigo, :DescricaoArtigo)";
            $p_sql = conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":TituloArtigo", $artigos->getTituloArtigo());
            $p_sql->bindValue(":DescricaoArtigo", $artigos->getDescricaoArtigo());
            //$p_sql->bindValue(":Comentarios", $Artigos->getComentarios());Comentarios= :Comentarios
             return $p_sql->execute();

           // return $this->populaArtigos($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar inserir dados no Banco de dados, tente novamente. DAOArtigos-Inserir";
        }
    }

    public function Deletar(PojoArtigos $artigos) {
        try {
            
            $sql = "DELETE FROM artigos WHERE idArtigos = :idArtigos";
            $p_sql = conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":idArtigos", $artigos->getidArtigos());
            
            return $p_sql->execute();
            //return $this->populaArtigos($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar DELETAR do Banco de dados, tente novamente. DAOArtigos-Deletar";
        }
    }

    public function populaArtigos($row) {
        $pojo = new PojoArtigos();
        $pojo->setidArtigos($row['idArtigos']);
        $pojo->setTituloArtigo($row['TituloArtigo']);
        $pojo->setDescricaoArtigo($row['DescricaoArtigo']);
        $pojo->setDataHoraPublicacao($row['DataHoraPublicacao']);
        $pojo->setComentarios($row['Comentarios']);

        return $pojo;
       
    }
}

?>
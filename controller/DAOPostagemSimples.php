<?php

class DAOPostagemSimples {

    public static $instance;
    public function __construct() {
        // 
    }

    public static function getInstance() 
    {
        if (!isset(self::$instance))
            self::$instance = new DAOPostagemSimples();
        return self::$instance;
    }

    //
    public function Editar(PojoPostagemSimples $postagemsimples) 
    {
        try {
            $sql = "UPDATE postagemsimples SET Descricao= :Descricao, dataHoraPostagem= :DataHoraPostagem WHERE idPostagem= :idPostagem";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":idPostagem", $postagemsimples->getIdPostagem());
            $p_sql->bindValue(":Descricao", $postagemsimples->getDescricao());
            $p_sql->bindValue(":DataHoraPostagem", $postagemsimples->getDataHoraPostagem());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente! - DAOPostagem - Editar";
        }
    }
   
    public function Deletar(PojoPostagemSimples $postagem) {
        try {
            
            $sql = "DELETE FROM postagemsimples WHERE idPostagem = :idPostagem";
            $p_sql = conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":idPostagem", $postagem->getIdPostagem());
            
            return $p_sql->execute();
            //return $this->populaArtigos($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar DELETAR do Banco de dados, tente novamente. DAOPostagem-Deletar";
        }
    }
    
    public function Buscar() {
        try {
            $sql = "SELECT * FROM postagemsimples";

            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();
            return $linha=$p_sql->fetchAll();
            //return $this->populaPostagem($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente!";
        }
    }
    
    public function buscarComLimit() {
        try {
            $sql = "SELECT * FROM agenda ORDER BY dataHoraEvento DESC LIMIT 2";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();    
            
            return $linha = $p_sql->fetchAll();
           // return $this->populaArtigos($p_sql->fetch(PDO::FETCH_ASSOC));
          // print_r($linha);
          } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOPostagem-Buscar";
        }
    }
    
    public function buscarPorId($idPostagem) {
        try {
            $sql = "SELECT * FROM postagemsimples WHERE idPostagem=:idPostagem";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":idPostagem", $idPostagem);
           
            $p_sql->execute();    
            
           //return $linha = $p_sql->fetchAll();
           return $this->populaPostagem($p_sql->fetch(PDO::FETCH_ASSOC));
            
          } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOPostagem-Buscar Por ID";
        }
    }
   
    public function Inserir(PojoPostagemSimples $postagem) {
        try {
            $sql = "INSERT INTO postagemsimples (Descricao) VALUES (:DescricaoPostagem)";
            $p_sql = conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":DescricaoPostagem", $postagem->getDescricao());
            
             return $p_sql->execute();

           // return $this->populaArtigos($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar inserir dados no Banco de dados, tente novamente. DAOPostagem-Inserir";
        }
    }
    
     public function contePostagem() {
        try {
            $sql = "SELECT * FROM postagemsimples";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();
            $count = $p_sql->rowCount();
            
            return $count;
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOPostagem-ContePostagem";
        }
    }
    
    public function populaPostagem($row) {
        $pojo = new PojoPostagemSimples();
        $pojo->setIdpostagem($row['idPostagem']);
        $pojo->setDescricao($row['Descricao']);
        $pojo->setDataHoraPostagem($row['dataHoraPostagem']);
        
        return $pojo;
    }

}

?>
<?php

class DAOUsuario {

    public static $instance;

    public function __construct() {
        // 
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new DAOUsuario();
        return self::$instance;
    }

    //
    public function Editar(PojoUsuario $Usuario) {
        try {
            $sql = "UPDATE artigos SET idUsuario = :idUsuarios, email = :email, senha= :senha,  NomeUsuario= :Nomeusuario, SobrenomeUsuario = :SobrenomeUsuario, DataNascimento = :DataNascimento, Idade = :Idade, cidade = :cidade";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":email", $Usuario->getEmail());
            $p_sql->bindValue(":senha", $Usuario->getSenha());
            $p_sql->bindValue(":NomeUsuario", $Usuario->getNomeUsuario());
            $p_sql->bindValue(":SobrenomeUsuario", $Usuario->getSobrenomeUsuario());
            $p_sql->bindValue(":DataNascimento", $Usuario->getDataNascimento());
            $p_sql->bindValue(":Idade", $Usuario->getIdade());
            $p_sql->bindValue(":cidade", $Usuario->getCidade());
            //
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOArtigos-Editar";
        }
    }
    
    public function Buscar() {
        try {
            $sql = "SELECT * FROM usuarios";

            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();
            //
            return $this->populaUsuarios($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOArtigos-Buscar";
        }
    }
    
    public function BuscarPorEmail($email)
    {
        try {
            $sql   = "SELECT * FROM usuarios WHERE email = :email";
			
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":email", $email);
            $p_sql->execute();
            return $this->populaUsuario($p_sql->fetch(PDO::FETCH_ASSOC));
        }
        catch (Exception $e) {
             echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOUsuario";
          
        }
    }
	
    public function Validar($email, $senha){
        try{
            $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
            
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":email", $email);    
            $p_sql->bindValue(":senha", $senha);
            $p_sql->execute();
            return $this->populaUsuario($p_sql->fetch(PDO::FETCH_ASSOC));
           
        } catch (Exception $e) {
            echo "ocorreu um erro! tente novamente!";
        }
        
    }
    
    public function populaUsuario($row){
        
        $pojo = new PojoUsuario();
        $pojo->setIdUsuario($row['idUsuarios']);
        $pojo->setEmail($row['email']);
        $pojo->setSenha($row['senha']);
        $pojo->setNomeusuario($row['NomeUsuario']);
        $pojo->setSobrenomeUsuario($row['SobrenomeUsuario']);
        $pojo->setDataNascimento($row['DataNascimento']);
        $pojo->setIdade($row['Idade']);
        $pojo->setCidade($row['cidade']);
        return $pojo;
    }
    
}

?>
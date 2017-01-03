<?php

class DAOConfiguracaoSite {

    public static $instance;
    public function __construct() {
        // 
    }

    public static function getInstance() 
    {
        if (!isset(self::$instance))
            self::$instance = new DAOConfiguracaoSite();
        return self::$instance;
    }

    //
    public function Editar(PojoConfiguracaodoSite $configuracaosite) 
    {
        try {
            $sql = "UPDATE configuracaodosite SET TituloDoSite = :TituloDoSite, BannerPrincipal= :BannerPrincipal, textoRodape= :textoRodape";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":TituloDoSite", $configuracaosite->getTituloDoSite());
            $p_sql->bindValue(":BannerPrincipal", $configuracaosite->getBannerPrincipal());
            $p_sql->bindValue(":textoRodape", $configuracaosite->getTextoRodape());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOConfiguracaoSite-Editar";
        }
    }
    
     public function editarView(PojoConfiguracaodoSite $configuracaosite) 
    {
        try {
            $sql = "UPDATE configuracaodosite SET artigos= :artigos,  galeria = :galeria, postagemsimples = :postagemsimples, agenda= :agenda";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":artigos", $configuracaosite->getArtigos());
            $p_sql->bindValue(":galeria", $configuracaosite->getGaleria());
            $p_sql->bindValue(":postagemsimples", $configuracaosite->getPostagemSimples());
            $p_sql->bindValue(":agenda", $configuracaosite->getAgenda());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOConfiguracaoSite-Editar";
        }
    }
    
    public function Buscar() {
        try {
            $sql = "SELECT * FROM configuracaodosite";

            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();
            return $this->populaConfiguracaoSite($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. DAOConfiguracaoSite-Editar";
        }
    }

    private function populaConfiguracaoSite($row) {
        $pojo = new PojoConfiguracaodoSite();
        $pojo->setTituloDoSite($row['TituloDoSite']);
        $pojo->setBannerPrincipal($row['BannerPrincipal']);
        $pojo->setArtigos($row['artigos']);
        $pojo->setGaleria($row['galeria']);
        $pojo->setPostagemSimples($row['postagemsimples']);
        $pojo->setAgenda($row['agenda']);
        $pojo->setTextoRodape($row['textoRodape']);
        return $pojo;
    }

}

?>
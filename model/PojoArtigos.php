<?php

class PojoArtigos {

    private $idArtigos;
    private $TituloArtigos;
    private $DescricaoArtigo;
    private $DataHoraPublicacao;
    private $Comentarios;
   

    public function getidArtigos() {
        return $this->idArtigos;
    }
    public function setidArtigos($idArtigos) {
        $this->idArtigos = $idArtigos;
    }

    public function getTituloArtigo() {
        return $this->TituloArtigos;
    }
    public function setTituloArtigo($TituloArtigos) {
        $this->TituloArtigos = $TituloArtigos;
    }

    public function getDescricaoArtigo() {
        return $this->DescricaoArtigo;
    }
    public function setDescricaoArtigo($DescricaoArtigo) {
        $this->DescricaoArtigo = $DescricaoArtigo;
    }
    
    public function getDataHoraPublicacao() {
        return $this->DataHoraPublicacao;
    }
    public function setDataHoraPublicacao($DataHoraPublicacao) {
        $this->DataHoraPublicacao = $DataHoraPublicacao;
    }
    
    public function getComentarios() {
        return $this->Comentarios;
    }
    public function setComentarios($Comentarios) {
        $this->Comentarios = $Comentarios;
    }

}

?>
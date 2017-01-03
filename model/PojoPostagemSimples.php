<?php

class PojoPostagemSimples {

    private $idPostagem;
    private $Descricao;
    private $dataHoraPostagem;

    public function getIdPostagem(){
        return $this->idPostagem;
    }
    public function setIdpostagem($idPostagem){
        $this->idPostagem = $idPostagem;
    }
    
    public function getDescricao(){
        return $this->Descricao;
    }
    public function setDescricao($Descricao){
        $this->Descricao = $Descricao;
    }
    
    public function getDataHoraPostagem(){
        return $this->dataHoraPostagem;
    }
    public function setDataHoraPostagem($dataHoraPostagem){
        $this->dataHoraPostagem = $dataHoraPostagem;
    }
}
?>
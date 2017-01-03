<?php

class PojoAgenda {

    private $idAgenda;
    private $DataHoraEvento;
    private $Descricao;
    
    //
    public function getIdAgenda() {
        return $this->idAgenda;
    }
    public function setIdAgenda($idAgenda) {
        $this->idAgenda = $idAgenda;
    }
    //
    public function getDataHoraEvento() {
        return $this->DataHoraEvento;
    }
    public function setDataHoraEvento($DataHoraEvento) {
        $this->DataHoraEvento = $DataHoraEvento;
    }
    //
    public function getDescricao() {
        return $this->Descricao;
    }
    public function setDescricao($Descricao) {
        $this->Descricao = $Descricao;
    }

}

?>
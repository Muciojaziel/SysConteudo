<?php

class PojoUsuario {

    private $idUsuarios;
    private $email;
    private $senha;
    private $NomeUsuario;
    private $SobrenomeUsuario;
    private $DataNascimento;
    private $idade;
    private $cidade;
    
    //
    public function getIdUsuario() {
        return $this->idUsuarios;
    }
    public function setIdUsuario($idUsuarios) {
        $this->idUsuarios = $idUsuarios;
    }
    //
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($Email) {
        $this->email = $Email;
    }
    //
    public function getSenha() {
        return $this->senha;
    }
    public function setSenha($senha) {
        $this->senha = $senha;
    }
    //
     public function getNomeUsuario() {
        return $this->NomeUsuario;
    }
    public function setNomeUsuario($NomeUsuario) {
        $this->NomeUsuario = $NomeUsuario;
    }
    //
     public function getSobrenomeUsuario() {
        return $this->SobrenomeUsuario;
    }
    public function setSobrenomeUsuario($SobrenomeUsuario) {
        $this->SobrenomeUsuario = $SobrenomeUsuario;
    }
    //
     public function getDataNascimento() {
        return $this->DataNascimento;
    }
    public function setDataNascimento($DataNascimento) {
        $this->DataNascimento = $DataNascimento;
    }
    //
     public function getIdade() {
        return $this->idade;
    }
    public function setIdade($idade) {
        $this->idade = $idade;
    }
    //
     public function getCidade() {
        return $this->cidade;
    }
    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

}

?>
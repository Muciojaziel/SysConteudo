<?php

class PojoAdministracao {

    private $TituloDoSite;
    private $BannerPrincipal;
    private $artigos;
    private $galeria;
    private $postagemsimples;
    private $textoRodape;

    public function getTituloDoSite() {
        return $this->TituloDoSite;
    }
    public function setTituloDoSite($TituloDoSite) {
        $this->TituloDoSite = $TituloDoSite;
    }

    public function getBannerPrincipal() {
        return $this->BannerPrincipal;
    }
    public function setBannerPrincipal($BannerPrincipal) {
        $this->BannerPrincipal = $BannerPrincipal;
    }

    public function getArtigos() {
        return $this->artigos;
    }
    public function setArtigos($artigos) {
        $this->artigos = $artigos;
    }

    public function getGaleria() {
        return $this->galeria;
    }
    public function setGaleria($galeria) {
        $this->galeria = $galeria;
    }

    public function getPostagemSimples() {
        return $this->postagemsimples;
    }
    public function setPostagemSimples($postagemsimples) {
        $this->postagemsimples = strtolower($postagemsimples);
    }

    public function getTextoRodape() {
        return $this->textoRodape;
    }
    public function setTextoRodape($textoRodape) {
        $this->textoRodape = strtolower($textoRodape);
    }

}

?>
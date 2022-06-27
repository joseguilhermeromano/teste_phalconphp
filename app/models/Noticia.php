<?php

use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as Paginator;

class Noticia extends Model
{
    private $id;
    private $titulo;
    private $texto;    
    private $data_ultima_atualizacao;
    private $data_cadastro;
    private $data_publicacao;

    public function initialize()
    {
        $this->setSource("noticia");

        $this->hasMany(
            'id',
            'NoticiaCategoria',
            'id_noticia'
        );
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    public function getDataUltimaAtualizacao()
    {
        if (!is_object($this->data_ultima_atualizacao)) {
            $this->data_ultima_atualizacao = new DateTime;
        }

        return $this->data_ultima_atualizacao->format('d/m/Y H:i:s');
    }

    public function setDataUltimaAtualizacao(DateTime $date = null)
    {
        if (!is_object($date)) {
            $date = new DateTime;
        }

        $this->data_ultima_atualizacao = $date->format('Y-m-d H:i:s');
    }

    public function getDataCadastro(){
        return $this->data_cadastro;
    }

    public function setDataCadastro(DateTime $date = null){
        if (!is_object($date)) {
            $date = new DateTime;
        }

        $this->data_cadastro = $date->format('Y-m-d H:i:s');
    }

    public function toStringDataCadastro(){
        $date = new DateTime;

        if (!empty($this->data_cadastro)) {
            $date = new DateTime($this->data_cadastro);
        }

        return $date->format('d/m/Y H:i:s');
    }

    public function getDataPublicacao(){
        return $this->data_publicacao;
    }

    public function setDataPublicacao(DateTime $date = null){
        if (!is_object($date)) {
            $date = new DateTime;
        }

        $this->data_publicacao = $date->format('Y-m-d H:i:s');
    }

    public function toStringDataPublicacao(){
        $date = new DateTime;

        if (!empty($this->data_publicacao)) {
            $date = new DateTime($this->data_publicacao);
        }

        return $date->format('d/m/Y H:i:s');
    }
    
}
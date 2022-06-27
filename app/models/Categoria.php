<?php

use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as Paginator;

class Categoria extends Model
{
    private $id;
    private $titulo;

    public function initialize()
    {
        $this->setSource("categoria");

        $this->hasMany(
            'id',
            'NoticiaCategoria',
            'id_categoria'
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
    
}
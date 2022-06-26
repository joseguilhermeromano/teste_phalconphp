<?php

use Phalcon\Forms\Exception;
use Phalcon\Forms\Manager;
use Phalcon\Mvc\Controller;

class NoticiaController extends ControllerBase
{
    private $mensagemDeErro = '';

    public function listaAction()
    {

        $this->view->pick("noticia/listar");
    }

    public function cadastrarAction()
    {
        return $this->view->pick("noticia/cadastrar");
    }

    public function editarAction($id)
    {
        $this->view->pick("noticia/editar");
    }

    public function salvarAction()
    {
        if(!$this->request->isPost())
        {
            return $this->dispatcher->forward(
                [
                    "controller" => "noticia",
                    "action"     => "lista",
                ]
            );
        }

        $data = $this->request->getPost();
        $form = new NoticiaForm();

        $noticia = new Noticia();
        $noticia->titulo = $data['titulo'];
        $noticia->texto = $data['texto'];
        $noticia->data_ultima_atualizacao = new DateTime();

        if (!$form->isValid($data, $noticia)) {
            $messages = $form->getMessages();
        
            foreach ($messages as $message) {
                $this->flash->error($message);
            }
        
            return $this->dispatcher->forward(
                [
                    "controller" => "noticia",
                    "action"     => "cadastrar",
                ]
            );
        }

        if ($noticia->save() === false) 
        {
            $messages = $noticia->getMessages();
        
            foreach ($messages as $message)
            {
                $this->flash->error($message);
            }
        
            return $this->dispatcher->forward(
                [
                    "controller" => "noticia",
                    "action"     => "cadastrar",
                ]
            );
        }

        $this->flash->success(
            "Cadastro efetuado com sucesso."
        );

        return $this->response->redirect(array('for' => 'noticia.lista'));
    }

     public function excluirAction($id)
     {
        return $this->response->redirect(array('for' => 'noticia.lista'));
     }

}
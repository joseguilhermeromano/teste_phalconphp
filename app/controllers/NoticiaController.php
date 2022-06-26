<?php

use Phalcon\Forms\Exception;
use Phalcon\Forms\Manager;
use Phalcon\Mvc\Controller;

class NoticiaController extends ControllerBase
{
    private $mensagemDeErro = '';

    public function listaAction()
    {
        $noticias = Noticia::find(['order' => 'id ASC']);

        $this->view->setParamToView("noticias", $noticias);
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
        $action = "cadastrar";

        if(!isset($data["id"]))
        {
            $date = new DateTime();
            $action="editar";
            $noticia->data_cadastro = $date->format('Y-m-d H:i:s');
        }

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
                    "action"     => $action,
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
                    "action"     => $action,
                ]
            );
        }

        $this->flash->success(
            "Registro salvo com sucesso."
        );

        return $this->response->redirect(array('for' => 'noticia.lista'));
    }

    public function excluirAction($id)
    {
        if(empty($id)){
            $this->flash->error(
                "O id da Notícia não foi informado."
            );
            return $this->response->redirect(array('for' => 'noticia.lista'));
        }

        $noticia = Noticia::FindFirst($id);

        if($noticia !== false)
        {
            if(!$noticia->delete())
            {
                $this->flash->error(
                    "Erro ao tentar excluir o registro."
                );
            }
            else
            {
                $this->flash->success(
                    "Registro excluído com sucesso."
                );
            }
        }
        else
        {
            $this->flash->error(
                "Registro não existe."
            );
        }

        return $this->response->redirect(array('for' => 'noticia.lista'));
     }

}
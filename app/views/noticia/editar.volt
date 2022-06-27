{% extends 'layouts/index.volt' %}

    {% block content %}

        <div id="cadastro_ticket" class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon-plus"></i>
                        &nbsp;Editar Noticia
                    </div>
                    {{ form('noticias/salvar', 'method': 'post', 'enctype' : 'multipart/form-data', 'name':'cadastrar') }}
                        
                        <div class="panel-body">
                            <div class="col-md-12"  id="conteudo">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <p><strong>Data de Criação:</strong> {{ noticia.toStringDataCadastro() }}</p>
                                                <p><strong>Data da Última Atualização:</strong> {{ noticia.data_ultima_atualizacao }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for ="Titulo">Título <span class="error">(*)<span></label>
                                                <input name="titulo" type="text" value="{{ noticia.titulo }}" width='100%' class= "form-control">
                                                <input type="hidden" name="id" value="{{ noticia.id }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for ="categorias">Categorias</label>
                                                <select class="categorias" name="categorias[]" multiple="multiple" style="width:100%;">
                                                    <option value="Javascript">Javascript</option>
                                                    <option value="Python">Python</option>
                                                    <option value="LISP">LISP</option>
                                                    <option value="C++">C++</option>
                                                    <option value="jQuery">jQuery</option>
                                                    <option value="Ruby">Ruby</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-3">
                                                <input type="checkbox" placeholder="" id="publicar" name="publicar"/>
                                                <label for ="publicar">Publicar? </label>
                                            </div>
                                        </div>
                                        <div class="row" id="datapublicacao" style="display:none">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for ="data_publicacao">Data de Publicação</label>
                                                    <div class='input-group date' id="id_0">
                                                        <input type='text' class="form-control" name="data_publicacao" id="set_publicacao"/>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for ="Texto">Texto</label>
                                                <textarea name="texto" class= "form-control">{{ noticia.texto }}</textarea>
                                            </div>
                                        </div>
                                    </div>{#/.panel-body#}
                                </div>{#/.panel#}
                                <div class="row" style="text-align:right;">
                                    <div id="buttons-cadastro" class="col-md-12">
                                        <a href="{{ url(['for':'noticia.lista']) }}" class="btn btn-default">Cancelar</a>
                                        {{ submit_button('Gravar', "class": 'btn btn-primary') }}
                                    </div>
                                </div>
                            </div>{#/.conteudo#}
                        </div>{#/.panel-body#}
                    {{ end_form() }}
                </div>{#/.panel#}
            </div>{#/.col-md-12#}
        </div><!-- row -->

    {% endblock %}

    {%  block extrafooter %}
        
    <script>
        $(document).ready(function(){
            $('.categorias').select2();

            $('#set_publicacao').val('{{ noticia.toStringDataPublicacao() }}')

            $('#publicar').on("change", function (){
                $('#datapublicacao').toggle();
            });
        });
    </script>
    {% endblock %}

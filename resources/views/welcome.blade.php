<!DOCTYPE html>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="{{ URL::asset('css/general.css') }}">
        <style>
            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                -webkit-animation-name: fadeIn; /* Fade in the background */
                -webkit-animation-duration: 0.4s;
                animation-name: fadeIn;
                animation-duration: 0.4s
            }

            /* Modal Content */
            .modal-content {
                position: fixed;
                bottom: 0;
                background-color: #fefefe;
                width: 50%;
                -webkit-animation-name: slideIn;
                -webkit-animation-duration: 0.4s;
                animation-name: slideIn;
                animation-duration: 0.4s;
                left: 25%;
            }

            /* The Close Button */
            .close {
                color: red;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: #f2dede;
                text-decoration: none;
                cursor: pointer;
            }

            /* The Close Button */
            .close2 {
                color: red;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close2:hover,
            .close2:focus {
                color: #f2dede;
                text-decoration: none;
                cursor: pointer;
            }

            /* The Close Button */
            .close3 {
                color: red;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close3:hover,
            .close3:focus {
                color: #f2dede;
                text-decoration: none;
                cursor: pointer;
            }

            /* The Close Button */
            .close4 {
                color: red;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close4:hover,
            .close4:focus {
                color: #f2dede;
                text-decoration: none;
                cursor: pointer;
            }

            .modal-header {
                padding: 2px 16px;
                background-color: #f9f9f9;
                color: #000;
            }

            .modal-body {padding: 2px 16px;}

            .modal-footer {
                padding: 2px 16px;
                background-color: #f9f9f9;
                color: #000;
            }

            /* Add Animation */
            @-webkit-keyframes slideIn {
                from {bottom: -300px; opacity: 0}
                to {bottom: 0; opacity: 1}
            }

            @keyframes slideIn {
                from {bottom: -300px; opacity: 0}
                to {bottom: 0; opacity: 1}
            }

            @-webkit-keyframes fadeIn {
                from {opacity: 0}
                to {opacity: 1}
            }

            @keyframes fadeIn {
                from {opacity: 0}
                to {opacity: 1}
            }
        </style>

        <title>Gerenciador de livros</title>
        <header>
            <h1>Gerenciador de livros</h1>
        </header>
    </head>
    <body>
        <!-- CADASTRO DE LIVRO -->
        <button class="btn btn-success btn-sm" id="myBtn"><span class="glyphicon glyphicon-plus"></span>  Cadastrar livro</button>
        <!-- The Modal -->
        <div id="myModal" class="modal">

          <!-- Modal content -->
          <div class="modal-content">
            <div class="modal-header">
                <span class="close">x</span>
                <h4>Cadastro de livro</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="livros">
                    <div class="form-group">
                        <div class="radio"> <!-- 1 para LIVRO, 2 para QUADRINHO -->
                            <label class="radio-inline"><input type="radio" name="livro_quadrinho" value="1">Livro</label>
                            <label class="radio-inline"><input type="radio" name="livro_quadrinho" value="2">Quadrinho</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nome_livro">Nome:</label>
                        <input type="input" class="form-control" id="nome_livro" name="nome_livro">
                    </div>
                    <div class="form-group">
                        <label for="dpd_autores">Autores (ordem alfabética):</label>
                        <select class="form-control" name="dpd_autores" id="dpd_autores">
                            <option value="0">Selecione um autor</option>
                            @if (count($autores_dropdown) > 0)
                                @foreach ($autores_dropdown as $autor)
                                    <option value="{{ $autor->aut_id }}">{{ $autor->aut_nome }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <table>
                        <tr>
                            <td width="200px">
                                <div class="form-group">
                                    <label for="dpd_sagas">Sagas (ordem alfabética):</label>
                                    <select class="form-control" name="dpd_sagas" id="dpd_sagas">
                                        <option value="0">Selecione uma saga</option>dpd_sagas
                                        @if (count($sagas_dropdown) > 0)
                                            @foreach ($sagas_dropdown as $saga)
                                                <option value="{{ $saga->sag_id }}">{{ $saga->sag_nome }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </td>
                            <td width="50px"></td>
                            <td>
                                <div class="alert alert-warning">
                                  <strong>Atenção!</strong> Se o livro não pertencer a nenhuma saga, deixe na primeira opção.
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="form-group">
                        <label for="livro_n_saga">Livro x da saga:</label>
                        <input type="input" class="form-control" id="n_livros" name="livro_n_saga">
                    </div>
                    <div class="form-group">
                        <label for="n_paginas_fisico">Número de páginas físico:</label>
                        <input type="input" class="form-control" id="n_paginas_fisico" name="n_paginas_fisico">
                    </div>
                    <div class="form-group">
                        <label for="n_paginas_ebook">Número de páginas ebook:</label>
                        <input type="input" class="form-control" id="n_paginas_ebook" name="n_paginas_ebook">
                    </div>
                    <table>
                        <tr>
                            <td width="300px">
                                <div class="form-group">
                                    <label for="pagina_atual">Página atual:</label>
                                    <input type="input" class="form-control" id="pagina_atual" name="pagina_atual">
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                  <label><input type="checkbox" value="1" name="livro_finalizado">Finalizado</label>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default">Cadastrar</button>
                </form>
            </div>
          </div>
        </div>

        <!-- CADASTRO DE AUTOR -->
        <button class="btn btn-success btn-sm" id="myBtn2"><span class="glyphicon glyphicon-plus"></span>  Cadastrar autor</button>
        <!-- The Modal -->
        <div id="myModal2" class="modal">

          <!-- Modal content -->
          <div class="modal-content">
            <div class="modal-header">
                <span class="close2">x</span>
                <h4>Cadastro de autor</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="autor">
                    <div class="form-group">
                        <label for="nome_autor">Nome:</label>
                        <input type="input" class="form-control" id="nome_autor" name="nome_autor">
                    </div>
                    <div class="form-group">
                        <label for="sexo_autor">Sexo:</label>
                        <div class="radio"> <!-- 1 para FEMININO, 2 para MASCULINO -->
                            <label class="radio-inline"><input type="radio" name="sexo_autor" value="1">Feminino</label>
                            <label class="radio-inline"><input type="radio" name="sexo_autor" value="2">Masculino</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cor_autor">Cor/raça:</label>
                        <div class="radio"> <!-- 1 para BRANCO, 2 para NEGRO, 3 para INDIGENA, 4 para AMARELO -->
                            <label class="radio-inline"><input type="radio" name="cor_autor" value="1">Branco</label>
                            <label class="radio-inline"><input type="radio" name="cor_autor" value="2">Negro</label>
                            <label class="radio-inline"><input type="radio" name="cor_autor" value="3">Indígena</label>
                            <label class="radio-inline"><input type="radio" name="cor_autor" value="4">Amarelo</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="continente_autor">Continente:</label>
                        <div class="radio"> <!-- 1 para EUROPA, 2 para AMÉRICA ANGLO SAXÃ, 3 para AMÉRICA LATINA, 4 para ÁFRICA, 5 para ÁSIA, 6 para OCEANIA -->
                            <label class="radio-inline"><input type="radio" name="continente_autor" value="1">Europa</label>
                            <label class="radio-inline"><input type="radio" name="continente_autor" value="2">América Anglo-Saxã</label>
                            <label class="radio-inline"><input type="radio" name="continente_autor" value="3">América Latina</label>
                            <label class="radio-inline"><input type="radio" name="continente_autor" value="4">África</label>
                            <label class="radio-inline"><input type="radio" name="continente_autor" value="5">Ásia</label>
                            <label class="radio-inline"><input type="radio" name="continente_autor" value="6">Oceania</label>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default">Cadastrar</button>
                </form>
            </div>
          </div>
        </div>

        <!-- CADASTRO DE SAGA -->
        <button class="btn btn-success btn-sm" id="myBtn3"><span class="glyphicon glyphicon-plus"></span>  Cadastrar saga</button>
        <!-- The Modal -->
        <div id="myModal3" class="modal">

          <!-- Modal content -->
          <div class="modal-content">
            <div class="modal-header">
                <span class="close3">x</span>
                <h4>Cadastro de saga</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="saga">
                    <div class="form-group">
                        <label for="nome_saga">Nome:</label>
                        <input type="input" class="form-control" id="nome_saga" name="nome_saga">
                    </div>
                    <div class="form-group">
                        <label for="dpd_autores">Autores (ordem alfabética):</label>
                        <select class="form-control" name="dpd_autores" id="dpd_autores">
                            <option value="0">Selecione um autor</option>
                            @if (count($autores_dropdown) > 0)
                                @foreach ($autores_dropdown as $autor)
                                    <option value="{{ $autor->aut_id }}">{{ $autor->aut_nome }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="n_livros">Número livros:</label>
                        <input type="input" class="form-control" id="n_livros" name="n_livros">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default">Cadastrar</button>
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                </form>
            </div>
          </div>
        </div>

        <br><br>
        @if (Session::has('message'))
            <!-- Form Error List -->
            <div class="alert alert-success" name="mensagem" id="mensagem">
                <strong>Sucesso! </strong>{{ Session::get('message') }}
            </div>
        @elseif (Session::has('message_erro'))
            <!-- Form Error List -->
            <div class="alert alert-danger" id="mensagem_erro">
                <strong>Erro! </strong>{{ Session::get('message_erro') }}
            </div>
        @endif
        @if (count($situacoes) > 0)
            <table class="table table-striped" style="width: 70%; margin-left: 15%;">
                <thead>
                  <tr>
                    <th>Situação</th>
                    <th>Livro</th>
                    <th>Página atual físico/ebook</th>
                    <th>Página atual físico *</th>
                    <th>Porcentagem</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                    <th>Finalizar</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($situacoes as $situacao)
                        <tr>
                            <td class="table-text" style="vertical-align: middle; text-align: center;">
                                @foreach ($livros as $livro)
                                    @if ($livro->liv_id == $situacao->liv_id)
                                        @if( ($situacao->sit_pag_atual == $livro->liv_n_ebook) || ($situacao->sit_pag_atual == $livro->liv_n_fisico))
                                            <div><span class="glyphicon glyphicon-ok" id="glyphicon_ok"></span></div>
                                        @else
                                            <div><span class="glyphicon glyphicon-eye-open"></span></div>
                                        @endif
                            </td>
                            <td class="table-text">
                                <div>{{ $livro->liv_nome }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $situacao->sit_pag_atual }}</div>
                            </td>
                            <td class="table-text warning">
                                @if (($livro->liv_n_ebook > 0))
                                    <div>{{ ($livro->liv_n_fisico * $situacao->sit_pag_atual)/$livro->liv_n_ebook }}</div>
                                @else
                                    <div>{{ $situacao->sit_pag_atual }}</div>
                                @endif
                            </td>
                            <td class="table-text">
                                @if (isset($livro->liv_n_ebook))
                                    <div>{{ (100 * $situacao->sit_pag_atual)/$livro->liv_n_ebook }}%</div>
                                @else
                                    <div>100%</div>
                                @endif
                            </td>
                            <td class="table-text">
                                <div>
                                    <button class="btn btn-warning" id="myBtn4"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <!-- The Modal -->
                                    <div id="myModal4" class="modal">

                                      <!-- Modal content -->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                            <span class="close4">x</span>
                                            <h4>Atualização de leitura</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="editar/{{ $livro->liv_id }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label for="pagina_atual">Página atual:</label>
                                                    <input type="input" class="form-control" id="pagina_atual" name="pagina_atual">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default">Editar</button>
                                            </form>
                                        </div>
                                      </div>

                                    </div>
                                </div>
                            </td>
                            <td id="coluna_centralizada">
                                <form action="excluir/{{ $livro->liv_id}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                </form>
                            </td>
                            <td id="coluna_centralizada">
                                <form action="finalizar/{{ $situacao->sit_id }}/{{ $livro->liv_n_fisico }}/ {{$livro->liv_n_ebook}}" method="POST">
                                    {{ csrf_field() }}

                                    <button class="btn btn-success"><span class="glyphicon glyphicon-check"></span></button>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            * (conversão feita a partir do ebook)<br><br>
            <a href="estatisticas" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-stats"></span>  Estatísticas</a>
        @else
            <div class="alert alert-info" id="mensagem">
              <strong>Info!</strong> Não há nenhum livro cadastrado.
            </div>
        @endif
        <script>
            // Get the modal
            var modal = document.getElementById('myModal');

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            // Get the modal
            var modal2 = document.getElementById('myModal2');

            // Get the button that opens the modal
            var btn2 = document.getElementById("myBtn2");

            // Get the <span> element that closes the modal
            var span2 = document.getElementsByClassName("close2")[0];

            // When the user clicks the button, open the modal
            btn2.onclick = function() {
                modal2.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span2.onclick = function() {
                modal2.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal2) {
                    modal2.style.display = "none";
                }
            }

            // Get the modal
            var modal3 = document.getElementById('myModal3');

            // Get the button that opens the modal
            var btn3 = document.getElementById("myBtn3");

            // Get the <span> element that closes the modal
            var span3 = document.getElementsByClassName("close3")[0];

            // When the user clicks the button, open the modal
            btn3.onclick = function() {
                modal3.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span3.onclick = function() {
                modal3.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal3) {
                    modal2.style.display = "none";
                }
            }

            // Get the modal
            var modal4 = document.getElementById('myModal4');

            // Get the button that opens the modal
            var btn4 = document.getElementById("myBtn4");

            // Get the <span> element that closes the modal
            var span4 = document.getElementsByClassName("close4")[0];

            // When the user clicks the button, open the modal
            btn4.onclick = function() {
                modal4.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span4.onclick = function() {
                modal4.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal2) {
                    modal4.style.display = "none";
                }
            }

            function mudaCor(sit_pag_atual, liv_n_ebook) {
                if (sit_pag_atual === liv_n_ebook) {
                    linha.style.backgroundColor = "#5cb85c";
                }
            }

            function mudaCorCelula(sit_pag_atual, liv_n_ebook) {
                if (sit_pag_atual === liv_n_ebook) {
                    linha.style.backgroundColor = "#fcf8e3";
                }
            }
        </script>
    </body>
</html>

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

        <title>Gerenciador de livros</title>
        <header>
            <h1>Estatísticas</h1>
        </header>
    </head>
    <body>
        <table style="width: 100%;">
            <tr>
                <td style="vertical-align: top;">
                    <div align="center"><h3>Sexo dos autores</h3>
                        <img src="{{ asset('imagens_teste/user-1.png') }}" width="60px" height="60px" />
                        @foreach($sexo_autores as $sexo)
                            @if($sexo->sexo == 1)
                                <font size="5px">{{ $sexo->qtde }}%</font>
                            @endif
                        @endforeach
                        <br><br>
                        <img src="{{ asset('imagens_teste/user.png') }}" width="60px" height="60px" />
                        @foreach($sexo_autores as $sexo)
                            @if($sexo->sexo == 2)
                                <font size="5px">{{ $sexo->qtde }}%</font>
                            @endif
                        @endforeach
                    </div>
                </td>
                <td>
                    <div align="center"><h3>Continente dos autores</h3>
                        <img src="{{ asset('imagens_teste/1-africa.png') }}" width="30px" height="30px" />@foreach($continente_autores as $continente)
                            @if($continente->continente == 4)
                                <font size="5px">{{ $continente->qtde }}%</font>
                            @endif
                        @endforeach
                        <br>
                        <img src="{{ asset('imagens_teste/1-america-anglo-saxa.png') }}" width="30px" height="30px" />@foreach($continente_autores as $continente)
                            @if($continente->continente == 2)
                                <font size="5px">{{ $continente->qtde }}%</font>
                            @endif
                        @endforeach
                        <br>
                        <img src="{{ asset('imagens_teste/1-america-latina.png') }}" width="30px" height="30px" />@foreach($continente_autores as $continente)
                            @if($continente->continente == 3)
                                <font size="5px">{{ $continente->qtde }}%</font>
                            @endif
                        @endforeach
                        <br>
                        <img src="{{ asset('imagens_teste/1-asia.png') }}" width="30px" height="30px" />@foreach($continente_autores as $continente)
                            @if($continente->continente == 5)
                                <font size="5px">{{ $continente->qtde }}%</font>
                            @endif
                        @endforeach
                        <br>
                        <img src="{{ asset('imagens_teste/1-europe.png') }}" width="30px" height="30px" />@foreach($continente_autores as $continente)
                            @if($continente->continente == 1)
                                <font size="5px">{{ $continente->qtde }}%</font>
                            @endif
                        @endforeach
                        <br>
                        <img src="{{ asset('imagens_teste/1-oceania.png') }}" width="30px" height="30px" />@foreach($continente_autores as $continente)
                            @if($continente->continente == 6)
                                <font size="5px">{{ $continente->qtde }}%</font>
                            @endif
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                </td>
            </tr>
        </table>
    </body>
</html>
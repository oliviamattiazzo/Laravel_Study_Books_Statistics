<?php

use App\Livro;
use App\Situacao;
use App\Autor;
use App\Saga;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

function montaViewWelcome() {
    $situacoes = Situacao::orderBy('created_at', 'asc')->get();
    $livros = Livro::orderBy('liv_id', 'asc')->get();
    $autores_dropdown = Autor::orderBy('aut_nome', 'asc')->get();
    $saga_dropdown = Saga::orderBy('sag_nome', 'asc')->get();

    return View::make('welcome', [
        'situacoes' => $situacoes,
        'livros' => $livros,
        'autores_dropdown' => $autores_dropdown,
        'sagas_dropdown' => $saga_dropdown
    ]);
}

Route::get('/livros', function () {
	return montaViewWelcome();
});

Route::get('/estatisticas', function() {
    //Total dos autores
    $totalAutores = DB::select('SELECT COUNT(autor.aut_id) AS total_autores FROM autor');

    //Sexo dos autores
    $buscaSexoAutores = DB::select('SELECT autor.aut_sexo AS sexo, 
                                           COUNT(autor.aut_sexo) AS qtde
                                    FROM autor
                                    INNER JOIN livro ON livro.aut_id = autor.aut_id
                                    INNER JOIN situacao ON situacao.liv_id = livro.liv_id
                                    WHERE situacao.sit_pag_atual = livro.liv_n_ebook
                                    OR situacao.sit_pag_atual = livro.liv_n_fisico
                                    GROUP BY autor.aut_sexo');

    $buscaSexoAutores[0]->qtde = (100 * $buscaSexoAutores[0]->qtde) / $totalAutores[0]->total_autores;
    $buscaSexoAutores[1]->qtde = (100 * $buscaSexoAutores[1]->qtde) / $totalAutores[0]->total_autores;

    //Continente dos autores
    $buscaContinenteAutores = DB::select('SELECT autor.aut_continente AS continente,
                                                 COUNT(autor.aut_continente) AS qtde
                                          FROM autor
                                          INNER JOIN livro ON livro.aut_id = autor.aut_id
                                          INNER JOIN situacao ON situacao.liv_id = livro.liv_id
                                          WHERE situacao.sit_pag_atual = livro.liv_n_ebook
                                          OR situacao.sit_pag_atual = livro.liv_n_fisico
                                          GROUP BY autor.aut_continente');

    for ($i = 0; $i < count($buscaContinenteAutores); $i++) {
        $buscaContinenteAutores[$i]->qtde = (100 * $buscaContinenteAutores[$i]->qtde) / $totalAutores[0]->total_autores;
    }

    // for ($c = 0; $c < 6; $c++) {
    //     if (!isset($buscaContinenteAutores[$c])) {
    //         $buscaContinenteAutores[$c] = new StdClass();
    //         $buscaContinenteAutores[$c]->continente = $c;
    //         $buscaContinenteAutores[$c]->qtde = array(0);
    //     }
    // }

    return view('estatisticas', [
        'sexo_autores' => $buscaSexoAutores,
        'continente_autores' => $buscaContinenteAutores
    ]);
});

Route::post('/livros', function(Request $request) { 
	$livro = new Livro;
    $livro->liv_nome = $request->nome_livro;
    $livro->liv_livro_quadrinho = $request->livro_quadrinho;
    $livro->aut_id = $request->dpd_autores;
    $livro->liv_n_ebook = $request->n_paginas_ebook == '' ? null : $request->n_paginas_ebook;
    $livro->liv_n_fisico = $request->n_paginas_fisico;
    $livro->sag_id = $request->dpd_sagas == 0 ? null : $request->dpd_sagas;
    $livro->liv_n_saga = $request->livro_n_saga == 0 ? null : $request->livro_n_saga;

    $livro->save();

    $situacao = new Situacao;
    $situacao->liv_id = $livro->id;
    if ($request->livro_finalizado == 1) {
        if ($request->n_paginas_ebook == null) {
            $situacao->sit_pag_atual = $request->n_paginas_fisico;
        } else {
            $situacao->sit_pag_atual = $request->n_paginas_ebook;
        }
    } else {
        $situacao->sit_pag_atual = $request->pagina_atual;
    }

    $situacao->save();

    return montaViewWelcome();
});

Route::post('/editar/{id}', function($id, Request $request) { //VERIFICAR 
    if ( $situacao = DB::table('situacao')
                    ->where('sit_id', $id)
                    ->update(['sit_pag_atual' => $request->pagina_atual])) {
        
        return Redirect::to('/livros')->with('message', 'Edição realizada com sucesso!');
    }
});

Route::delete('/excluir/{id}', function ($id) { 
    DB::table('situacao')->where('liv_id', $id)->delete();
    DB::table('livro')->where('liv_id', $id)->delete();


    return Redirect::to('/livros')->with('message', 'Exclusão realizada com sucesso!');
});

Route::post('/autor', function(Request $request){
    $autor = new Autor;
    $autor->aut_nome = $request->nome_autor;
    $autor->aut_sexo = $request->sexo_autor;    //1 para FEMININO, 2 para MASCULINO
    $autor->aut_cor = $request->cor_autor;      //1 para BRANCO, 2 para NEGRO, 3 para INDIGENA, 4 para AMARELO
    $autor->aut_continente = $request->continente_autor; //1 para EUROPA, 2 para AMÉRICA ANGLO SAXÃ, 3 para AMÉRICA LATINA, 4 para ÁFRICA, 5 para ÁSIA, 6 para OCEANIA

    if ($autor->save()) {
        return Redirect::to('/livros')->with('message', 'Cadastro realizado com sucesso!');
    } else {
        return Redirect::to('/livros')->with('message', 'O cadastro não pôde ser realizado.');
    }
});

Route::post('/saga', function(Request $request){
    $saga = new Saga;
    $saga->sag_nome = $request->nome_saga;
    $saga->aut_id = $request->dpd_autores;
    $saga->sag_n_livros = $request->n_livros;

    if ($saga->save()) {
        return Redirect::to('/livros')->with('message', 'Cadastro realizado com sucesso!');
    } else {
        return Redirect::to('/livros')->with('message', 'O cadastro não pôde ser realizado.');
    }
});

Route::post('/finalizar/{id}/{n_fisico}/{n_ebook}', function($id, $n_fisico, $n_ebook) { 
    if ( $situacao = DB::table('situacao')
                    ->where('sit_id', $id)
                    ->update(['sit_pag_atual' => $n_ebook > 0 ? $n_ebook : $n_fisico])) {
        
        return Redirect::to('/livros')->with('message', 'Livro finalizado com sucesso!');
    }
});
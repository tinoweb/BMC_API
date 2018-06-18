<?php

namespace BMC_API\Http\Controllers;

use Illuminate\Http\Request;
use BMC_API\Produto;
use Route;
use File;
use URL;

class ProdutoController extends Controller
{
    public $produto;

    function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $produtos = Produto::all();
        return response()->json($produtos->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $imagem = $request['file'];
            $imagem->move(public_path('Imagens'), $imagem->getClientOriginalName());
        }else{
            $produto = new Produto();
            $produto->nome = $request->get('nome');
            $produto->descricao = $request->get('descricao');
            $produto->valordecompra = $request->get('valordecompra');
            $produto->valordevenda = $request->get('valordevenda');
            $produto->imagem = $request->get('imagem');
            $produto->ativo = $request->get('ativo') ? $request->get('ativo'): false;
            $produto->save();

            return response()->json([
                'response' => 'salvo com sucesso',
                'imagePath' => public_path('Imagens'),
                'storage' => URL('/Imagens/')
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produtos = Produto::find($id);
        return response()->json($produtos);
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $produtos = Produto::find($id);
        return response()->json($produtos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produtos = Produto::find($id);

        if ($request->hasFile('file')) 
        {
            $imagem = $request['file'];
            $image_path = public_path('Imagens/'. $produtos->imagem);

            if ($request->hasFile('file') && $image_path) {
                File::delete($image_path);
            }

            $imagem->move(public_path('Imagens'), $imagem->getClientOriginalName());
        }
        else
        {
            $produtos->nome = $request['nome'];
            $produtos->descricao = $request['descricao'];
            $produtos->valordecompra = $request['valordecompra'];
            $produtos->valordevenda = $request['valordevenda'];
            $produtos->imagem = $request['imagem'];
            $produtos->ativo = $request['ativo'] ? $request['ativo']: false;
            $produtos->save();

            return response()->json([
                'mensagem' => 'atualizada com sucesso',
                'storage' => URL('/Imagens/')
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produtos = Produto::find($id);
        $image_path = public_path('Imagens/'. $produtos->imagem);
        if ($image_path) {
            File::delete($image_path);
        }
        $produtos->delete();
        return response()->json(['mensagem' => 'Produto excluido com sucesso']);
    }
}

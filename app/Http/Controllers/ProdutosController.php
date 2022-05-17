<?php

namespace App\Http\Controllers;

use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProdutosController extends Controller
{

    public function index()
    {
        //dd(Auth::user()->admin);
        /*
        if(Auth::user()->admin == false)
            return redirect()
                    ->back();
        */
        $produtos = DB::table('produtos')
                    ->leftJoin('users', 'users.id', 'produtos.user_id')
                    ->select('produtos.*', 'users.name as usuario')
                    ->orderBy('produtos.name')
                    ->paginate(20);

        return view('produto')
                ->with('produtos', $produtos)
                ->render();
    }

    public function create()
    {
        //
    }

    public function store(Request $request, ImageRepository $repoImg)
    {
        $dados = $request->all();
        if($request->hasFile('url'))
        {
            $dados['url'] = $repoImg->saveImage($request->file('url'), 1, 'produtos', 200);
        } else {
            return redirect()->back()->with('error', 'Imagem não encontrada!');
        }
        $salvar = [
            'name' => $dados['name'],
            'url' => $dados['url'],
        ];
        try{
            $id = DB::table('produtos')->insertGetId($salvar);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {

    }
}

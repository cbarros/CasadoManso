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
            $dados['url'] = $repoImg->saveImage($request->file('url'), 1, 'produtos', 1024);
        } else {
            return redirect()->back()->with('error', 'Imagem não encontrada!');
        }
        $salvar = [
            'name' => $dados['name'],
            'url' => $dados['url'],
        ];
        try{
            DB::table('produtos')->insertGetId($salvar);
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
        echo 'Estou aqui!';
        exit;
    }

    public function destroy($id)
    {

        $produto = DB::table('produtos')->where('id', $id)->first();
        if(isset($produto->url))
        {
            $ArrPATH = explode("/", $produto->url);
            $file = public_path('images/produtos/1/' . $ArrPATH[count($ArrPATH) - 1]);

            if(file_exists($file))
            {
                unlink($file);
            }
        }
        try {
            DB::table('produtos')->where('id', $id)->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()
                ->route('produtos.index')
                ->with('success', 'Produto Deletado com Sucesso!');


    }

    public function reserva($id)
    {
        $salvar = [
            'user_id' => Auth::user()->id,
            'confirmado' => date('Y-m-d'),
        ];
        try{
            DB::table('produtos')->where('id', $id)->update($salvar);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('home')->with('success', 'Presente reservado com sucesso!');
    }

    public function cancela($id)
    {
        $salvar = [
            'user_id' => NULL,
            'confirmado' => NULL,
        ];
        try{
            DB::table('produtos')->where('id', $id)->update($salvar);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('home')->with('success', 'Presente cancelado com sucesso!');
    }

    public function email(Request $request)
    {
        $dados = $request->all();
        unset($dados['_token']);
        $dados['cad'] = date('Y-m-d');

        try{
            DB::table('emails')->insert($dados);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('home')->with('success', 'Mensagem enviada com sucesso!');
    }
}

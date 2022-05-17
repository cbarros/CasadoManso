<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produtos = DB::table('produtos')
                    ->leftJoin('users', 'users.id', 'produtos.user_id')
                    ->select('produtos.*', 'users.name as usuario')
                    ->orderBy('produtos.name')
                    ->get();

        return view('index',[
            'produtos' => $produtos,
        ]);
    }
}

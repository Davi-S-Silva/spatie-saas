<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SearchController extends Controller
//  implements HasMiddleware
{
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:Deletar Cliente', only: ['destroy']),
    //         new Middleware('permission:Listar Cliente', only: ['index']),
    //         new Middleware('permission:Show Cliente', only: ['show']),
    //         new Middleware('permission:Editar Cliente', only: ['edit', 'update']),
    //         new Middleware('permission:Criar Cliente', only: ['create', 'store']),
    //     ];
    // }

    //
    public function search(Request $request){
        // print_r($request->input());

        return view('search.index');
    }

    public function result(){

    }
}

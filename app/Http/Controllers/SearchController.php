<?php

namespace App\Http\Controllers;

use App\Models\Carga;
use App\Models\Colaborador;
use App\Models\Nota;
use App\Models\Veiculo;
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

    public function getSearchResult(Request $request){
        $inputText = htmlspecialchars($request->search);
        //pesquisar as notas
        $Notas = Nota::where('nota','like','%'.$inputText.'%')->get();
        //pesquisar remessa
        $Cargas = Carga::where('remessa','like','%'.$inputText.'%')->orwhere('os','like','%'.$inputText.'%')->get();
        //pesquisar colaborador
        $Colaboradores = Colaborador::where('name','like','%'.$inputText.'%')->get();
        //pesquisar veiculo
        $Veiculos = Veiculo::where('placa','like','%'.$inputText.'%')->get();
        //pesquisar fornecedor


        return view('search.result',[
            'result'=>$request->input(),
            'Notas'=>$Notas,
            'Cargas'=>$Cargas,
            'Veiculos'=>$Veiculos,
            'Colaboradores'=>$Colaboradores,
        ]);
        // return response()->json($request->input());
    }
}

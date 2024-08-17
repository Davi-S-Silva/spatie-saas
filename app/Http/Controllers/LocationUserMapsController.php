<?php

namespace App\Http\Controllers;

use App\Models\LocationUserMaps;
use Illuminate\Http\Request;
// use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class LocationUserMapsController extends Controller
//  implements HasMiddleware
{
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:Listar ...', only: ['index']),
    //         new Middleware('permission:Criar ...', only: ['create', 'store']),
    //         new Middleware('permission:Show ...', only: ['show']),
    //         new Middleware('permission:Editar ...', only: ['edit', 'update']),
    //         new Middleware('permission:Deletar ...', only: ['destroy']),
    //     ];
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return response()->json(LocationUserMaps::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userExists = LocationUserMaps::where('user_id',Auth::user()->id)->get();
        if($userExists->count()!=0){
            $user = $userExists->first();
            $user->latitude = '-8.696969';
            $user->longitude = '-34.766969';
            $user->save();
            echo 'User Alterado';
        }else{
            $locationUser = new LocationUserMaps();
            $locationUser->latitude = '-8.563636';
            $locationUser->longitude = '-34.693636';
            $locationUser->user_id = Auth::user()->id;
            $locationUser->logado = true;
            $locationUser->save();
            echo 'User Criado';
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function setLocationUserMaps(Request $request){
        return response()->json($request->input());
    }
}

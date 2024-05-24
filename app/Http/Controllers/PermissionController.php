<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;

use function Pest\Laravel\json;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        // try{

            return [
                // examples with aliases, pipe-separated names, guards, etc:
                // 'role_or_permission:manager|edit articles',
                new Middleware('permission:Deletar Permissao', only: ['destroy']),
                new Middleware('permission:Visualizar Permissao', only: ['index','show']),
                new Middleware('permission:Editar Permissao', only: ['edit','update']),
                new Middleware('permission:Criar Permissao', only: ['create','store']),
                // new Middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('manager'), except:['show']),
                // new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete role'), only:['destroy']),
            ];
        // }catch(UnauthorizedException $ex){
        //     return json_encode(['status' => 'danger', 'msg' => $ex->getMessage()]);
        //     // return;
        // }
    }
    /**
     * Display a listing of the resource.
     */

    //  public function __construct(string $id=null)
    //  {
    //     $permission = Permission::find($id);


    //     print_r($permission);

    //  }

    public function index()
    {

        return view('role-permission.permission.index', ['permissions'=>Permission::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role-permission.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{


            $request->validate([
                'PermissionName'=> ['required', 'string', 'unique:permissions,name'],
                'PermissionModel'=> ['required', 'string']
            ]);

            // echo json_encode($request->input());

            Permission::create([
                'name'=>$request->PermissionName,
                'model'=>$request->PermissionModel
            ]);

            // echo json_encode($request->input('PermissionName'));

            echo json_encode(['status'=>'success', 'msg'=>'Permissão criada com sucesso!']);

            // session(['message'=>['status'=>'success', 'msg'=>'Permissão criada com sucesso!']]);
            session()->flash('message',['status'=>'success', 'msg'=>'Permissão criada com sucesso!']);
            return;
        }catch(Exception $ex){
            echo json_encode(['status'=>'danger','msg'=>$ex->getMessage()]);
            session()->flash('message',['status'=>'danger', 'msg'=>$ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'ola show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(string $id)
    {
        try{
            $permission = Permission::find($id);
            if(!$permission)
            {
                throw new Exception('0');
                // abort(403,'não existe');
            }
            // return $permission;
            return view('role-permission.permission.edit',['permission'=>Permission::find($permission->id)]);
        }catch(Exception $ex){
            if($ex->getMessage()=='0'){
                abort(403);
            }
            return $ex->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {

        try{

            // print_r($request->input());
            // $permission = Permission::find($id);



            $request->validate([
                'PermissionName'=>['required', 'string', 'unique:permissions,name,'.$permission->id]
                // 'PermissionName'=> ['required', 'string', 'unique:permissions,name']
            ]);

            // echo json_encode($request->input());


            $permission->update([
                'name'=>$request->PermissionName
            ]);
            // echo json_encode($request->input('PermissionName'));

            echo json_encode(['status'=>'success','msg'=>'Permission update success']);
            // session(['message'=>['status'=>'success', 'msg'=>'Permission update success!']]);
            session()->flash('message',['status'=>'success', 'msg'=>'Permission update success!']);
            // echo json_encode($request->input());
            return;
        }catch(Exception $ex){
            echo json_encode(['status'=>'danger','msg'=>$ex->getMessage()]);
            return;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        try{
            $permission->delete();
            echo json_encode(['status'=>'success', 'msg'=>'Permission Deleted Successfuly']);
            // session(['message'=>['status'=>'success', 'msg'=>'Permission Deleted Successfuly']]);
            session()->flash('message',['status'=>'success', 'msg'=>'Permission Deleted Successfuly!']);
            return;
        }catch(Exception $ex){
            echo json_encode(['status'=>'danger','msg'=>$ex->getMessage()]);
            return;
        }
    }
}

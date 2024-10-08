<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Laravel\Facades\Image;

// use Intervention\Image\Image;

class CompressedImage extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Deletar Cliente', only: ['destroy']),
            new Middleware('permission:Listar Cliente', only: ['index']),
            new Middleware('permission:Show Cliente', only: ['show']),
            new Middleware('permission:Editar Cliente', only: ['edit', 'update']),
            new Middleware('permission:Criar Cliente', only: ['create', 'store']),
        ];
    }

    public function index(){
        return view('compressed');
    }
    public function store(Request $request){
        // echo '<pre>';print_r($request->file('image'));echo '</pre>';
        // $imageName = "compressed_images/". \Str::uuid().$request->file('image')->getClientOriginalName();
        // $size = $request->file('image')->getSize()/1024;
        // echo $imageName;
        // echo '<br />';
        // echo $size;

        $manager = new ImageManager(new Driver());
        $image = $request->file('image');
        $imageName = \Str::uuid().'-moved-'.$request->file('image')->getClientOriginalName();

        $image->move('uploads',$imageName);
        // $image = Image::make($request->file('image'));
        $manager = new ImageManager(Driver::class);
//public\uploads\197e2e16-2f26-41f4-ba2d-1359adfa7dfd-moved-790559.png
// echo getenv('RAIZ').'/public/uploads/'.$imageName;
// echo '<br />C:\xampp_bkp\htdocs\spatie-saas\public\uploads\1a317503-a50c-4f8c-beaa-a7a9beca40c5-moved-790559.png';
//C:\xampp_bkp\htdocs\spatie-saas\public\uploads\1a317503-a50c-4f8c-beaa-a7a9beca40c5-moved-790559.png
$imageRead = $manager->read('uploads/'.$imageName);
// if(file_exists(getenv('RAIZ').'/public/uploads/'.$imageName)){
//     $imageRead = $manager->read('uploads/'.$imageName);
// }else{
//     echo 'nada';
// }

        $imageRead->scale(height:500)->save(public_path('uploads/teste/'.$imageName));
        dd($imageName,$request->image, $manager->driver());
        // $image = $manager->read($request->image, new FilePathImageDecoder());
        // $image = $manager->read(file_get_contents($request->file('image')));
        // $image = $manager->read($request->file('image'), new FilePathImageDecoder());
        // Image::make($request->file('image'))->save('test.jpg');
    }
}

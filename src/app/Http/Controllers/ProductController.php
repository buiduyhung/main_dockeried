<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Response;

class ProductController extends Controller
{
    public function index(){
        return Product::all();
    }

    public function likes(Request $request, $id){
        $respone = Http::get('http://docker.for.linux:8080/api/user');

        $user = $respone->json();

        try{
            ProductUser::create([
                'user_id' => $user['id'],
                'product_id' => $id
            ]);

            return response([
                'message' => 'success!'
            ]);

        }catch(Exception $e) {
            return response([
                'message' => 'you already liked this product!'
            ], 404);
        }
    }
}

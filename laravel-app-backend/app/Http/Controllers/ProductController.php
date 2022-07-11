<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ApiResource;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        $products = DB::table('products')->get();

        return new ApiResource(true, 'List product berhasil diambil.', $products);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>  'required',
            'price' =>  'required',
            'stock' =>  'required',
            'description' =>  'required',
            'image' =>  'required|image|mimes:jpeg,png,jpg,svg',
        ]);

        if ($validator->fails()) {
            return new ApiResource(false, $validator->errors(), null);
        }

        // upload image
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        // create product
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $image->hashName(),
        ]);

        return new ApiResource(true, 'Data product berhasil disimpan.', $product);
    }


    public function show(Product $product)
    {
        return new ApiResource(true, 'Produk ditemukan', $product);
    }


    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' =>  'required',
            'price' =>  'required',
            'stock' =>  'required',
            'description' =>  'required',
        ]);

        if ($validator->fails()) {
            return new ApiResource(false, 'Data product gagal diubah.', null);
        }

        // check if image has not empty
        if ($request->hasFile('image')) {
            // upload image
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            // delete old image
            Storage::delete('public/products/' . $product->image);

            // update product with new image
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'description' => $request->description,
                'image' => $image->hashName(),
            ]);
        } else {
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'description' => $request->description,
            ]);
        }

        return new ApiResource(true, 'Data product berhasil diubah.', $product);
    }


    public function destroy(Product $product)
    {
        // delete image
        Storage::delete('public/products/' . $product->image);

        $product->delete();

        return new ApiResource(true, 'Data product berhasil dihapus.', null);
    }
}

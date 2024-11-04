<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Service;
use App\Models\ProductPictures;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function register(Request $request)
    {
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $admin->createToken('admin-token')->plainTextToken;

        return response()->json([
            'admin' => $admin,
            'token' => $token
        ], 201);
    }
    public function login(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $admin->createToken('admin-token')->plainTextToken;

        return response()->json([
            'admin' => $admin,
            'token' => $token
        ], 200);
    }
    public function addProduct(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'color' => $request->color,
            'size' => $request->size,
            'sheets_per_set' => $request->sheets_per_set,
        ]);

        return response()->json($product, 201);
    }

    public function getAdminName()
    {
        $adminId = Auth::id(); 

        if ($adminId) {
            $admin = Admin::find($adminId);
            
            if ($admin) {
                return response()->json(['adminName' => $admin->name]);
            } else {
                return response()->json(['error' => 'Admin not found'], 404);
            }
        } else {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
    }

    public function getProducts()
    {
        $products = Product::with(['pictures:id,product_id,file_path'])->get();

        return $products;
    }
    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    
        $product->update([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'color' => $request->color,
            'size' => $request->size,
            'sheets_per_set' => $request->sheets_per_set,
        ]);
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('img', 'public');
            $productPicture = ProductPictures::where('product_id', $id)->first();
    
            if ($productPicture) {
                Storage::disk('public')->delete($productPicture->file_path);
                $productPicture->update(['file_path' => $path]);
            } else {
                ProductPictures::create([
                    'product_id' => $id,
                    'file_path' => $path,
                ]);
            }
        }
    
        return response()->json(['message' => 'Product updated successfully']);
    }
    


    public function deleteProduct($id)
    {
        $product = product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(['message' => 'product deleted successfully.']);
        } else {
            return response()->json(['message' => 'product not found.'], 404);
        }
    }

    public function addPicture(Request $request, $productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
    
        $path = $request->file('image')->store('img', 'public');

        $productPicture = ProductPictures::where('product_id', $productId)->first();
        if ($productPicture) {
            Storage::disk('public')->delete($productPicture->file_path);  // Delete existing file
            $productPicture->update(['file_path' => $path]);         
        } else {
            ProductPictures::create([
                'product_id' => $productId,
                'file_path' => $path,
            ]);
        }
    
        return response()->json([
            'message' => 'Image uploaded successfully',
            'path' => Storage::url($path)
        ]);
    }
    
    public function addService(Request $request)
    {

        $service = Service::create([
            'service_name' => $request->service_name,
            'service_description' => $request->service_description,
            'service_price' => $request->service_price,
        ]);
    
        return response()->json($service, 201);
    }
    
    public function getServices()
    {
        $services = Service::all();
        return $services;
    }

        
    public function deleteService($id)
    {
        $service = Service::find($id);
        if ($service) {
            $service->delete();
            return response()->json(['message' => 'service deleted successfully.']);
        } else {
            return response()->json(['message' => 'service not found.'], 404);
        }
    }

    public function updateService(Request $request, $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'service not found'], 404);
        }
    
        $service->update([
            'service_name' => $request->service_name,
            'service_description' => $request->service_description,
            'service_price' => $request->service_price,
        ]);
    
        return response()->json(['message' => 'Product updated successfully']);
    }
    
}

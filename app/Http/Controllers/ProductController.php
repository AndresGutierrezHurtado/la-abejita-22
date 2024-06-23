<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\School;
use App\Models\Size;
use App\Models\ProductMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function profile($product_id) {

        $product = Product::with('sizes', 'media')->find($product_id);
        $schools = School::all();
        $sizes = Size::all();

        return view('admin.profile.product', ['product' => $product, 'schools' => $schools, 'sizes' => $sizes]);
    }

    public function update(Request $request, $product_id) {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string|max:255',
            'product_materials' => 'required|string',
            'product_image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'product_media.*' => 'nullable|file|mimes:jpeg,png,jpg,mp4,avi|max:20480',
            'sizes.*' => 'nullable|exists:sizes,size_id',
            'size_prices' => 'array',
            'size_prices.*' => 'numeric|min:0',
            'size_stocks' => 'array',
            'size_stocks.*' => 'integer|min:0',
            'schools' => 'array',
            'schools.*' => 'exists:schools,school_id',
        ]);

        DB::beginTransaction();
        
        try {
            // Encontrar el producto
            $product = Product::findOrFail($product_id);

            // Actualizar la información del producto
            $product->product_name = $request->input('product_name');
            $product->product_description = $request->input('product_description');
            $product->product_materials = $request->input('product_materials');

            // Subir la imagen principal del producto si se ha cargado una nueva
            if ($request->hasFile('product_image_url')) {
                $image = $request->file('product_image_url');
                $imageName = $product -> product_id . '.jpg';
                $image->move(public_path('images/products'), $imageName);
                $product->product_image_url = '/images/products/' . $imageName;
            }

            // Guardar el producto
            $product->save();

            // Sincronizar los colegios
            $schools = $request->input('schools', []);
            $product->schools()->sync($schools);

            // Sincronizar las tallas
            $sizes = $request->input('sizes', []);
            $sizePrices = $request->input('size_prices', []);
            $sizeStocks = $request->input('size_stocks', []);
            $sizeData = [];
            foreach ($sizes as $size_id) {
                $sizeData[$size_id] = [
                    'product_size_price' => $sizePrices[$size_id] ?? 0,
                    'product_size_stock' => $sizeStocks[$size_id] ?? 0,
                ];
            }
            $product->sizes()->sync($sizeData);

            // Subir y sincronizar archivos multimedia
            if ($request->hasFile('product_media')) {
                foreach ($request->file('product_media') as $index => $file) {
                    // Determinar el tipo de media (imagen o video)
                    $mediaType = Str::startsWith($file->getMimeType(), 'image') ? 'image' : 'video';
                    $mediaExtension = $file->getClientOriginalExtension();
                    
                    // Nombrar y mover
                    $mediaName = $product->product_id . '_' . ($index ++) . '.' . date('YmdHis') . '.' . ($mediaType === 'image' ? 'jpg' : 'mp4');
                    $file -> move(public_path('images/products/extra'), $mediaName);

                    // Crear el registro de media en la base de datos
                    $product->media()->create([
                        'media_url' => '/images/products/extra/' . $mediaName,
                        'media_type' => $mediaType,
                    ]);
                }
            }

            // Confirmar la transacción
            DB::commit();

            // Redirigir con mensaje de éxito
            return redirect()->back()->with('status_profile', 'Producto actualizado con éxito');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollback();

            return redirect()->back()->withErrors('Error al actualizar el producto: ' . $e->getMessage());
        }
    }

    public function media_destroy($media_id) {
        DB::beginTransaction();
    
        try {
            // Encontrar el registro de media por su ID
            $media = ProductMedia::findOrFail($media_id);
    
            // Obtener la URL del archivo multimedia
            $mediaUrl = public_path($media->media_url);
    
            // Verificar si el archivo existe y eliminarlo
            if (file_exists($mediaUrl)) {
                unlink($mediaUrl); // Eliminar el archivo del sistema de archivos
            }
    
            // Eliminar el registro de media de la base de datos
            $media->delete();
    
            // Confirmar la transacción
            DB::commit();
    
            // Redirigir con mensaje de éxito
            return redirect()->back()->with('status_profile', 'Archivo multimedia eliminado correctamente');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollback();
    
            return redirect()->back()->withErrors('Error al eliminar el archivo multimedia: ' . $e->getMessage());
        }
    }
    
}
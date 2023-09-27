<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProductoCollection;
use App\Http\Requests\CrearProductoRequest;
use App\Http\Requests\EditarProductoRequest;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //  return new ProductoCollection(Producto::where("disponible",1)
    //  ->orderBy('id', 'desc')
    //  ->paginate(10)
    // );

    // return new ProductoCollection(Producto::all());

    return new ProductoCollection(Producto::where("disponible",1)
    ->orderBy("id","DESC")
    ->get());
    }

    public function view()
    {
        return "productos aqui...";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CrearProductoRequest $request)
    {
        $data = $request->validated();

        $producto = [
            "nombre" => $data["nombre"],
            "precio" => $data["precio"],
            "categoria_id" => $data["categoria_id"],
            "url" => $data["url"],
            "imagen" => "",
            "disponible" => true,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ];

       $producto_agregado = DB::table("productos")->insert($producto);

        return [
            "mensaje" => "Producto creado correctamente",
            "producto" => $producto_agregado
        ];

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);

        return [
            "mensaje" => "Producto encontrado",
            "producto" => $producto
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $producto->disponible = 0;
        $producto->save();
        return [
            "producto" => $producto
        ];
    }

    public function actualizarProducto(EditarProductoRequest $request){
        $data = $request->validated();

        $producto = Producto::findOrFail($request->id);

        // Actualiza cada atributo del modelo
        $producto->nombre = $data["nombre"];
        $producto->precio = $data["precio"];
        $producto->categoria_id = $data["categoria_id"];
        $producto->url = $data["url"];
        $producto->disponible = true;

        $producto->save(); // Guarda los cambios en la base de datos

        return [
            "mensaje" => "Editado correctamente mi rey",
            "request" => $request->id
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return [
            "message" => "Producto eliminado de la base de datos correctamente",
        ];
    }

    public function productosFiltrados(Request $request){

        $productos = Producto::when($request->nombre, function($query, $nombre){
             $query->where("nombre", "LIKE", "%$nombre%");
        })
        ->when($request->categoria_id, function($query, $categoria_id){
            $query->where("categoria_id", $categoria_id);
        })
        ->paginate(100);

        return new ProductoCollection($productos);
    }
}

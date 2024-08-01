<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
    public function index() //funcion listar
    {
        $products = Product::where('state', 1)->get(); //llamo a model Product

        $data = [
            'products' => $products,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request) //request=peticion que envia el usuario
    {
        $validator = Validator::make($request->all(), [ //arreglo[]
            'name' => 'required|string|max:255',
            'description' => 'required|max:255',
            'price'  => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) { // si la vallidacion falla
            $data = [
                'message' => 'error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->jason($data, 400);
        }

        // Asignar el estado por defecto de 1 si no se proporciona en la solicitud
        $state = $request->has('state') ? $request->state : 1;

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price'  => $request->price,
            'stock' => $request->stock,
            'state' => $state,


        ]);

        if (!$product) { //si el crear falla
            $data = [
                'message' => 'Error al crear producto',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [ //si el crear funciona
            'message' => 'producto creado',
            'product' => $product,
            'status' => 201
        ];

        return response()->json($data, 201);
    }


    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {  //si el mostrar falla
            $data = [
                'message' => 'producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [ //si el mostrar funciona
            'product' => $product,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) { //si no hay Productos
            $data = [
                'message' => 'producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $product->state = 0;
        $product->save();

        $data = [
            'message' => 'producto eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id) //request: colocamos el dato|| id = buscar un dato
    {
        $product = Product::find($id);

        if (!$product) { //si encontrar estudiante falla
            $data = [
                'message' => 'producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        //sii lo encuentra entonces validar

        $validator = Validator::make($request->all(), [ //arreglo[]
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price'  => 'required|numeric', // 'price' es requerido y debe ser numérico
            'stock' => 'required|integer', //'stock' es requerido y debe ser un número entero
        ]);

        if ($validator->fails()) { // si la vallidacion falla
            $data = [
                'message' => 'error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->jason($data, 400);
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;


        $product->save();

        $data = [
            'message' => 'producto actualizado',
            'product' => $product,
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    public function updatePartial(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) { //si encontrar producto falla
            $data = [
                'message' => 'producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }


        $validator = Validator::make($request->all(), [ //arreglo[]
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price'  => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) { // si la vallidacion falla
            $data = [
                'message' => 'error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->jason($data, 400);
        }

        if ($request->has('name')) {
            $product->name = $request->name;
        }

        if ($request->has('description')) {
            $product->description = $request->description;
        }

        if ($request->has('price')) {
            $product->price = $request->price;
        }

        if ($request->has('stock')) {
            $product->stock = $request->stock;
        }


        $product->save();

        $data = [
            'message' => 'producto actualizado',
            'product' => $product,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function deleted()
    {
        $products = Product::where('state', 0)->get(); // Mostrar solo productos eliminados

        $data = [
            'products' => $products,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Platillo;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class ApiPlatillos
{
    public function index()
    {
        $platillos = Platillo::all();

        $platillos->transform(function ($platillo) {
            $platillo->foto_url = $platillo->foto 
                ? asset('storage/' . $platillo->foto)
                : asset('blog/default.png'); // imagen por defecto
            return $platillo;
        });

        return response()->json($platillos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categorias_id' => 'required|exists:categorias,id',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('platillos', 'public');
        }

        Platillo::create([
            'nombre' => $request->nombre,
            'categorias_id' => $request->categorias_id,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'foto' => $path,
        ]);

        return redirect()->back()->with('success', 'Platillo agregado correctamente.');
    }

    public function show($id)
    {
        $platillo = Platillo::find($id);

        if (!$platillo) {
            return redirect()->back()->with('error', 'Platillo no encontrado.');
        }

        $categorias = Categoria::all();

        return view('CRUDS.agregarPlatillo', compact('platillo', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categorias_id' => 'required|exists:categorias,id',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $platillo = Platillo::find($id);

        if (!$platillo) {
            return redirect()->back()->with('error', 'Platillo no encontrado.');
        }

        // Si se sube una nueva imagen, borrar la anterior
        if ($request->hasFile('foto')) {
            if ($platillo->foto && Storage::disk('public')->exists($platillo->foto)) {
                Storage::disk('public')->delete($platillo->foto);
            }

            $platillo->foto = $request->file('foto')->store('platillos', 'public');
        }else {
            $validated['foto'] = $platillo->foto;
        }
        $platillo->update([
            'nombre' => $request->nombre,
            'categorias_id' => $request->categorias_id,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'foto' => $platillo->foto,
        ]);
        

        return redirect()->back()->with('success', 'Platillo actualizado correctamente.');
    }

    public function destroy($id)
    {
        $platillo = Platillo::find($id);

        if (!$platillo) {
            return redirect()->back()->with('error', 'Platillo no encontrado.');
        }

        // Eliminar la foto del almacenamiento si existe
        if ($platillo->foto && Storage::disk('public')->exists($platillo->foto)) {
            Storage::disk('public')->delete($platillo->foto);
        }

        $platillo->delete();

        return redirect()->back()->with('success', 'Platillo eliminado correctamente.');
    }
}

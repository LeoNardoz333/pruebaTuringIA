<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class ApiCategorias
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Categoria::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->back()->with('success', 'Categoría agregada correctamente.');
    }
    public function show($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return redirect()->back()->with('error', 'Categoría no encontrada.');
        }

        return view('CRUDS.agregarCategoria', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $categoria = Categoria::find($id);

        if (!$categoria) {
            return redirect()->back()->with('error', 'Categoría no encontrada.');
        }

        $categoria->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->back()->with('success', 'Categoría actualizada correctamente.');
    }
    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return redirect()->back()->with('error', 'Categoría no encontrada.');
        }

        $categoria->delete();

        return redirect()->back()->with('success', 'Categoría eliminada correctamente.');
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Platillo;
use Carbon\Carbon;

class ApiVentas
{
    public function index()
    {
        $ventas = DB::table('v_ventas')->get();
        return response()->json($ventas);
    }
    public function store(Request $request)
    {
        $request->validate([
            'platillos_id' => 'required|exists:platillos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        Venta::create([
            'platillos_id' => $request->platillos_id,
            'cantidad' => $request->cantidad,
            'fecha_venta' => $request->fecha_venta ?? Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Venta registrada correctamente.');
    }

    public function show($id)
    {
        $venta = Venta::find($id);

        if (!$venta) {
            return redirect()->back()->with('error', 'Venta no encontrada.');
        }

        $platillos = Platillo::all();

        return view('CRUDS.agregarVenta', compact('venta', 'platillos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'platillos_id' => 'required|exists:platillos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $venta = Venta::find($id);

        if (!$venta) {
            return redirect()->back()->with('error', 'Venta no encontrada.');
        }

        $venta->update([
            'platillos_id' => $request->platillos_id,
            'cantidad' => $request->cantidad,
            'fecha_venta' => $request->fecha_venta,
        ]);

        return redirect()->back()->with('success', 'Venta actualizada correctamente.');
    }

    public function destroy($id)
    {
        $venta = Venta::find($id);

        if (!$venta) {
            return redirect()->back()->with('error', 'Venta no encontrada.');
        }

        $venta->delete();

        return redirect()->back()->with('success', 'Venta eliminada correctamente.');
    }
}

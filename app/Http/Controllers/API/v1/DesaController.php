<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function getData()
    {
        $desa = Desa :: all();
        return response()-> json([
            'message'   => 'success',
               'data'      => $desa
               ], 200);
        
    }
    public function getDetail($id)
    {
        $desa = Desa::find($id);

        if (!$desa) {
            return response()->json([
                'message' => 'Desa not found',
            ], 404);
        }

        return response()->json([
            'message' => 'success',
            'data' => $desa
        ], 200);
    }
    public function addDesa(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'district_code' => 'required|string',
            'name' => 'required|string',
            'meta' => 'required|string',
            
        ]);

        $newDesa = Desa::create([
            'code' => $request->input('code'),
            'district_code' => $request->input('district_code'),
            'name' => $request->input('name'),
            'meta' => $request->input('meta'),
            
        ]);

        return response()->json([
            'message' => 'Desa added successfully',
            'data' => $newDesa
        ], 201);
    }
    public function updateDesa(Request $request, $id)
    {
        $desa = Desa::find($id);

        if (!$desa) {
            return response()->json([
                'message' => 'Desa not found',
            ], 404);
        }

        $request->validate([
            'code' => 'required|string',
            'district_code' => 'required|string',
            'name' => 'required|string',
            'meta' => 'required|string',
            
        ]);

        $desa->update([
            'code' => $request->input('code'),
            'district_code' => $request->input('district_code'),
            'name' => $request->input('name'),
            'meta' => $request->input('meta'),
            
        ]);

        return response()->json([
            'message' => 'Desa updated successfully',
            'data' => $desa
        ], 200);
    }
    public function deleteDesa($id)
    {
        $desa = Desa::find($id);

        if (!$desa) {
            return response()->json([
                'message' => 'Desa not found',
            ], 404);
        }

        $desa->delete();

        return response()->json([
            'message' => 'Desa deleted successfully',
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\API;


use App\Models\API\Komentar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KomentarController extends Controller
{
    //
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'         => 'required|string|exists:user,uid',
            'isi_komentar'    => 'required|string',
            'komentar_type'   => 'required|string',
            'item_id'         => 'required|string',
            'parent_id'       => 'nullable|string|exists:komentar,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        return Komentar::create([
            'user_id'        => $request->user_id,
            'isi_komentar'   => $request->isi_komentar,
            'komentar_type'  => $request->komentar_type,
            'item_id'        => $request->item_id,
            'parent_id'      => $request->parent_id,
        ]);
    }
}

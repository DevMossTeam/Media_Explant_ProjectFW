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

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'komentar_type' => 'required|string',
            'item_id'       => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $komentar = Komentar::with(['user', 'parent'])
            ->where('komentar_type', $request->komentar_type)
            ->where('item_id', $request->item_id)
            ->orderBy('tanggal_komentar', 'desc')
            ->get();


        $data = $komentar->map(function ($item) {
            return [
                'id'               => $item->id,
                'user_id'          => $item->user_id,
                'isi_komentar'     => $item->isi_komentar,
                'tanggal_komentar' => $item->tanggal_komentar,
                'komentar_type'    => $item->komentar_type,
                'item_id'          => $item->item_id,
                'parent_id'        => $item->parent_id,
                'nama_pengguna'    => $item->user->nama_pengguna ?? null,
                'profil_pic'       => $item->user->profile_pic ?? null,
            ];
        });

        return response()->json($data);
    }
}

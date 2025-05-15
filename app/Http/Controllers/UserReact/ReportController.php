<?php

namespace App\Http\Controllers\UserReact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserReact\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Anda harus login untuk melaporkan.'], 401);
        }

        $request->validate([
            'report_reason' => 'required|string|max:255',
            'detail_pesan' => 'nullable|string|max:500',
            'item_id' => 'required|string'
        ]);

        $report = Report::create([
            'user_id'      => Auth::user()->uid,
            'pesan'        => $request->report_reason,
            'detail_pesan' => $request->detail_pesan,
            'status_read'  => 'belum',
            'status'       => 'laporan',
            'pesan_type'   => 'Berita',
            'item_id'      => $request->item_id
        ]);

        return response()->json(['success' => true, 'message' => 'Laporan berhasil dikirim.']);
    }
}

<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Author\Berita;
use App\Models\Author\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\DeviceToken;
use App\Providers\Services\NotificationService;
use Illuminate\Support\Facades\Log;

class BeritaController extends Controller
{

    protected NotificationService $notifier;

    public function __construct(NotificationService $notifier)
    {
        $this->notifier = $notifier;
    }
    public function store(Request $request)
    {
        // Validasi input (tags tidak wajib)
        $request->validate([
            'judul' => 'required|max:100',
            'konten_berita' => 'required|string',
            'kategori' => 'required',
            'visibilitas' => 'required|in:public,private',
        ]);

        // Validasi tambahan: pastikan konten bukan hanya kosong atau <p><br></p>
        $konten = trim(strip_tags($request->konten_berita));
        if ($konten === '' || $request->konten_berita === '<p><br></p>') {
            return redirect()->back()->withInput()->with('error', 'Konten berita tidak boleh kosong.');
        }

        // Ambil uid dari cookie
        $userUid = $request->cookie('user_uid');

        // Buat berita
        $articleId = Str::random(12); // ID berita dibuat secara acak
        $article = Berita::create([
            'id' => $articleId,
            'judul' => $request->judul,
            'tanggal_diterbitkan' => $request->tanggal_diterbitkan,
            'user_id' => $userUid,
            'kategori' => $request->kategori,
            'konten_berita' => $request->konten_berita,
            'visibilitas' => $request->visibilitas,
        ]);

        // Simpan tags jika ada
        if ($request->has('tags') && !empty($request->tags)) {
            $tags = explode(',', $request->tags);
            foreach ($tags as $tag) {
                Tag::create([
                    'id' => Str::random(12),
                    'nama_tag' => trim($tag),
                    'berita_id' => $articleId,
                ]);
            }
        }

        $notificationResult = [];
        try {
            // Judul notifikasi
            $notifTitle = 'Berita Baru: ' . $article->judul;
            // Body notifikasi (bisa Anda sesuaikan)
            $notifBody  = Str::limit(strip_tags($article->konten_berita), 50);
            // Payload data, misal kita kirim berita_id
            $payloadData = [
                'berita_id' => (string) $article->id,
            ];

            $notificationResult = $this->notifier->send($notifTitle, $notifBody, $payloadData);
        } catch (\Throwable $e) {
            // Log error agar kita tahu mengapa notifikasi gagal
            Log::error('Gagal mengirim notifikasi berita', [
                'error'      => $e->getMessage(),
                'berita_id'  => $article->id,
            ]);
            // Kita tetap lanjutkan—jangan batalkan proses simpan berita
            $notificationResult = [
                [
                    'success' => false,
                    'error'   => $e->getMessage(),
                ]
            ];
        }

        // 7. Redirect kembali dengan pesan sukses, sertakan hasil notifikasi (opsional)
        return redirect()
            ->back()
            ->with('success', 'Berita berhasil dipublikasikan.')
            ->with('notificationResult', $notificationResult);
    }
}

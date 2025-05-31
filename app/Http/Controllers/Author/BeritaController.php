<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Author\Berita;
use App\Models\Author\Tag;
use App\Models\DeviceToken;
use App\Providers\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    protected NotificationService $notifier;

    public function __construct(NotificationService $notifier)
    {
        $this->notifier = $notifier;
    }

    public function store(Request $request)
    {
        // 1. Validasi input (tags tidak wajib)
        $request->validate([
            'judul'              => 'required|string|max:100',
            'konten_berita'      => 'required|string|max:65535',
            'kategori'           => 'required|string',
            'visibilitas'        => 'required|in:public,private',
            // Jika tanggal_diterbitkan diizinkan override, bisa ditambahkan validasinya:
            // 'tanggal_diterbitkan' => 'nullable|date',
        ]);

        // 2. Ambil uid pengguna dari cookie (asumsi sudah di‐set)
        $userUid = $request->cookie('user_uid');

        // 3. Generate ID acak untuk berita
        $articleId = Str::random(12);

        // 4. Buat berita baru
        $article = Berita::create([
            'id'                  => $articleId,
            'judul'               => $request->judul,
            'tanggal_diterbitkan' => $request->tanggal_diterbitkan ?? now(),
            'user_id'             => $userUid,
            'kategori'            => $request->kategori,
            'konten_berita'       => $request->konten_berita,
            'visibilitas'         => $request->visibilitas,
        ]);

        // 5. Simpan tags jika ada (dipisah dengan koma)
        if ($request->filled('tags')) {
            // Contoh input: "politik, ekonomi, teknologi"
            $tags = explode(',', $request->tags);
            foreach ($tags as $tagNama) {
                $tagNama = trim($tagNama);
                if (strlen($tagNama) === 0) {
                    continue;
                }
                Tag::create([
                    'id'         => Str::random(12),
                    'nama_tag'   => $tagNama,
                    'berita_id'  => $articleId,
                ]);
            }
        }

        // 6. Kirim notifikasi ke semua device token pembaca
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

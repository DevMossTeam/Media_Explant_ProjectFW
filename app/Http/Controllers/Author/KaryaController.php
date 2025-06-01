<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author\Karya;
use App\Models\API\DeviceToken;
use App\Providers\Services\NotificationService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class KaryaController extends Controller
{
    protected NotificationService $notifier;

    public function __construct(NotificationService $notifier)
    {
        $this->notifier = $notifier;
    }

    public function store(Request $request)
    {
        // 1. Validasi Input (mirip persis dengan BeritaController, hanya sesuaikan rule-nya)
        $request->validate([
            'penulis'     => 'required|string|max:100',
            'judul'       => 'required|string|max:150',
            'deskripsi'   => 'required_unless:kategori,fotografi,desain_grafis|string',
            'konten'      => 'nullable|string',
            'kategori'    => 'required|string',
            'media'       => 'required|file|mimes:jpg,jpeg,png|max:10240',
            'visibilitas' => 'required|in:public,private',
        ]);

        // 2. Konversi file gambar menjadi base64 (jika ada)
        $fileBase64 = null;
        if ($request->hasFile('media')) {
            $fileBase64 = base64_encode(
                file_get_contents($request->file('media')->path())
            );
        }

        // 3. Ambil uid pengguna dari cookie (sama seperti BeritaController)
        $userUid = $request->cookie('user_uid');

        // 4. Generate ID acak untuk Karya
        $karyaId = Str::random(12);

        // 5. Simpan ke Database
        $karya = Karya::create([
            'id'           => $karyaId,
            'creator'      => $request->penulis,
            'judul'        => $request->judul,
            'deskripsi'    => $request->deskripsi ?? '',
            'konten'       => $request->konten ?? '',
            'kategori'     => $request->kategori,
            'user_id'      => $userUid,
            'media'        => $fileBase64,
            'release_date' => now(),
            'visibilitas'  => $request->visibilitas,
        ]);

        // 6. Kirim notifikasi ke semua device token pembaca
        $notificationResult = [];
        try {
            // – Judul notifikasi: ambil dari judul karya
            $notifTitle = $karya->judul;

            // – Body notifikasi: potong deskripsi sampai 50 karakter
            //   (sama persis seperti di BeritaController: strip_tags dan Str::limit)
            $plainDesc  = strip_tags($karya->deskripsi);
            $notifBody  = Str::limit($plainDesc, 50);

            // – Payload data: sertakan ID karya agar aplikasi bisa membuka detailnya
            $payloadData = [
                'karya_id' => (string) $karya->id,
            ];

            // – Panggil service untuk mengirim notifikasi (harus sama persis)
            $notificationResult = $this->notifier->send($notifTitle, $notifBody, $payloadData);

        } catch (\Throwable $e) {
            // Jika ada error, log ke file agar developer tahu penyebabnya
            Log::error('Gagal mengirim notifikasi Karya', [
                'error'    => $e->getMessage(),
                'karya_id' => $karya->id,
            ]);

            // Buat hasil notifikasi berupa array dengan success=false
            $notificationResult = [
                [
                    'success' => false,
                    'error'   => $e->getMessage(),
                ]
            ];
        }

        // 7. Redirect kembali dengan pesan sukses, sertakan hasil notifikasi (sama persis)
        return redirect()
            ->back()
            ->with('success', 'Karya berhasil dipublikasikan!')
            ->with('notificationResult', $notificationResult);
    }
}

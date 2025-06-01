<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\Services\NotificationService;
use Illuminate\Support\Facades\DB;
use App\Models\API\DeviceToken;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    protected NotificationService $notifier;

    public function __construct(NotificationService $notifier)
    {
        $this->notifier = $notifier;
    }

    public function create()
    {
        return view('author.create-product');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'kategori'    => 'required|in:Buletin,Majalah',
            'media'       => 'required|file|mimes:pdf|max:10240',
            'cover'       => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'visibilitas' => 'required|in:public,private',
        ]);

        $plainDesc = trim(strip_tags($request->deskripsi));
        if ($plainDesc === '' || $request->deskripsi === '<p><br></p>') {
            return redirect()->back()->withInput()->with('error', 'Deskripsi tidak boleh kosong.');
        }

        // 2. Ambil file media (PDF) sebagai binary
        $mediaFile    = $request->file('media');
        $mediaContent = file_get_contents($mediaFile->getRealPath());

        // 3. Ambil file cover (image) dan ubah ke base64 (untuk thumbnail/previews)
        $coverFile   = $request->file('cover');
        $coverContent = file_get_contents($coverFile->getRealPath());
        $coverBase64 = 'data:' . $coverFile->getMimeType() . ';base64,' . base64_encode($coverContent);

        // 4. Ambil UID user dari cookie
        $userUid = $request->cookie('user_uid');

        // 5. Generate ID acak untuk produk
        $produkId = Str::random(12);

        // 6. Persiapkan hasil notifikasi
        $notificationResult = [];

        try {
            // 7. Simpan data produk ke tabel 'produk'
            DB::table('produk')->insert([
                'id'           => $produkId,
                'judul'        => $request->judul,
                'deskripsi'    => $request->deskripsi,
                'kategori'     => $request->kategori,
                'user_id'      => $userUid,
                'media'        => $mediaContent,
                'cover'        => $coverBase64,
                'release_date' => now(),
                'visibilitas'  => $request->visibilitas,
            ]);

            // 8. Kirim notifikasi ke semua device token
            // – Judul notifikasi: sama dengan judul produk
            $notifTitle = $request->judul;

            // – Body notifikasi: potong deskripsi hingga 50 karakter (strip HTML jika ada)
            $plainDesc  = strip_tags($request->deskripsi);
            $notifBody  = Str::limit($plainDesc, 50);

            // – Payload data: sertakan ID produk agar aplikasi bisa menavigasi ke detail
            $payloadData = [
                'produk_id' => (string) $produkId,
            ];

            // – Panggil service untuk mengirim notifikasi (mirip persis Berita/Karya)
            $notificationResult = $this->notifier->send($notifTitle, $notifBody, $payloadData);

            // 9. Redirect sukses, sertakan hasil notifikasi
            return redirect()
                ->back()
                ->with('success', 'Produk berhasil disimpan.')
                ->with('notificationResult', $notificationResult);
        } catch (\Throwable $e) {
            // Jika penyimpanan atau notifikasi gagal, cek apakah error terjadi di pengiriman notifikasi
            // Atau error query DB—menangkap semuanya di sini
            Log::error('Gagal menyimpan atau mengirim notifikasi Produk', [
                'error'     => $e->getMessage(),
                'produk_id' => $produkId,
            ]);

            // Kalau memang error karena notifikasi, kita tetap menganggap produk sudah tersimpan.
            // Namun jika error di query DB, produk belum masuk ke database.
            // Untuk sederhana, langsung redirect dengan pesan error:
            return redirect()
                ->back()
                ->with('error', 'Gagal menyimpan atau mengirim notifikasi: ' . $e->getMessage());
        }
    }
}

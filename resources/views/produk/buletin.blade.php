<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buletin - {{ $buletin->judul ?? 'Tidak Ditemukan' }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
</head>
<body>
    <h1>Produk Kami</h1>
    <p>Kumpulan Produk Terbaik</p>
    <hr>

    @if (isset($error))
        <p>{{ $error }}</p>
    @elseif ($buletin)
        <h2>{{ $buletin->judul }}</h2>
        <p><strong>Tanggal Rilis:</strong> {{ \Carbon\Carbon::parse($buletin->release_date)->translatedFormat('d M Y') }}</p>

        <!-- Thumbnail PDF -->
        <canvas id="pdf-thumbnail"></canvas>

        <!-- PDF Viewer -->
        <iframe src="data:application/pdf;base64,{{ base64_encode($buletin->media) }}" width="100%" height="600px"></iframe>

        <script>
            var pdfData = atob("{{ base64_encode($buletin->media) }}");

            var loadingTask = pdfjsLib.getDocument({ data: pdfData });
            loadingTask.promise.then(function(pdf) {
                pdf.getPage(1).then(function(page) {
                    var scale = 1.5;
                    var viewport = page.getViewport({ scale: scale });

                    var canvas = document.getElementById('pdf-thumbnail');
                    var context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    page.render(renderContext);
                });
            });
        </script>
    @endif
</body>
</html>

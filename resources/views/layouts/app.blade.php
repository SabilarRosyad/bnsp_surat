<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Surat Desa Karangduren</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid justify-content-center">
            <a class="navbar-brand mx-auto text-center" style="font-weight:700;letter-spacing:1px;font-size:1.5rem;" href="{{ route('letters.index') }}">Arsip Surat Karangduren</a>
        </div>
    </nav>
    @yield('content')

</body>
</html>
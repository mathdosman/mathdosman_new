<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Formulir Kontak</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            margin: 0; /* Menghapus margin default body */
            background-color: #f4f4f4;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto; /* Memberi margin dan memusatkan container */
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden; /* Memastikan konten tidak keluar dari container */
        }

        .email-header {
            background-color: #007bff; /* Warna biru untuk header */
            color: white;
            text-align: center;
            padding: 20px;
        }

        .email-body {
            padding: 20px;
        }

        .email-footer {
            background-color: #f0f0f0;
            text-align: center;
            padding: 20px;
            font-size: 0.8em;
            color: #666;
        }

        .strong {
            font-weight: bold;
        }

        @media (max-width: 600px) {
            .email-container {
                margin: 10px; /* Menyesuaikan margin untuk layar kecil */
            }
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="email-header">
            <h1>Pesan Baru dari Formulir Kontak</h1>
        </div>

        <div class="email-body">
            <p><strong>Nama:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> {{$email}}</p>
            <p><strong>Subjek:</strong> {{ $subject }}</p>
            <p><strong>Pesan:</strong></p>
            <p>{{ $message }}</p>
        </div>

        <div class="email-footer">
            <p>Ini adalah pesan otomatis dari formulir kontak situs web Anda.</p>
        </div>
    </div>

</body>
</html>

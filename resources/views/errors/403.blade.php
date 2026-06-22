<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — Akses Ditolak</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('admin_assets/favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            color: #1a1a2e;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .error-box {
            text-align: center;
            max-width: 480px;
        }

        .error-box__code {
            font-size: 80px;
            font-weight: 700;
            color: #c0392b;
            line-height: 1;
            margin-bottom: 8px;
        }

        .error-box__title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .error-box__message {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .error-box__btn {
            display: inline-block;
            padding: 10px 24px;
            background: #1a1a2e;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: opacity .2s;
        }

        .error-box__btn:hover {
            opacity: .85;
        }
    </style>
</head>

<body>
    <div class="error-box">
        <div class="error-box__code">403</div>
        <div class="error-box__title">Akses Ditolak</div>
        <div class="error-box__message">
            {{ $exception->getMessage() ?: 'Anda tidak memiliki izin untuk mengakses halaman ini.' }}
        </div>
        <a href="{{ route('admin.dashboard') }}" class="error-box__btn">Kembali ke Dashboard</a>
    </div>
</body>

</html>

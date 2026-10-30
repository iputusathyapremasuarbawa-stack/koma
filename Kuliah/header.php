<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f2f4f8;
            color: #333;
        }
        header {
            background: #1e3a8a;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        header h1 { margin: 0; font-size: 24px; }
        header p { margin: 5px 0 0; font-size: 14px; }
        main {
            max-width: 600px;
            margin: 30px auto;
            padding: 0 16px;
        }
        .kotak {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .pilihan label {
            display: inline;
            font-weight: normal;
            margin-right: 15px;
        }
        .pilihan input { width: auto; }
        .tombol {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }
        .simpan { background: #1e3a8a; color: #fff; }
        .reset { background: #ccc; }
        .error {
            background: #fde2e2;
            color: #b91c1c;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .sukses {
            background: #dcfce7;
            color: #166534;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 8px; border-bottom: 1px solid #eee; vertical-align: top; }
        td:first-child { width: 35%; font-weight: bold; }
        footer {
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #666;
        }
    </style>
</head>
<body>
    <header>
        <h1>Formulir Pendaftaran</h1>
        <p>Silakan isi data diri Anda dengan lengkap dan benar</p>
    </header>
    <main>

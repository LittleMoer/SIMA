<!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Akses Dilarang</title>
       <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Jika Anda menggunakan CSS -->
   </head>
   <body>
       <div style="text-align: center; margin-top: 50px;">
           <h1>403 - Akses Dilarang</h1>
           <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>
           <a href="{{ url('/') }}">Kembali ke Beranda</a>
       </div>
   </body>
   </html>

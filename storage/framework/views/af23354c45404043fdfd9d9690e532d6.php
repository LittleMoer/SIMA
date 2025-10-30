<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Dilarang</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>"> <!-- Jika Anda menggunakan CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8d7da;
            color: #721c24;
            text-align: center; /* Center text and image */
            margin-top: 50px;
        }
        img {
            max-width: 100%; /* Responsive image */
            height: auto; /* Maintain aspect ratio */
            margin: 20px 0; /* Add some margin around the image */
        }
    </style>
</head>
<body>
    <h1>403 - Akses Dilarang</h1>
    <img src="<?php echo e(asset('images/403img2.jpg')); ?>" alt="Akses Dilarang">
    <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>
    <a href="<?php echo e(url('/')); ?>">Kembali ke Beranda</a>
</body>
</html>
<?php /**PATH C:\Users\Windows 10 Pro\Documents\work\simapush\SIMA\resources\views/403.blade.php ENDPATH**/ ?>
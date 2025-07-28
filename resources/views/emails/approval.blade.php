<!DOCTYPE html>
<html>
<head>
    <title>Akun Disetujui</title>
</head>
<body>
    <h2>Halo, {{ $user->username }}</h2>
    <p>Selamat! Akun Anda telah disetujui oleh admin.</p>
    <p>Silakan login ke aplikasi menggunakan username dan password Anda.</p>

    <br>
    <p>Terima kasih,</p>
    <p>Admin {{ config('app.name') }}</p>
</body>
</html>

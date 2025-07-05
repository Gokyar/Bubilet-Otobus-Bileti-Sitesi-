<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifremi unuttum</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.bundle.js"></script>
</head>

<body>
    <nav class="menu">
        <a class="menu_anasayfa" href="index.php">buBİLET</a>
    </nav>


    <div class="login" style="height: 350px;">
        <form class="form1" method="post" action="sifre_degistir.php">
            <label>E-posta:</label>
            <input type="email" name="mail">
            <label>Yeni Şifre:</label>
            <input type="password" name="yeni_sifre">
            <label>Yeni Şifre Tekrar:</label>
            <input type="password" name="yeni_sifre_tekrar">
            <button>Şifre Değiştir</button>
        </form>
    </div>

</body>

</html>
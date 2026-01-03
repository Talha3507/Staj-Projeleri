<?php
    session_start();
    include("baglanti.php");

    if ($_SESSION["giris"] == sha1(md5("var")) && $_COOKIE["kullanici"] == "msb") {
        header("Location: cikis.php");
    }

    if ($_POST) {
        $aciklama = $_POST["aciklama"];
        $sorgu = $baglanti->query("delete from projelerimiz");
        $sorgu = $baglanti->query("insert into projelerimiz (aciklama) values ('$aciklama')");
        echo "<script> window.location.href='projelerimiz.php';</script>";
    }


    $sorgu = $baglanti->query("select * from projelerimiz");
    $satir = $sorgu->fetch_object();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title> Yönetim Paneli Projelerimiz</title>
</head>
<body>

    <div style="text-align:center;">
        <a href="anasayfa.php">ANA SAYFA</a> - <a href="duzenleme.php">KULLANICI DÜZENLEME</a> - <a href="portfolyo.php">PORTFOLYO</a> - <a href="hakkimizda.php">HAKKIMIZDA</a> - <a href="hizmetlerimiz.php">HİZMETLERİMİZ</a> - <a href="projelerimiz.php">PROJERLEİMİZ</a> - <a href="index.php" onclick="if (!confirm('Çıkış Yapmak İstediğinize Emin misiniz?')) return false;">ÇIKIŞ</a>
        <br><hr><br><br>
    </div>

    <form action="" method="post">
        <b>İçerik:</b><br><br>
        <textarea style="width:50%;height:200px;" name="aciklama"><?php echo $satir->aciklama; ?></textarea><br><br>
        <input type="submit" value="Kaydet">
    </form>



</body>
</html>

<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    include("baglanti.php");

    if (
    (isset($_SESSION["giris"]) && $_SESSION["giris"] == sha1(md5("var"))) &&
    (isset($_COOKIE["kullanici"]) && $_COOKIE["kullanici"] == "msb"))
        {
    header("Location: cikis.php");
    exit;
      }

    if ($_POST) {
        $aciklama = $_POST["aciklama"];
        $sorgu = $baglanti->query("delete from hizmetlerimiz");
        $stmt = $baglanti->prepare("INSERT INTO hizmetlerimiz (aciklama) VALUES (?)");
        $stmt->bind_param("s", $aciklama);
        $stmt->execute();

        if ($sorgu) {
            echo "<script> window.location.href='hizmetlerimiz.php';</script>";
        } else {
            echo "<script>
            alert('HATA: KAYIT YAPILAMADI!');
            window.location.href='hizmetlerimiz.php';</script>";
        }
    }


    $sorgu = $baglanti->query("select * from hizmetlerimiz");
    $satir = $sorgu->fetch_object();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title> Yönetim Paneli Hizmetlerimiz</title>
</head>
<body>

    <div style="text-align:center;">
        <a href="anasayfa.php">ANA SAYFA</a> - <a href="duzenleme.php">KULLANICI DÜZENLEME</a> - <a href="portfolyo.php">PORTFOLYO</a> - <a href="hakkimizda.php">HAKKIMIZDA</a> - <a href="hizmetlerimiz.php">HİZMETLERİMİZ</a> - <a href="projelerimiz.php">PROJELERİMİZ</a> - <a href="index.php" onclick="if (!confirm('Çıkış Yapmak İstediğinize Emin misiniz?')) return false;">ÇIKIŞ</a>
        <br><hr><br><br>
    </div>

    <form action="" method="post">
        <b>İçerik:</b><br><br>
        <textarea style="width:50%;height:200px;" name="aciklama"><?php echo $satir->aciklama; ?></textarea><br><br>
        <input type="submit" value="Kaydet">
    </form>



</body>
</html>

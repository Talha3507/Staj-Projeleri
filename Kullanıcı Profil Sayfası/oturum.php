<?php
session_start();
include "config.php"; //config dosyamızı sayfaya dahil ettik.

$hata = "";
if($_POST) {
    //post işlemi yapılmış mı
    $postKadi = addslashes($_POST["kullanici_adi"]);
    $postSifre = addslashes($_POST["sifre"]);

    $prepare = $db->prepare("select * from kisi where kullanici_adi=:kadi && sifre=:sifre");
    $prepare->execute(array(
        "kadi" => $postKadi,
        "sifre" => $postSifre
    ));

    if($prepare->rowCount() > 0) {
        // bilgiler eşleşiyor oturum aç.
        $kullanici = $prepare->fetch();

        $_SESSION["kid"] = $kullanici["kullanici_id"]; //oturum için kullanıcı id değerini tutmamız yeterli. bu id değerli ile diğer bilgilerine ulaşabiliriz.
        $_SESSION["kullanici_adi"] = $kullanici["kullanici_adi"];
        header("Location: oturum.php");
    }else {
        $hata = "Kullanıcı adı veya şifre hatalı!";
        header("Location: oturum.php");
    }
}
$hata = "";
if(isset($_SESSION["hata"])) {
    $hata = $_
}

// çıkış yap


if(isset($_GET["islem"]) && $_GET["islem"] == "cikis") {
    session_destroy();
    // çıkış yap oturum sayfasına yönlendir
    header("Location: oturum.php");
}



?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
        <meta charset="UTF-8">
        <title>Oturum sayfası</title>
        </head>
        <body>
        <?php
            if(isset($_SESSION["kid"])) {
                //oturum açılmış login ekranını gösterme
                ?>

                <p>Merhaba <?= $_SESSION["kullanici_adi"] ?>, Oturum Açtığınız için teşekkür ederiz. </p>

                <a href="?islem=cikis"> Çıkış yap</a>



                <?php
            }else {
                //oturum açılmamış login ekranını göster
                ?>

                <form action="" method="post">
                <table>
                <tr>
                <td colspan="2">
                <?= $hata ?></td>
                </tr>
                <tr>
                <td>Kullanıcı Adı</td>
                <td><input type="text" name="kullanici_adi" /></td>
                </tr>
                <tr>
                <td>Şifre</td>
                <td><input type="password" name="sifre" /></td>
                </tr>
                <tr>
                <td colspan="2"> <button type="submit">Giriş Yap</button></td>
                </tr>

                </table>
                <?php } ?>
                </form>

                </body>
                </html>

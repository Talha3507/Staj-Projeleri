<!DOCTYPE HTML>
<html lang="en-US">
<head>
        <meta charset="UTF-8">
        <title></title>
</head>
<body style="width:800px;margin:0 auto;padding:20px 0;">


<?php

try {
    $db = new
    PDO("mysql:host=localhost;dbname=kullanicilar", "root","Test");
    $db->setAttribute(PDO::ATTR_ERRMODE,
                      PDO::ERRMODE_EXCEPTION);
}   catch (PDOException $e ){
    print $e->getMessage();
}



$page = isset($_GET["page"]) ? addslashes($_GET["page"])
:"";


echo '

<a href="?page=anasayfa"> Ana Sayfa</a> |
<a href="?page=ekle"> Yeni Kullanıcı Ekle</a> |
<a href="?page=listele"> Tüm kullanıcıları listele</a>
<br/>
';



if($page == "ekle") {
    if($_POST) {
        $kullanici_id = addslashes($_POST["kullanici_id"]);
        $kullanici_adi = addslashes($_POST["kullanici_adi"]);
        $kullanici_soyadi = addslashes($_POST["kullanici_soyadi"]);
        $kullanici_cinsiyeti = addslashes($_POST["kullanici_cinsiyeti"]);


        $sorgu = $db->prepare("INSERT INTO kullanicilar SET kullanici_id= :kid, kullanici_adi= :kad, kullanici_soyadi= :ksoyad, kullanici_cinsiyeti= :kcinsiyet");


        try {
            $ekle = $sorgu->execute(array(
                "kid" => $kullanici_id,
                "kad" => $kullanici_adi,
                "ksoyad" => $kullanici_soyadi,
                "kcinsiyet" => $kullanici_cinsiyeti
            ));
            echo $ekle ? "Kullanıcı Eklendi." : "Sistemsel bir hata oluştu.";
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    //kullanıcı ekleme formu

    echo ' <form action="?page=ekle" method="post">
    <h2>Kullanıcı Ekle</h2>
    <table>
        <tr>
        <td>Kullanıcı id</td>
        <td>:</td>
        <td><input type="text" name="kullanici_id" /></td>
        </tr>
        <tr>
        <td>Kullanıcı Adı</td>
        <td>:</td>
        <td><input type="text" name="kullanici_adi" /></td>
        </tr>
        <tr>
        <td>Kullanıcı Soyadı</td>
        <td>:</td>
        <td><input type="text" name="kullanici_soyadi" /></td>
        </tr>
        <tr>
        <td>Kullanıcı cinsiyeti</td>
        <td>:</td>
        <td><input type="text" name="kullanici_cinsiyeti" /></td>
        </tr>
        <tr>
        <td colspan="3">
        <button type="submit"> KAYDET</button></td>
        </tr>
        </table>

        </form>';


} else if ($page=="guncelle") {
    //Güncelleme Sayfası
    $id = intval($_GET["id"]); // kullanıcı id

    if($_POST) {
        //post işlemi gerçekleşmiş ise

        $kullanici_id = addslashes($_POST["kullanici_id"]);
        $kullanici_adi = addslashes($_POST["kullanici_adi"]);
        $kullanici_soyadi = addslashes($_POST["kullanici_soyadi"]);
        $kullanici_cinsiyeti = addslashes($_POST["kullanici_cinsiyeti"]);

        $sorgu = $db->prepare("UPDATE kullanicilar SET kullanici_id= :kid, kullanici_adi= :kadi, kullanici_soyadi= :ksoyadi,
                              kullanici_cinsiyeti= :kcinsiyet WHERE kullanici_id = :id");

        try {
            $ekle = $sorgu->execute(array(
                "kid" => $kullanici_id,
                "kadi" => $kullanici_adi,
                "ksoyadi" => $kullanici_soyadi,
                "kcinsiyet" => $kullanici_cinsiyeti,
                "id" => $id
            ));

            echo $ekle ? "Kullanıcı Güncellendi." : "Sistemsel bir hata oluştu.";
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    $kullanici = $db->query("select * from kullanicilar where kullanici_id='$id'")->fetch();

    //kulllanıcı ekleme formu
    echo '<form action="?page=guncelle&id='.$id.'"
    method="post">
        <h2>Kullanıcı Düzenle</h2>
        <table>
            <tr>
            <td>Kullanıcı id</td>
            <td>:</td>
            <td><input type="text" name="kullanici_id" value="'.$kullanici["kullanici_id"].'" /></td>
            </tr>
            <tr>
            <td>Ad</td>
            <td>:</td>
            <td><input type="text" name="kullanici_adi" value="'.$kullanici["kullanici_adi"].'" /></td>
            </tr>
            <tr>
            <td>Soyad</td>
            <td>:</td>
            <td><input type="text" name="kullanici_soyadi" value="'.$kullanici["kullanici_soyadi"].'" /></td>
            </tr>
            <tr>
            <td>Cinsiyet</td>
            <td>:</td>
            <td><input type="text" name="kullanici_cinsiyeti" value="'.$kullanici["kullanici_cinsiyeti"].'"/></td>
            </tr>
            <tr>
            <td colspan="3">
            <button type="submit">GÜNCELLE</button></td>
            </tr>
            </table>
            </form>';
} else if($page == "listele") {
    //listeleme sayfası

    if(isset($_GET["islem"]) && $_GET["islem"]
        =="sil" && isset($_GET["id"])
    ) {
        //DELETE işlemi
        $id = intval($_GET["id"]);

        $sorgu = $db->prepare("delete from kullanicilar where kullanici_id= ?");
        $sil = $sorgu->execute(array($id));

        echo $sil ? "Kullanıcı Silindi." :
        "Sistemsel bir hata oluştu.";
    }

    echo '<h2> KULLANICI LİSTELE</h2>';
    $kullanicilar = $db->query("select * from kullanicilar order by kullanici_adi asc");
    if($kullanicilar->rowCount() == 0) {
        echo 'Kullanıcı Bulunamadı.';
    }else {
       echo ' <table border=1 width="100%">
        <tr>
        <td>Kullanıcı id</td>
        <td>Kullanıcı Adı</td>
        <td>Kullanıcı Soyadı</td>
        <td>Kullanıcı Cinsiyeti</td>
        <td>İşlemler</td>
        </tr>';
    foreach($kullanicilar->fetchAll() as $kullanici)  {
        echo '
        <tr>
        <td>'.$kullanici["kullanici_id"].'</td>
        <td>'.$kullanici["kullanici_adi"].'</td>
        <td>'.$kullanici["kullanici_soyadi"].'</td>
        <td>'.$kullanici["kullanici_cinsiyeti"].'</td>
        <td>
        <a href="?
        page=listele&islem=sil&id='.$kullanici["kullanici_id"].'">SİL</a>

        <a href="?page=guncelle&id='.$kullanici["kullanici_id"].'">
        Güncelle</a>
        </td>
        </tr>
        ';
    }
    }
}else {
    echo 'Ana Sayfa. Yapabileceğiniz İşlemler:
    <br/>
        ';
}
?>

</body>
</html>

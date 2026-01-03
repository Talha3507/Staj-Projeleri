<?php
session_start();
include("config.php");

// Giriş yapılmamışsa login sayfasına yönlendir
if(!isset($_SESSION["Oturum"]) || $_SESSION["Oturum"] != "6789") {
    header("location:giris.php");
    exit;
}

$hata = "";
if($_POST){
    $txtKadi = trim($_POST["txtKadi"]);
    $txtParola = trim($_POST["txtParola"]);
    $txtParolaTekrar = trim($_POST["txtParolaTekrar"]);

    if($txtKadi != "" && $txtParola != "" && $txtParola == $txtParolaTekrar){
        $parolaHash = md5("56".$txtParola."23");

        if($baglanti->query("INSERT INTO kullanici (kadi, parola) VALUES ('$txtKadi', '$parolaHash')")){
            header("location:indexx.php");
            exit;
        } else {
            $hata = "Bir hata oluştu, tekrar deneyin.";
        }
    } else {
        $hata = "Alanları düzgün doldurunuz ve şifreler eşleşmeli.";
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<title>Yeni Kullanıcı</title>
<style>.kutu{margin-top:40px}</style>
</head>
<body>

<div class="row align-content-center justify-content-center">
    <div class="col-md-3 kutu">
        <h3 class="text-center">Yeni Kullanıcı Ekle</h3>

        <?php if($hata != ""): ?>
            <div class="alert alert-danger"><?php echo $hata; ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="txtKadi" class="form-control" placeholder="Kullanıcı Adı" value="<?php echo @$txtKadi; ?>"/>
            <br>
            <input type="password" name="txtParola" class="form-control" placeholder="Parola"/>
            <br>
            <input type="password" name="txtParolaTekrar" class="form-control" placeholder="Parola Tekrar"/>
            <br>
            <input type="submit" class="btn btn-primary btn-block" value="Kaydet"/>
        </form>
    </div>
</div>

</body>
</html>

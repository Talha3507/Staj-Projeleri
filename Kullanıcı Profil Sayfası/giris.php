<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
include("config.php");

// Zaten giriş yapmışsa yönlendir
if(isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789") {
    header("location:indexx.php");
    exit;
}

// Çerez kontrolü
if(isset($_COOKIE["cerez"])) {
    $sorgu = $conn->query("select kadi from kullanici");
    while($sonuc = $sorgu->fetch_assoc()) {
        if($_COOKIE["cerez"] == md5("aa" . $sonuc['kadi'] . "bb")) {
            $_SESSION["Oturum"] = "6789";
            $_SESSION["kadi"] = $sonuc['kadi'];
            header("location:indexx.php");
            exit;
        }
    }
}

// FORM POST EDİLDİYSE
$hata = "";
if($_POST){
    $txtKadi = $_POST["txtKadi"];
    $txtParola = $_POST["txtParola"];

    $sorgu = $baglanti->query("select parola from kullanici where kadi='$txtKadi'");
    $sonuc = $sorgu->fetch_assoc();

    if($sonuc && md5("56".$txtParola."23") == $sonuc["parola"]){
        $_SESSION["Oturum"] = "6789";
        $_SESSION["kadi"] = $txtKadi;

        if(isset($_POST["ckbHatirla"])){
            setcookie("cerez", md5("aa".$txtKadi."bb"), time() + (60*60*24*7));
        }

        header("location:indexx.php");
        exit;
    } else {
        $hata = "Kullanıcı adı veya parola yanlış";
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<title>Giriş</title>
<style>.kutu{margin-top:40px}</style>
</head>
<body>

<form method="post">
    <div class="row align-content-center justify-content-center">
        <div class="col-md-3 kutu">
            <h3 class="text-center">Giriş Ekranı</h3>

            <?php if($hata != "") echo "<div class='alert alert-danger'>$hata</div>"; ?>

            <input type="text" name="txtKadi" class="form-control" placeholder="Kullanıcı Adı"
                   value="<?php echo @$txtKadi; ?>" />

            <br>

            <input type="password" name="txtParola" class="form-control" placeholder="Parola"/>

            <br>

            <label>
                <input type="checkbox" name="ckbHatirla"/> Beni Hatırla
            </label>

            <br><br>

            <input type="submit" class="btn btn-primary btn-block" value="Giriş"/>

        </div>
    </div>
</form>

</body>
</html>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("baglanti.php");

// Giriş kontrolü
if (!isset($_SESSION["Oturum"]) || $_SESSION["Oturum"] != "6789") {
    header("location:index.php");
    exit;
}

// ID kontrolü
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id <= 0){
    die("Geçerli bir kullanıcı ID belirtin.");
}

// Mevcut kullanıcıyı getir
$sorgu = $baglanti->query("SELECT * FROM kullanici WHERE id=$id");
if(!$sorgu){
    die("Sorgu hatası: " . $baglanti->error);
}

$sonuc = $sorgu->fetch_assoc();
if(!$sonuc){
    die("Kullanıcı bulunamadı.");
}

// Form gönderildiğinde
if($_SERVER["REQUEST_METHOD"] == "POST") {
 $txtKadi = isset($_POST['txtKadi']) ? trim($_POST['txtKadi']) : '';
$txtParola = isset($_POST['txtParola']) ? $_POST['txtParola'] : '';

$sorgu = $baglanti->query("SELECT sifre FROM kullanici WHERE kullanici='$txtKadi'");
if($sorgu && $sonuc = $sorgu->fetch_assoc()){
    if(md5("56".$txtParola."23") == $sonuc['sifre']){
        $_SESSION['Oturum'] = '6789';
        $_SESSION['kadi'] = $txtKadi;
        header("location:indexx.php");
        exit;
    } else {
        $hata = "Kullanıcı adı veya parola yanlış";
    }
} else {
    $hata = "Kullanıcı adı veya parola yanlış";
}

    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <title>Kullanıcı Düzenle</title>
    <style>
        .kutu { margin-top: 40px; }
    </style>
</head>
<body>
<div class="row align-content-center justify-content-center">
    <div class="col-md-3 kutu">
        <h3 class="text-center">Kullanıcı Düzenle</h3>
        <?php if(isset($hata)) echo "<div class='alert alert-danger'>$hata</div>"; ?>
        <form method="post">
            <table class="table">
                <tr>
                    <td>
                        <input type="text" name="txtKadi" class="form-control" placeholder="Kullanıcı Adı"
                               value="<?php echo htmlspecialchars($sonuc['kullanici']); ?>" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" name="txtParola" class="form-control" placeholder="Yeni Parola (isteğe bağlı)"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" name="txtParolaTekrar" class="form-control" placeholder="Parola Tekrar"/>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        <input type="submit" class="btn btn-primary btn-block" value="Kaydet"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
</body>
</html>

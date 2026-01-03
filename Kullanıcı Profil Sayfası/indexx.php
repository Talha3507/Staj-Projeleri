<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>İndex</title>
    <link rel="stylesheet" type="text/css" href="css/boostrap.min.css">
</head>
<body>
<?php
session_start();


if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789") {
    $kadi = $_SESSION["kadi"];
}else {
    header("location:giris.php");
}
?>
<div class="container">
    <h1>Merhaba <?php echo $kadi; ?></h1>

    <a href="register.php" class="btn btn-primary">Yeni Kullanıcı</a>
    <a href="cıkıs.php" class="btn btn-danger">Çıkış</a> <br><br>

    <div class="col-md-6">
        <table class="table">
            <tr>
                <th>Kullanıcı Adı</th>
                <th>İşlem</th>
            </tr>
            <?php
            include("config.php");

            $sorgu = $baglanti->query("select * from kullanici");

            while ($sonuc = $sorgu->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $sonuc["kadi"] ?></td>
                    <td>

                    <a href="userEdit.php?id=<?php echo $sonuc["id"] ?>"></a>
                    <a href="userDelete.php?id=<?php echo $sonuc["id"]?>"></a>
                    </td>
                    </tr>
                    <?php
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>
            }

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("baglanti.php");


if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $stmt = $baglanti->prepare("DELETE FROM kullanici WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: duzenleme.php?msg=Silindi");
        exit;
    } else {
        echo "Hata: " . $baglanti->error;
    }
}


$kullanicilar = $baglanti->query("SELECT * FROM kullanici WHERE email != 'admin@gmail.com' ORDER BY id ASC");
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kullanıcı Düzenle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.min.css" />
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Kullanıcı Listesi</h2>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success text-center"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>

    <div class="text-center mb-3">
        <a href="yeni_kayit.php" class="btn btn-success">Yeni Kayıt Ekle</a>
        <a href="anasayfa.php" class="btn btn-dark">Vazgeç</a>
    </div>

    <div class="d-flex justify-content-center">
        <table class="table table-bordered table-striped" style="width: auto;">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Kullanıcı Adı</th>
                    <th>E-Posta</th>
                    <th>Şifre</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($k = $kullanicilar->fetch_assoc()): ?>
                    <tr>
                        <td><?= $k['id'] ?></td>
                        <td><?= $k['kullanici'] ?></td>
                        <td><?= $k['email'] ?></td>
                        <td><?= $k['sifre'] ?></td>
                        <td>
                            <a href="kullanici_duzenle.php?id=<?= $k['id'] ?>" class="btn btn-outline-primary btn-sm">Düzenle</a>
                            <a href="duzenleme.php?delete_id=<?= $k['id'] ?>" onclick="return confirm('Silmek istediğinize Emin Misiniz?')" class="btn btn-outline-danger btn-sm">Sil</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

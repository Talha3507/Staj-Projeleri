<?php

$servername="localhost";
$username="root";
$password="Test";
$dbname="kullanicilar";

//Bağlantı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// bağlantıyı test et
if($conn->connect_error) {
    die("Bağlantı hatası:" . $conn->connect_error);
}else {
    echo "MYSQL bağlantı başarılı";
}




if(isset($_POST['isim'],$_POST['email'],$_POST['sifre'])) {
    $isim = $_POST['isim'];
    $email = $_POST['email'];
    $sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT); //şifreyi hashle
    
    

    $sql = "INSERT INTO uyeler(isim, email, sifre) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if(!$stmt) {
    die("Hazırlama hatası: " . $conn->error);
}
    $stmt->bind_param("sss", $isim, $email, $sifre);


    if($stmt->execute()) {
        echo "Kayıt başarılı<br>";
    } else {
        echo "Hata" . $conn->error;
    }

}
?>

<form method="post">
    İsim: <input type="text" name="isim"><br>
    Email: <input type="email" name="email"><br>
    Şifre: <input type="password" name="sifre"><br>
    <button type="submit">Kayıt Ol</button>

</form>

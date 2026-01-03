 <?php
 session_start();

 if(isset($_SESSION["Oturum"]) || $_SESSION["Oturum"] !="6789")
 {
     header("location:giris.php");
}
if($_GET)
{
    include("config.php");
    $id=(int)$_GET["id"];

    $sorgu=$baglanti->query("delete from kullanici where id=$id");

    header("location:indexx.php");
}
?>

<?php
require_once "db_bagla.php";

try {
    if (isset($_POST['kaydet'])) {
    
    //if($_POST['email'] == "" || $_POST['sifre'] == "")
    //{
       // $_POST['hata']="Lütfen tüm alanları doldurunuz";
    //}
    //else{
        $sqlQuery = "INSERT INTO uyeler(mail,sifre) VALUES(
          '" . $_POST['kayit_email'] . "',
          '" . $_POST['kayit_sifre'] . "')";
        

        echo $sqlQuery;

        $sqlResult = $dbConnection->exec($sqlQuery);

        header("Location:uye_giris.php?state=1");
    }
    //}
} catch (Exception $e) {
    echo $e->getMessage();
    header("Location:uye_giris.php?state=0");
}

?>
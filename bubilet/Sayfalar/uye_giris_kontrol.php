<?php
require_once "db_bagla.php"; 
$e_posta=$_POST['email'];

$sqlQuery = $dbConnection->query("SELECT *, count(*) as kontrol FROM uyeler WHERE mail='$e_posta'");

foreach($sqlQuery as $deger){
    if($deger['kontrol']==1){
        if($deger['sifre']==$_POST['sifre']){
            session_start();
            $_SESSION['uye_id']=$deger['id'];
            echo $_SESSION['uye_id'];
        }
        else{
            echo "Şifre yanlış";
            break;
        }
    }
    else{
        echo "E-posta yanlış";
        break;
    }
}
?>

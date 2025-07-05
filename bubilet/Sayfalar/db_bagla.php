<?php 
  try
  {
    // PDO bağlantısı kurulur
    $dbConnection = new PDO("mysql:host=localhost;dbname=bubilet", "root", "0123456789");
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Hata modunu ayarlayalım
  }
  catch (Exception $e)
  {
    // Hata durumunda bağlantı null yapılır ve hata mesajı gösterilir
    $dbConnection = null;
    echo "Veritabanı bağlantı hatası: " . $e->getMessage();
  }
?>

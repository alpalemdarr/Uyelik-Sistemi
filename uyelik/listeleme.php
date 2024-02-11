<?php


$baglanti = new mysqli("localhost", "root", "", "uyelik");

if ($baglanti->connect_errno > 0) {
    die("<b>Bağlantı Hatası:</b> " . $baglanti->connect_error);
}

$baglanti->set_charset("utf8");

$sorgu = $baglanti->prepare("SELECT * FROM kullanicilar");

if ($baglanti->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $baglanti->error);
}

$sorgu->execute();

$sonuc = $sorgu->get_result();

while ($cikti = $sonuc->fetch_array()) {
    echo "Kullanıcı Adı: " . $cikti["kullanici_adi"] . "<br /> E-posta: " . $cikti["email"] . "<hr />";
}

$sorgu->close();
$baglanti->close();

?>
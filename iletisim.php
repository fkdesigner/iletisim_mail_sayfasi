<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>�LET���M</title>
</head>

<body>
</body>
</html>

<?php

/*
FK Mail Sistemi
Yazar: F�rat KOYUNCU
Nick: FK Designer
Website: www.fkdesigner.com
E-Mail: fkdesigner@hotmail.com - iletisim@fkdesigner.com
Facebook Sayfas�: www.facebook.com/fkdesigner
Twitter Sayfas�: www.twitter.com/fkdesigner
*/


//E�er form g�nderilmi� ise a�a��daki i�lemler uygulanacakt�r.
if (isset($_POST["guvenlik"])) {

//Formdan gelen bilgileri al�p de�i�kenlere kaydediyoruz.
$ad_soyad2 = $_POST['ad_soyad'];
$e_posta2 = $_POST['e_posta'];
$konu2 = $_POST['konu'];
$guvenlik2 = $_POST['guvenlik'];
$mesaj2 = $_POST['mesaj'];

//E�er bilgiler bo� girilmi�se hata verdiriyoruz
if (empty($ad_soyad2)){
echo '<br><font face="arial" size="3" color="red">L�tfen ad�n�z� ve soyad�n�z� giriniz.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri D�n</a>';
exit;
}
if (empty($e_posta2)){
echo '<br><font face="arial" size="3" color="red">L�tfen e-posta adresinizi giriniz.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri D�n</a>';
exit;
}
if (empty($konu2)){
echo '<br><font face="arial" size="3" color="red">L�tfen mesaj�n�za uygun bir konu giriniz.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri D�n</a>';
exit;
}
if (empty($guvenlik2)){
echo '<br><font face="arial" size="3" color="red">L�tfen g�venlik sorusunu yan�tlay�n�z.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri D�n</a>';
exit;
}
if (empty($mesaj2)){
echo '<br><font face="arial" size="3" color="red">L�tfen mesaj�n�z� yaz�n�z.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri D�n</a>';
exit;
}

//E-Posta kontrol� yap�yoruz, do�ru girilmi� mi diye
if (eregi("^.+@.+\..+$", $e_posta2, $e_posta3 )){
}
else {
echo '<br><font face="arial" size="3" color="red">L�tfen e-posta adresinizi do�ru bir bi�imde giriniz.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri D�n</a>';
exit;
}

foreach ($e_posta3 as $e_posta4){
$son_e_posta = $e_posta4;
}

//Burada g�venlik sorusu e�er do�ru cevaplanm��sa mail gidiyor, cevaplanmam��sa hata veriliyor
if ($guvenlik2==44){
//BU SATIRIN ALTINA �STED���N�Z@MA�L.ADRES�N�N YER�NE KEND� MA�L ADRES�N�Z� YAZIN
$kime = 'istediginiz@mail.adresi';
$basliklar = 'From:'."$son_e_posta"."\n";
$basliklar .= 'Reply-To:'."$son_e_posta"."\n";
$basliklar .= 'Content-type: text/html; charset=iso-8859-9'."\n";

$son_mesaj .= '<b>G�nderenin Bilgileri:</b><br><font color="red">Ad� Soyad� : </font>'."$ad_soyad2".'<br><font color="red">E-Posta Adresi : </font>'."$son_e_posta".'<br><font color="red">Mesaj Konusu : </font>'."$konu2".'<br><font color="red">Mesaj� : </font>';
$son_mesaj .= $mesaj2;
$son_mesaj .= '<br><br><font face="verdana" size="1" color="black">Bu e-mail <b><font face="verdana" size="1" color="red">FK</font> <font face="verdana" size="1" color="blue">Designer</font> Bili�im Hizmetleri</b>nin FK Mail Sistemi ile gonderilmistir.</font><br><br>';
$son_konu = "�LET���M MA�L�";
if (mail($kime, $son_konu, $son_mesaj, $basliklar)){
echo '<br><b><font face="arial" size="4" color="green">Mesaj�n�z iletildi, te�ekk�rler.</font></b><br>';
}
else {
echo '<br><font face="arial" size="3" color="red">Bir sorun olu�tu ve mesaj g�nderilemedi. L�tfen daha sonra tekrar deneyin.</font><br>';
}
}
else {
echo '<br><font face="arial" size="3" color="red">G�venlik Sorusunu Yanl�� Yan�tlad�n�z.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri D�n</a>';
exit;
}

}
//E�er form g�nderilmemi� ise o zaman a�a��dan bo� form g�sterilecektir.
else { ?>

<form action="<?php echo $_SERVER["SCRIPT_NAME"] ?>" method="post">
<font face="arial" size"3" color="black">Ad�n�z Soyad�n�z : </font><input type="text" name="ad_soyad" size="25" maxlength = "25"><br>
<br><font face="arial" size"3" color="black">E-Posta Adresiniz : </font><input type="text" name="e_posta" size="25" maxlength = "25"><br>
<br><font face="arial" size"3" color="black">Mesaj�n�z�n Konusu : </font><input type="text" name="konu" size="25" maxlength = "25"><br>
<br><font face="arial" size"3" color="black">G�venlik Sorusu :
<br> 15+22+7 = </font><input type="text" name="guvenlik" size="10" maxlength = "10"><br>
<br><font face="arial" size"3" color="black">Mesaj�n�z : </font><br><textarea name="mesaj" rows="10" cols="40" tabindex="40" maxlength = "500"></textarea><br>
<br><input type="reset" value="TEM�ZLE"> <input type="submit" value="G�NDER">
</form>



<?php
}
?>
<br>
<br>
<font face="verdana" size="1" color="black">FK Mail System</font>
<br><font face="verdana" size="1" color="red">FK </font><font face="verdana" size="1" color="blue">Designer </font><font face="verdana" size="1" color="black">Bili�im Hizmetleri: <font face="verdana" size="1" color="blue"><a href="http://www.fkdesigner.com">www.fkdesigner.com</a></font>
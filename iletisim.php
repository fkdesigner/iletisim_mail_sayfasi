<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>�LET���M</title>
</head>
<body>
<?php

############################################################
/*
FK �leti�im Mail Sistemi
Yazar: F�rat KOYUNCU
Nick: FK Designer
Website: www.fkdesigner.com
E-Mail: fkdesigner@hotmail.com - iletisim@fkdesigner.com
Facebook Sayfas�: www.facebook.com/fkdesigner
Twitter Sayfas�: www.twitter.com/fkdesigner
*/
############################################################

//Fonksiyonlar�m�z:
//bosmu_kontrol: Formun bo� g�nderilmemesi i�in yazd���m fonksiyon.
function bosmu_kontrol($deger){
	if (empty($deger)){
	echo "<br><center><b><font face='verdana' size='2' color='red'>L�tfen t�m alanlar� doldurun.</font></b>";
	echo "<br><br><a href='iletisim.php'>Geri d�nmek i�in t�klay�n.</a></center><br>";
	exit;
	}
return;
}
//guvenlik_filtresi: K�t� ama�l� ziyaret�iler i�in forma yaz�lan html kodlar�n�z temizler ve kod yaz�m�nda kullan�lan temel karakterleri siler.
function guvenlik_filtresi($deger){
	$deger = strip_tags ($deger);
	$deger = eregi_replace ("<", "", $deger);
	$deger = eregi_replace (">", "", $deger);
	$deger = eregi_replace ("/", "", $deger);
	$deger = eregi_replace ("=", "", $deger);
	$deger = eregi_replace ("'", "", $deger);
	$deger = eregi_replace ('"', "", $deger);
	$deger = eregi_replace ("{", "", $deger);
	$deger = eregi_replace ("}", "", $deger);
	$deger = eregi_replace ("&", "", $deger);
	$deger = eregi_replace ("%", "", $deger);
	$deger = eregi_replace ("$", "", $deger);
return $deger;
}

//E�er form g�nderilmi� ise a�a��daki i�lemler uygulanacakt�r.
if (isset($_POST["guvenlik"])) {

//Formdan gelen bilgileri al�p de�i�kenlere kaydediyoruz.
$ad_soyad = $_POST['ad_soyad'];
$e_posta = $_POST['e_posta'];
$konu = $_POST['konu'];
$guvenlik = $_POST['guvenlik'];
$mesaj = $_POST['mesaj'];

//E�er bilgiler bo� girilmi�se hata verdiriyoruz
bosmu_kontrol($ad_soyad);
bosmu_kontrol($e_posta);
bosmu_kontrol($konu);
bosmu_kontrol($guvenlik);
bosmu_kontrol($mesaj);

//E-Posta kontrol� yap�yoruz, do�ru girilmi� mi diye
if (eregi("^.+@.+\..+$", $e_posta, $e_posta )){
}
else {
echo '<br><font face="arial" size="3" color="red">L�tfen e-posta adresinizi do�ru bir bi�imde giriniz.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri D�n</a>';
exit;
}
list ($e_posta) = $e_posta;

//Burada t�m veriler g�venlik filtresinden ge�iriliyor;
guvenlik_filtresi($ad_soyad);
guvenlik_filtresi($e_posta);
guvenlik_filtresi($konu);
guvenlik_filtresi($guvenlik);
guvenlik_filtresi($mesaj);

//Burada g�venlik sorusu e�er do�ru cevaplanm��sa mail gidiyor, cevaplanmam��sa hata veriliyor;
if ($guvenlik == "44"){
//BU SATIRIN ALTINA �STED���N�Z@MA�L.ADRES�N�N YER�NE KEND� MA�L ADRES�N�Z� YAZIN
$kime = 'istediginiz@mail.adresi';
$basliklar = 'From:'."$e_posta"."\n";
$basliklar .= 'Reply-To:'."$e_posta"."\n";
$basliklar .= 'Content-type: text/html; charset=iso-8859-9'."\n";

$son_mesaj .= '<b>G�nderenin Bilgileri:</b><br><font color="red">Ad� Soyad� : </font>'."$ad_soyad".'<br><font color="red">E-Posta Adresi : </font>'."$e_posta".'<br><font color="red">Mesaj Konusu : </font>'."$konu".'<br><font color="red">Mesaj� : </font>';
$son_mesaj .= $mesaj;
$son_mesaj .= '<br><br><font face="verdana" size="1" color="black">Bu e-mail <b><font face="verdana" size="1" color="red">FK</font> <font face="verdana" size="1" color="blue">Designer</font> Bili�im Hizmetleri</b>nin FK �leti�im Mail Sistemi ile g�nderilmi�tir.</font><br><br>';
$son_konu = "�LET���M MA�L�";
if (mail($kime, $son_konu, $son_mesaj, $basliklar)){
echo '<br><center><b><font face="arial" size="4" color="green">Mesaj�n�z iletildi, te�ekk�rler.</font></b></center><br>';
}
else {
echo '<br><center><font face="arial" size="3" color="red">Bir sorun olu�tu ve mesaj g�nderilemedi. L�tfen daha sonra tekrar deneyin.</font></center><br>';
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
<br />
<br />
<br />
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
<center><font face="verdana" size="1" color="black">FK �leti�im Mail Sistemi</font>
<br><font face="verdana" size="1" color="red">FK </font><font face="verdana" size="1" color="blue">Designer </font><font face="verdana" size="1" color="black">Bili�im Hizmetleri:</font> <font face="verdana" size="1" color="blue"><a href="http://www.fkdesigner.com">www.fkdesigner.com</a></font></center>
</body>
</html>

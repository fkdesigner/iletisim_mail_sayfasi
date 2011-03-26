<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>İLETİŞİM</title>
</head>
<body>
<?php

############################################################
/*
FK İletişim Mail Sistemi
Yazar: Fırat KOYUNCU
Nick: FK Designer
Website: www.fkdesigner.com
E-Mail: fkdesigner@hotmail.com - iletisim@fkdesigner.com
Facebook Sayfası: www.facebook.com/fkdesigner
Twitter Sayfası: www.twitter.com/fkdesigner
*/
############################################################

//Fonksiyonlarımız:
//bosmu_kontrol: Formun boş gönderilmemesi için yazdığım fonksiyon.
function bosmu_kontrol($deger){
	if (empty($deger)){
	echo "<br><center><b><font face='verdana' size='2' color='red'>Lütfen tüm alanları doldurun.</font></b>";
	echo "<br><br><a href='iletisim.php'>Geri dönmek için tıklayın.</a></center><br>";
	exit;
	}
return;
}
//guvenlik_filtresi: Kötü amaçlı ziyaretçiler için forma yazılan html kodlarınız temizler ve kod yazımında kullanılan temel karakterleri siler.
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

//Eğer form gönderilmiş ise aşağıdaki işlemler uygulanacaktır.
if (isset($_POST["guvenlik"])) {

//Formdan gelen bilgileri alıp değişkenlere kaydediyoruz.
$ad_soyad = $_POST['ad_soyad'];
$e_posta = $_POST['e_posta'];
$konu = $_POST['konu'];
$guvenlik = $_POST['guvenlik'];
$mesaj = $_POST['mesaj'];

//Eğer bilgiler boş girilmişse hata verdiriyoruz
bosmu_kontrol($ad_soyad);
bosmu_kontrol($e_posta);
bosmu_kontrol($konu);
bosmu_kontrol($guvenlik);
bosmu_kontrol($mesaj);

//E-Posta kontrolü yapıyoruz, doğru girilmiş mi diye
if (eregi("^.+@.+\..+$", $e_posta, $e_posta )){
}
else {
echo '<br><font face="arial" size="3" color="red">Lütfen e-posta adresinizi doğru bir biçimde giriniz.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri Dön</a>';
exit;
}
list ($e_posta) = $e_posta;

//Burada tüm veriler güvenlik filtresinden geçiriliyor;
guvenlik_filtresi($ad_soyad);
guvenlik_filtresi($e_posta);
guvenlik_filtresi($konu);
guvenlik_filtresi($guvenlik);
guvenlik_filtresi($mesaj);

//Burada güvenlik sorusu eğer doğru cevaplanmışsa mail gidiyor, cevaplanmamışsa hata veriliyor;
if ($guvenlik == "44"){
//BU SATIRIN ALTINA İSTEDİĞİNİZ@MAİL.ADRESİNİN YERİNE KENDİ MAİL ADRESİNİZİ YAZIN
$kime = 'istediginiz@mail.adresi';
$basliklar = 'From:'."$e_posta"."\n";
$basliklar .= 'Reply-To:'."$e_posta"."\n";
$basliklar .= 'Content-type: text/html; charset=iso-8859-9'."\n";

$son_mesaj .= '<b>Gönderenin Bilgileri:</b><br><font color="red">Adı Soyadı : </font>'."$ad_soyad".'<br><font color="red">E-Posta Adresi : </font>'."$e_posta".'<br><font color="red">Mesaj Konusu : </font>'."$konu".'<br><font color="red">Mesajı : </font>';
$son_mesaj .= $mesaj;
$son_mesaj .= '<br><br><font face="verdana" size="1" color="black">Bu e-mail <b><font face="verdana" size="1" color="red">FK</font> <font face="verdana" size="1" color="blue">Designer</font> Bilişim Hizmetleri</b>nin FK İletişim Mail Sistemi ile gönderilmiştir.</font><br><br>';
$son_konu = "İLETİŞİM MAİLİ";
if (mail($kime, $son_konu, $son_mesaj, $basliklar)){
echo '<br><center><b><font face="arial" size="4" color="green">Mesajınız iletildi, teşekkürler.</font></b></center><br>';
}
else {
echo '<br><center><font face="arial" size="3" color="red">Bir sorun oluştu ve mesaj gönderilemedi. Lütfen daha sonra tekrar deneyin.</font></center><br>';
}
}
else {
echo '<br><font face="arial" size="3" color="red">Güvenlik Sorusunu Yanlış Yanıtladınız.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri Dön</a>';
exit;
}

}
//Eğer form gönderilmemiş ise o zaman aşağıdan boş form gösterilecektir.
else { ?>
<br />
<br />
<br />
<form action="<?php echo $_SERVER["SCRIPT_NAME"] ?>" method="post">
<font face="arial" size"3" color="black">Adınız Soyadınız : </font><input type="text" name="ad_soyad" size="25" maxlength = "25"><br>
<br><font face="arial" size"3" color="black">E-Posta Adresiniz : </font><input type="text" name="e_posta" size="25" maxlength = "25"><br>
<br><font face="arial" size"3" color="black">Mesajınızın Konusu : </font><input type="text" name="konu" size="25" maxlength = "25"><br>
<br><font face="arial" size"3" color="black">Güvenlik Sorusu :
<br> 15+22+7 = </font><input type="text" name="guvenlik" size="10" maxlength = "10"><br>
<br><font face="arial" size"3" color="black">Mesajınız : </font><br><textarea name="mesaj" rows="10" cols="40" tabindex="40" maxlength = "500"></textarea><br>
<br><input type="reset" value="TEMİZLE"> <input type="submit" value="GÖNDER">
</form>



<?php
}
?>
<br>
<br>
<center><font face="verdana" size="1" color="black">FK İletişim Mail Sistemi</font>
<br><font face="verdana" size="1" color="red">FK </font><font face="verdana" size="1" color="blue">Designer </font><font face="verdana" size="1" color="black">Bilişim Hizmetleri:</font> <font face="verdana" size="1" color="blue"><a href="http://www.fkdesigner.com">www.fkdesigner.com</a></font></center>
</body>
</html>

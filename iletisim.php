<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>İLETİŞİM</title>
</head>

<body>
</body>
</html>

<?php

/*
FK Mail Sistemi
Yazar: Fırat KOYUNCU
Nick: FK Designer
Website: www.fkdesigner.com
E-Mail: fkdesigner@hotmail.com - iletisim@fkdesigner.com
Facebook Sayfası: www.facebook.com/fkdesigner
Twitter Sayfası: www.twitter.com/fkdesigner
*/


//Eğer form gönderilmiş ise aşağıdaki işlemler uygulanacaktır.
if (isset($_POST["guvenlik"])) {

//Formdan gelen bilgileri alıp değişkenlere kaydediyoruz.
$ad_soyad2 = $_POST['ad_soyad'];
$e_posta2 = $_POST['e_posta'];
$konu2 = $_POST['konu'];
$guvenlik2 = $_POST['guvenlik'];
$mesaj2 = $_POST['mesaj'];

//Eğer bilgiler boş girilmişse hata verdiriyoruz
if (empty($ad_soyad2)){
echo '<br><font face="arial" size="3" color="red">Lütfen adınızı ve soyadınızı giriniz.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri Dön</a>';
exit;
}
if (empty($e_posta2)){
echo '<br><font face="arial" size="3" color="red">Lütfen e-posta adresinizi giriniz.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri Dön</a>';
exit;
}
if (empty($konu2)){
echo '<br><font face="arial" size="3" color="red">Lütfen mesajınıza uygun bir konu giriniz.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri Dön</a>';
exit;
}
if (empty($guvenlik2)){
echo '<br><font face="arial" size="3" color="red">Lütfen güvenlik sorusunu yanıtlayınız.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri Dön</a>';
exit;
}
if (empty($mesaj2)){
echo '<br><font face="arial" size="3" color="red">Lütfen mesajınızı yazınız.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri Dön</a>';
exit;
}

//E-Posta kontrolü yapıyoruz, doğru girilmiş mi diye
if (eregi("^.+@.+\..+$", $e_posta2, $e_posta3 )){
}
else {
echo '<br><font face="arial" size="3" color="red">Lütfen e-posta adresinizi doğru bir biçimde giriniz.</font><br>';
echo "<br>";
echo '<a href="iletisim.php">Geri Dön</a>';
exit;
}

foreach ($e_posta3 as $e_posta4){
$son_e_posta = $e_posta4;
}

//Burada güvenlik sorusu eğer doğru cevaplanmışsa mail gidiyor, cevaplanmamışsa hata veriliyor
if ($guvenlik2==44){
//BU SATIRIN ALTINA İSTEDİĞİNİZ@MAİL.ADRESİNİN YERİNE KENDİ MAİL ADRESİNİZİ YAZIN
$kime = 'istediginiz@mail.adresi';
$basliklar = 'From:'."$son_e_posta"."\n";
$basliklar .= 'Reply-To:'."$son_e_posta"."\n";
$basliklar .= 'Content-type: text/html; charset=iso-8859-9'."\n";

$son_mesaj .= '<b>Gönderenin Bilgileri:</b><br><font color="red">Adı Soyadı : </font>'."$ad_soyad2".'<br><font color="red">E-Posta Adresi : </font>'."$son_e_posta".'<br><font color="red">Mesaj Konusu : </font>'."$konu2".'<br><font color="red">Mesajı : </font>';
$son_mesaj .= $mesaj2;
$son_mesaj .= '<br><br><font face="verdana" size="1" color="black">Bu e-mail <b><font face="verdana" size="1" color="red">FK</font> <font face="verdana" size="1" color="blue">Designer</font> Bilişim Hizmetleri</b>nin FK Mail Sistemi ile gonderilmistir.</font><br><br>';
$son_konu = "İLETİŞİM MAİLİ";
if (mail($kime, $son_konu, $son_mesaj, $basliklar)){
echo '<br><b><font face="arial" size="4" color="green">Mesajınız iletildi, teşekkürler.</font></b><br>';
}
else {
echo '<br><font face="arial" size="3" color="red">Bir sorun oluştu ve mesaj gönderilemedi. Lütfen daha sonra tekrar deneyin.</font><br>';
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
<font face="verdana" size="1" color="black">FK Mail System</font>
<br><font face="verdana" size="1" color="red">FK </font><font face="verdana" size="1" color="blue">Designer </font><font face="verdana" size="1" color="black">Bilişim Hizmetleri: <font face="verdana" size="1" color="blue"><a href="http://www.fkdesigner.com">www.fkdesigner.com</a></font>
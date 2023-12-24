<?php 
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Hasil CAPTCHA</title>
</head>
<body>
	<h2 align="center">Informasi Login: </h2>
	<p align="center">
		<?php 
			$nama = $_POST["username"];
			$pwd = $_POST["password"];

				session_start();


				if($_SESSION["code"] !=$_POST["kodecaptcha"]){
					echo '<img src="https://s3.zerochan.net/240/26/10/3568026.jpg" alt="ayase" width="140" height="180">'; echo "<br>";
					echo "Username anda adalah <b>$nama</b>"; echo "<br>";
					echo "Password anda adalah <b>$pwd</b>"; echo "<br>"; echo "<br>";
					echo "Kode Captcha Anda Salah";
				} else {
					echo "Username anda adalah <b>$nama</b>"; echo "<br>";
					echo "Password anda adalah <b>$pwd</b>"; echo "<br>"; echo "<br>";
					echo "Kode Captcha Anda Benar"; 
				}
		?>
	</p>
</body>
</html>
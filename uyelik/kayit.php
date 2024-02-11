<?php  

include ("baglanti.php");


$username_err="";
$email_err="";
$parola_err="";
$parolatkr_err="";


if (isset($_POST["kaydet"])) 
{
	if (empty($_POST["kullaniciadi"])) 
	{
		$username_err="Kullanıcı adı boş geçilemez.";
	}
	elseif (strlen($_POST["kullaniciadi"])<6) {
		$username_err="Kullanıcı adı en az 6 karakterden oluşmalıdır.";
	}

	else if (!preg_match('/^[a-z\d_]{5,20}$/i', $_POST["kullaniciadi"])) 
	{
		$username_err="Kullanıcı adı büyük küçük harf ve rakamdan oluşmalıdır";
	}
	else 
	{
		$username=$_POST["kullaniciadi"];
	}

	if (empty($_POST["email"])) 
	{
		$email_err="Email boş geçilemez.";
	}
	else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
	{
  		$email_err = "Geçersiz email formatı.";
	}
	else 
	{
		$email=$_POST["email"];
	}

	if (empty($_POST["parola"])) 
	{
		$parola_err="Parola boş geçilemez.";
	}
	else 
	{
		$parola=password_hash($_POST["parola"], PASSWORD_DEFAULT);
	}

	if (empty($_POST["parolatkr"])) 
	{
		$parolatkr_err="Parola tekrar kısmı boş geçilemez.";
	}
	elseif($_POST["parola"]!=$_POST["parolatkr"])
	{
		$parolatkr_err="Parolalar eşleşmiyor";
	}
	else 
	{
		$parotkr=$_POST["parola"];
	}	
	
	if (isset($username) && isset($email) && isset($parola)) 
	{
		
	

	$ekle="INSERT INTO kullanicilar (kullanici_adi,email,parola) VALUES ('$username','$email','$parola')";
	$calistirekle=mysqli_query($baglanti,$ekle);

	if ($calistirekle) {
		echo '<div class="alert alert-success" role="alert">KAYIT BAŞARILI BİR ŞEKİLDE GERÇEKLEŞTİ </div>';
	}
	else{
		echo '<div class="alert alert-danger" role="alert">KAYIT EKLENİRKEN BİR PROBLEM OLUŞTU</div>';
	}
	mysqli_close($baglanti);
}
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>ÜYE KAYIT İŞLEMİ</title>
  </head>
  <body>
    <div class="container p-5">
    	<div class="card p-5">
    		
    		<form action="kayit.php" method="POST">
    			<div class="form-group">
				    <label for="exampleInputEmail1">Kullanıcı Adı</label>
				    <input type="text" class="form-control 
				    <?php
				    	if (!empty($username_err)) {
				    		echo "is-invalid";
				    	}

					?>  " id="exampleInputEmail1" name="kullaniciadi" aria-describedby="emailHelp">
				    <div id="validationServer03Feedback" class="invalid-feedback">
        		<?php  
        		echo $username_err;

        		?>
      				</div>
				</div>
				<div class="form-group">
				    <label for="exampleInputEmail1">Email adresi</label>
				    <input type="text" class="form-control 
				    <?php
				    	if (!empty($email_err)) {
				    		echo "is-invalid";
				    	}

					?> 
					" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
				    <div id="validationServer03Feedback" class="invalid-feedback">
        		<?php  
        			echo $email_err;

        		?>
      				</div>
				</div>
				<div class="form-group">
				    <label for="exampleInputPassword1">Parola</label>
				    <input type="password" class="form-control 
				    <?php
				    	if (!empty($parola_err)) {
				    		echo "is-invalid";
				    	}

					?>  " name="parola" id="exampleInputPassword1">
				    <div id="validationServer03Feedback" class="invalid-feedback">
        		<?php  
        			echo $parola_err;
        		?>
      				</div>
				</div>
				<div class="form-group">
				    <label for="exampleInputPassword1">Parola</label>
				    <input type="password" class="form-control <?php
				    	if (!empty($parolatkr_err)) {
				    		echo "is-invalid";
				    	}

					?>  " name="parolatkr" id="exampleInputPassword1">
				    <div id="validationServer03Feedback" class="invalid-feedback">
        		<?php  
        			echo $parolatkr_err;
        		?>
      				</div>
				</div>
				
				<button type="submit" name="kaydet" class="btn btn-primary">Kaydet</button>
			</form>
    	

    	</div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>
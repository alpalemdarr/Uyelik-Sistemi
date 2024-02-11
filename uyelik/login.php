<?php  

include ("baglanti.php");


$username_err="";

$parola_err="";



if (isset($_POST["giris"])) 
{
	if (empty($_POST["kullaniciadi"])) 
	{
		$username_err="Kullanıcı adı boş geçilemez.";
	}
	
	else 
	{
		$username=$_POST["kullaniciadi"];
	}

	
	if (empty($_POST["parola"])) 
	{
		$parola_err="Parola boş geçilemez.";
	}
	else 
	{
		$parola=$_POST["parola"];
	}

	
	
	if (isset($username) && isset($parola)) 
	{
		$secim="SELECT * FROM kullanicilar WHERE kullanici_adi='$username'";
		$calistir=mysqli_query($baglanti,$secim);
		$kayitsayisi=mysqli_num_rows($calistir);

		if ($kayitsayisi>0) {
			$ilgilikayit=mysqli_fetch_assoc($calistir);
			$hashlisifre=$ilgilikayit["parola"];

			if (password_verify($parola,$hashlisifre)) {
				session_start();
				$_SESSION["kullanici_adi"]=$ilgilikayit["kullanici_adi"];
				$_SESSION["email"]=$ilgilikayit["email"];
				header("location:profile.php");
			}

			else{
				echo '<div class="alert alert-danger" role="alert">PAROLA YANLIŞ </div>';
			}
		}
		else
		{
			echo '<div class="alert alert-danger" role="alert">KULLANICI ADI YANLIŞ </div>';
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

    <title>ÜYE GİRİŞ İŞLEMİ</title>
  </head>
  <body>
    <div class="container p-5">
    	<div class="card p-5">
    		
    		<form action="login.php" method="POST">
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
				
				
				<button type="submit" name="giris" class="btn btn-primary">Giriş Yap</button>
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
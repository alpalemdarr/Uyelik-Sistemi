<?php  
session_start();

if(isset($_SESSION["kullanici_adi"])) 
{
	echo "<h3>".$_SESSION["kullanici_adi"]." HOŞGELDİN </h3> ";
	echo "<h3>".$_SESSION["email"]."</h3>";
	echo "<a href='cikis.php' style = 'color:red; background-color:yellow;border:1px solid red; padding:5px 5px'>ÇIKIŞ YAP</a>";
	echo "<a href='listeleme.php' style = 'color:red; background-color:yellow;border:1px solid red; padding:5px 5px'>Listeleme</a>";

}
else
{
	echo "Bu sayfayı görüntüleme yetkiniz yoktur";
}


?>
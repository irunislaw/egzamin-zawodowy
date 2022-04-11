<?php

$con = new mysqli('localhost','root',"","dane");
$tytul = $_POST['tytul'];
$gatunek =$_POST['gatunek'];
$rok = $_POST['rok'];
$ocena = $_POST['ocena'];
mysqli_query($con,"insert into filmy(tytul,gatunki_id,rok,ocena) VALUES ('".$tytul."',".$gatunek.",".$rok.",".$ocena.")");
echo "Film ".$tytul." został dodany do bazy";
mysqli_close($con);
?>
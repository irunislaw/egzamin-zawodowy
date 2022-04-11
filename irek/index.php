<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        td{
            border:1px solid black;
            padding:5px;
        }
        table {
  border-collapse: collapse;
}
.nag{
    background-color:pink;
    color:white;
}
        </style>
</head>
<body>
<fieldset>
    <legend> dodawanie</legend>
<form method='post' action="">
imie <input name="imie" type="text"> <br>
nazwisko <input name="nazwisko" type="text"> <br>
srednia <input name="srednia" type="number" step="0.01"> <br>
<input type="submit" value="dodaj">
</form>
</fieldset>

<fieldset>
    <legend> update</legend>
<form method='post' action="">
    id <input name="idu" type="number"> <br>
imie <input name="imieu" type="text"> <br>
nazwisko <input name="nazwiskou" type="text"> <br>
srednia <input name="sredniau" type="number" step="0.01"> <br>
<input type="submit" value="dodaj">
</form>
</fieldset>



<?php    
$mysqli = new mysqli("localhost","root","");
mysqli_query($mysqli,"Create database if not exists szkola;");
mysqli_query($mysqli,"use szkola");
mysqli_query($mysqli,"CREATE TABLE if not exists `uczen` (
    `id` int(2) NOT NULL,
    `Nazwisko` tinytext,
    `Imie` tinytext,
    `Srednia_ocen` float NOT NULL,
    `id_klasy` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ");
mysqli_set_charset($mysqli, "utf8");
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    mysqli_query($mysqli,'ALTER TABLE uczen AUTO_INCREMENT = 1');
$usuwanie=$_GET['usuwanie'];
mysqli_query($mysqli,"delete from uczen where id like ".$usuwanie);

}


if(($_SERVER['REQUEST_METHOD'] == 'POST')){
   
$imie=$_POST['imie'];
$nazwisko=$_POST['nazwisko'];
$srednia=$_POST['srednia'];
mysqli_query($mysqli,'ALTER TABLE uczen AUTO_INCREMENT = 1');
mysqli_query($mysqli,'insert into uczen (imie,nazwisko,Srednia_ocen) values ("'.$imie.'","'.$nazwisko.'",'.$srednia.')');


}
$wynik = mysqli_query($mysqli,"Select * from uczen");


if($wynik!=null){
    
echo '<table style="border:black solid 1px">
    <tr><td class="nag">L.p.</td><td class="nag">Imię</td><td class="nag">Nazwisko</td><td class="nag">Średnia ocen</td><td class="nag">usuwanie</td> </tr>
';
while($row = mysqli_fetch_array($wynik))

{
    echo "
    <tr>
    <td>".$row['id'] . "</td> <td>" . $row['Imie']."</td> <td> ".$row['Nazwisko']."</td> <td> ".$row['Srednia_ocen']."</td><td><form method='get' action=''><button type='submit' value=".$row['id']." name='usuwanie'>usun</button></form></td> </tr>"; 
    
}
echo "</table>";
$wynik2 = mysqli_query($mysqli,"Select avg(Srednia_ocen) as wynik from uczen");
while($row = mysqli_fetch_array($wynik2))
{
    echo 'Średnia klasy:'.round($row["wynik"],3);
}
}







?>
</body>
</html>
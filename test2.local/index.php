
<?php
$db_host = "localhost";
$db_user = "mysql"; // Логин БД
$db_password = "mysql"; // Пароль БД
$db_base = 'test2'; // Имя БД
$db_table = "lots2"; // Имя Таблицы БД

// Подключение к базе данных
$mysqli = new mysqli($db_host,$db_user,$db_password,$db_base);
if ($mysqli->connect_error) {
    die('Ошибка : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

mysqli_query($mysqli,"CREATE TABLE 'lots2' (
`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
`value`double NOT NULL,
`valute` 	varchar(30) CHARACTER SET utf32 NOT NULL
`status` 	varchar(30) CHARACTER SET utf32 NOT NULL
)");

?>
<html>
 <head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="css/style.css">
  <title>Лоты</title>
  <!--[if IE]>
   <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
 </head>
 <body>
   <form action="index.php" method="get" name="form">
      <p class="put">Введите сумму:</p>
      <p><input class="input" type="text" name="value" required pattern="[0-9]{1,}\.[0-9]{1,}">
      <select class = "list" name="valute">
            <option  value="CNY">Китайский юань</option>
            <option  value="CHF">Швейцарский франк</option>
            <option  value="JPY">Японская Иена</option>
      </select>
      <button class="button1" name="button" type="submit" >Создать лот</button>
      </p>
      <button class="button2" name="tolots" type="submit" onclick="location.href='./lot.php'" >Перейти к лотам</button>
     </form>
 <?php
 $value = $_GET['value'];
 $valute = $_GET['valute'];
//echo $value;
//echo $valute;

 // Если есть ошибка соединения, выводим её и убиваем подключение

 $result = $mysqli->query("INSERT INTO ".$db_table." (value,valute,status) VALUES ('$value','$valute','Новый')");
 /*if ($result == true){
	echo "Информация занесена в базу данных";
}else{
	echo "Информация не занесена в базу данных";
}*/
/*$query ="SELECT id,status FROM lots2";
$output_status = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($link));

if($output_status )
{
    echo "<div >";
    while($row = mysqli_fetch_array($output_status))
    {
      echo "<div >";
      echo "<p>Лот№ ".$row['id']."<br>\n</p>";
      echo $row['status'];
      echo "</div>";
    }
    echo "</div>";

    // очищаем результат
    mysqli_free_result($output_status);
}*/
  ?>
 </body>

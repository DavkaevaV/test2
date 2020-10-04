<?php
  // Ссылка куда будем отправлять GET запрос
$url = "https://www.cbr-xml-daily.ru/daily_json.js";

// Создаём запрос
$ch = curl_init();
// Настройки запроса
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Отправка и декодинг ответа
$data = json_decode(curl_exec($ch), $assoc=true);
// Закрытие запроса
curl_close($ch);
$count=count($data["Valute"]);
?>
<!DOCTYPE html>
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
$query ="SELECT id,value,valute FROM lots2";

$result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($link));

if($result)
{
    echo "<div class='table'>";
    while($row = mysqli_fetch_array($result))
    {
      echo "<div class='lot'>";
      echo "<form>";
      echo "<p class='ls'>Лот№ ".$row['id']."<br>\n</p>";
      echo $row['value']*$data["Valute"][$row['valute']]["Value"] ." RUB<br>\n";
      echo "<select class = 'button3' name='status'>";
            echo "<option  value='Куплен'>Купить лот</option>";
            echo "<option  value='Отклонен'>Отклонить лот</option>";
      echo "</select>";
      echo "<button class='button4' name='submit' type='submit' >Подтвердить</button>";
      echo "</form>";
      $idd=$row['id'];
      //echo $idd;
      $status = $_GET['status'];
      $query ="UPDATE lots2 SET status='$status' WHERE id=$idd";
      $res=mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($link));
      //$res = $mysqli->query("UPDATE lots2".$db_table." SET status=".$status." WHERE id=".$row['id']);
    /*  if ($res == true){
     	echo "Информация занесена в базу данных";
     }else{
     	echo "Информация не занесена в базу данных";
    }*/
      echo "</div>";
    }
    echo "</div>";

    // очищаем результат
    mysqli_free_result($result);
}
?>
</body>

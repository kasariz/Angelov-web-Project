<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Админ панель</title>
	<link href="static/css/adminPanel.css" rel="stylesheet" type="text/css">
</head>
<body>

<div style="text-align:center">


<?php if(!empty($_SESSION['login'])) :?>

<?php echo "<h1>Вы в админке, ".$_SESSION['login']."</h1>"; ?>
<br>
<a href="/admin/editGoods.php">Редактировать товары</a>
<br>
<a href="/admin/editOrders.php">Редактировать заказы</a>
<br>
<a href="/logout.php">Выйти</a>

<?php else:
	echo '<h1>Хорошая попытка</h1>';
	echo '<a href="/">Выйти</a>';
?>

<?php endif ?>
</div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Вход в админку</title>
	<link href="static/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<h2 style="text-align:center;padding-top:100px">Вход в административную панель</h2>
	
	<form action="admin/admin.php" method="post" style="text-align:center;padding-top:80px">
	<div class="for-group">
	<input type="text" placeholder="Введите логин" name="login">
	</div>
	<br>
	<div class="for-group">
	<input type="text" placeholder="Введите пароль" name="password">
	</div>
	<br>
		<button style="background-color: #650000; "type="submit" class="btn btn-primary">Войти</button>
	</form>
	
</body>
</html>
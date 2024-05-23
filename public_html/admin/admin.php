<?php
	require_once "../classes/PdoConnect.php";
	
	try {
		$pdoConnect = PdoConnect::getInstance();
		$pdo = $pdoConnect->PDO;
	} catch (PDOException $e) {
		echo "Ошибка подключения к базе данных: " . $e->getMessage();
		exit; 
	}
	
	session_start();

	$login=$_POST["login"];
	$password=$_POST["password"];

	try {
		$sql = $pdo->prepare("SELECT id, login FROM user WHERE login=:login AND password=:password");
		$sql->execute(array('login' => $login, 'password' => $password));
		$array = $sql->fetch(PDO::FETCH_ASSOC);
		
		if ($array["id"] > 0) {
			$_SESSION['login'] = $array["login"];
			header('Location: /admin.php');
			exit; 
		} else {
			header('Location: /login.php');
			exit; 
		}
	} catch (PDOException $e) {

		echo "Ошибка выполнения SQL-запроса: " . $e->getMessage();
		exit; 
	}
?>
<?php
	session_start();
	require_once "../classes/PdoConnect.php";
	
	$pdoConnect = PdoConnect::getInstance();
	$pdo = $pdoConnect->PDO;

	// Получение списка заказов
	$orders = [];
	try {
		$sql = $pdo->query("SELECT id, fio FROM orders");
		$orders = $sql->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo "Ошибка получения заказов: " . $e->getMessage();
		exit; 
	}

	if(isset($_POST['delete_id'])) {
		$delete_id = $_POST['delete_id'];
		$sql_delete = $pdo->prepare("DELETE FROM orders WHERE id = :delete_id");
		$sql_delete->bindParam(':delete_id', $delete_id);
		$sql_delete->execute();
	}

	if(isset($_POST['edit_id'])) {
		$edit_id = $_POST['edit_id'];
		$new_fio = $_POST['new_fio'];
		$new_phone = $_POST['new_phone'];
		$new_email = $_POST['new_email'];
		$new_comment = $_POST['new_comment'];
		$new_product_id = $_POST['new_product_id'];

		// Получение текущих данных заказа
		$sql_current = $pdo->prepare("SELECT * FROM orders WHERE id = :edit_id");
		$sql_current->bindParam(':edit_id', $edit_id);
		$sql_current->execute();
		$current_data = $sql_current->fetch(PDO::FETCH_ASSOC);

		// Замена значений на новые, если они заданы
		$new_fio = !empty($new_fio) ? $new_fio : $current_data['fio'];
		$new_phone = !empty($new_phone) ? $new_phone : $current_data['phone'];
		$new_email = !empty($new_email) ? $new_email : $current_data['email'];
		$new_comment = !empty($new_comment) ? $new_comment : $current_data['comment'];
		$new_product_id = !empty($new_product_id) ? $new_product_id : $current_data['product_id'];

		$sql_edit = $pdo->prepare("UPDATE orders SET fio = :new_fio, phone = :new_phone, email = :new_email, comment = :new_comment, product_id = :new_product_id WHERE id = :edit_id");
		$sql_edit->bindParam(':edit_id', $edit_id);
		$sql_edit->bindParam(':new_fio', $new_fio);
		$sql_edit->bindParam(':new_phone', $new_phone);
		$sql_edit->bindParam(':new_email', $new_email);
		$sql_edit->bindParam(':new_comment', $new_comment);
		$sql_edit->bindParam(':new_product_id', $new_product_id);
		$sql_edit->execute();

		header("Location: ".$_SERVER['PHP_SELF']);
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Админ панель</title>
	<link href="editPages.css" rel="stylesheet" type="text/css">
</head>
<body>

<div style="text-align:center">
<h1>Редактирование заказов</h1>

<?php if(!empty($_SESSION['login'])) : ?>

<br>

<form action="" method="post">
	<select name="delete_id">
		<option value="" disabled selected>Выберите заказ для удаления</option>
		<?php foreach ($orders as $order): ?>
			<option value="<?php echo $order['id']; ?>"><?php echo $order['fio']; ?></option>
		<?php endforeach; ?>
	</select>
	<input type="submit" value="Удалить заказ">
</form>
<br>

<form action="" method="post">
	<select name="edit_id">
		<option value="" disabled selected>Выберите заказ для редактирования</option>
		<?php foreach ($orders as $order): ?>
			<option value="<?php echo $order['id']; ?>"><?php echo $order['fio']; ?></option>
		<?php endforeach; ?>
	</select>
	<input type="text" placeholder="Новое ФИО" name="new_fio">
	<input type="text" placeholder="Новый телефон" name="new_phone">
	<input type="text" placeholder="Новая почта" name="new_email">
	<input type="text" placeholder="Новый комментарий" name="new_comment">
	<input type="text" placeholder="Новый id товара" name="new_product_id">
	<input type="submit" value="Изменить данные">
</form>
<br>

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

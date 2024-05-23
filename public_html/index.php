<!DOCTYPE html>
<html>
<head>
	<title>MonitorShop - интернет-магазин мониторов</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<script src="static/js/jquery-3.4.1.min.js"></script>
	<script src="static/js/slick.js"></script>
	<script src="static/js/script.js"></script>
	<link href="static/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="static/css/slick.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	<link href="static/css/style.css" rel="stylesheet" type="text/css">
	<link rel="apple-touch-icon" sizes="180x180" href="/static/favicon//1apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/static/favicon//1favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/static/favicon//1favicon-16x16.png">
	<link rel="manifest" href="/static/favicon//site.webmanifest">
</head>
<body>
	<div class="vein"></div>
	<div class="main container">
		<header>
			<div class="mobile-menu-open-button js_mobile_menu_open_button"><i class="fas fa-bars"></i></div>
			<nav class="js_wide_menu">
				<i class="fas fa-times close-mobile-menu js_close_mobile_menu"></i>
				<div class="wrapper-inside">
					<div class="visible-elements">
						<span>Главная</span>
						<span>Каталог</span>
						<span>Новости</span>
						<span>Акции</span>
						<span>Оплата</span>
						<span>Доставка</span>
						<span>Отзывы</span>
						<span>О магазине</span>
					</div>
				</div>
			</nav>
			<div class="slider-block">
				<div class="nav-left"><i class="fas fa-chevron-left"></i></div>
				<div class="slider">
					<div style="background: url('static/img/slide-11.jpg') no-repeat; background-size: auto 100%; background-position: center; background-position-y: 0;">
					</div>
					<div style="background: url('static/img/slide-22.jpg') no-repeat; background-size: auto 100%; background-position: center; background-position-y: 0;">
						<span class="text-box">Возможна оплата долями!</span>
					</div>
				</div>
				<div class="nav-right"><i class="fas fa-chevron-right"></i></div>
			</div>
		</header>
		<section class="product-box">
			<h2>Каталог</h2>
			<div class="row">
			
				<?php
				spl_autoload_register(function ($class) {
				include 'classes/' . $class . '.php';
				});

				$PDO = PdoConnect::getInstance();

				$result = $PDO->PDO->query("
				SELECT * FROM `goods`
				");

				$products = array();

				while ($productInfo = $result->fetch()) {
				$products[] = $productInfo;
				}
				?>
				<?foreach ($products as $product):?>
					<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 product-parent" data-id="<?=$product['id']?>">
						<div class="product">
							<div class="product-pic" style="background: url('<?=$product['image']?>') no-repeat; background-size: auto 75%; background-position: center"></div>
							<span class="product-name"><?=$product['name']?></span>
							<span class="product_price"><?=$product['price']?> руб.</span>
							<button class="js_buy">Купить</button>
						</div>
					</div>
				<?endforeach?>
			</div>
		</section>
		<footer>
			2024 ©MonitorShop
		</footer>
	</div>
	<div class="overlay js_overlay"></div>
	<div class="popup">
		<h3>Оформление заказа</h3><i class="fas fa-times close-popup js_close-popup"></i>
		<div class='js_error'></div>
		<input type="hidden" name="product-id">
		<input type="text" name="fio" placeholder="Ваше ФИО">
		<input type="tel" class ="art-stranger" name="phone" placeholder="Телефон">
		<input type="text" name="email" placeholder="E-mail">
		<textarea placeholder="Комментарий" name="comment"></textarea>
		<button class="js_send">Отправить</button>
	</div>
	
	<script src="static/js/maska-nomera.js" type="text/javascript" ></script>

     <script>
	$('.art-stranger').mask('+7 (999) 999-99-99');

	$.fn.setCursorPosition = function(pos) {
	  if ($(this).get(0).setSelectionRange) {
		$(this).get(0).setSelectionRange(pos, pos);
	  } else if ($(this).get(0).createTextRange) {
		var range = $(this).get(0).createTextRange();
		range.collapse(true);
		range.moveEnd('character', pos);
		range.moveStart('character', pos);
		range.select();
	  }
	};


	$('input[type="tel"]').click(function(){
		$(this).setCursorPosition(4);
	});
</script>
</body>
</html>


/static/favicon/
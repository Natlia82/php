<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<title>FAQ</title>
</head>
<body>
	<header>
		<h1>FAQ</h1>

	</header>
	<a class="btn btn-primary" href="?c=admin&a=pass" role="button">Войти как администратор</a>
	<section class="cd-faq">
		<ul class="cd-faq-categories">
			<?php //print_r($topicss);
			foreach ($allTopics as $quest) : ?>
			<li><a href="#<?php $quest[0]; ?>"><?php  echo $quest[1]; ?></a></li>
		<?php endforeach ?>
	</ul> <!-- cd-faq-categories -->

	<div class="cd-faq-items">
		<?php //print_r( $question);
		foreach ($allTopics as $quest) : ?>
		<ul id="<?php $quest[0]; ?>" class="cd-faq-group">
			<li class="cd-faq-title"><h2><?php  echo $quest[1]; ?></h2></li>
			<?php foreach ( $question as $questi) :
				if ($quest[0] == $questi[5] and $questi[4] == 1) { ?>
					<li>
						<a class="cd-faq-trigger" href="#0"><?php  echo $questi[1]; ?></a>
						<div class="cd-faq-content">
							<p><?php echo $questi[2];?></p>
						</div> <!-- cd-faq-content -->
					</li>

				<?php } endforeach ?>
			</ul> <!-- cd-faq-group -->

		<?php endforeach ?>
	</ul> <!-- cd-faq-group -->
	<form class="" action="?c=topic&a=questionAdd" method="post">
		<button type="submit" class="btn btn-outline-success" name="but">Задать вопос</button>
		<?php
		if ($_SESSION['getList']) {
			?>
			<div class="form-group">
				<label for="exampleFormControlTextarea1">Ваше имя:</label>
				<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="text">
			</div>
			<div class="form-group">
				<label for="exampleFormControlSelect1">Выбирите тему:</label>
				<select class="form-control" id="exampleFormControlSelect1" name="select">
					<?php
					foreach ($allTopics as $quest) : ?>
					<option value="<?php echo $quest[0]; ?>"><?php echo $quest[1]; ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleFormControlTextarea1">Ваш вопрос:</label>
			<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="textarea"></textarea>
		</div>
		<button type="submit" class="btn btn-outline-success" name="butinsert">Отправить</button>
		<button type="submit" class="btn btn-outline-success" name="butcancel">Отмена</button>
		<?php
	}

	?>
</form>


</div> <!-- cd-faq-items -->

<a href="#0" class="cd-close-panel">Close</a>

</section> <!-- cd-faq -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>

<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator</title>
</head>
<body>

<form action="<?php print(_APP_URL);?>/app/credit.php" method="post">
	<label for="id_amount">Kwota kredytu </label>
	<input id="id_amount" type="text" name="amount" value="<?php print($amount); ?>" /><br />
	<label for="id_yperiod">Okres kredytowania w latach</label>
	<input id="id_yperiod" type="text" name="period" value="<?php print($period); ?>" /><br />
	<label for="id_percent">Oprocentowanie (%)</label>
	<input id="id_percent" type="text" name="percent" value="<?php print($percent); ?>" /><br />
	<input type="submit" value="Oblicz" />
</form>	

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($errors)) {
	if (count ( $errors ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $errors as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($monthNumber)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Miesięczna rata: '.$monthNumber; 'zł'?>
</div>
<?php } ?>



</body>
</html>
<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

$amount = $_REQUEST ['amount'];
$period = $_REQUEST ['period'];
$percent = $_REQUEST ['percent'];


// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($amount) && isset($period) && isset($percent))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$errors [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
    console.log('elo');
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $amount == "") {
	$errors [] = 'Nie podano kwoty kredytu';
}
if ( $period == "") {
	$errors [] = 'Nie podano okresu kredytowania';
}
if ( $percent == "") {
	$errors [] = 'Nie podano procentu kredytowania';
}

//nie ma sensu walidować dalej gdy brak parametrów
if (empty( $errors )) {
	
	// sprawdzenie, czy $x i $y są liczbami całkowitymi
	if (! is_numeric( $amount )) {
		$errors [] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $period )) {
		$errors [] = 'Druga wartość nie jest liczbą całkowitą';
	}	

	if (! is_numeric( $percent )) {
		$errors [] = 'Trzecia wartość nie jest liczbą całkowitą';
	}	

}

// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty ( $errors )) { // gdy brak błędów
	
	//konwersja parametrów na int
	$amount = floatval($amount);
	$period = floatval($period);
	$percent = floatval($percent);

    $monthNumber = ($amount + ($amount * ($percent / 100))) / ($period * 12);
}


include 'credit_view.php';
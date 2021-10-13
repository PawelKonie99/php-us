<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__) . "/../config.php";

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
// include _ROOT_PATH . "/app/security/check.php";

// function consolelog($data) {
//     echo "<script>console.log('".$data."');</script>";
// }
// 1. pobranie parametrów
function getParams(&$amount, &$period, &$percent)
{
    $amount = isset($_REQUEST["amount"]) ? $_REQUEST["amount"] : null;
    $period = isset($_REQUEST["period"]) ? $_REQUEST["period"] : null;
    $percent = isset($_REQUEST["percent"]) ? $_REQUEST["percent"] : null;
}


function validate(&$amount, &$period, &$percent, &$errors)
{
    // sprawdzenie, czy parametry zostały przekazane
    if (!(isset($amount) && isset($period) && isset($percent))) {
        // sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
        // teraz zakładamy, ze nie jest to błąd. Po prostu nie wykonamy obliczeń
        return false;
    }

    if ($amount == "") {
        $errors[] = "Nie podano kwoty kredytu";
    }
    if ($period == "") {
        $errors[] = "Nie podano okresu kredytowania";
    }
    if ($percent == "") {
        $errors[] = "Nie podano procentu kredytowania";
    }

    //nie ma sensu walidować dalej gdy brak parametrów
    if (count($errors) != 0) {
        return false;
    }

    // sprawdzenie, czy $x i $y są liczbami całkowitymi
    if (!is_numeric($amount)) {
        $errors[] = "Pierwsza wartość nie jest liczbą całkowitą";
    }

    if (!is_numeric($period)) {
        $errors[] = "Druga wartość nie jest liczbą całkowitą";
    }

    if (!is_numeric($percent)) {
        $errors[] = "Trzecia wartość nie jest liczbą całkowitą";
    }

    return true;
}

// 3. wykonaj zadanie jeśli wszystko w porządku

function process(&$amount, &$period, &$percent, &$errors, &$monthNumber)
{
    // gdy brak błędów

    //konwersja parametrów na int
    $amount = floatval($amount);
    $period = floatval($period);
    $percent = floatval($percent);

    $monthNumber = ($amount + $amount * ($percent / 100)) / ($period * 12);
}

//definicja zmiennych kontrolera
$x = null;
$y = null;
$operation = null;
$monthNumber = null;
$errors = array();

getParams($amount, $period, $percent);

if (validate($amount, $period, $percent, $errors)) {
    // gdy brak błędów
    process($amount, $period, $percent, $errors, $monthNumber);
}


$page_title = 'Kredyt';
$page_description = 'test1';
$page_header = 'Proste szablony';
$page_footer = 'przykładowa tresć stopki wpisana do szablonu z kontrolera';


include "credit_view.php";
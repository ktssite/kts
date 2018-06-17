
<?php

use Money\Currency;
use Money\Money;
use Money\Currencies\ISOCurrencies;
use Money\Parser\IntlMoneyParser;
use Money\Formatter\IntlMoneyFormatter;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Parser\DecimalMoneyParser;


function _d($value) {
	$decimal_places = config('app.decimal_places');
	$decimal        = substr_count($decimal_places, '0', 1);
 	$result         = $value / $decimal_places;
    return number_format((float)$result, $decimal, '.', '');
}

function pround($value) {
    return number_format((float)$value, 2, '.', '');
}
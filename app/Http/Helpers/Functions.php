
<?php

use Money\Currency;
use Money\Money;
use Money\Currencies\ISOCurrencies;
use Money\Parser\IntlMoneyParser;
use Money\Formatter\IntlMoneyFormatter;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Parser\DecimalMoneyParser;
use Illuminate\Support\Facades\DB;


function _d($value) {
	$decimal_places = config('app.decimal_places');
	$decimal        = substr_count($decimal_places, '0', 1);
 	$result         = $value / $decimal_places;
    return number_format((float)$result, $decimal, '.', ',');
}

function pround($value) {
    return number_format((float)$value, 2, '.', '');
}

function dbDate($date) {
	//For db value
	return (bool)strtotime($date)? date_create($date)->format('Y-m-d'): '';
}

function cDate($date) {
	//For calendar
	return (bool)strtotime($date)? date_create($date)->format('m/d/Y'): '';
}

function month($monthNum) {
	//Month name
	return date('F', mktime(0, 0, 0, $monthNum, 10));
}

function _date($date) {
	return date_format(date_create($date), 'F j, Y');
}

function monthNum($date) {	
	$date = dbDate($date);
	return (bool)strtotime($date)? DB::select("select month('$date') as m")[0]->m: '';	
}

function weekNum($date) {
	$date = dbDate($date);
	return (bool)strtotime($date)? DB::select("select week('$date') as w")[0]->w: '';
}
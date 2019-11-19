<?php
// use Money\Currencies\ISOCurrencies;
// use Money\Currency;
// use Money\Formatter\IntlMoneyFormatter;
// use Money\Money;


function presentPrice($price)
{
    // $money = new Money($price, new Currency('USD'));
    // $currencies = new ISOCurrencies();
    // $numberFormatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
    // $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
    // return $moneyFormatter->format($money);
    $fmt = new NumberFormatter( 'vi-VN', NumberFormatter::CURRENCY );
    return $fmt->formatCurrency($price, "VND");

    #en-US USD
    #vi-VN VND
}
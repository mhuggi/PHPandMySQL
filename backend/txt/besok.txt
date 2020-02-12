<?php
/*
$visitAmount = fopen("visitAmount.txt", "w") or die("Could not open file");
$amount = 1;
fwrite($visitAmount, $amount);
*/


$visitAmount = fopen("visitAmount.txt", "r") or die("Could not open file");

$read = (float) fread($visitAmount, filesize("visitAmount.txt"));
$amount = $read + 1;

echo "Du är besökare nummer " . $amount;
fclose($visitAmount);

$visitAmount = fopen("visitAmount.txt", "w") or die("Could not open file");
fwrite($visitAmount, $amount);
fclose($visitAmount);

//Get IP addresses: https://www.w3schools.com/php/func_filesystem_feof.asp

$visiterInfo = fopen("visiterinfo.txt", "a+") or die("Could not open file");
$getUserInfo = $_SERVER['REMOTE_ADDR'] . " " . date("d.m.Y H:i") . "\n";

fwrite($visiterInfo, $getUserInfo);
fclose($visiterInfo);

echo '<p><a href="visiterinfo.txt">Kolla besökarnas IP!</a>';




?>
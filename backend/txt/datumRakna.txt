<?php include "init.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <section>
    <?php include "navbar.php" ?>

        <article>
        <h1>DatumRakna</h1>
        <p>Tredje sida</p>
        </article>
        <article>
            <?php
//phpinfo();
date_default_timezone_set("Europe/Helsinki");
$day = $_GET["day"];
$month = $_GET["month"];
$year = $_GET["year"];
print("<p>Du matade in dagen " . $day . "<br>");
print "Och månaden " . $month . ".<br>";
print "Och året " . $year;


if (($day > 0) && ($day < 32) && ($month > 0) && ($month < 13)) {
    $timeNow = time();
    $givenTime = mktime(12, 0, 0, $month, $day, $year);
    $difference = $givenTime - $timeNow;
    $dayOfWeek = date("N", $givenTime);
    $days = array("Måndag", "Tisdag", "Onsdag", "Torsdag", "Fredag", "Lördag", "Söndag");

    $weekDay = $days[$dayOfWeek - 1];
    print "<p>Dagen är en " . $weekDay;

    $difDay = floor(($difference / (60 * 60 * 24)));
    $difHour = floor(($difference / (60 * 60)) - ($difDay * 24));
    $hourCount = floor($difference / (60 * 60));
    $difMin = floor(($difference / 60) - ($hourCount * 60));
    $minCount = floor($difference / 60);
    $difSecs = floor($difference - $minCount * 60);

    if ($difference < 0) {
        print "<p> Dagen är i förflutna";
        print "<p> Dagen har gått för " . $difDay . " Dagar och " . $difHour . ":" . $difMin . ":" . $difSecs . " sedan";
    } else {
        print "<p> Dagen är i framtiden";
        print "<p>Det är " . $difDay . " Dagar, " . $difHour . ":" . $difMin . ":" . $difSecs . " till inmatade dagen kl. 12:00";

    }


} else {
    print "<p>Felaktig dag";
}

?>
        </article>
    </section>
</body>
</html>

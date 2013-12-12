<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

require "./composer/autoload.php";
require "./lib/get_french_holidays_dates.php";
require "./lib/get_easter_datetime.php";

date_default_timezone_set("Europe/Paris");

$app = new Application();

$app->get("/", function (Application $app) {
    $year = date("Y");
    return $app->redirect("/years/{$year}");
});

$app->get("/check/{date}", function (Application $app, $date) {
    $year = date("Y", strtotime($date));
    return $app->json(in_array($date, get_french_holidays_dates($year)));
})->assert("date", "[0-9]{4}-[0-9]{2}-[0-9]{2}");

$app->get("/years/{years}", function (Application $app, $years) {
    $years = explode(",", $years);
    $years = array_unique($years); // juste au cas ou....
    $years = array_values($years); // parce que array_unique garde les clefs, donc on renumérote chaque élements à partir de 0
    sort($years);                  // histoire de se simplifier la vie plus tard

    $holidays = [];
    foreach ($years as $year) {
        $holidays = array_merge($holidays, get_french_holidays_dates($year));
    }

    return $app->json($holidays);
})->assert("years", "([0-9]{4},)*[0-9]{4}");

return $app;

<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

require "./composer/autoload.php";

date_default_timezone_set("Europe/Paris");

$app = new Application();

$app->get(
    "/",
    function (Application $app) {
        $year = date("Y");
        return $app->redirect("/years/{$year}");
    }
);

$app->get(
    "/check/{date}",
    function (Application $app, $date) {
        $year = date("Y", strtotime($date));

        if ($year < 1970 || $year > 2037) {
            $app->abort(400, "This function is only valid for years between 1970 and 2037 inclusive");
        }

        return $app->json(in_array($date, get_french_holidays_dates($year)));
    }
)->assert("date", "[0-9]{4}-[0-9]{2}-[0-9]{2}");

$app->get(
    "/years/{years}",
    function (Application $app, $years) {
        $years = explode(",", $years);
        $years = array_unique($years); // juste au cas ou....
        $years = array_values($years); // on renumérote chaque élement à partir de 0 a cause de array_unique
        sort($years);                  // histoire de se simplifier la vie plus tard

        $holidays = [];
        foreach ($years as $year) {
            $year = intval($year);

            if ($year < 1970 || $year > 2037) {
                $app->abort(400, "This function is only valid for years between 1970 and 2037 inclusive");
            }

            $holidays = array_merge($holidays, get_french_holidays_dates($year));
        }

        return $app->json($holidays);
    }
)->assert("years", "([0-9]{4},)*[0-9]{4}");

/**
 * Error Handler magique :
 * catch toutes les exceptions, et fait une réponse JSON normale, en gardant le code d'erreur HTTP :)
 */
$app->error(
    function (Exception $e, $code) use ($app) {
        if ($code >= 100 && $code < 500) {
            return $app->json($e->getMessage(), $code);
        }
        return $app->json($app["debug"] == true ? $e->getMessage() : null, 500);
    }
);

return $app;

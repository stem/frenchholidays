<?php

/**
 * Cette fonction retourne un tableau de timestamp correspondant
 * aux jours fériés en France pour une année donnée.
 */
function get_french_holidays_dates($year)
{
    $holidays = array(
        // Dates fixes
        (new DateTime("{$year}-01-01"))->format("Y-m-d"), // 1er janvier
        (new DateTime("{$year}-05-01"))->format("Y-m-d"), // Fête du travail
        (new DateTime("{$year}-05-08"))->format("Y-m-d"), // Victoire des alliés
        (new DateTime("{$year}-07-14"))->format("Y-m-d"), // Fête nationale
        (new DateTime("{$year}-08-15"))->format("Y-m-d"), // Assomption
        (new DateTime("{$year}-11-01"))->format("Y-m-d"), // Toussaint
        (new DateTime("{$year}-11-11"))->format("Y-m-d"), // Armistice
        (new DateTime("{$year}-12-25"))->format("Y-m-d"), // Noel

        // Dates variables
        get_easter_datetime($year)->add(new DateInterval("P1D"))->format("Y-m-d"),  // Lundi de Pâques
        get_easter_datetime($year)->add(new DateInterval("P39D"))->format("Y-m-d"), // Ascension
        get_easter_datetime($year)->add(new DateInterval("P50D"))->format("Y-m-d"), // Lundi de Pentecôte
    );

    sort($holidays);

    return $holidays;
}

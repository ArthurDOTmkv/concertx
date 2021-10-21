<?php

function getPrix($prixCentimes)
{
    $prix = floatval($prixCentimes) / 100;
    
    /*
    * Prix - Décimales - Séparateur - Espace entre les milliers
    */
    return number_format($prix, 2, ',', ' ') . " €";
}
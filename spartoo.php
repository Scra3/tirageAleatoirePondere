<?php
$liste = array("Adidas" => 153, "converse" => 193, "Nike" => 124, "Asics" => 67);
$tirage = tirage($liste);
foreach ($tirage as $key => $value) {
    echo $value."<br>" ;
}
// Prend en param�tre un liste de type (String ou Int) => Int et retourne une liste de String qui repr�sente le r�sultat du tirage 
function tirage($liste) {
    $tirage = array();
    while (count($liste) > 0) {
        $element = aleatoire($liste);
        unset($liste[$element]);
        $tirage[] = $element;
    }
    return $tirage;
}
// Prend en param�tre une liste (String ou Int) => Int et retourne un �l�ment de cette liste de mani�re al�atoire
function aleatoire(array $liste) {
    $nbVotes = getVotes($liste);
    $probabilites = getProbabilites($liste, $nbVotes);
    $prob = 0;
    $tirage = mt_rand(0, 1000000000) / 10000000; // Pr�cis jusqu'� 10^-7

    foreach ($probabilites as $element => $value) {
        if ($prob < $tirage && $tirage <= $value + $prob) {
            return $element;
            break;
        } else {
            $prob = $prob + $value;
        }
    }
}
// Prend en param�tre une liste (String ou Int) => Int et retourne une liste de type (String ou Int) => Int contenant les probabilit�s
function getProbabilites(array $liste, $nbVotes) {
    $probabilites = array();
    foreach ($liste as $element => $votes) {
        $probabilites[$element] = ($votes / $nbVotes) * 100;
    }
    arsort($probabilites); // tableau de probabilt�s d�croissante pour v�rifier en premier les probabilit�s les plus fortes
    return $probabilites;
}
// Prend en param�tre une liste (String ou Int) => Int et retourne la somme des clefs  ( le nombre de vote)
function getVotes(array $liste) {
    $votes = 0;
    foreach ($liste as $element => $vote) {
        $votes = $votes + $vote;
    }
    return $votes;
}
?>
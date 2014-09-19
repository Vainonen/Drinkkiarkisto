<?php
require 'tietokantayhteys.php';
require 'kayttaja.php';
$sql = "SELECT id, tunnus, salasana, muokkausoikeus, adminoikeus from kayttajat";
$kysely = getTietokantayhteys()->prepare($sql);
$kysely->execute();

$rivit = $kysely->fetchAll();
echo $rivit[0]['id'];
echo $rivit[0]['tunnus'];
echo $rivit[0]['salasana'];
echo $rivit[0]['muokkausoikeus'];
echo $rivit[0]['adminoikeus'];
echo $rivit[1]['id'];
echo $rivit[1]['tunnus'];
echo $rivit[1]['salasana'];
echo $rivit[1]['muokkausoikeus'];
echo $rivit[1]['adminoikeus'];

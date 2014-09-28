<?php
require_once 'tietokantayhteys.php';
require_once 'models/kayttaja.php';


$sql = "SELECT id, tunnus, salasana from kayttajat";
$kysely = getTietokantayhteys()->prepare($sql);
$kysely->execute();
$rivit = $kysely->fetchAll();
echo $rivit[0]['id'];
echo $rivit[0]['tunnus'];
echo $rivit[0]['salasana'];
echo $rivit[1]['id'];
echo $rivit[1]['tunnus'];
echo $rivit[1]['salasana'];

 


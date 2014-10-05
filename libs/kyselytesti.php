<?php
require_once '../libs/tietokantayhteys.php';


$sql = "SELECT kayttaja_id, tunnus, salasana from kayttajat WHERE kayttaja_id=0";
$kysely = getTietokantayhteys()->prepare($sql);
$kysely->execute();
$rivit[0] = $kysely->fetchColumn(0);
$rivit[1] = $kysely->fetchColumn(1);

echo $rivit[0];
echo $rivit[1];


 


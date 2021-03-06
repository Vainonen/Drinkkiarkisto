CREATE TABLE kayttajat
(
kayttaja_id SERIAL PRIMARY KEY NOT NULL, 
tunnus varchar(255),
salasana varchar(255),
muokkausoikeus boolean,
adminoikeus boolean
); 

CREATE TABLE drinkit
(
drinkki_id SERIAL PRIMARY KEY NOT NULL, 
nimi varchar(255),
aliakset varchar(255),
drinkkityyppi varchar(255),
valmistustapa varchar(255)
); 

CREATE TABLE raakaaineet
(
raakaaine_id SERIAL PRIMARY KEY NOT NULL, 
nimi varchar(255)
);

CREATE TABLE muokkaajat
(
kayttaja_id integer REFERENCES kayttajat (kayttaja_id)
ON DELETE cascade
ON UPDATE cascade,
drinkki_id integer REFERENCES drinkit (drinkki_id)
ON DELETE cascade
ON UPDATE cascade,
aika timestamp
);

CREATE TABLE ainesosat
(
tilavuus integer,
drinkki_id integer REFERENCES drinkit (drinkki_id),
raakaaine_id integer REFERENCES raakaaineet (raakaaine_id)
ON DELETE cascade
ON UPDATE cascade
);

CREATE TABLE kayttajat
(
id SERIAL PRIMARY KEY NOT NULL, 
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
aine_id SERIAL PRIMARY KEY NOT NULL, 
nimi varchar(255)
);

CREATE TABLE muokkaajat
(
id integer REFERENCES kayttajat (id),
drinkki_id integer REFERENCES drinkit (drinkki_id),
aika timestamp
);

CREATE TABLE ainesosat
(
tilavuus int,
drinkki_id integer REFERENCES drinkit (drinkki_id),
aine_id integer REFERENCES raakaaineet (aine_id)
);

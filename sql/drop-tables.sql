CREATE TABLE drinkit
(
DrinkkiID SERIAL PRIMARY KEY NOT NULL, 
Nimi varchar(255),
Aliakset varchar(255),
Drinkkityyppi varchar(255),
Valmistustapa varchar(255),
CONSTRAINT ainesosa integer FOREIGN KEY (aines_id)
      REFERENCES ainesosat (aines_id)
      ON UPDATE CASCADE ON DELETE CASCADE
CONSTRAINT muokkaaja integer FOREIGN KEY (juoma)
      REFERENCES muokkaajat (juoma)
      ON UPDATE CASCADE ON DELETE CASCADE
); 

CREATE TABLE ainesosat
(
aines_id SERIAL PRIMARY KEY NOT NULL, 
Nimi varchar(255),
Tilavuus integer,
CONSTRAINT drinkki integer FOREIGN KEY (aines_id)
      REFERENCES drinkit (DrinkkiID)
      ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE muokkaajat
(
CONSTRAINT henk_tunnus integer FOREIGN KEY (user_id)
      REFERENCES users (user_id)
      ON UPDATE CASCADE ON DELETE CASCADE
CONSTRAINT juoma integer FOREIGN KEY (DrinkkiID)
      REFERENCES drinkit (DrinkkiID)
      ON UPDATE CASCADE ON DELETE CASCADE
Aika timestamp;
);

CREATE TABLE users
(
user_id SERIAL PRIMARY KEY NOT NULL, 
Tunnus varchar(255),
Salasana varchar(255),
Muokkausoikeus boolean,
Adminoikeus boolean,
CONSTRAINT muokkaukset integer FOREIGN KEY (henk_tunnus)
      REFERENCES muokkaajat (henk_tunnus)
      ON UPDATE CASCADE ON DELETE CASCADE
); 
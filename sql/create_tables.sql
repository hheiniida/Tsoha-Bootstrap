-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Henkilo(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  nimi varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  salasana varchar(50) NOT NULL
);

CREATE TABLE Muistettava(
  id SERIAL PRIMARY KEY,
  henkilo_id INTEGER REFERENCES Henkilo(id), -- Viiteavain Henkilo-tauluun
 luokka_id INTEGER REFERENCES Luokka(id),
 nimi varchar(50) NOT NULL,
  prioriteetti varchar(2),
  kuvaus varchar(50),
  pvm DATE
);

CREATE TABLE Luokka(
id SERIAL PRIMARY KEY,
nimi varchar(15) NOT NULL,
kuvaus varchar(50)
);
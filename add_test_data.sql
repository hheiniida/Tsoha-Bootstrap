-- Lisää INSERT INTO lauseet tähän tiedostoon
-- Henkilo-taulun testidata
INSERT INTO Henkilo (nimi, salasana) VALUES ('Kalle', 'Kalle123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Henkilo (nimi, salasana) VALUES ('Henri', 'Henri123');
-- Muistettava taulun testidata
INSERT INTO Muistettava (nimi, prioriteetti, kuvaus, pvm) VALUES ('Vie roskat', '6', 'Vie roskat keittiöstä ja olohuoneesta.', NOW());
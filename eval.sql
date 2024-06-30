CREATE TABLE unites(
    idUnite SERIAL PRIMARY KEY,
    designation TEXT
);
insert into unites(designation) values('m2');
insert into unites(designation) values('m3');

CREATE TABLE maisons(
    idMaison SERIAL PRIMARY KEY,
    designation TEXT,
    description TEXT,
    dure_construction double precision,
    surface double precision
);
insert into maisons(designation,description,dure_construction,surface) values('villa basse','Villa spacieuse avec 3 chambres , 1 living, 1 douche ,acces voiture',120,100);
insert into maisons(designation,description,dure_construction,surface) values('studio','studio ho any mpianatra , omby anla ranga io a',19,20);

CREATE TABLE finitions(
    idFinition SERIAL PRIMARY KEY,
    designation TEXT,
    pourcentage double precision
);
insert into finitions(designation,pourcentage) values('Standrad',0);
insert into finitions(designation,pourcentage) values('Gold',10);
insert into finitions(designation,pourcentage) values('Premium',20);
insert into finitions(designation,pourcentage) values('VIP',40);

CREATE TABLE travaux(
    idTravaux SERIAL PRIMARY KEY,
    idMaison int,
    idUnite int,
    designation TEXT,
    quantite double precision,
    prix_unitaire double precision,
    code VARCHAR(3),
    FOREIGN KEY(idMaison) REFERENCES maisons(idMaison),
    FOREIGN KEY(idUnite) REFERENCES unites(idUnite)
);
insert into travaux(idMaison,idUnite,designation,quantite,prix_unitaire,code) values(1,2,'place',20,2000,'102');
insert into travaux(idMaison,idUnite,designation,quantite,prix_unitaire,code) values(1,2,'beton',100,1000,'102');

CREATE TABLE devis(
    idDevis SERIAL PRIMARY KEY,
    idMaison int,
    idFinition int,
    pourcentage double precision,
    date_debut_travaux DATE,
    date_fin_travaux DATE,
    numero VARCHAR(15),
    montant_total double precision,
    ref_devis VARCHAR(5),
    date_devis DATE,
    lieu TEXT,
    FOREIGN KEY(idMaison) REFERENCES maisons(idMaison),
    FOREIGN KEY(idFinition) REFERENCES finitions(idFinition)
);

CREATE TABLE detail_devis(
    idDetailDevis SERIAL PRIMARY KEY,
    idDevis int,
    designation TEXT,
    unite TEXT,
    quantite double precision,
    prix_unitaire double precision,
    total double precision,
    FOREIGN KEY(idDevis) REFERENCES devis(idDevis)
);

CREATE TABLE paiement(
    idPaiement SERIAL PRIMARY KEY,
    idDevis int,
    montant double precision,
    date_paiement DATE,
    ref_paiement TEXT,
    FOREIGN KEY(idDevis) REFERENCES devis(idDevis)
);
ALTER TABLE paiement
ADD CONSTRAINT ref_unique UNIQUE (ref_paiement);


CREATE TABLE csv_maisontravaux(
    type_maison TEXT,
    description TEXT,
    surface double precision,
    code_travaux int,
    type_travaux TEXT,
    unite TEXT,
    prix_unitaire double precision,
    quantite double precision,
    duree_travaux double precision
);
create table csv_paiement(
    ref_devis VARCHAR(50),
    ref_paiement VARCHAR(50),
    date_paiement DATE,
    montant double precision
);
create table csv_devis(
    client TEXT,
    ref_devis VARCHAR(100),
    type_maison VARCHAR(150),
    finition VARCHAR(150),
    taux_finition VARCHAR(150),
    date_devis DATE,
    date_debut DATE,
    lieu VARCHAR(150)
);
-- drop table paiement;
-- drop table detail_devis;
-- drop table devis;
-- drop table travaux;
-- drop table finitions;
-- drop table maisons;
-- drop table unites;
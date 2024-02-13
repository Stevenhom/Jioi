create database jioi;
alter database event owner to gestion;

\c event gestion

create table admins(
	id_admins serial primary key not null,
	name varchar(20),
	mail varchar(20),
	password varchar(20) 
);

insert into admins(name,mail,password) values('Admins','admin@admin','123456');

create table gestionnaires(
	id_gestionnaires serial primary key not null,
	name varchar(20),
	mail varchar(20),
	password varchar(20)
);

insert into gestionnaires(name,mail,password) values('Gestionnaires','gestion@gestion','654321');

create table pays(
	id_pays serial primary key not null,
	nom varchar(20)
);

create table type_discipline(
	id_type serial primary key not null,
	label varchar(20)
);

insert into type_discipline(label) values('collectif'),('individuel');

create table disciplines(
	id_disciplines serial primary key not null,
	nom varchar(20),
	code varchar(3),
	id_type int,
	foreign key (id_type) references type_discipline(id_type)
); 

create table athletes(
	id_athletes serial primary key not null,
	nom varchar(20),
	id_discipline int,
	id_pays int,
	foreign key (id_discipline) references disciplines(id_disciplines),
	foreign key (id_pays) references pays(id_pays)
);

create table site(
	id_site serial primary key not null,
	nom varchar(20)
);

create table calendrier(
	id_calendrier serial primary key not null,
	daty timestamp,
	id_discipline int,
	id_site int,
	foreign key (id_discipline) references disciplines(id_disciplines),
	foreign key (id_site) references site(id_site)
);

CREATE TABLE classement_medailles (
    id_classement serial PRIMARY KEY NOT NULL,
    nom varchar(20)
);

INSERT INTO classement_medailles (nom) VALUES ('Or');
INSERT INTO classement_medailles (nom) VALUES ('Argent');
INSERT INTO classement_medailles (nom) VALUES ('Bronze');

create table resultat(
	id_resultat serial primary key not null,
	id_discipline int,
	id_pays int,
	rang int,
	id_classement_medaille int,
	foreign key (id_discipline) references disciplines(id_disciplines),
	foreign key (id_pays) references pays(id_pays),
	FOREIGN KEY (id_classement_medaille) REFERENCES classement_medailles(id_classement)
);

ALTER TABLE resultat
ADD id_athlete int,
ADD FOREIGN KEY (id_athlete) REFERENCES athletes(id_athletes);

create table athletes_resultat(
	id_athlete_resultat serial primary key not null,
	id_athlete int,
	id_resultat int,
	foreign key (id_athlete) references athletes(id_athletes),
	foreign key (id_resultat) references resultat(id_resultat)
);

/*

SELECT
    pays.nom AS pays,
    disciplines.nom AS discipline,
    COUNT(CASE WHEN classement_medailles.nom = 'Or' THEN 1 ELSE NULL END) AS or,
    COUNT(CASE WHEN classement_medailles.nom = 'Argent' THEN 1 ELSE NULL END) AS argent,
    COUNT(CASE WHEN classement_medailles.nom = 'Bronze' THEN 1 ELSE NULL END) AS bronze
FROM
    resultat
JOIN
    pays ON resultat.id_pays = pays.id_pays
JOIN
    disciplines ON resultat.id_discipline = disciplines.id_disciplines
JOIN
    classement_medailles ON resultat.id_classement_medaille = classement_medailles.id_classement
GROUP BY
    pays.nom, disciplines.nom;
*/


create table type_categorie(
	id_type serial primary key not null,
	label varchar(20)
);

insert into type_categorie(label) values('DEPENSE'),('RECETTE');

create table categorie(
	id_categorie serial primary key not null,
	id_type int,
	nom varchar(20),
	code varchar(3),
	foreign key (id_type) references type_categorie(id_type)
);

create table budget(
	id_budget serial primary key not null,
	id_categorie int,
	montant DECIMAL(10, 2),
	daty date,
	id_discipline int,
	foreign key (id_categorie) references categorie(id_categorie),
	foreign key (id_discipline) references disciplines(id_disciplines)
);

/*
select budget.id_budget, type_categorie.label as type,
categorie.nom, categorie.code as code_categorie, budget.montant, budget.daty,
disciplines.nom as discipline, disciplines.code as code_discipline
from budget join categorie on categorie.id_categorie=budget.id_categorie
join type_categorie on type_categorie.id_type=categorie.id_type
join disciplines on disciplines.id_disciplines=budget.id_discipline;
*/


create or replace view v_budget as
select budget.id_budget, type_categorie.label as type,
categorie.nom, categorie.code as code_categorie, budget.montant, budget.daty,
disciplines.nom as discipline, disciplines.code as code_discipline
from budget join categorie on categorie.id_categorie=budget.id_categorie
join type_categorie on type_categorie.id_type=categorie.id_type
join disciplines on disciplines.id_disciplines=budget.id_discipline;


--DEPENSE
create or replace view v_depense as
select discipline, montant from v_budget where type='DEPENSE' 
;
--RECETTE
create or replace view v_recette as
select discipline, montant from v_budget where type='RECETTE' 
;

create or replace view r_depense as
select discipline, sum(montant) as depense from v_depense
group by discipline; 

create or replace view r_recette as
select discipline, sum(montant) as recette from v_recette
group by discipline; 

/*SELECT
    rd.discipline,
    COALESCE(rr.recette, 0) AS recette,
    COALESCE(rd.depense, 0) AS depense,
    COALESCE(rr.recette, 0) - COALESCE(rd.depense, 0) AS difference
FROM r_depense rd
LEFT JOIN r_recette rr ON rd.discipline = rr.discipline;
*/

create or replace view isa_medaille as
select  COUNT(*) as medailles_count from resultat where id_pays=1 group by id_classement_medaille;

select sum(medailles_count) as isa from isa_medaille;


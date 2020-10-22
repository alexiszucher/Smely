CREATE TABLE users
(
    id int not null PRIMARY KEY Auto_Increment,
    email varchar(150) not null,
    mdp varchar(200) not null
);

CREATE TABLE projets
(
    id int not null PRIMARY KEY Auto_Increment,
    libelle varchar(150) not null
);

CREATE TABLE droits_projets
(
    id_user int not null,
    id_projet int not null
);

CREATE TABLE taches
(
    id int not null PRIMARY KEY Auto_Increment,
    id_projet int not null,
    libelle varchar(150) not null,
    fait int default null
);

CREATE TABLE rapports
(
    id int not null PRIMARY KEY Auto_Increment,
    id_projet int not null,
    libelle varchar(150) not null,
    date date default null,
    contenu VARCHAR(21000) Default NULL
);
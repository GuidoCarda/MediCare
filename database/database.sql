CREATE DATABASE medicare;
USE medicare;

CREATE TABLE `user` (
  id int primary key auto_increment,
  email varchar(50),
  password varchar(50)
);

CREATE TABLE blood_type(
  id int primary key auto_increment,
  denomination varchar(50)
);

CREATE TABLE patient(
  id int primary key auto_increment,
  name varchar(50),
  lastname varchar(50),
  gender enum('Masculino', "Femenino"),
  birth_date date,
  dni varchar(8),
  user_id int,
  blood_type_id int,
  foreign key (user_id) references `user`(id),
  foreign key (blood_type_id) references blood_type(id)
);



CREATE TABLE frecuency(
  id int primary key auto_increment,
  denomination varchar(50),
  hours_interval int
);

CREATE TABLE medicine_type(
  id int primary key auto_increment,
  denomination varchar(50),
  unit varchar(50)
);

CREATE TABLE specialty(
  id int primary key auto_increment,
  denomination varchar(50)
);

CREATE TABLE professional(
  id int primary key auto_increment,
  name varchar(50),  
  lastname varchar(50),
  email varchar(50),
  license_number varchar(10),
  phone_number varchar(10),
  specialty_id int,
  foreign key (specialty_id) references specialty(id)
);

CREATE TABLE patient_professional(
  id int primary key auto_increment,
  patient_id int,
  professional_id int,
  status boolean,
  foreign key (patient_id) references patient(id),
  foreign key (professional_id) references professional(id)
);

CREATE TABLE medicine(
  id int primary key auto_increment,
  generic_name varchar(50),
  drug varchar(50),
  medicine_type_id int,
  foreign key (medicine_type_id) references medicine_type(id)
);

CREATE TABLE prescription(
  id int primary key auto_increment,
  quantity int,
  created_at date,
  professional_id int,
  patient_id int,
  frecuency_id int,
  foreign key (professional_id) references professional(id),
  foreign key (patient_id) references patient(id),
  foreign key (frecuency_id) references frecuency(id)
);


-- Primeros inserts

INSERT INTO medicine_type (denomination, unit)
VALUES
  ('Pastilla', 'Comprimido'),
  ('Jarabe', 'Mililitros'),
  ('Inyección', 'Mililitros'),
  ('Cápsula', 'Comprimido'),
  ('Crema', 'Gramos'),
  ('Parche Transdérmico', 'Unidades'),
  ('Supositorio', 'Unidades'),
  ('Solución Oftálmica', 'Gotas'),
  ('Inhalador', 'Inhalaciones'),
  ('Gotas Orales', 'Gotas');


INSERT INTO specialty (denomination)
VALUES
  ('Neumonólogo'),
  ('Neurologo'),
  ('Psicólogo'),
  ('Nutricionista'),
  ('Cardiólogo'),
  ('Dermatólogo'),
  ('Ginecólogo'),
  ('Oftalmólogo'),
  ('Pediatra'),
  ('Cirujano General'),
  ('Endocrinólogo'),
  ('Oncólogo'),
  ('Ortopedista'),
  ('Psiquiatra'),
  ('Radiólogo'),
  ('Urología'),
  ('Odontólogo'),
  ('Fisioterapeuta'),
  ('Geriatra');

INSERT INTO blood_type (denomination)
VALUES
  ('A+'),
  ('A-'),
  ('B+'),
  ('B-'),
  ('AB+'),
  ('AB-'),
  ('O+'),
  ('O-');


INSERT INTO frecuency (denomination, hours_interval)
VALUES
  ('Diario', 24),
  ('Dia por medio', 48),
  ('Una vez por semana', 168),
  ('Cada 15 dias', 360),
  ('Cada 12 horas', 12),
  ('Cada 8 horas', 8),
  ('Cada 6 horas', 6),
  ('Cada 4 horas', 4),
  ('Cada 2 horas', 2),
  ('Cada 1 hora', 1);



-- Common queries 


SELECT * FROM blood_type;

SELECT * FROM frecuency;

SELECT * FROM medicine_type;

SELECT * FROM specialty;

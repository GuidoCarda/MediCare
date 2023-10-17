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

CREATE TABLE frequency(
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
  status boolean default true,
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
  frequency_id int,
  medicine_id int,
  is_active boolean default true,
  foreign key (professional_id) references professional(id),
  foreign key (patient_id) references patient(id),
  foreign key (frequency_id) references frequency(id),
  foreign key (medicine_id) references medicine(id)
);

CREATE TABLE inquiry(
  id int primary key auto_increment,
  `name` varchar(50),
  email varchar(50),
  `subject` varchar(50),
  `message` varchar(255),
  created_at date default (CURRENT_DATE),
  user_id int,
  foreign key (user_id) references `user`(id)
)

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

SELECT * FROM patient_professional WHERE patient_id = 1;

SELECT * FROM patient_professional WHERE professional_id = 1;

-- Obtener los datos de todos los profesionales
SELECT p.id
       p.name, 
       p.lastName, 
       p.phone_number, 
       s.denomination 
FROM professional p 
INNER JOIN specialty s ON p.specialty_id = s.id


-- Obtener los datos de todos los profesionales que atienden a un paciente
SELECT p.id
       p.name, 
       p.lastName, 
       p.phone_number, 
       s.denomination 
FROM professional p
INNER JOIN patient_professional pp ON p.id = pp.professional_id 
INNER JOIN specialty s ON p.specialty_id = s.id
WHERE pp.patient_id = 3;


-- Obtener las prescriptiones de un paciente
SELECT p.id, 
       p.quantity, 
       p.created_at, 
       pr.name, 
       pr.lastName, 
       f.denomination 
FROM prescription p 
INNER JOIN professional pr ON p.professional_id = pr.id 
INNER JOIN frequency f ON p.frequency_id = f.id
WHERE p.patient_id = $patientId

-- Obtener una prescription de un paciente
SELECT p.id, 
       p.quantity, 
       p.created_at, 
       pr.name, 
       pr.lastName, 
       f.denomination 
FROM prescription p 
INNER JOIN professional pr ON p.professional_id = pr.id 
INNER JOIN frequency f ON p.frequency_id = f.id
WHERE p.id = $id AND p.patient_id = $patient_id;

-- Restart auto increment
ALTER TABLE tablename AUTO_INCREMENT = 1

-- obtener la ultima prescripcion por cada medicina de un paciente
SELECT 
    p.id, 
    p.quantity, 
    p.created_at, 
    p.medicine_id, 
    pr.name, 
    pr.lastName, 
    f.denomination AS frequency, 
    m.drug, 
    m.generic_name, 
    mt.denomination AS medicine_type, 
    mt.unit AS medicine_unit 
FROM prescription p 
INNER JOIN professional pr ON p.professional_id = pr.id 
INNER JOIN frequency f ON p.frequency_id = f.id 
INNER JOIN medicine m ON p.medicine_id = m.id 
INNER JOIN medicine_type mt ON m.medicine_type_id = mt.id 
WHERE p.patient_id = 1 
AND p.id IN (SELECT MAX(p2.id) FROM prescription p2 GROUP BY p2.medicine_id)


-- Reset database dynamic tables

DELIMITER //
CREATE PROCEDURE restartdb () 
BEGIN
  DELETE `user` WHERE 1;
  ALTER TABLE `user` AUTO_INCREMENT = 1;
  DELETE patient_professional WHERE 1;
  ALTER TABLE patient_professional AUTO_INCREMENT = 1;
  DELETE patient WHERE 1;
  ALTER TABLE patient AUTO_INCREMENT = 1;
  DELETE professional WHERE 1;
  ALTER TABLE professional AUTO_INCREMENT = 1;
  DELETE prescription WHERE 1;
  ALTER TABLE prescription AUTO_INCREMENT = 1;
  DELETE medicine WHERE 1;
  ALTER TABLE medicine AUTO_INCREMENT = 1;
  DELETE inquiry WHERE 1;
  ALTER TABLE inquiry AUTO_INCREMENT = 1;
END;

//
DELIMITER ;

CALL restartdb();


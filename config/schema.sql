 create table departments(
        department_id int (11) PRIMARY KEY AUTO_INCREMENT,
        department_name VARCHAR (50),
        location VARCHAR(100)
    );
 
create TABLE patients(
    patient_id int(11)  PRIMARY KEY AUTO_INCREMENT,
    first_name varchar(50),
    last_name varchar(50),
    genre enum('Male', 'Female'),
    date_of_birth date,
    phone_number varchar(11),
    email varchar(100),
    adress varchar(255)
);

create table doctors(
    doctor_id int (11) PRIMARY key AUTO_INCREMENT,
    firs_name VARCHAR (100),
    last_name VARCHAR (100),
    specialisation VARCHAR (50),
    phone_number VARCHAR (15),
    email VARCHAR (100),
    department_id int (11),
    Foreign Key (department_id) REFERENCES departments(department_id)
    );

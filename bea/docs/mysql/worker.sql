drop database if exists basic_employment_agency;

create database if not exists basic_employment_agency
default character set utf8
default collate utf8_general_ci;

use basic_employment_agency;

drop table if exists user;
create table if not exists user(
	user_id int auto_increment,
    login_id int,
    access_id tinyint(1),
    name varchar(100) not null,
    gender enum('M', 'F'),
    email varchar(100) not null unique,
    primary key(user_id),
    foreign key(login_id) references login(id),
    foreign key(access_id) references access_level(id)
) default charset = utf8;

drop table if exists curriculum;
create table if not exists curriculum(
	curriculum_id int auto_increment,
    /*id do usuario*/
    user_id int,
    /*endereço*/
    address_id int,
    date_birth date not null,
    salary_pretension decimal(7, 2),
    curriculum_path varchar(100),
    summary mediumtext,
    isbpd bool not null default false,
    marital_status enum('casado', 'solteiro'),
    primary key(curriculum_id),
    /*referencia o usuário*/
    foreign key(user_id) references user(user_id),
    /*referencia o endereço*/
    foreign key(address_id) references address(address_id)
) default charset = utf8;

/*telefone para contato 3 niveis:
	1 - celular;
    2 - telefone fixo;
    3 - telefone para recado
*/
drop table if exists phone_contact;
create table if not exists phone_contact(
	phone_id int auto_increment,
    type tinyint unsigned default 1,
    phone varchar(20),
    primary key(phone_id)
) default charset = utf8;

/*relação contato com usuário*/
drop table if exists phone_curriculum;
create table if not exists phone_curriculum(
	id int auto_increment,
	curriculum_id int,
    phone_id int,
    primary key(id),
    foreign key(curriculum_id) references curriculum(curriculum_id),
    foreign key(phone_id) references phone_contact(phone_id)
) default charset = utf8;

/*Endereço*/
drop table if exists city;
create table if not exists city(
	city_id int auto_increment,
    name varchar(100) not null,
    state char(2) not null,
    primary key(city_id)
) default charset = utf8;

drop table if exists address;
create table if not exists address(
	address_id int auto_increment,
    city_id int,
    neighborhood varchar(100),
    cep varchar(20),
    primary key(address_id),
    foreign key(city_id) references city(city_id)
) default charset = utf8;

drop table if exists bpd;
create table if not exists bpd(
	bpd_id tinyint(1) auto_increment,
    description varchar(100),
    primary key(bpd_id)
) default charset = utf8;

drop table if exists bpd_curriculum;
create table if not exists bpd_curriculum(
	id int auto_increment,
    curriculum_id int,
    bpd_id tinyint(1),
    primary key(id),
    foreign key(curriculum_id) references curriculum(curriculum_id),
    foreign key(bpd_id) references bpd(bpd_id)
) default charset = utf8;

/*Cursos*/
# nivel
drop table if exists level;
create table if not exists level(
	level_id tinyint(1) auto_increment,
	type enum('doutorado', 'medio', 'medio-tecnico', 'mestrado', 
			  'pos-graduacao', 'pos-medio', 'profissionalizante', 
              'superior', 'tecnico', 'tecnologo' ) default 'medio',
    primary key(level_id)
) default charset = utf8;

drop table if exists course;
create table if not exists course(
	course_id int auto_increment,
    level_id tinyint(1),
    city_id int,
    institution varchar(64) not null,
    name varchar(64) not null,
    year_conclusion year,
    primary key(course_id),
    foreign key(level_id) references level(level_id),
    foreign key(city_id) references city(city_id)
) default charset = utf8;

/*Relação Cursos - usuário*/
drop table if exists course_curriculum;
create table if not exists course_curriculum(
	id int auto_increment,
	curriculum_id int,
    course_id int,
    primary key(id),
    foreign key(curriculum_id) references curriculum(curriculum_id),
    foreign key(course_id) references course(course_id)
) default charset = utf8;

drop table if exists experience;
create table if not exists experience(
	exp_id int auto_increment,
    func_id tinyint(2),
    company_name varchar(100),
    specialty varchar(100),
    date_entrance date,
    date_exit date,
    description text,
    primary key(exp_id),
    foreign key(func_id) references func(func_id)
) default charset = utf8;

drop table if exists experience_curriculum;
create table if not exists experience_curriculum(
	id int auto_increment,
    curriculum_id int,
    exp_id int,
    primary key(id),
    foreign key(curriculum_id) references curriculum(curriculum_id),
    foreign key(exp_id) references experience(exp_id)
) default charset = utf8;

/*Escolaridade*/

drop table if exists education;
create table if not exists education(
	ed_id int auto_increment,
    course_id int,
    situation enum('completo', 'cursando', 'trancado'),
    primary key(ed_id),
    foreign key(course_id) references course(course_id)
) default charset = utf8;

drop table if exists education_curriculum;
create table if not exists education_curriculum(
	id int auto_increment,
    curriculum_id int,
    ed_id int,
    primary key(id),
    foreign key(curriculum_id) references curriculum(curriculum_id),
    foreign key(ed_id) references education(ed_id)
) default charset = utf8;

/*função*/
drop table if exists func;
create table if not exists func(
	func_id tinyint(2) auto_increment,
    name varchar(64) not null,
    primary key(func_id)
) default charset = utf8;

drop table if exists function_curriculum;
create table if not exists function_curriculum(
	id int auto_increment,
    curriculum_id int,
    func_id tinyint(2),
    primary key(id),
    foreign key(curriculum_id) references curriculum(curriculum_id),
    foreign key(func_id) references func(func_id)
) default charset = utf8;

/*---------------------------------------------------------------------------------------------*/
# populando tabela level
insert into level
values (1, default),
	   (2, 'médio-técnico'),
       (3, 'profissionalizante'),
       (4, 'técnologo');
       
insert into level
values (default, 'doutorado'),
	   (default, 'mestrado'),
	   (default, 'pos-graduacao'),
	   (default, 'pos-medio'),
	   (default, 'superior'),
       (default, 'tecnico');
select * from level;

# populando table func
insert into func
values (default, 'Auxiliar Administrativo'),
	   (default, 'Auxiliar de Almoxarifado'),
       (default, 'Auxiliar de Escritório'),
       (default, 'Auxiliar de Estoque'),
       (default, 'Auxiliar de Produção'),
       (default, 'Auxiliar de Cozinha'),
       (default, 'Assistente Administrativo'),
       (default, 'Assistente de Almoxarifado'),
       (default, 'Assistente de Almoxarife'),
       (default, 'Assistente de Limpeza'),
       (default, 'Analista de Sistemas'),
       (default, 'Analista de Produção'),
       (default, 'Almoxarife'),
       (default, 'Auxiliar de Acesso'),
       (default, 'Arquiteto'),
       (default, 'Balconista'),
       (default, 'Cozinheiro'),
       (default, 'Chapeiro'),
       (default, 'Cirurgião Dentista'),
       (default, 'Cirurgião'),
       (default, 'Costura'),
       (default, 'Dentista'),
       (default, 'Desenvolvedor'),
       (default, 'Design Altomotivo'),
       (default, 'Design Digital'),
       (default, 'Design de Interiores'),
       (default, 'Desenvolvedor Web'),
       (default, 'Documentador Escolar'),
       (default, 'Documentador'),
       (default, 'Estoquista'),
       (default, 'Enfermeiro'),
       (default, 'Eletricista'),
       (default, 'Engenheiro Ambiental'),
       (default, 'Engenheiro Agronomo'),
       (default, 'Engenheiro Cívil'),
       (default, 'Engenheiro Industrial'),
       (default, 'Engenheiro Químico'),
       (default, 'Educador Infantil'),
       (default, 'Empacotador'),
       (default, 'Faxineiro'),
       (default, 'Farmaceutico'),
       (default, 'Ferreiro'),
       (default, 'Inspetor de Alunos'),
       (default, 'Inspetor de Qualidade'),
       (default, 'Instalador'),
       (default, 'Locutor'),
       (default, 'Logistica'),
       (default, 'Manutenção'),
       (default, 'Marceneiro'),
       (default, 'Mestre de Obras'),
       (default, 'Mecânico'),
       (default, 'Padeiro'),
       (default, 'Pedreiro'),
       (default, 'Professor'),
       (default, 'Programador Junior'),
       (default, 'Programador Pleno'),
       (default, 'Programador Senior'),
       (default, 'Programador de Computador'),
       (default, 'Programador de Jogos'),
       (default, 'Serviços Gerais'),
       (default, 'Secretária'),
       (default, 'Soldador'),
       (default, 'Técnico em Meio Ambiente'),
       (default, 'Técnico Eletricista'),
       (default, 'Técnico em Informática'),
       (default, 'Técnico Programador'),
       (default, 'Técnico em Edificações'),
       (default, 'Web Designer'),
       (default, 'Zelador');
       
select * from func order by name;




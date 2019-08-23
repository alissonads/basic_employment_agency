use basic_employment_agency;

drop table if exists login;
create table if not exists login(
	id int auto_increment,
    /*cpf, matricula, cnpj*/
    username varchar(64) not null unique,
    password varchar(20) not null,
    primary key(id)
) default charset = utf8;

drop table if exists access_level;
create table if not exists access_level(
	id tinyint(1) auto_increment,
    type enum('Admin', 'Colaborador', 'Trabalhador') default 'Trabalhador',
    primary key(id)
) default charset = utf8;

insert into access_level
values (1, 'Admin'),
	   (2, 'Colaborador'),
       (3, 'Trabalhador');
       
select * from access_level WHERE id order by id desc;
select * from access_level WHERE type = 'Trabalhador';

       



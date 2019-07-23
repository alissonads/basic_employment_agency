use basic_employment_agency;

drop table if exists login;
create table if not exists login(
	id int auto_increment,
    /*cpf, matricula, cnpj*/
    username varchar(64) not null,
    password varchar(20) not null,
    primary key(id)
) default charset = utf8;

drop table if exists access_level;
create table if not exists access_level(
	id tinyint(1) auto_increment,
    type enum('admin', 'admin_company', 
			  'collaborating', 'worker') default 'worker',
    primary key(id)
) default charset = utf8;

insert into access_level
values (1, 'admin'),
	   (2, 'admin_company'),
       (3, 'collaborating'),
       (4, default);
       
select * from access_level;

       



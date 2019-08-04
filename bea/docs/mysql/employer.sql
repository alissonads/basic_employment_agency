drop table if exists company;
create table if not exists company(
	company_id int auto_increment,
    name varchar(100) not null,
    specialty varchar(100) not null,
    cnpj varchar(20) not null,
    primary key(company_id)
) default charset = utf8;

drop table if exists collaborator_company;
create table if not exists collaborator_company(
	advertiser_id int auto_increment,
    user_id int,
    company_id int,
    primary key(advertiser_id),
    foreign key(user_id) references user(user_id),
    foreign key(company_id) references company(company_id)
) default charset = utf8;

drop table if exists announcement;
create table if not exists announcement(
	announcement_id int auto_increment,
    company_id int,
    advertiser_id int,
    address_id int,
    phone_id int,
    func_id tinyint,
    phone_visible bool default false,
    email varchar(100) not null,
    email_visible bool default false,
    salary decimal(7, 2),
    amount tinyint unsigned not null,
    description text not null,
    isbpd bool default false,
    date_ann date not null,
    to_receive_email bool default false,
    primary key(announcement_id),
    foreign key(company_id) references company(company_id),
    foreign key(advertiser_id) references collaborator_company(advertiser_id),
    foreign key(address_id) references address(address_id),
    foreign key(phone_id) references phone_contact(phone_id),
    foreign key(func_id) references func(func_id)
) default charset = utf8;

drop table if exists bpd_announcement;
create table if not exists bpd_announcement(
	id int auto_increment,
	announcement_id int,
    bpd_id tinyint,
    primary key(id),
    foreign key(announcement_id) references announcement(announcement_id),
    foreign key(bpd_id) references bpd(bpd_id)
) default charset = utf8;

/*drop table if exists advertiser_makes_announcement;
create table if not exists advertiser_makes_announcement(
	id int auto_increment,
    advertiser_id int,
    company_id int,
    announcement_id int,
    date_ann date not null,
    primary key(id),
    foreign key(advertiser_id) references collaborator_company(advertiser_id),
    foreign key(company_id) references company(company_id),
    foreign key(announcement_id) references announcement(announcement_id)
) default charset = utf8;*/

drop table if exists worker_interested_announce;
create table if not exists worker_interested_announce(
	id int auto_increment,
    user_id int,
    announcement_id int,
    date_cand date not null,
    primary key(id),
    foreign key(user_id) references user(user_id),
    foreign key(announcement_id) references announcement(announcement_id)
) default charset = utf8;

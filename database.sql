create table books(
id integer not null auto_increment,
title varchar(50) not null,
author_name varchar(50) not null,
publisher_name varchar(50) not null,
publish_year year not null,
created_at timestamp not null default now(),
updated_at timestamp default null,

PRIMARY KEY(id));
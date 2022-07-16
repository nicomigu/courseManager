create database new_co;
use new_co;

create table users (
   id int auto_increment not null primary key,
   password_digest varchar(255),
   email varchar(255) not null unique,
   name varchar(255) not null
);

create table posts (
   id int auto_increment not null primary key,
   title varchar(255) not null,
   body varchar(255) not null,
   author_id int not null,
   foreign key (author_id) references users (id)
);


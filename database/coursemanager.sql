create database course_manager;
use course_manager;

create table users (
   id int auto_increment not null primary key,
   password_digest varchar(255),
   email varchar(255) not null unique,
   name varchar(255) not null
);

create table courses (
   id int auto_increment not null primary key,
   courseTitle varchar(255) not null,
   completed boolean default 0,
   student_id int not null,
   foreign key (student_id) references users (id)
);

CREATE DATABASE packets;

CREATE TABLE entry(id int AUTO_INCREMENT primary key,d_date date, protocol varchar(3),src_ip varchar(16),d_port int);

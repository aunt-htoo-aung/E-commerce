CREATE TABLE if not EXISTS admin(
    id integer primary key auto_increment,
    email varchar(30) UNIQUE,
    username varchar(30),
    password varchar(100)
);
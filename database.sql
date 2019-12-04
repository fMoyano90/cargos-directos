CREATE DATABASE IF NOT EXISTS cargos_directos_laravel;
USE cargos_directos_laravel;

CREATE TABLE users(
    id                  int(255) auto_increment not null, 
    role                varchar(20),
    name                varchar(200),
    surname             varchar(200),
    email               varchar(255),
    password            varchar(255),
    image               varchar(255),
    created_at          datetime,
    updated_at          datetime,
    remember_token      varchar(255),
    CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE cargos(
    id                  int(255) auto_increment not null, 
    lote                varchar(50),
    fecha_entrada       date,
    detalle             varchar(200),
    nro_contable        varchar(255),
    ubicacion           varchar(255),
    cantidad_stock      float,
    salida              varchar(255),
    cantidad_salida     float,
    correo              varchar(255),
    observacion         varchar(255),
    created_at          datetime,
    updated_at          datetime,
    CONSTRAINT pk_cargos PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE correos(
    id          int(255) auto_increment not null, 
    correo      varchar(50),
    primero     int(5),
    segundo     int(5),
    tercero     int(5),
    created_at  date,
    updated_at  datetime,
    CONSTRAINT pk_correos PRIMARY KEY(id)
)ENGINE=InnoDb;


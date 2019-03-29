drop table if exists tb_registros;

create table `tb_registros` (
  `id` int primary key not null AUTO_INCREMENT,
  `nombre` varchar(100) not null,
  `fecha_creado` datetime not null default current_timestamp
)
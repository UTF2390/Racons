INSERT INTO `racons`.`persona` (`nick`, `password`, `nombre`, `apellido1`, `apellido2`) VALUES ('profe@profe', '1234', 'Robert', 'de', 'Niro');
INSERT INTO `racons`.`profesor` (`id_profesor`, `administrador`) VALUES ('2', '0');
INSERT INTO `racons`.`categoria` (`limite`, `nombre`) VALUES ('5', 'Arte');
INSERT INTO `racons`.`taller` (`nombre`, `descripcion`, `aforamiento`, `dia`, `hora_inicio`, `hora_fin`, `activo`, `id_profesor`, `id_categoria`) VALUES ('Electronica', 'Traer firmado un papel autorizado por vuestros tutores. ', '50', '2', '800', '900', '0', '2', '1');
INSERT INTO `racons`.`categoria` (`limite`, `nombre`) VALUES ('5', 'Matematicas');
INSERT INTO `racons`.`categoria` (`limite`, `nombre`) VALUES ('5', 'Musica');
INSERT INTO `racons`.`categoria` (`nombre`) VALUES ( 'Literatura');
INSERT INTO `racons`.`curso` (`curso`) VALUES ('1ºESO');
INSERT INTO `racons`.`curso` (`curso`) VALUES ('2ºESO');
INSERT INTO `racons`.`curso` (`curso`) VALUES ('3ºESO');
INSERT INTO `racons`.`curso` (`curso`) VALUES ('4ºESO');
INSERT INTO `racons`.`persona` (`nick`, `password`, `nombre`, `apellido1`, `apellido2`) VALUES ('O@alumno', '1234', 'Omar', 'Lopez', 'Garrido');
INSERT INTO `racons`.`persona` (`nick`, `password`, `nombre`, `apellido1`, `apellido2`) VALUES ('P@profesor', '1234', 'Alex', 'Sevillano', 'Barrera');
INSERT INTO `racons`.`persona` (`nick`, `password`, `nombre`, `apellido1`, `apellido2`) VALUES ('admin', '1234', 'God', 'god', 'god');
INSERT INTO `racons`.`alumno` (`id_alumno`, `id_curso`) VALUES ('3', '4');
INSERT INTO `racons`.`profesor` (`id_profesor`, `administrador`) VALUES ('4', '0');
INSERT INTO `racons`.`profesor` (`id_profesor`, `administrador`) VALUES ('5', '1');
INSERT INTO `racons`.`persona` (`nick`, `password`, `nombre`, `apellido1`, `apellido2`) VALUES ('alumno1', '1234', 'Migel', 'Fernandez', 'de la Vega');
INSERT INTO `racons`.`persona` (`nick`, `password`, `nombre`, `apellido1`, `apellido2`) VALUES ('alumno2', '1234', 'Michael', 'Jackson', 'Negro');
INSERT INTO `racons`.`alumno` (`id_alumno`, `id_curso`) VALUES ('6', '4');
INSERT INTO `racons`.`alumno` (`id_alumno`, `id_curso`) VALUES ('7', '4');
INSERT INTO `racons`.`persona` (`nick`, `nombre`, `apellido1`, `apellido2`) VALUES ('alumno3', 'Mi ', 'Colega', 'el del Bigote');
INSERT INTO `racons`.`alumno` (`id_alumno`, `id_curso`) VALUES ('8', '4');
INSERT INTO `racons`.`taller` (`nombre`, `descripcion`, `aforamiento`, `dia`, `hora_inicio`, `hora_fin`, `activo`, `id_profesor`, `id_categoria`) VALUES ('Integrame', '¿Quieres aprovar calculo?','25', '3', '000800', '000900', '0', '2', '1');
INSERT INTO `racons`.`taller` (`nombre`, `descripcion`, `aforamiento`, `dia`, `hora_inicio`, `hora_fin`, `activo`, `id_profesor`, `id_categoria`) VALUES ('Grafos', 'Matematicas en 2D', '25', '2', '800', '900', '0', '2', '1');
INSERT INTO `racons`.`taller` (`nombre`, `descripcion`, `aforamiento`, `dia`, `hora_inicio`, `hora_fin`, `id_profesor`, `id_categoria`) VALUES ('Algebra', 'Matrices y conguntos', '25', '2', '800', '1000', '2', '1');
INSERT INTO `racons`.`alumno_taller` (`id_alumno`, `id_taller`, `fecha`) VALUES ('8', '1', '2017-05-12');
INSERT INTO `racons`.`alumno_taller` (`id_alumno`, `id_taller`, `fecha`) VALUES ('8', '3', '2017-05-23');
INSERT INTO `racons`.`persona` (`nick`, `password`, `nombre`, `apellido1`, `apellido2`) VALUES ('alumno@alumno', '1234', 'Jhon', 'Carter', 'Peliculon');
INSERT INTO `racons`.`profesor` (`id_profesor`, `administrador`) VALUES ('9', '1');
INSERT INTO `racons`.`curso_taller` (`id_curso`, `id_taller`) VALUES ('1', '1');
INSERT INTO `racons`.`curso_taller` (`id_curso`, `id_taller`) VALUES ('2', '1');
INSERT INTO `racons`.`curso_taller` (`id_curso`, `id_taller`) VALUES ('3', '1');
INSERT INTO `racons`.`curso_taller` (`id_curso`, `id_taller`) VALUES ('4', '1');
INSERT INTO `racons`.`curso_taller` (`id_curso`, `id_taller`) VALUES ('4', '2');
INSERT INTO `racons`.`curso_taller` (`id_curso`, `id_taller`) VALUES ('4', '3');
INSERT INTO `racons`.`curso_taller` (`id_curso`, `id_taller`) VALUES ('4', '4');
INSERT INTO `racons`.`alumno_taller` (`id_alumno`, `id_taller`, `fecha`) VALUES ('3', '2', '2017-06-15');
INSERT INTO `racons`.`alumno_taller` (`id_alumno`, `id_taller`, `fecha`) VALUES ('3', '1', '2017-06-2');
INSERT INTO `racons`.`persona` (`nick`, `password`, `nombre`, `apellido1`, `apellido2`) VALUES ('alumno@alumno', '1234', 'Jhon ', 'Salchi ', 'Jhon');
INSERT INTO `racons`.`persona` (`nick`, `password`, `nombre`, `apellido1`, `apellido2`) VALUES ('alu@alu', '1234', 'David', 'Olivares', 'Menchen');
INSERT INTO `racons`.`alumno` (`id_alumno`, `id_curso`) VALUES ('10', '4');
UPDATE `racons`.`taller` SET `activo`='1' WHERE `id_taller`='1';
UPDATE `racons`.`taller` SET `activo`='1' WHERE `id_taller`='2';
UPDATE `racons`.`taller` SET `activo`='1' WHERE `id_taller`='3';
UPDATE `racons`.`taller` SET `activo`='1' WHERE `id_taller`='4';
UPDATE `racons`.`persona` SET `password`='alumno3' WHERE `id_persona`='8';
INSERT INTO `racons`.`persona` (`nick`, `password`, `nombre`, `apellido1`, `apellido2`) VALUES ('alumno@alumno2', '1234', 'Sergio', 'Ortega', 'Gimenez');


INSERT INTO `racons`.`alumno_taller` (`id_alumno`, `id_taller`, `fecha`) VALUES ('9', '1', '2017-06-06');
INSERT INTO `racons`.`alumno_taller` (`id_alumno`, `id_taller`, `fecha`) VALUES ('9', '1', '2017-05-06');

INSERT INTO `racons`.`alumno` (`id_alumno`, `id_curso`) VALUES ('11', '4');
INSERT INTO `racons`.`alumno` (`id_alumno`, `id_curso`) VALUES ('12', '4');

INSERT INTO `racons`.`alumno_taller` (`id_alumno`, `id_taller`, `fecha`) VALUES ('10', '1', '2017-05-23');
INSERT INTO `racons`.`alumno_taller` (`id_alumno`, `id_taller`, `fecha`) VALUES ('10', '2', '2017-05-23');
INSERT INTO `racons`.`alumno_taller` (`id_alumno`, `id_taller`, `fecha`) VALUES ('10', '3', '2017-05-23');
INSERT INTO `racons`.`alumno_taller` (`id_alumno`, `id_taller`, `fecha`) VALUES ('10', '4', '2017-05-23');
INSERT INTO `racons`.`alumno_taller` (`id_alumno`, `id_taller`, `fecha`) VALUES ('10', '4', '2016-05-23');

drop database if exists Racons;
create database Racons;
use Racons;

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(80),
  `password` varchar(80),
  `nombre` varchar(80) NOT NULL,
  `apellido1` varchar(80) NOT NULL,
  `apellido2` varchar(80) NOT NULL,
  `imagen` varchar(80) DEFAULT 'default_user_image.jpg',
   UNIQUE KEY `nick` (`nick`),
  PRIMARY KEY (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

CREATE TABLE `profesor` (
  `id_profesor` int(11) NOT NULL,
  `administrador` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_profesor`),
  UNIQUE KEY `id_profesor` (`id_profesor`),
  CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `curso` varchar(80) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `alumno` (
  `id_alumno` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  PRIMARY KEY (`id_alumno`),
  CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `alumno_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `limite` int(11) NOT NULL DEFAULT 4,
  `nombre` varchar(80) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `taller` (
  `id_taller` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(250),
  `aforamiento` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT FALSE,
  `id_profesor` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_taller`),
  CONSTRAINT `taller_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `profesor` (`id_profesor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `taller_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `alumno_categoria` (
  `id_categoria` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `limite` int(11) NOT NULL,
  PRIMARY KEY (`id_categoria`, `id_alumno`),
  CONSTRAINT `alumno_categoria_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ,
  CONSTRAINT `alumno_categoria_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `alumno_taller` (
  `id_alumno` int(11) NOT NULL,
  `id_taller` int(11) NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`id_taller`, `id_alumno`, `fecha`),
  CONSTRAINT `alumno_taller_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  CONSTRAINT `alumno_taller_ibfk_2` FOREIGN KEY (`id_taller`) REFERENCES `taller` (`id_taller`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `curso_taller` (
  `id_curso` int(11) NOT NULL,
  `id_taller` int(11) NOT NULL,
 PRIMARY KEY (`id_curso`, `id_taller`),
 CONSTRAINT `curso_taller_ibfk_1` FOREIGN KEY (`id_taller`) REFERENCES `taller` (`id_taller`) ,
  CONSTRAINT `curso_taller_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TRIGGER IF EXISTS `racons`.`persona_BEFORE_INSERT`;

DELIMITER $$
USE `racons`$$
CREATE DEFINER = CURRENT_USER TRIGGER `racons`.`persona_BEFORE_INSERT` BEFORE INSERT ON `persona` FOR EACH ROW
BEGIN
IF NEW.password IS NULL THEN
               SET NEW.password = SUBSTRING(MD5(RAND()) FROM 1 FOR 6);
           END IF;
END$$
DELIMITER ;

DROP FUNCTION   IF EXISTS apuntar;
DELIMITER $$
CREATE FUNCTION apuntar(param_id_taller int,param_id_alumno int)
  RETURNS TEXT
  LANGUAGE SQL
BEGIN 
SET @id_categoria=(select id_categoria from taller as pgx where pgx.id_taller = param_id_taller);
SET @limite_categoria=(select c.limite from taller as afg, categoria as c 
							where  afg.id_categoria = c.id_categoria and 
									afg.id_taller = param_id_taller);
SET @limite_alumno_count = (select count(*) from alumno_categoria where id_categoria = @id_categoria and id_alumno = param_id_alumno);
SET @limite_alumno = (select limite from alumno_categoria where id_categoria = @id_categoria and id_alumno = param_id_alumno);
SET @taller_hora_inicio = (select hora_inicio from taller where id_taller = param_id_taller);
SET @taller_hora_fin = (select hora_fin from taller where id_taller = param_id_taller);
if (select count(*) 
from alumno_taller as a, categoria as c, taller as t 
	where t.id_taller = a.id_taller 
		and t.id_categoria = c.id_categoria 
		and c.id_categoria = @id_categoria 
        and a.id_alumno = param_id_alumno
		and (DATE_ADD(curdate(), INTERVAL - 30 DAY)) < a.fecha)<
				if(  0 < @limite_alumno_count,@limite_alumno,@limite_categoria)
					  then
	if (0 = (select count(*) from taller as t2, (select fg.id_taller as ap_id_taller, dia as ap_dia, hora_fin as ap_hora_fin, hora_inicio as ap_hora_inicio
						from alumno_taller as alu, taller as fg
								where alu.id_taller = fg.id_taller and 
										alu.id_alumno = param_id_alumno and
										curdate()< alu.fecha) as ap
				where 
				t2.id_taller = param_id_taller and
				t2.dia = ap.ap_dia and
				(( t2.hora_inicio < ap.ap_hora_fin and t2.hora_inicio > ap.ap_hora_inicio) or 
						(t2.hora_fin > ap.ap_hora_inicio and t2.hora_fin < ap.ap_hora_fin) or 
						(t2.hora_inicio < ap.ap_hora_inicio and t2.hora_fin > ap.ap_hora_fin)))) then
                        
        if ((select aforamiento from taller where id_taller = param_id_taller)>=(select count(*) from alumno_taller as alu_t, taller as bz where id_taller = param_id_taller and  bz.id_taller = alu_t.id_taller and bz.fecha > curdate())) then
			Insert into alumno_taller (`id_taller`,`id_alumno`,`fecha`) VALUE (param_id_taller,param_id_alumno,
			(SELECT curdate() + INTERVAL((select dia from taller where id_taller = param_id_taller) -1) +
			(if ( (select dia from taller where id_taller = param_id_taller)-1 < weekday(curdate()), 7, 0)) - weekday(curdate()) DAY));
			return 'ok';
        else
			return 'No hay plazas';
        end if;
	else
		return 'Se solapa';
	end if;
else
RETURN 'Limite por categoria alcanzado.';
end if;
END;
$$
DELIMITER ;

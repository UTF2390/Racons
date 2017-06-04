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
  CONSTRAINT `alumno_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON UPDATE CASCADE
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
  CONSTRAINT `alumno_categoria_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `alumno_categoria_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `alumno_taller` (
  `id_alumno` int(11) NOT NULL,
  `id_taller` int(11) NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`id_taller`, `id_alumno`, `fecha`),
  CONSTRAINT `alumno_taller_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `alumno_taller_ibfk_2` FOREIGN KEY (`id_taller`) REFERENCES `taller` (`id_taller`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `curso_taller` (
  `id_curso` int(11) NOT NULL,
  `id_taller` int(11) NOT NULL,
 PRIMARY KEY (`id_curso`, `id_taller`),
 CONSTRAINT `curso_taller_ibfk_1` FOREIGN KEY (`id_taller`) REFERENCES `taller` (`id_taller`) ,
  CONSTRAINT `curso_taller_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE
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


USE `racons`;
DROP function IF EXISTS `esta_apuntado`;

DELIMITER $$
USE `racons`$$
CREATE FUNCTION `esta_apuntado` (param_id_taller int, param_id_alumno int)
RETURNS INTEGER
BEGIN
if (0 < (select count(*) 
		from alumno_taller 
		where id_taller = param_id_alumno 
        and id_alumno = param_id_alumno 
        and fecha > curdate()) ) then
	return 1;
else
	return 0;
end if;

END$$

DELIMITER ;

USE `racons`;
DROP function IF EXISTS `limite_alumno`;

DELIMITER $$
USE `racons`$$
CREATE FUNCTION `limite_alumno` (param_id_taller int, param_id_alumno int)
RETURNS INTEGER
BEGIN
SET @id_categoria=(select id_categoria 
					from taller as pgx 
					where pgx.id_taller = param_id_taller);

SET @limite_categoria=(select c.limite from taller as t, categoria as c 
						where  t.id_categoria = c.id_categoria and 
								t.id_taller = param_id_taller);
SET @limite_alumno_count = (select count(*) 
						from alumno_categoria 
                        where id_categoria = @id_categoria 
							and id_alumno = param_id_alumno);
SET @limite_alumno = (select limite 
						from alumno_categoria 
						where id_categoria = @id_categoria 
						and id_alumno = param_id_alumno);
                        
if( @limite_alumno_count > 0) then 
	RETURN @limite_alumno;
ELSE
	RETURN @limite_categoria;
END IF;
END$$

DELIMITER ;

USE `racons`;
DROP function IF EXISTS `numero_talleres_categoria`;

DELIMITER $$
USE `racons`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `numero_talleres_categoria`(param_id_categoria int, param_id_alumno int) RETURNS int(11)
BEGIN
set @numero = (select count(*) 
from alumno_taller as a, taller as t 
	where t.id_taller = a.id_taller 
		and t.id_categoria = param_id_categoria 
        and a.id_alumno = param_id_alumno
		and (DATE_ADD(curdate(), INTERVAL - 30 DAY)) < a.fecha);
RETURN @numero;
END$$

DELIMITER ;




USE `racons`;
DROP function IF EXISTS `limite_categoria_excedido`;

DELIMITER $$
USE `racons`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `limite_categoria_excedido`(param_id_taller int, param_id_alumno int) RETURNS int(11)
BEGIN
SET @id_categoria=(select id_categoria 
					from taller as g 
					where g.id_taller = param_id_taller);
                    
if(numero_talleres_categoria(@id_categoria, param_id_alumno)>=
				limite_alumno(param_id_taller ,param_id_alumno)) then
	RETURN 1;
else
	RETURN 0;

END IF;
END$$

DELIMITER ;

USE `racons`;
DROP function IF EXISTS `numero_alumno_solapa`;

DELIMITER $$
USE `racons`$$
CREATE FUNCTION `numero_alumno_solapa` (param_id_taller int, param_id_alumno int)
RETURNS INTEGER
BEGIN
set @hora_inicio = (select hora_inicio from taller where id_taller = param_id_taller);
set @hora_fin =(select hora_fin from taller where id_taller = param_id_taller);
set @dia =(select dia from taller where id_taller = param_id_taller);
set @numero_solapa = (select count(*) from taller as t, alumno_taller as al
			where
            al.id_taller = t.id_taller and
			t.dia = @dia and
            t.id_taller != param_id_taller and
            al.fecha > curdate() and
            al.id_alumno = param_id_alumno and
			(( t.hora_inicio < @hora_fin and t.hora_inicio > @hora_inicio) or 
			(t.hora_fin > @hora_inicio and t.hora_fin < @hora_fin) or 
			(t.hora_inicio <= @hora_inicio and t.hora_fin >= @hora_fin)));

RETURN @numero_solapa;
END$$

DELIMITER ;

USE `racons`;
DROP function IF EXISTS `alumno_solapa`;

DELIMITER $$
USE `racons`$$
CREATE FUNCTION `alumno_solapa` (param_id_taller int, param_id_alumno int)
RETURNS INTEGER
BEGIN

if (0 < numero_alumno_solapa(param_id_taller, param_id_alumno)) then
	return 1;
else
	return 0;
end if;
RETURN 1;
END$$

DELIMITER ;


USE `racons`;
DROP function IF EXISTS `fecha`;

DELIMITER $$
USE `racons`$$
CREATE FUNCTION `fecha` (param_id_taller int)
RETURNS DATE
BEGIN
set @dia_taller = (select dia 
							from taller as jrp 
                            where jrp.id_taller = param_id_taller) -1;
set @proxima_semana = if ( (select dia 
							from taller as t 
							where t.id_taller = param_id_taller) -1 < weekday(curdate()), 7, 0);
set @fecha = (SELECT curdate() + INTERVAL( @dia_taller +
			(@proxima_semana) - weekday(curdate())) DAY);
RETURN @fecha;
END$$

DELIMITER ;

USE `racons`;
DROP function IF EXISTS `hay_plazas`;

DELIMITER $$
USE `racons`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `hay_plazas`(param_id_taller int) RETURNS int(11)
BEGIN
if(select aforamiento 
				from taller t 
                where t.id_taller = param_id_taller)>(select count(*) 
															from alumno_taller as a
															where a.id_taller = param_id_taller 
																and a.fecha > curdate()) then
	RETURN 1;
else
	RETURN 0;
end if;
END$$

DELIMITER ;



USE `racons`;
DROP function IF EXISTS `apuntar`;

DELIMITER $$
USE `racons`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `apuntar`(param_id_taller int, param_id_alumno int) RETURNS text CHARSET utf8
BEGIN 
set @fecha_taller = fecha(param_id_taller);
if (limite_categoria_excedido(param_id_taller, param_id_alumno) = 0)
					  then
	if (alumno_solapa(param_id_taller, param_id_alumno) = 0) then
                        
        if (hay_plazas(param_id_taller)) then
            if ((select count(*) 
				from alumno_taller as at 
				where at.id_taller = param_id_taller 
					and at.id_alumno = param_id_alumno 
					and at.fecha > curdate() )=0) then 
				if ((select activo from taller where id_taller = param_id_taller) = 1) then	
					Insert into alumno_taller (`id_taller`,`id_alumno`,`fecha`) 
									VALUE (param_id_taller,param_id_alumno,@fecha_taller);
					return 'ok';
                else
					return 'Hola hacker. El taller no esta activado.';
				end if;
			else
				return 'Ya estas apuntado al taller.';
			end if;
        else
			return 'No hay plazas.';
        end if;
	else
		return 'No puedes apuntarte a dos talleres a la misma hora y dia.';
	end if;
else
RETURN 'Limite por categoria alcanzado.';
end if;
END$$

DELIMITER ;




USE `racons`;
DROP function IF EXISTS `habilitar_taller`;

DELIMITER $$
USE `racons`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `habilitar_taller`(param_id_taller int, param_id_profesor int) RETURNS int(11)
BEGIN
set @hora_inicio = (select hora_inicio from taller where id_taller = param_id_taller);
set @hora_fin =(select hora_fin from taller where id_taller = param_id_taller);
set @dia =(select dia from taller where id_taller = param_id_taller);

set @solapa_taller = (	SELECT COUNT(*) 
						FROM taller as t
						where t.dia = @dia  
                        and t.activo = 1 
                        and t.id_profesor = param_id_profesor
                        and (( t.hora_inicio < @hora_fin and t.hora_inicio > @hora_inicio) or 
						(t.hora_fin > @hora_inicio and t.hora_fin < @hora_fin) or 
						(t.hora_inicio <= @hora_inicio and t.hora_fin >= @hora_fin)));

if (@solapa_taller = 0) then
	UPDATE taller as t 
	SET activo = 1
    where t.id_taller = param_id_taller;
	return 1;
else
	return 0;
end if;

            
END$$

DELIMITER ;









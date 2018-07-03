DELIMITER $$

DROP PROCEDURE IF EXISTS `votoelectronico`.`sp_getEleccionporNom` $$
CREATE PROCEDURE votoelectronico.`sp_getEleccionporNom`(IN `pNom` char (80))
BEGIN
      select * from Eleccion where nombre like pNom ;
END $$

DELIMITER ;
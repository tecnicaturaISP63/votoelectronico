DELIMITER $$

DROP PROCEDURE IF EXISTS `votoelectronico`.`sp_deleteEleccion` $$
CREATE PROCEDURE `votoelectronico`.`sp_deleteEleccion` (IN `pId` INT )
BEGIN
             DELETE FROM eleccion where idLocalidad = pId;
END $$

DELIMITER ;
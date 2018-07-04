DELIMITER $$

DROP PROCEDURE IF EXISTS `votoelectronico`.`sp_getEleccionporId` $$
CREATE PROCEDURE votoelectronico.`sp_getEleccionporId`(IN `pId` INT )
BEGIN
      select * from Eleccion where idEleccion = pId ;
END $$

DELIMITER ;
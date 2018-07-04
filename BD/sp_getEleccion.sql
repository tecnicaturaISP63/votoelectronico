DELIMITER $$

DROP PROCEDURE IF EXISTS `votoelectronico`.`sp_getEleccion` $$
CREATE PROCEDURE votoelectronico.`sp_getEleccion`()
BEGIN
  select * from Eleccion order by 2;
END $$

DELIMITER ;
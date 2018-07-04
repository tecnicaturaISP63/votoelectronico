DELIMITER $$

DROP PROCEDURE IF EXISTS `votoelectronico`.`sp_updateEleccion` $$
CREATE PROCEDURE `votoelectronico`.`sp_updateEleccion` (IN `pId` INT , IN `pNombre` CHAR(80),IN `pFecha` CHAR(15))
BEGIN
         DECLARE vOK  char (2);
         set vOK="Si";

         IF TRIM(pNombre)=""  THEN
            set vOK="No";
         END IF;

         IF TRIM(pFecha)=""  THEN
            set vOK="No";
         END IF;
         If vOK="Si" then
             update eleccion set nombre=pNombre, fecha=pFecha where idEleccion = pId;

         end if;
END $$

DELIMITER ;
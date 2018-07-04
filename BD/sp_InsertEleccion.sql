DELIMITER $$

DROP PROCEDURE IF EXISTS votoelectronico.`sp_InsertEleccion` $$
CREATE PROCEDURE votoelectronico.`sp_InsertEleccion` (IN `pNombre` CHAR(50),IN `pFecha` CHAR(20))
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
         insert into eleccion( nombre, fecha)values(TRIM(pNombre), pFecha);
         end if;
END $$

DELIMITER ;
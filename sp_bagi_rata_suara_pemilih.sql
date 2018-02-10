USE pemilu;

DROP PROCEDURE IF EXISTs sp_bagi_rata_suara_pemilih;

DELIMITER $$
CREATE PROCEDURE `sp_bagi_rata_suara_pemilih`(param_jumlah INT)
BEGIN
	DECLARE v_kandidat_finished INTEGER DEFAULT 0;
	DECLARE v_no_kandidat TINYINT;

    -- declare cursor for kandidat
	DECLARE kandidat_cursor CURSOR FOR 
	SELECT no_kandidat FROM kandidat;


 
 -- declare NOT FOUND handler
	DECLARE CONTINUE HANDLER 
        FOR NOT FOUND SET v_kandidat_finished = 1;

DROP TABLE IF EXISTS temp_pemilih;
CREATE TEMPORARY TABLE temp_pemilih (no_induk CHAR(8));

DROP TABLE IF EXISTS suara_pemilih_backup;

CREATE TABLE suara_pemilih_backup AS
SELECT * FROM suara_pemilih;

OPEN kandidat_cursor;
 
 get_kandidat: LOOP
 
	FETCH kandidat_cursor INTO v_no_kandidat;
 
	 IF v_kandidat_finished = 1 THEN 
		CLOSE kandidat_cursor;
		LEAVE get_kandidat;
	 END IF;
     
     TRUNCATE TABLE temp_pemilih;
    
    INSERT INTO temp_pemilih 
    SELECT no_induk FROM pemilih WHERE status = 0 LIMIT 0,param_jumlah;
    
    INSERT INTO suara_pemilih
    SELECT no_induk,v_no_kandidat FROM temp_pemilih ;
    
    UPDATE pemilih SET status = 1 WHERE no_induk IN 
    (
    SELECT no_induk FROM temp_pemilih
    );
    
 END LOOP get_kandidat;
 
END$$
DELIMITER ;

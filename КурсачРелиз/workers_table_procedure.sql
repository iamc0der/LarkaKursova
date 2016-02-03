CREATE TABLE workers (
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
fio VARCHAR(45),
registred_at DATETIME,
packages_count INT,
department_id INTEGER NOT NULL,
FOREIGN KEY (department_id) REFERENCES departments(id) 
ON UPDATE CASCADE ON DELETE CASCADE);

DELIMITER //
CREATE PROCEDURE worker_registration(IN n_fio varchar(150),
IN n_department INT, n_login VARCHAR(80), IN n_password VARCHAR(60))
BEGIN  
DECLARE nworker_id INT;
    DECLARE exit handler for sqlexception
  BEGIN
    -- ERROR
  ROLLBACK;
END;

DECLARE exit handler for sqlwarning
 BEGIN
    -- WARNING
 ROLLBACK;
END;
START TRANSACTION;
SET nworker_id = (SELECT id from workers order by id desc limit 1) + 1;
IF nworker_id IS NULL THEN SET nworker_id = 1;
END IF;
INSERT INTO workers(fio,department_id,registred_at) 
VALUE(n_fio, n_department, current_date());
INSERT INTO users(login, password,worker_id)
VALUE(n_login, n_password, nworker_id);
COMMIT;
END// 

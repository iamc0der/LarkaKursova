CREATE TABLE packages (
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
ttn VARCHAR(45) NOT NULL,
registred_at DATETIME,
given_at DATETIME,
orient_date DATETIME,
weight FLOAT NOT NULL,
shipping_cost FLOAT,
package_status ENUM("REGISTRED","RECEIVED","GIVEN"),
payer ENUM("SENDER","RECEIVER") DEFAULT "SENDER",
sender_id INTEGER NOT NULL,
receiver_id INTEGER NOT NULL,
sender_department_id INTEGER NOT NULL,
receiver_department_id INTEGER NOT NULL,
package_type_id INTEGER NOT NULL DEFAULT 1,
packing_type_id INTEGER NOT NULL DEFAULT 1,
inspector_id INTEGER NOT NULL,

FOREIGN KEY(sender_id) REFERENCES clients(id)
 ON DELETE CASCADE ON UPDATE CASCADE, 
FOREIGN KEY(receiver_id) REFERENCES clients(id)
 ON DELETE CASCADE ON UPDATE CASCADE, 
FOREIGN KEY(sender_department_id) REFERENCES departments(id)
 ON DELETE CASCADE ON UPDATE CASCADE, 
FOREIGN KEY(receiver_department_id) REFERENCES departments(id)
 ON DELETE CASCADE ON UPDATE CASCADE, 
FOREIGN KEY(packing_type_id) REFERENCES packing_type(id)
 ON DELETE CASCADE ON UPDATE CASCADE, 
FOREIGN KEY(package_type_id) REFERENCES package_type(id)
 ON DELETE CASCADE ON UPDATE CASCADE, 
FOREIGN KEY(inspector_id) REFERENCES workers(id)
 ON DELETE CASCADE ON UPDATE CASCADE);

##################### TTN GENERATOR #################
DELIMITER //  
  CREATE FUNCTION generate_TTN(pkg_id INTEGER, send_dep INTEGER, rec_dep INTEGER)
  RETURNS VARCHAR(45)
  LANGUAGE SQL
  BEGIN
  DECLARE package_ttn VARCHAR(45);
  DECLARE sd_city CHAR(2);
  DECLARE rd_city CHAR(2);

SET sd_city =  UPPER(LEFT((SELECT distance.region_name from distance 
where distance.id = (SELECT departments.city_id FROM departments
 WHERE departments.id = send_dep)),2));

SET rd_city =  UPPER(LEFT((SELECT distance.region_name from distance 
where distance.id = (SELECT departments.city_id FROM departments 
WHERE departments.id = rec_dep)),2));

SET package_ttn = CONCAT(sd_city, send_dep, pkg_id, rec_dep, rd_city);
  RETURN package_ttn;      
END//

#################### PACKAGE REGISTRATOR ################

DELIMITER //
CREATE PROCEDURE `regis_package` 
(IN sender_phone INTEGER(9),IN sender_name VARCHAR(45),
 IN receiver_phone INTEGER(9), IN receiver_name VARCHAR(45),
 IN sender_dept INTEGER, IN receiver_dept INTEGER,
 IN package_weight FLOAT, IN pking_type_id INTEGER,
 IN pkg_type_id INTEGER, IN worker_id INTEGER, IN payer_code INTEGER(1))  

BEGIN  
DECLARE total_cost FLOAT;
DECLARE packing_cost FLOAT;
DECLARE extra_cost FLOAT;
DECLARE depts_distance INTEGER;
DECLARE transporting_cost FLOAT;
DECLARE client_sender INTEGER;
DECLARE client_receiver INTEGER;
DECLARE prognos_date DATETIME;
DECLARE prognos_day INT;

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

SET depts_distance = get_distance((SELECT departments.city_id FROM departments
WHERE departments.id = sender_dept),(SELECT departments.city_id FROM departments
WHERE departments.id = receiver_dept));

SET prognos_day = ROUND(depts_distance / (SELECT constants.value FROM constants WHERE name = 'KILOMETRS_PER_DAY' limit 1));

IF (prognos_day = 0) 
THEN
SET prognos_date = DATE_ADD(current_date(),INTERVAL 1 DAY);
ELSE
SET prognos_date = DATE_ADD(current_date(),INTERVAL prognos_day DAY);
END IF;
SET packing_cost = (SELECT packing_type.cost FROM packing_type
               WHERE packing_type.id = pking_type_id);

SET extra_cost = (SELECT package_type.extra_price FROM package_type
               WHERE package_type.id = pkg_type_id);

SET transporting_cost = (SELECT constants.const_value 
FROM constants WHERE name = "MONEY_PER_10_KM" limit 1) *(depts_distance / 10);

SET total_cost = transporting_cost + extra_cost + packing_cost;

SET client_sender = (SELECT clients.id FROM clients WHERE clients.phone = sender_phone);

IF(client_sender IS NULL) THEN
INSERT INTO clients(name, phone)VALUE(sender_name, sender_phone);
SET client_sender = (SELECT clients.id FROM clients WHERE clients.phone = sender_phone);
END IF;

SET client_receiver = (SELECT clients.id FROM clients 
                        WHERE clients.phone = receiver_phone);

IF(client_receiver IS NULL) THEN
INSERT INTO clients(name, phone)VALUE(receiver_name, receiver_phone);
SET client_receiver = (SELECT clients.id FROM clients 
                          WHERE clients.phone = receiver_phone);
END IF;

INSERT INTO packages(orient_date,weight, shipping_cost, payer, sender_id, receiver_id,
sender_department_id, receiver_department_id, package_type_id, 
packing_type_id, inspector_id)
VALUE(prognos_date,package_weight, total_cost, payer_code, client_sender, client_receiver,
       sender_dept,receiver_dept,pkg_type_id, pking_type_id, worker_id);

COMMIT;
END// 

####################### PACKAGES BEFORE INSRT TRIGGER #####################


DELIMITER // 
CREATE TRIGGER before_insert_packages
BEFORE INSERT ON packages
FOR EACH ROW
BEGIN
DECLARE msg VARCHAR(255);
DECLARE dep_wlimit FLOAT;
DECLARE worker_dept_id INTEGER;
DECLARE package_id INT;

SET worker_dept_id = (SELECT workers.department_id 
FROM workers WHERE workers.id = NEW.inspector_id);

SET dep_wlimit = (SELECT departments.weight_limit FROM departments 
WHERE departments.id = NEW.receiver_department_id);

SET package_id = (SELECT id from packages GROUP BY id DESC LIMIT 1) + 1;
IF package_id IS NULL then
SET package_id = 1;
END IF;
 SET NEW.ttn = generate_TTN(package_id, NEW.sender_department_id,
NEW.receiver_department_id);

SET NEW.registred_at = NOW();
SET NEW.package_status = "REGISTRED";

IF ((NEW.weight > dep_wlimit) OR (NEW.weight < 0)) THEN
 SET msg = "Not correct weight!";
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;

ELSEIF (NEW.sender_department_id != worker_dept_id) THEN
 SET msg = "You are not from this department!";
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
END IF;
UPDATE workers SET packages_count = packages_count + 1 WHERE id = NEW.inspector_id;
END//

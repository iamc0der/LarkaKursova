CREATE TABLE package_type (
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(40),
extra_price FLOAT);

CREATE TABLE packing_type (
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(40),
cost FLOAT);

DELIMITER // 
CREATE TRIGGER before_insert_pckg_type 
BEFORE INSERT ON package_type 
FOR EACH ROW
BEGIN
DECLARE msg VARCHAR(255);
IF NEW.extra_price < 0 THEN
 SET msg = "Price can't be negative!!";
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
END IF;
END//

DELIMITER // 
CREATE TRIGGER before_insert_pcking_type 
BEFORE INSERT ON packing_type 
FOR EACH ROW
BEGIN
DECLARE msg VARCHAR(255);
IF NEW.cost < 0 THEN
 SET msg = "Cost can't be negative!!";
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
END IF;
END//
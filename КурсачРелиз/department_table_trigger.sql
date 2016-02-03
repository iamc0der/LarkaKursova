CREATE TABLE departments (
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(100) NOT NULL,
weight_limit FLOAT,
city_id INTEGER NOT NULL,
adress VARCHAR(145),
phone varchar(10),
FOREIGN KEY (city_id) REFERENCES distance(id));

DELIMITER // 
CREATE TRIGGER before_insert_department 
BEFORE INSERT ON departments 
FOR EACH ROW
BEGIN
DECLARE msg VARCHAR(255);
IF (NEW.phone REGEXP '^(\\+?[0-9]{1,4}-)?[0-9]{3,10}$' = 0) THEN
 SET msg = "Incorrect phone number format!!";
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
END IF;
END//
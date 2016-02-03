CREATE TABLE expired_packages(
package_id integer not null primary key,
expired_since date);

DELIMITER // 
CREATE TRIGGER trigg_auto_date_expired
BEFORE INSERT ON expired_packages
FOR EACH ROW
BEGIN
SET NEW.expired_since = curdate();
END//

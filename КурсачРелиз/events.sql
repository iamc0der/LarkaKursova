
SET GLOBAL event_scheduler = ON;

CREATE EVENT expire_packages_checker
    ON SCHEDULE
      EVERY 1 DAY
    STARTS '2015-12-31 00:00:00'
    DO
   INSERT INTO expired_packages(package_id)
(select packages.id from packages
left join expired_packages
on packages.id = expired_packages.fackage_id
 where  expired_packages.package_id IS NULL 
AND
TIMESTAMPDIFF(DAY,packages.registred_at, curdate()) > 
(SELECT const_value from constants WHERE name = 'EXPIRED_AFTER_DAYS')
 AND packages.givent_at IS NULL);

CREATE EVENT clear_old_packages
    ON SCHEDULE
      EVERY 1 DAY
    STARTS '2015-12-31 00:00:00'
    DO
  DELETE FROM packages WHERE
TIMESTAMPDIFF(DAY,packages.registred_at, curdate()) > 
(SELECT const_value from constants WHERE name = 'DELETE_AFTER_DAYS')
 AND (packages.givent_at IS NOT NULL);

CREATE EVENT mark_packages_as_received
    ON SCHEDULE
      EVERY 1 DAY
    STARTS '2015-12-31 00:00:00'
    DO
  UPDATE packages SET package_status = 2 
WHERE orient_date < curdate() and package_status = 1;

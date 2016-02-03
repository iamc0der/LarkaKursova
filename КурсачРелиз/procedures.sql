DELIMITER //  
CREATE PROCEDURE `department_send_receiv_statistic` (IN dept_id INTEGER)  
BEGIN  
    SELECT  (
    SELECT COUNT(*)
    FROM   packages where sender_department_id = dept_id
    ) AS sended,
    (
    SELECT COUNT(*)
    FROM   packages where receiver_department_id = dept_id
    ) AS received;
END//  

DELIMITER //  
CREATE PROCEDURE `department_money_per_month_statistic` (IN dept_id INTEGER)  
BEGIN  
   select sum(packages.shipping_cost), elt(month(registred_at),'January','February',
'March','April','May','June','July','August','September','October',
'November','December') as MonthName
from packages where sender_department_id = dept_id group by month(registred_at);
END//  

 DELIMITER //
CREATE PROCEDURE best_5_clients(IN dept_id INTEGER)
BEGIN
select clients.name, clients.phone, count(packages.id) as Sended
from packages
inner join clients on clients.id = packages.sender_id
where packages.sender_department_id = dept_id
group by  packages.sender_id
having Sended > (SELECT const_value from constants WHERE name = 'BEST_CLIENT_AFTER' LIMIT 1) 
order by Sended desc limit 5;
END//


DELIMITER //
CREATE PROCEDURE top_10_workers()
BEGIN
select count(packages.id) as packages, workers.fio as name
from packages
inner join workers on workers.id = inspector_id
group by (inspector_id)
order by (packages) desc limit 10;
END//

DELIMITER //
CREATE PROCEDURE sended_received_stats(IN dept_id INTEGER)
BEGIN
SELECT 
(SELECT COUNT(packages.id) FROM packages WHERE sender_department_id = dept_id) 
AS SENDED,
(SELECT COUNT(packages.id) FROM packages WHERE receiver_department_id = dept_id) 
AS RECEIVED;
END//

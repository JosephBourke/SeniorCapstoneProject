CREATE VIEW `requests` AS
select id, requestdate, request_permission_id, isapproved
from request
order by id;

select * from `requests`;
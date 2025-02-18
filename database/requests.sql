CREATE VIEW `requests` AS
select id, create_time, description, accepted, user_id, equipment_id
from request
order by id;

select * from `requests`;
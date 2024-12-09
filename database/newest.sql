CREATE VIEW `newest` AS
select lastreturned, lastcheckedout
from equipment
order by coalesce(lastreturned, lastcheckedout) desc;

select * from `newest`;
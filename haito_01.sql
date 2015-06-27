select
    team_id,
    power
from 
    (
    -- �e�`�[���̐퓬�͂��Z�o
    select
        team_id,sum(sum_val) as power
    from tbl_member
    group by team_id
    ) team
order by
 power desc
limit 3
;

select
    team_id,
    amt
from 
    (
    -- �e�`�[���̓q�������Z�o
    select
        team_id,sum(amt)
    from tbl_bet
    group by team_id
    ) team
order by
 amt desc
limit 3
;

select
    team_id,
    amt
from 
    (
    -- 各チームの賭け金を算出
    select
        team_id,sum(amt)
    from tbl_bet
    group by team_id
    ) team
order by
 amt desc
limit 3
;

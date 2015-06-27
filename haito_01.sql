select
    team_id,
    power
from 
    (
    -- 各チームの戦闘力を算出
    select
        team_id,sum(sum_val) as power
    from tbl_member
    group by team_id
    ) team
order by
 power desc
limit 3
;

-- 予想オッズと払い戻し金額予想
select
    team_id,
 if 1行目（1位）なら then
    truncate(power * 0.6,0)
 else if 2行目(2位)なら then
    truncate(power * 0.3,0)
 else if 3行目(3位)なら then
    truncate(power * 0.1,0)
 else -- それ以外（ないけど）
    power * 0
 end if
from 
    (
    -- 各チームの戦闘力を算出
    select
        team_id,sum(sum_val) as power
    from tbl_member a
    group by team_id
    order by
     power
    limit 3
    ) team
;

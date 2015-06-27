select
    team_id
   ,sum(amt)
from tbl_bet
where
    login_id = $1
and team_id  = $2
group by
 team_id
;
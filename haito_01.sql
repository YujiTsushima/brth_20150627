-- �\�z�I�b�Y�ƕ����߂����z�\�z
select
    team_id,
 if 1�s�ځi1�ʁj�Ȃ� then
    truncate(power * 0.6,0)
 else if 2�s��(2��)�Ȃ� then
    truncate(power * 0.3,0)
 else if 3�s��(3��)�Ȃ� then
    truncate(power * 0.1,0)
 else -- ����ȊO�i�Ȃ����ǁj
    power * 0
 end if
from 
    (
    -- �e�`�[���̐퓬�͂��Z�o
    select
        team_id,sum(sum_val) as power
    from tbl_member a
    group by team_id
    order by
     power
    limit 3
    ) team
;

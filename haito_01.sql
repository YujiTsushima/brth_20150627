-- �\�z�I�b�Y�ƕ����߂����z�\�z
select
    team_id,
 if 1�s�ځi1�ʁj�Ȃ� then
    truncate(power * 0.6,0)
 else 2�s��(2��)�Ȃ� then
    truncate(power * 0.3)
 else 3�s��(3��)�Ȃ� then
    truncate(power * 0.1)
 else -- ����ȊO�i�Ȃ����ǁj
    power * 0
from 
    (
    -- �e�`�[���̐퓬�͂��Z�o
    select
        team_id,sum(sum_val) as power
    from member_tbl a
    group by team_id
    order by
     power
    limit 3
    ) team
;

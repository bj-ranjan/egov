update hc_casetransaction set Submit_date='2013-8-18',Signed_by='ADC(Revenue)',Nextdue_date='2013-12-21',Present_status ='Running',T4=T4  where Case_id='2' and Rsl='1';
insert into hc_casetransaction(Case_id,Rsl,Submit_date,Signed_by,Nextdue_date,Present_status ) values ('2','2','2013-8-18','ADc(revenue)','2013-12-21','Running');
insert into hc_casetransaction(Case_id,Rsl,Submit_date,Signed_by,Nextdue_date) values ('3','2','2013-3-1','rrr','2013-12-21');
insert into hc_casetransaction(Case_id,Rsl,Submit_date,Signed_by,Nextdue_date,Entry_date,Present_status ) values ('2','3','2013-8-19','adc','0-0-0','2013-08-19','DD');
insert into hc_casetransaction(Case_id,Rsl,Submit_date,Signed_by,Nextdue_date,Entry_date,Present_status ) values ('3','3','2014-8-15','EAC','2013-9-12','2013-08-19','Explanaron call');
insert into hc_casetransaction(Case_id,Rsl,Submit_date,Signed_by,Nextdue_date,Entry_date,Present_status ) values ('1','2','2013-8-17','eee','2013-11-18','2013-08-19','eeee');
insert into hc_casetransaction(Case_id,Rsl,Submit_date,Signed_by,Nextdue_date,Entry_date,Present_status ) values ('1','3','2013-8-18','DC And ADC','2013-8-20','2013-08-19','ADC to be Present in Next date');

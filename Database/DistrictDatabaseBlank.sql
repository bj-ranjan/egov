-- Database Name EGOV


-- 
-- Structure for Table [ADJUST]
-- 

CREATE TABLE IF NOT EXISTS adjust(
yr varchar(4)  NOT NULL ,
mn int  NOT NULL ,
Bank varchar(50)  NOT NULL ,
opcase int,
amt int,
PRIMARY KEY (yr,mn,bank)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [AREAOFWORK]
-- 

CREATE TABLE IF NOT EXISTS areaofwork(
Area_Code int  NOT NULL ,
Area_Name varchar(40)  NOT NULL ,
Branch_Code int  NOT NULL ,
PRIMARY KEY (area_code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [AREAOFWORK]
-- 

Insert Into areaofwork(Area_Code,Area_Name,Branch_Code) values
(1,'New Case Registration',1),
(2,'Collection Updation',1),
(3,'Issue Certificate',1),
(4,'Bank Deposit Updation',1),
(5,'Print Jamabandi',2),
(6,'Entry Dak',3),
(7,'Enter Petition',4),
(8,'Process Certificate(PRC,Caste,etc)',4),
(9,'Issue Certificate',4),
(10,'Issue Notice',1),
(11,'Update Old Payment',1),
(12,'Process Eroll',4),
(13,'Process Jamabandi',4),
(14,'Process Legal Heir',4),
(15,'Case Particular Modification',1),
(16,'Interest Updation',1),
(17,'High Court Case',6),
(18,'Update Bakijai',4),
(19,'Edit Petition',4),
(20,'Print Duplicate Cert',4),
(21,'Deposit PFC Collection',4),
(22,'Edit Processed Petition',4),
(23,'Batch Reject',4);


-- 
-- Structure for Table [BAKIJAI_CASEDATE]
-- 

CREATE TABLE IF NOT EXISTS bakijai_casedate(
Case_Id bigint  NOT NULL ,
Day int  NOT NULL ,
Next_Date datetime,
Appeared varchar(1)  DEFAULT 'N'   NOT NULL ,
Appeared_Date datetime,
Action_Taken varchar(1)  DEFAULT 'N' ,
Note_of_Action varchar(255),
Entry_date datetime  NOT NULL ,
Notice_Type int,
PRIMARY KEY (case_id,day)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [BAKIJAI_INTEREST]
-- 

CREATE TABLE IF NOT EXISTS bakijai_interest(
Case_ID bigint  DEFAULT '0'   NOT NULL ,
Interest_Payable int  NOT NULL ,
Pay_Date datetime,
Entry_Date datetime,
User_Code varchar(20),
Receipt_no varchar(50),
PRIMARY KEY (case_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [BAKIJAI_MAIN]
-- 

CREATE TABLE IF NOT EXISTS bakijai_main(
Case_Id bigint  NOT NULL ,
Fin_yr varchar(50),
Case_no varchar(50)  NOT NULL ,
Start_Date datetime  NOT NULL ,
Bank varchar(50)  NOT NULL ,
Branch varchar(50)  NOT NULL ,
Full_name varchar(50)  NOT NULL ,
Full_Name_Ass varchar(100)  CHARACTER SET utf8 COLLATE utf8_unicode_ci ,
Father varchar(50)  NOT NULL ,
Father_Ass varchar(100)  CHARACTER SET utf8 COLLATE utf8_unicode_ci ,
District varchar(50)  DEFAULT 'Nalbari'   NOT NULL ,
Polst_Code int  NOT NULL ,
Circle int  NOT NULL ,
Mouza int  NOT NULL ,
Vill_Code int  NOT NULL ,
Village varchar(50),
Amount decimal(12,2)  NOT NULL ,
Balance decimal(19,0),
No_of_Notice_served int  DEFAULT '0' ,
Disposed varchar(1)  DEFAULT 'N' ,
Disposed_Date datetime,
Payment_mode varchar(50)  DEFAULT 'Cash' ,
Certificate_officer varchar(50),
User_Code varchar(50),
Court_case varchar(1)  DEFAULT 'N' ,
Req_letter_no varchar(50),
Req_letter_Date datetime,
Entry_Date datetime,
Remarks varchar(50),
PRIMARY KEY (case_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [BAKI_PAYMENT]
-- 

CREATE TABLE IF NOT EXISTS baki_payment(
Case_id bigint  NOT NULL ,
Pay_Date datetime,
Instalment_no int  NOT NULL ,
Paid_today decimal(10,0)  DEFAULT '0' ,
Payment_mode varchar(50)  DEFAULT 'NA' ,
Receipt_no varchar(100),
RSL bigint,
Nextdate datetime,
Entry_Date datetime,
FYear varchar(9),
PRIMARY KEY (case_id,instalment_no)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [BANKBRANCH]
-- 

CREATE TABLE IF NOT EXISTS bankbranch(
RSL int,
Bank varchar(50)  NOT NULL ,
Branch varchar(50)  NOT NULL ,
PRIMARY KEY (bank,branch)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [BANK_DEPOSIT]
-- 

CREATE TABLE IF NOT EXISTS bank_deposit(
Case_id bigint  NOT NULL ,
Installment int  NOT NULL ,
Deposit_date datetime  NOT NULL ,
Collection_book_no varchar(10),
Collection_rcpt_no varchar(10),
Bank_rcpt_no varchar(10),
Amount decimal(10,2)  NOT NULL ,
RSL bigint  NOT NULL ,
PRIMARY KEY (case_id,installment)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [BANK_MASTER]
-- 

CREATE TABLE IF NOT EXISTS bank_master(
Bank_Name varchar(50)  NOT NULL ,
BType varchar(25)  DEFAULT 'Financial' ,
PRIMARY KEY (bank_name)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [BRANCH_SECTION]
-- 

CREATE TABLE IF NOT EXISTS branch_section(
Branch_Code int  NOT NULL ,
Branch_Name varchar(40)  NOT NULL ,
PRIMARY KEY (branch_code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [BRANCH_SECTION]
-- 

Insert Into branch_section(Branch_Code,Branch_Name) values
(0,'Outside DC Office'),
(1,'Bakijai'),
(2,'Revenue'),
(3,'Personnel'),
(4,'Administration(PFC)'),
(5,'Magistracy'),
(6,'PA'),
(7,'Land Acquition'),
(8,'TN Branch'),
(9,'Supply'),
(10,'Planning and Dev'),
(11,'Nazarat'),
(12,'Administration'),
(13,'ARTPS'),
(14,'Disaster Management'),
(15,'Election'),
(16,'Land Records'),
(17,'Settlement'),
(18,'Land Reforms'),
(19,'Zila Sainik Welfare Board'),
(20,'Fishery'),
(21,'SDPL'),
(22,'Census'),
(23,'PG Cell'),
(24,'Women Cell'),
(25,'M Administration'),
(26,'CA'),
(27,'Home Guard'),
(28,'Sub Register'),
(29,'Land Settlement'),
(30,'Excise'),
(31,'NRC'),
(32,'Treasury Officer,Nalbari'),
(33,'PD, DRDA,Nalbari'),
(34,'Public Grivance');


-- 
-- Structure for Table [CIRCLE]
-- 

CREATE TABLE IF NOT EXISTS circle(
Cir_code int  NOT NULL ,
Circle varchar(30),
Circle_Ass varchar(50)  CHARACTER SET utf8 COLLATE utf8_unicode_ci ,
Co_name varchar(50),
PRIMARY KEY (cir_code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [CIRCLE]
-- 

Insert Into circle(Cir_code,Circle,Circle_Ass,Co_name) values
(0,'-','.',NULL),
(1,'Nalbari','নলবাৰী',NULL),
(2,'Paschim Nalbari','পশ্চিম নলবাৰী',NULL),
(3,'Barkhetri','বৰক্ষেত্রী',NULL),
(4,'Tihu','টিহু',NULL),
(5,'Ghagrapar','ঘগ্ৰাপাৰ',NULL),
(6,'Banekuchi','বানেকুচি',NULL),
(7,'Barbhag','বৰভাগ',NULL),
(8,'Baganpara','বাগানপাৰা',NULL),
(9,'Barama','বৰমা',NULL),
(10,'Rangia',NULL,NULL);


-- 
-- Structure for Table [COURTCASE]
-- 

CREATE TABLE IF NOT EXISTS courtcase(
Id int  NOT NULL ,
Remarks varchar(50)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [DAK_DISPOSED]
-- 

CREATE TABLE IF NOT EXISTS dak_disposed(
Dak_id int  NOT NULL ,
Recvd_yr int  NOT NULL ,
Target_date date  NOT NULL ,
disposed_date date  NOT NULL ,
gap int  NOT NULL ,
User_id varchar(20),
PRIMARY KEY (dak_id,recvd_yr)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [DAK_ENTRY]
-- 

CREATE TABLE IF NOT EXISTS dak_entry(
dak_id int  NOT NULL ,
recvd_yr int  NOT NULL ,
subject varchar(500),
recvd_from varchar(200),
ltr_no varchar(50),
ltr_dt date,
ltr_format varchar(50),
priority varchar(15),
mark_branch varchar(300),
entry_date date,
reply varchar(3),
target_date date,
Disposed char(1)  DEFAULT 'N'   NOT NULL ,
Branch_code int  DEFAULT '0'   NOT NULL ,
Dispose_date date,
Updation_Date date,
Remarks varchar(30),
PRIMARY KEY (dak_id,recvd_yr)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [FINALREPORT]
-- 

CREATE TABLE IF NOT EXISTS finalreport(
FDate datetime  NOT NULL ,
user varchar(20),
entry_date datetime,
PRIMARY KEY (fdate)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [LAC]
-- 

CREATE TABLE IF NOT EXISTS lac(
CODE int  NOT NULL ,
NAME varchar(30),
TOTPS int,
HPCCODE smallint,
RTAG varchar(1),
PRIMARY KEY (code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [LAC]
-- 

Insert Into lac(CODE,NAME,TOTPS,HPCCODE,RTAG) values
(0,'OUTSIDE',0,0,'a'),
(58,'TAMULPUR',232,5,'K'),
(59,'NALBARI',230,8,'L'),
(60,'BARKHETRI',231,7,'M'),
(61,'DHARMAPUR',184,6,'N'),
(62,'BARAMA(ST)',187,5,'O'),
(63,'CHAPAGURI(ST)',184,5,'P');


-- 
-- Structure for Table [LASTLOGIN]
-- 

CREATE TABLE IF NOT EXISTS lastlogin(
logdate date
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [LEGAL_HEIR]
-- 

CREATE TABLE IF NOT EXISTS legal_heir(
Pet_yr char(4)  NOT NULL ,
Pet_no bigint  NOT NULL ,
Slno int  NOT NULL ,
NOK varchar(60),
Age int  NOT NULL ,
DOB date,
Relation varchar(20),
PRIMARY KEY (pet_yr,pet_no,slno)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [MOBILE]
-- 

CREATE TABLE IF NOT EXISTS mobile(
Mobile_no varchar(10)  NOT NULL ,
Name varchar(100)  NOT NULL ,
PRIMARY KEY (mobile_no),
Unique key  Name (name)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [MONTHNAME]
-- 

CREATE TABLE IF NOT EXISTS monthname(
monthcode int  NOT NULL ,
montheng varchar(20),
no_days int,
PRIMARY KEY (monthcode)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [MONTHNAME]
-- 

Insert Into monthname(monthcode,montheng,no_days) values
(1,'January',31),
(2,'February',28),
(3,'March',31),
(4,'April',30),
(5,'May',31),
(6,'June',30),
(7,'July',31),
(8,'August',31),
(9,'September',30),
(10,'October`',31),
(11,'November',30),
(12,'December',31);


-- 
-- Structure for Table [MOUZA]
-- 

CREATE TABLE IF NOT EXISTS mouza(
Mouza_Code int  NOT NULL ,
Mouza_Name varchar(30),
Mouza_Name_Ass varchar(30)  CHARACTER SET utf8 COLLATE utf8_unicode_ci ,
Cir_Code int,
PRIMARY KEY (mouza_code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [MOUZA]
-- 

Insert Into mouza(Mouza_Code,Mouza_Name,Mouza_Name_Ass,Cir_Code) values
(0,'-','..............................',0),
(1,'KHATA   ','খাটা ',1),
(2,'BATAHGILA ','বতাহগিলা ',1),
(3,'BAHJANI ','বাহজানি ',1),
(4,'DHARMAPUR. ','ধৰ্মপুৰ ',2),
(5,'KHETRI DHARMAPUR ','ক্ষেত্রি ধৰ্মপুৰ ',2),
(6,'PAKOWA ','পকোৱা ',2),
(7,'PUB BARKSHETRI  ','পুব বৰক্ষেত্রি ',3),
(8,'PASHCHIM BARKHETRI    ','পশ্চিম বৰক্ষেত্রি ',3),
(9,'UTTAR BARKHETRI   ','উত্তৰ বৰক্ষেত্রি ',3),
(10,'MADHYAM BARKHETRI   ','মধ্যম বৰক্ষেত্রি ',3),
(11,'NAMATI  ','নমাটি ',4),
(12,'NAMBARBHAG   ','নামবৰভাগ ',4),
(13,'TIHU ','টিহু ',4),
(14,'PUB BANBHAG. ','পুব বনভগ ',5),
(15,'PASHCHIM BANBHAG ','পশ্চিম বনভাগ ',5),
(16,'NATUN DEHAR. ','নতুন দেহৰ ',6),
(17,'UPAR BARBHAG.  ','উপৰ বৰভাগ ',7),
(18,'PUB BANBHAG. ','পুব বনভাগ ',7),
(19,'NAMATI   ','নমাটি ',9),
(20,'NAMBARBHAG  ','নামবৰভাগ ',9),
(21,'Madhyam Baska',NULL,8),
(22,'Dharmapur',NULL,6),
(23,'Madhyam Baksa',NULL,5);


-- 
-- Structure for Table [NOTICETYPE]
-- 

CREATE TABLE IF NOT EXISTS noticetype(
CODE int  DEFAULT '0'   NOT NULL ,
NOTICEDETAIL varchar(30),
PRIMARY KEY (code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [NOTICETYPE]
-- 

Insert Into noticetype(CODE,NOTICEDETAIL) values
(1,'77 Act(First)'),
(2,'77 Act(Second)'),
(3,'Warrant(Bailable)'),
(4,'Warrant(Non Bailable)'),
(5,'Common General Notice'),
(6,'INTEREST NOTICE'),
(7,'Rajah Adalat');


-- 
-- Structure for Table [OFFICER]
-- 

CREATE TABLE IF NOT EXISTS officer(
Slno int  NOT NULL ,
Officer_Name varchar(35),
Designation varchar(20),
Exist bit,
PRIMARY KEY (slno)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [OFFICER_CHAIN]
-- 

CREATE TABLE IF NOT EXISTS officer_chain(
Case_Id bigint  NOT NULL ,
From_Date datetime  NOT NULL ,
To_Date datetime,
Officer_Code int  NOT NULL ,
PRIMARY KEY (case_id,officer_code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [PETITION_CHANGED]
-- 

CREATE TABLE IF NOT EXISTS petition_changed(
Pet_yr char(4)  NOT NULL ,
Pet_type varchar(2)  NOT NULL ,
Pet_no bigint  NOT NULL ,
Applicant varchar(70)  NOT NULL ,
Father varchar(60),
Mother varchar(50),
PRIMARY KEY (pet_yr,pet_no)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [PETITION_MASTER]
-- 

CREATE TABLE IF NOT EXISTS petition_master(
Id bigint  NOT NULL ,
Pet_yr char(4)  NOT NULL ,
Pet_date date  NOT NULL ,
Pet_type varchar(2)  NOT NULL ,
Pet_no bigint  NOT NULL ,
Applicant varchar(70)  NOT NULL ,
Relation varchar(20),
Father varchar(60),
Mother varchar(50),
District varchar(30)  DEFAULT 'Nalbari' ,
Sub_Division varchar(30)  DEFAULT 'Nalbari' ,
Circle_Code int,
PS_Code int,
Mauza_Code int,
vill_code int,
Village varchar(50),
Ward varchar(50),
CO_letter varchar(50),
CO_letter_dt varchar(50),
BPL varchar(1),
Introduced_by varchar(200),
Ast varchar(1)  DEFAULT 'N' ,
Ast_report varchar(200),
Process_date date,
Processed_by varchar(50),
BO varchar(1)  DEFAULT 'N' ,
Status varchar(15)  DEFAULT 'Pending' ,
Issue_date date,
Rejected_Reason varchar(100),
Exp_dt date,
Fees int  DEFAULT '0' ,
Court_fee float  DEFAULT '0' ,
Purpose varchar(50),
Income int,
Sex varchar(1),
Dob date,
Period varchar(10),
Patta_no varchar(50),
Caste varchar(50),
Subcaste varchar(50),
Lac_no int  DEFAULT '0' ,
Part_no varchar(10),
House_no varchar(50),
Phone varchar(11),
Bakijai_CaseId int  DEFAULT '0' ,
Entered_By varchar(50),
Circle varchar(30),
Mauza varchar(30),
PS varchar(30),
Patta_type varchar(30),
Xohari_RequestID varchar(50)  DEFAULT '0'   NOT NULL ,
Issued_By varchar(70),
Challan_no varchar(30),
Challan_amount int  DEFAULT '0' ,
Enclosure varchar(50)  DEFAULT '0' ,
Bo_Name varchar(50),
PRIMARY KEY (pet_yr,pet_no)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [PETITION_STATUS]
-- 

CREATE TABLE IF NOT EXISTS petition_status(
Status varchar(15)  NOT NULL ,
PRIMARY KEY (status)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [PETITION_STATUS]
-- 

Insert Into petition_status(Status) values
('Disposed'),
('Issued'),
('Pending'),
('Processed'),
('Rejected');


-- 
-- Structure for Table [PETITION_TYPE]
-- 

CREATE TABLE IF NOT EXISTS petition_type(
Code varchar(2)  NOT NULL ,
Detail varchar(35)  NOT NULL ,
Running char(1)  DEFAULT 'Y'   NOT NULL ,
Xohari_ServiceId int  DEFAULT '0'   NOT NULL ,
Abvr varchar(10),
Fees int  DEFAULT '0'   NOT NULL ,
ServiceId varchar(10),
Signed_by varchar(200)  DEFAULT 'Addl. Deputy Commissioner' ,
PRIMARY KEY (code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [PETITION_TYPE]
-- 

Insert Into petition_type(Code,Detail,Running,Xohari_ServiceId,Abvr,Fees,ServiceId,Signed_by) values
('BK','Bakijai Clearence Certificate','Y',0,'Bakijai',20,NULL,'Certificate Officer<br>Nalbari'),
('BR','Birth Certificate','N',0,'Birth',0,NULL,'Addl. Deputy Commissioner'),
('CT','Caste Certificate','Y',0,'Caste',0,'34','EAC<br>For Deputy Commissioner <br>Nalbari'),
('DH','Death Certificate','N',0,'Death',0,NULL,'Addl. Deputy Commissioner'),
('DM','Domicile Certificate','N',0,'Domicile',0,NULL,'Addl. Deputy Commissioner'),
('ER','Certified Electoral Roll ','Y',0,'E. Roll',20,NULL,'Election Officer<br>Nalbari'),
('JB','Jamabandi Copy','Y',0,'Jamabandi',0,NULL,'Addl. Deputy Commissioner<br>Nalbari'),
('LH','Legal Heir Certificate(Next to Kin)','Y',0,'Legal Heir',0,'36','Addl. Deputy Commissioner<br>Nalbari'),
('LV','Land Valuation Certificate','N',0,'Land Value',0,NULL,'Addl. Deputy Commissioner'),
('NC','Non Creme Layer Certificate','Y',0,'Non Creamy',0,'35','EAC<br>For Deputy Commissioner <br>Nalbari'),
('PR','Permenant Residence Certificate','Y',0,'PRC',50,'42','Addl. Deputy Commissioner<br>Nalbari');


-- 
-- Structure for Table [PFC_COLLECTION]
-- 

CREATE TABLE IF NOT EXISTS pfc_collection(
Id bigint  NOT NULL ,
Sl_no int  NOT NULL ,
Collection_Date datetime  NOT NULL ,
Cal_yr int  DEFAULT '0'   NOT NULL ,
Cal_month int  DEFAULT '0'   NOT NULL ,
Jama_fee int  DEFAULT '0'   NOT NULL ,
Er_fee int  DEFAULT '0'   NOT NULL ,
Other_fee int  DEFAULT '0'   NOT NULL ,
Total int  NOT NULL ,
PRIMARY KEY (cal_yr,cal_month)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [PFC_EXPENSE]
-- 

CREATE TABLE IF NOT EXISTS pfc_expense(
Id bigint  NOT NULL ,
Sl_no int,
Head varchar(20),
Pay_Date datetime,
Salary_year int,
Salary_month int,
Farm_Staff_Name varchar(50),
Detail varchar(50),
Amount decimal(6,2)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [POLICE_STATION]
-- 

CREATE TABLE IF NOT EXISTS police_station(
Code int  NOT NULL ,
Name varchar(30),
Name_ass varchar(50)  CHARACTER SET utf8 COLLATE utf8_unicode_ci ,
PRIMARY KEY (code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [POLICE_STATION]
-- 

Insert Into police_station(Code,Name,Name_ass) values
(0,'-','-'),
(1,'Nalbari','নলবাৰী'),
(2,'Barbhag','বৰভাগ'),
(3,'Ghagrapar','ঘগ্ৰাপাৰ'),
(4,'Belsor','বেলশৰ'),
(5,'Mukalmua','মুকালমুৱা'),
(6,'Tihu','টিহু'),
(7,'Barama','-'),
(8,'Bhangnamari',NULL),
(9,'Sialmari',NULL),
(10,'Rangia',NULL);


-- 
-- Structure for Table [PWD]
-- 

CREATE TABLE IF NOT EXISTS pwd(
UID varchar(20)  NOT NULL ,
PWD varchar(20)  CHARACTER SET utf8 COLLATE utf8_unicode_ci   NOT NULL ,
ROLL int  NOT NULL ,
Active char(1),
Fullname varchar(50),
Branch_Code int  DEFAULT '0'   NOT NULL ,
FirstLogin varchar(1)  DEFAULT 'Y'   NOT NULL ,
Area varchar(50)  DEFAULT '0'   NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [PWD]
-- 

Insert Into pwd(UID,PWD,ROLL,Active,Fullname,Branch_Code,FirstLogin,Area) values
('Adc','@bffg',1,'Y','Bibhash Modi',3,'N','0'),
('admin','Ebfpms79 l',1,'Y','Administrator',0,'N','0'),
('anamika','Dtervuovk',2,'Y','Anamika Chakrabarty',3,'N','6'),
('Anupam','Iltlwmthouru=p',2,'N','Anupan Talukdar(Pers)',3,'N','6'),
('billu','Bqcumxi',2,'Y','Dibakar Basumatari',4,'N','7,8,9,12,13,14,18,19,20,21,22,23'),
('DA','?ecf',3,'Y','Branch Assistant(Common)',0,'N','0'),
('DC','?eef',1,'Y','Dak Status Viewer',0,'N','0'),
('Hemen','Accemh',2,'N','Hemen Dutta',4,'N','13'),
('hriday','Ccjdxygj',3,'N','Hriday(PA)',6,'N','0'),
('jitu','Eegne68:<l',2,'Y','Deben Das,Copiest',4,'N','13'),
('kamal','Dlcpeq68k',1,'Y','Kamal Sarma',0,'N','0'),
('mamoni','Anqqmh',2,'Y','Mamani Garo',1,'N','1,2,3,4,10,16'),
('mohan','?67f',2,'N','Mohan Ch Barman',3,'N','6'),
('Naba','@omqg',2,'Y','Naba Kishor Nath',1,'N','1,2,3,4,10,16'),
('onupom','IHwuyEQyqsrymp',2,'Y','Anupam Talukdar',4,'N','7,8,19,20,22'),
('pa','Cctdrhnj',2,'Y','Hriday Bhatta',6,'N','17'),
('pb','A2 :4h',2,'N','Prasanna Baishya',4,'N','7,14'),
('ramen','Abcgmh',2,'Y','Ramen Barman',4,'N','7,8,9,19,20'),
('root','Cokf457j',0,'Y','System Manager',0,'N','0'),
('sunindra','Fccuqft:=@m',2,'Y','Sunindra Barman',4,'N','7,8,19,20,22'),
('super','Etwsiw79 l',2,'Y','super User',0,'N','0'),
('wahida','BMQWYXi',2,'Y','Wahida Rahman',1,'N','1,2,3,10'),
('billup','Aqcumh',2,'Y','Dibakar Basumatary(Pers)',3,'N','6'),
('pranab','Clqomygj',2,'Y','Pranab Kalita',3,'N','6'),
('pfc','@qhfg',2,'Y','Mamoni Garo(Pfc)',4,'N','20'),
('smita','Bntlhzi',2,'Y','Mridusmita Das',3,'N','6'),
('prakash','G::98>8<9 @n',2,'Y','Prakash',3,'N','6'),
('Kishor','Cucqeygj',2,'Y','Kishor Baro',3,'N','6'),
('mano','Bkm34<i',2,'Y','Jitumoni Kalita',4,'N','7,14,19,20,22'),
('mehmooda','Dqtlrhkwk',2,'Y','Mehmooda Begum',3,'N','6');


-- 
-- Structure for Table [RELATION]
-- 

CREATE TABLE IF NOT EXISTS relation(
Rel_name varchar(20)  NOT NULL ,
ARTPS bit,
PRIMARY KEY (rel_name)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [RELATION]
-- 

Insert Into relation(Rel_name,ARTPS) values
('Aunty of',true),
('Brother of',true),
('Daughter of',false),
('Father of',true),
('Husband of',true),
('Mother of',true),
('Nephew of',true),
('Niece of',true),
('Sister of',true),
('Son of',false),
('Uncle of',true),
('Wife of',false);


-- 
-- Structure for Table [ROLL]
-- 

CREATE TABLE IF NOT EXISTS roll(
Roll int  NOT NULL ,
Description varchar(21),
PRIMARY KEY (roll)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [ROLL]
-- 

Insert Into roll(Roll,Description) values
(0,'System Manager'),
(1,'Gen. Administrator'),
(2,'Super User'),
(3,'General Operator'),
(4,'Guest');


-- 
-- Structure for Table [SEX]
-- 

CREATE TABLE IF NOT EXISTS sex(
Code varchar(1)  NOT NULL ,
Detail varchar(8),
PRIMARY KEY (code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [SEX]
-- 

Insert Into sex(Code,Detail) values
('F','Female'),
('M','Male'),
('O','Other');


-- 
-- Structure for Table [SUBCASTE]
-- 

CREATE TABLE IF NOT EXISTS subcaste(
Slno int  NOT NULL ,
Detail varchar(50)  NOT NULL ,
PRIMARY KEY (detail)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [SUBCASTE]
-- 

Insert Into subcaste(Slno,Detail) values
(41,'Ahom'),
(5,'Bania'),
(12,'Bansphor'),
(36,'Bhangi'),
(27,'Bhuinmali'),
(29,'Bhupi'),
(23,'Bishnupuriya Manipuri'),
(28,'Brittial Bania'),
(4,'Dhobi'),
(31,'Dholi'),
(30,'Dugla'),
(40,'Gwala'),
(16,'Harijon'),
(8,'Hira'),
(32,'Jaliya'),
(14,'Jalkeot'),
(6,'Jhalo'),
(26,'Jhalo-Malo'),
(9,'Jogi'),
(11,'Kaibartta'),
(24,'Koch'),
(19,'Koch Rajbongshi'),
(39,'Koiri'),
(38,'Kori'),
(18,'Kumar'),
(33,'Lalbegi'),
(34,'Mahara'),
(13,'Mali'),
(32,'Malo'),
(35,'Mehtar'),
(15,'Muchi'),
(1,'Mukhi'),
(22,'Muttak'),
(10,'Namasudra'),
(3,'Napit'),
(2,'Nath'),
(37,'Patni'),
(17,'Rishi'),
(20,'Saloi'),
(25,'Sut'),
(7,'Sutradhar'),
(21,'Tassa'),
(42,'Teli');


-- 
-- Structure for Table [UPDATE_HISTORY]
-- 

CREATE TABLE IF NOT EXISTS update_history(
Case_Id bigint  DEFAULT '0'   NOT NULL ,
RSL int  DEFAULT '0'   NOT NULL ,
Detail varchar(600),
User_Code varchar(30),
Entry_Date datetime,
PRIMARY KEY (case_id,rsl)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [USERLOG]
-- 

CREATE TABLE IF NOT EXISTS userlog(
uid varchar(20)  NOT NULL ,
log_date datetime  NOT NULL ,
log_time_in varchar(15)  NOT NULL ,
log_time_out varchar(15)  NOT NULL ,
Client_Ip varchar(40)  NOT NULL ,
Session_id bigint  NOT NULL ,
Left_Frame int  NOT NULL ,
Middle_Frame int  NOT NULL ,
Right_Frame int  NOT NULL ,
Active varchar(1)  DEFAULT 'N'   NOT NULL ,
PRIMARY KEY (session_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [VILLAGE]
-- 

CREATE TABLE IF NOT EXISTS village(
Vill_Code int  NOT NULL ,
Vill_name varchar(60),
Cir_code int,
Vill_Name_Ass varchar(100)  CHARACTER SET utf8 COLLATE utf8_unicode_ci ,
Revenue_Village bit,
PRIMARY KEY (vill_code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- FOREIGN KEY


-- 
-- Foreign Key for Table [ADJUST]
--

ALTER TABLE adjust ADD CONSTRAINT adjust_ibfk_1 FOREIGN KEY (bank) REFERENCES bank_master(bank_name) ;

-- 
-- Foreign Key for Table [AREAOFWORK]
--

ALTER TABLE areaofwork ADD CONSTRAINT areaofwork_ibfk_1 FOREIGN KEY (branch_code) REFERENCES branch_section(branch_code) ;

-- 
-- Foreign Key for Table [BAKIJAI_CASEDATE]
--

ALTER TABLE bakijai_casedate ADD CONSTRAINT bakijai_casedate_ibfk_1 FOREIGN KEY (case_id) REFERENCES bakijai_main(case_id) ;
ALTER TABLE bakijai_casedate ADD CONSTRAINT bakijai_casedate_ibfk_2 FOREIGN KEY (notice_type) REFERENCES noticetype(code) ;

-- 
-- Foreign Key for Table [BAKIJAI_MAIN]
--

ALTER TABLE bakijai_main ADD CONSTRAINT bakijai_main_ibfk_1 FOREIGN KEY (circle) REFERENCES circle(cir_code) ;
ALTER TABLE bakijai_main ADD CONSTRAINT bakijai_main_ibfk_2 FOREIGN KEY (mouza) REFERENCES mouza(mouza_code) ;
ALTER TABLE bakijai_main ADD CONSTRAINT bakijai_main_ibfk_4 FOREIGN KEY (polst_code) REFERENCES police_station(code) ;
ALTER TABLE bakijai_main ADD CONSTRAINT bakijai_main_ibfk_5 FOREIGN KEY (bank) REFERENCES bank_master(bank_name) ;
ALTER TABLE bakijai_main ADD CONSTRAINT bakijai_main_ibfk_6 FOREIGN KEY (bank,branch) REFERENCES bankbranch(bank,branch) ;

-- 
-- Foreign Key for Table [BAKI_PAYMENT]
--

ALTER TABLE baki_payment ADD CONSTRAINT baki_payment_ibfk_1 FOREIGN KEY (case_id) REFERENCES bakijai_main(case_id) ;

-- 
-- Foreign Key for Table [BANKBRANCH]
--

ALTER TABLE bankbranch ADD CONSTRAINT bankbranch_ibfk_1 FOREIGN KEY (bank) REFERENCES bank_master(bank_name) ;

-- 
-- Foreign Key for Table [BANK_DEPOSIT]
--

ALTER TABLE bank_deposit ADD CONSTRAINT bank_deposit_ibfk_1 FOREIGN KEY (case_id) REFERENCES bakijai_main(case_id) ;

-- 
-- Foreign Key for Table [LEGAL_HEIR]
--

ALTER TABLE legal_heir ADD CONSTRAINT legal_heir_ibfk_1 FOREIGN KEY (pet_yr,pet_no) REFERENCES petition_master(pet_yr,pet_no) ;

-- 
-- Foreign Key for Table [MOUZA]
--

ALTER TABLE mouza ADD CONSTRAINT mouza_ibfk_1 FOREIGN KEY (cir_code) REFERENCES circle(cir_code) ;

-- 
-- Foreign Key for Table [OFFICER_CHAIN]
--

ALTER TABLE officer_chain ADD CONSTRAINT officer_chain_ibfk_1 FOREIGN KEY (case_id) REFERENCES bakijai_main(case_id) ;
ALTER TABLE officer_chain ADD CONSTRAINT officer_chain_ibfk_2 FOREIGN KEY (officer_code) REFERENCES officer(slno) ;

-- 
-- Foreign Key for Table [PETITION_MASTER]
--

ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_1 FOREIGN KEY (status) REFERENCES petition_status(status) ;
ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_2 FOREIGN KEY (pet_type) REFERENCES petition_type(code) ;
ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_3 FOREIGN KEY (circle_code) REFERENCES circle(cir_code) ;
ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_4 FOREIGN KEY (mauza_code) REFERENCES mouza(mouza_code) ;
ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_5 FOREIGN KEY (ps_code) REFERENCES police_station(code) ;
ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_6 FOREIGN KEY (sex) REFERENCES sex(code) ;

-- 
-- Foreign Key for Table [PWD]
--

ALTER TABLE pwd ADD CONSTRAINT pwd_ibfk_1 FOREIGN KEY (branch_code) REFERENCES branch_section(branch_code) ;
ALTER TABLE pwd ADD CONSTRAINT pwd_ibfk_2 FOREIGN KEY (roll) REFERENCES roll(roll) ;

-- 
-- Foreign Key for Table [UPDATE_HISTORY]
--

ALTER TABLE update_history ADD CONSTRAINT update_history_ibfk_1 FOREIGN KEY (case_id) REFERENCES bakijai_main(case_id) ;

-- 
-- Foreign Key for Table [VILLAGE]
--

ALTER TABLE village ADD CONSTRAINT village_ibfk_1 FOREIGN KEY (cir_code) REFERENCES circle(cir_code) ;

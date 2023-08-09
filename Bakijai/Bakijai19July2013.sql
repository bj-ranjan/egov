-- Database Name EGOVERNANCE


-- 
-- Structure for Table [AREAOFWORK]
-- 

CREATE TABLE IF NOT EXISTS areaofwork(
Area_Code int  NOT NULL ,
Area_Name varchar(40)  NOT NULL ,
Branch_Code int  NOT NULL ,
 PRIMARY KEY (Area_Code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [AREAOFWORK]
-- 

INSERT INTO areaofwork(Area_Code,Area_Name,Branch_Code) VALUES
('1','New Case Registration','1'),
('2','Collection Updation','1'),
('3','Issue Certificate','1'),
('4','Bank Deposit Updation','1'),
('5','Print Jamabandi','2'),
('6','Entry Dak','3'),
('7','Enter Petition','4'),
('8','Process Certificate(PRC,Caste,etc)','4'),
('9','Issue Certificate','4'),
('10','Issue Notice','1'),
('11','Update Old Payment','1'),
('12','Process Eroll','4'),
('13','Process Jamabandi','4'),
('14','Process Legal Heir','4'),
('15','Case Particular Modification','1'),
('16','Interest Updation','1');

-- 
-- Structure for Table [BAKIJAI_CASEDATE]
-- 

CREATE TABLE IF NOT EXISTS bakijai_casedate(
Case_Id bigint  NOT NULL ,
Day int  NOT NULL ,
Next_Date datetime,
Appeared varchar(1)  DEFAULT 'N' ,
Appeared_Date datetime,
Action_Taken varchar(1)  DEFAULT 'N' ,
Note_of_Action varchar(255),
Entry_date datetime,
Notice_Type int,
 PRIMARY KEY (Case_Id,Day)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [BAKIJAI_INTEREST]
-- 

CREATE TABLE IF NOT EXISTS bakijai_interest(
CASE_ID bigint  DEFAULT '0'   NOT NULL ,
INTEREST_PAYABLE int,
PAY_DATE datetime,
ENTRY_DATE datetime,
USER_CODE varchar(20),
Receipt_No varchar(150),
 PRIMARY KEY (CASE_ID)
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
 PRIMARY KEY (Case_Id)
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
 PRIMARY KEY (Case_id,Instalment_no)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [BANKBRANCH]
-- 

CREATE TABLE IF NOT EXISTS bankbranch(
RSL int,
Bank varchar(50)  NOT NULL ,
Branch varchar(50)  NOT NULL ,
 PRIMARY KEY (Bank,Branch)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [BANKBRANCH]
-- 

INSERT INTO bankbranch(RSL,Bank,Branch) VALUES
(NULL,'AFC','Nalbari'),
('1','AGVB','Bangaon'),
(NULL,'AGVB','Barajol'),
('2','AGVB','Barama'),
('3','AGVB','Barni'),
('4','AGVB','Barnibari'),
('5','AGVB','Chamata'),
('6','AGVB','Dhamdhama'),
('7','AGVB','Dwarkuchi'),
('8','AGVB','Ghagrapar'),
('10','AGVB','Gopal Bazar, Nalbari'),
('11','AGVB','Haribhanga'),
('12','AGVB','Jagara'),
('13','AGVB','Joysagar'),
('14','AGVB','Kaithalkuchi'),
('15','AGVB','Kaplabari'),
('16','AGVB','Karia'),
('17','AGVB','Marowa'),
('18','AGVB','Nalbari'),
('19','AGVB','Rampur'),
('20','AGVB','Solmara'),
('21','AGVB','Tihu'),
('22','AGVB','Tihu Chowk'),
(NULL,'Allahabad Bank','Balitara'),
('23','Allahabad Bank','Nalbari'),
('24','Apex Bank','Nalbari'),
('25','Apex Bank','Tihu'),
(NULL,'ASDC','Nalbari'),
('26','Bank of India','Adabari'),
('27','Bank of India','Bahjani'),
('28','Bank of India','Loharkatha'),
(NULL,'Bank of India','Nalbari'),
(NULL,'Bijoya Bank','Nalbari'),
('0','Canara Bank','Gopal Bazar'),
('29','Canara Bank','Nalbari'),
('30','CBI','Baharghat'),
(NULL,'CBI','Banbhag'),
('31','CBI','Belsor'),
(NULL,'CBI','Datara'),
('32','CBI','Dhamdhama'),
('33','CBI','Ghagrapar'),
('0','CBI','Kalag'),
('34','CBI','Mukalmua'),
('35','CBI','Nalbari'),
('36','CBI','Nathkuchi'),
(NULL,'CBI','Nayabasti'),
(NULL,'DFDC','Nalbari'),
(NULL,'EMTC','Nalbari'),
(NULL,'Fishery','Nalbari'),
(NULL,'Forest','Nalbari'),
('59','HDFC','Nalbari'),
(NULL,'HMT','Nalbari'),
(NULL,'Housing','Nalbari'),
(NULL,'MACT','Nalbari'),
(NULL,'MIDC','Nalbari'),
('58','Mini Co-Operative Bank','Barbhag Kalag'),
(NULL,'Misc','-'),
(NULL,'Misc','Nalbari'),
(NULL,'NMB','Nalbari'),
('38','PNB','Amayapur'),
('39','PNB','Barajol'),
('0','PNB','Barama'),
('40','PNB','Nalbari'),
('57','Post Office','Nalbari'),
('56','SBI','Bazar Branch'),
('41','SBI','Kalag'),
('42','SBI','Kamarkuchi'),
('43','SBI','Makhibaha'),
('44','SBI','Mukalmua'),
('45','SBI','Nalbari'),
(NULL,'SBI','Piplibari'),
('56','SBI','Tihu'),
(NULL,'SCDC','Nalbari'),
(NULL,'Syndicate Bank','Nalbari'),
('56','UBI','Nalbari'),
(NULL,'UCO','Mukalmua'),
('48','UCO','Nalbari'),
('49','UCO','Tihu'),
('51','Union Bank','Nalbari'),
('52','Union Bank','Rangia'),
('0','Union Co-Operative Bank','Tihu'),
('54','Urban Cooperative Bank','Chamata'),
('53','Urban Cooperative Bank','Nalbari');

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
 PRIMARY KEY (Case_id,Installment)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [BANK_MASTER]
-- 

CREATE TABLE IF NOT EXISTS bank_master(
Bank_Name varchar(50)  NOT NULL ,
BType varchar(25)  DEFAULT 'Financial' ,
 PRIMARY KEY (Bank_Name)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [BANK_MASTER]
-- 

INSERT INTO bank_master(Bank_Name,BType) VALUES
('AFC','Financial'),
('AGVB','Financial'),
('Allahabad Bank','Financial'),
('Apex Bank','Financial'),
('ASDC','Non Financial'),
('Bank of India','Financial'),
('Bijoya Bank','Financial'),
('Canara Bank','Financial'),
('CBI','Financial'),
('DFDC','Non Financial'),
('EMTC','Non Financial'),
('Fishery','Non Financial'),
('Forest','Non Financial'),
('HDFC','Financial'),
('HMT','Non Financial'),
('Housing','Non Financial'),
('MACT','Non Financial'),
('MIDC','Non Financial'),
('Mini Co-Operative Bank','Financial'),
('MISC','Non Financial'),
('NIL',NULL),
('NMB','Non Financial'),
('PGB','Nalbari'),
('PNB','Financial'),
('Post Office','Financial'),
('SBI','Financial'),
('SCDC','Non Financial'),
('Syndicate Bank','Financial'),
('UBI','Financial'),
('UCO','Financial'),
('Union Bank','Financial'),
('Union Co-Operative Bank','Financial'),
('Urban Cooperative Bank','Financial');

-- 
-- Structure for Table [BRANCH_SECTION]
-- 

CREATE TABLE IF NOT EXISTS branch_section(
Branch_Code int  NOT NULL ,
Branch_Name varchar(40)  NOT NULL ,
 PRIMARY KEY (Branch_Code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [BRANCH_SECTION]
-- 

INSERT INTO branch_section(Branch_Code,Branch_Name) VALUES
('0','All Branch'),
('1','Bakijai'),
('2','Revenue'),
('3','Personnel'),
('4','Administration(PFC)'),
('5','Magistracy');

-- 
-- Structure for Table [CIRCLE]
-- 

CREATE TABLE IF NOT EXISTS circle(
Cir_code int  NOT NULL ,
Circle varchar(30),
Circle_Ass varchar(50)  CHARACTER SET utf8 COLLATE utf8_unicode_ci ,
 PRIMARY KEY (Cir_code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [CIRCLE]
-- 

INSERT INTO circle(Cir_code,Circle,Circle_Ass) VALUES
('0','Out','ন'),
('1','Nalbari','নলবাৰী'),
('2','Paschim Nalbari','পশ্চিম নলবাৰী'),
('3','Barkhetry','বৰক্ষেত্রী'),
('4','Tihu','টিহু'),
('5','Ghagrapar','ঘগ্ৰাপাৰ'),
('6','Banekuchi','বানেকুচি'),
('7','Barbhag','বৰভাগ'),
('8','Baganpara','বাগানপাৰা'),
('9','Barama','বৰমা'),
('10','bidyut khanda','বিদ্যুৎ খণ্ড '),
('11','tantra sankara','তন্ত্র শঙ্কৰা ');

-- 
-- Structure for Table [FINALREPORT]
-- 

CREATE TABLE IF NOT EXISTS finalreport(
FDate datetime  NOT NULL ,
user varchar(20),
entry_date datetime,
 PRIMARY KEY (FDate)
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
 PRIMARY KEY (CODE)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [LAC]
-- 

INSERT INTO lac(CODE,NAME,TOTPS,HPCCODE,RTAG) VALUES
('0','OUTSIDE','0','0','a'),
('58','TAMULPUR','232','5','K'),
('59','NALBARI','230','8','L'),
('60','BARKHETRI','231','7','M'),
('61','DHARMAPUR','184','6','N'),
('62','BARAMA(ST)','187','5','O'),
('63','CHAPAGURI(ST)','184','5','P');

-- 
-- Structure for Table [MOUZA]
-- 

CREATE TABLE IF NOT EXISTS mouza(
Mouza_Code int  NOT NULL ,
Mouza_Name varchar(30),
Mouza_Name_Ass varchar(30)  CHARACTER SET utf8 COLLATE utf8_unicode_ci ,
Cir_Code int,
 PRIMARY KEY (Mouza_Code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [MOUZA]
-- 

INSERT INTO mouza(Mouza_Code,Mouza_Name,Mouza_Name_Ass,Cir_Code) VALUES
('0','-','..............................','0'),
('1','KHATA   ','খাটা ','1'),
('2','BATAHGILA ','বতাহগিলা ','1'),
('3','BAHJANI ','বাহজানি ','1'),
('4','DHARMAPUR. ','ধৰ্মপুৰ ','2'),
('5','KSHETRI DHARMAPUR ','ক্ষেত্রি ধৰ্মপুৰ ','2'),
('6','PAKOWA ','পকোৱা ','2'),
('7','PUB BARKSHETRI  ','পুব বৰক্ষেত্রি ','3'),
('8','PASHCHIM BARKSHETRI    ','পশ্চিম বৰক্ষেত্রি ','3'),
('9','UTTAR BARKSHETRI   ','উত্তৰ বৰক্ষেত্রি ','3'),
('10','MADHYAM BARKSHETRI   ','মধ্যম বৰক্ষেত্রি ','3'),
('11','NAMATI  ','নমাটি ','4'),
('12','NAMBARBHAG   ','নামবৰভাগ ','4'),
('13','TIHU ','টিহু ','4'),
('14','PUB BANBHAG. ','পুব বনভগ ','5'),
('15','PASHCHIM BANBHAG ','পশ্চিম বনভাগ ','5'),
('16','NATUN DEHAR. ','নতুন দেহৰ ','6'),
('17','UPAR BARBHAG.  ','উপৰ বৰভাগ ','7'),
('18','PUB BANBHAG. ','পুব বনভাগ ','7'),
('19','NAMATI   ','নমাটি ','9'),
('20','NAMBARBHAG  ','নামবৰভাগ ','9'),
('21','Noee','see','0'),
('22','Baska',NULL,'8');

-- 
-- Structure for Table [NOTICETYPE]
-- 

CREATE TABLE IF NOT EXISTS noticetype(
CODE int  DEFAULT '0'   NOT NULL ,
NOTICEDETAIL varchar(30),
 PRIMARY KEY (CODE)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [NOTICETYPE]
-- 

INSERT INTO noticetype(CODE,NOTICEDETAIL) VALUES
('1','77 Act(First)'),
('2','77 Act(Second)'),
('3','Warrant(Bailable)'),
('4','Warrant(Non Bailable)'),
('5','Common General Notice');

-- 
-- Structure for Table [OFFICER]
-- 

CREATE TABLE IF NOT EXISTS officer(
Slno int  NOT NULL ,
Officer_Name varchar(35),
Designation varchar(20),
Exist bit,
 PRIMARY KEY (Slno)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [OFFICER]
-- 

INSERT INTO officer(Slno,Officer_Name,Designation,Exist) VALUES
('1','Joly Das Brahma','ADC','1'),
('2','Dipak Kumar Handique','ADC','1'),
('3','Adhar Bhuyan','ADC','1'),
('4','Bulbul Roy','SDO(S)','1'),
('5','Lakhimi Dutta','EAC','0'),
('6','Haripad Roy','ADC','0'),
('7','Renu Mahanta','ADC','0'),
('8','Pramod Kalita','RS','1'),
('9','Chinmoy P. Phookan','EO','1');

-- 
-- Structure for Table [OFFICER_CHAIN]
-- 

CREATE TABLE IF NOT EXISTS officer_chain(
Case_Id bigint  NOT NULL ,
From_Date datetime  NOT NULL ,
To_Date datetime,
Officer_Code int  NOT NULL ,
 PRIMARY KEY (Case_Id,Officer_Code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [PETITION_MASTER]
-- 

CREATE TABLE IF NOT EXISTS petition_master(
Id bigint  NOT NULL ,
Pet_yr char(4)  NOT NULL ,
Pet_date datetime  NOT NULL ,
Pet_type varchar(2)  NOT NULL ,
Pet_no bigint  NOT NULL ,
Applicant varchar(70)  NOT NULL ,
Relation varchar(50),
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
Process_date datetime,
Processed_by varchar(50),
BO varchar(1)  DEFAULT 'N' ,
Status varchar(10)  DEFAULT 'Pending' ,
Issue_date datetime,
Rejected_Reason varchar(100),
Exp_dt datetime,
Fees int  DEFAULT '0' ,
Court_fee float  DEFAULT '0' ,
Purpose varchar(50),
Income int,
Sex varchar(5),
DOB datetime,
Period varchar(10),
Patta_no varchar(50),
Caste varchar(50),
Subcaste varchar(50),
Lac_no int  DEFAULT '0' ,
Part_no varchar(10),
House_no varchar(50),
Phone varchar(11),
Countersignature varchar(50),
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
 PRIMARY KEY (Pet_yr,Pet_no)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



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
 PRIMARY KEY (Code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [PETITION_TYPE]
-- 

INSERT INTO petition_type(Code,Detail,Running,Xohari_ServiceId,Abvr,Fees) VALUES
('BK','Bakijai Clearence Certificate','Y','0','Bakijai','20'),
('BR','Birth Certificate','N','0','Birth','0'),
('CT','Caste Certificate','Y','34','Caste','0'),
('DH','Death Certificate','N','0','Death','0'),
('DM','Domicile Certificate','Y','0','Domicile','20'),
('ER','Certified Electoral Roll ','Y','0','E. Roll','20'),
('JB','Jamabandi Copy','Y','0','Jamabandi','0'),
('LH','Legal Heir Certificate(Next to Kin)','Y','36','Legal Heir','0'),
('LV','Land Valuation Certificate','N','0','Land Value','0'),
('NC','Non Creme Layer Certificate','Y','35','Non Creamy','0'),
('PR','Permenant Residence Certificate','Y','42','PRC','50');

-- 
-- Structure for Table [PFC_COLLECTION]
-- 

CREATE TABLE IF NOT EXISTS pfc_collection(
Id bigint  NOT NULL ,
Sl_no int,
Collection_Date datetime,
Cal_yr int,
Cal_month int,
Jama_fee int  DEFAULT '0' ,
Er_fee int  DEFAULT '0' ,
Other_fee int  DEFAULT '0' ,
Total int
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
Name_Ass varchar(50)  CHARACTER SET utf8 COLLATE utf8_unicode_ci ,
 PRIMARY KEY (Code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [PWD]
-- 

CREATE TABLE IF NOT EXISTS pwd(
UID varchar(20)  NOT NULL ,
PWD varchar(20)  CHARACTER SET utf8 COLLATE utf8_unicode_ci   NOT NULL ,
ROLL int  NOT NULL ,
Active char(1),
FullName varchar(50),
Branch_Code int  DEFAULT '0'   NOT NULL ,
FirstLogin varchar(1)  DEFAULT 'Y'   NOT NULL ,
Area varchar(50)  DEFAULT '0'   NOT NULL ,
 PRIMARY KEY (UID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [PWD]
-- 

INSERT INTO pwd(UID,PWD,ROLL,Active,FullName,Branch_Code,FirstLogin,Area) VALUES
('admin','Ebfpms79;l','1','Y','Administrator','0','N','0'),
('Anamika ','FDjdowgii{m','2','Y','Anamika Chakrabarty','3','N','6'),
('anupam','Eucoypjhzl','2','Y','Anupam Talukdar','4','N','7'),
('diba','Btrlgji','2','Y','Dibakar Basumatary','4','N','9,12'),
('Hemen','Bewwxfi','2','Y','Hemen Dutta','4','N','13'),
('Jitu','Aegneh','2','Y','Jitumani Deka','4','N','13'),
('kamal','Elcpeqe=<l','1','Y','Kamal Sarma','0','N','0'),
('mamoni','Anqqmh','2','Y','Mamani Garo','1','N','2,3,4'),
('Naba','@omqg','2','Y','Naba Kishor Nath','1','N','2,3,4,15'),
('root','@okfg','0','Y','Super Administrator','0','N','0'),
('Sunanda','Dtddvrguk','2','Y','Sunanda Barman','4','N','8'),
('super','Etwsiw79;l','2','Y','super User','0','N','0'),
('wahida','Ftwqjqu~m{m','2','Y','Wahida Rahman','1','N','1,10');

-- 
-- Structure for Table [RELATION]
-- 

CREATE TABLE IF NOT EXISTS relation(
Rel_name varchar(20)  NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [ROLL]
-- 

CREATE TABLE IF NOT EXISTS roll(
Roll int  NOT NULL ,
Description varchar(20),
 PRIMARY KEY (Roll)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [ROLL]
-- 

INSERT INTO roll(Roll,Description) VALUES
('0','Super Administrator'),
('1','Administrator'),
('2','Super User'),
('3','General Operator'),
('4','Guest');

-- 
-- Structure for Table [SEX]
-- 

CREATE TABLE IF NOT EXISTS sex(
Code varchar(1)  NOT NULL ,
Detail varchar(8),
 PRIMARY KEY (Code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [SEX]
-- 

INSERT INTO sex(Code,Detail) VALUES
('F','Female'),
('M','Male');

-- 
-- Structure for Table [SUBCASTE]
-- 

CREATE TABLE IF NOT EXISTS subcaste(
Slno int  NOT NULL ,
detail varchar(30),
 PRIMARY KEY (Slno)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [SUBCASTE]
-- 

INSERT INTO subcaste(Slno,detail) VALUES
('1','Mukhi'),
('2','Nath'),
('3','Napit'),
('4','Dhobi'),
('5','Bania'),
('6','Jalo'),
('7','Sutradhar'),
('8','Hira'),
('9','Jogi'),
('10','Namasudra'),
('11','Kaibarta');

-- 
-- Structure for Table [UPDATE_HISTORY]
-- 

CREATE TABLE IF NOT EXISTS update_history(
Case_Id bigint  DEFAULT '0'   NOT NULL ,
RSL int  DEFAULT '0'   NOT NULL ,
Detail varchar(600),
User_Code varchar(30),
Entry_Date datetime,
 PRIMARY KEY (Case_Id,RSL)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [USERLOGIN]
-- 

CREATE TABLE IF NOT EXISTS userlogin(
uid varchar(20)  NOT NULL ,
log_date datetime  NOT NULL ,
Client_Ip varchar(30),
 PRIMARY KEY (uid,log_date)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [USERLOGIN]
-- 

INSERT INTO userlogin(uid,log_date,Client_Ip) VALUES
('Anamika','2013-05-06 00:00:00','10.177.92.2'),
('anupam','2013-05-17 00:00:00','10.177.92.2'),
('anupam','2013-05-18 00:00:00','10.177.92.2'),
('anupam','2013-06-11 00:00:00','10.177.92.2'),
('anupam','2013-06-12 00:00:00','10.177.92.2'),
('diba','2013-05-18 00:00:00','10.177.92.2'),
('mamoni','2013-04-30 00:00:00','10.177.92.2'),
('mamoni','2013-05-03 00:00:00','10.177.92.2'),
('mamoni','2013-05-06 00:00:00','10.177.92.2'),
('mamoni','2013-05-17 00:00:00','10.177.92.2'),
('mamoni','2013-05-18 00:00:00','10.177.92.2'),
('naba','2013-05-13 00:00:00','10.177.92.2'),
('root','2013-04-30 00:00:00','10.177.92.2'),
('root','2013-05-02 00:00:00','10.177.92.2'),
('root','2013-05-03 00:00:00','10.177.92.2'),
('root','2013-05-04 00:00:00','10.177.92.2'),
('root','2013-05-06 00:00:00','10.177.92.2'),
('root','2013-05-08 00:00:00','10.177.92.2'),
('root','2013-05-13 00:00:00','127.0.0.1'),
('root','2013-05-14 00:00:00','10.177.92.2'),
('root','2013-05-16 00:00:00','10.177.92.2'),
('root','2013-05-17 00:00:00','10.177.92.2'),
('root','2013-05-18 00:00:00','10.177.92.2'),
('root','2013-05-20 00:00:00','10.177.92.2'),
('root','2013-05-21 00:00:00','10.177.92.2'),
('root','2013-05-23 00:00:00','10.177.92.2'),
('root','2013-05-24 00:00:00','10.177.92.2'),
('root','2013-05-27 00:00:00','10.177.92.2'),
('root','2013-05-28 00:00:00','10.177.92.2'),
('root','2013-05-29 00:00:00','10.177.92.2'),
('root','2013-05-31 00:00:00','10.177.92.2'),
('root','2013-06-01 00:00:00','127.0.0.1'),
('root','2013-06-04 00:00:00','10.177.92.2'),
('root','2013-06-05 00:00:00','10.177.92.2'),
('root','2013-06-06 00:00:00','10.177.92.2'),
('root','2013-06-07 00:00:00','10.177.92.2'),
('root','2013-06-11 00:00:00','10.177.92.2'),
('root','2013-06-12 00:00:00','10.177.92.2'),
('root','2013-06-13 00:00:00','10.177.92.2'),
('root','2013-06-20 00:00:00','10.177.92.2'),
('root','2013-06-21 00:00:00','10.177.92.2'),
('root','2013-06-24 00:00:00','10.177.92.2'),
('root','2013-06-28 00:00:00','10.177.92.2'),
('root','2013-07-01 00:00:00','10.177.92.2'),
('root','2013-07-05 00:00:00','10.177.92.2'),
('root','2013-07-06 00:00:00','10.177.92.2'),
('sunanda','2013-06-11 00:00:00','10.177.92.2'),
('sunanda','2013-06-12 00:00:00','10.177.92.2'),
('super','2013-04-30 00:00:00','10.177.92.2'),
('wahida','2013-04-30 00:00:00','10.177.92.2'),
('wahida','2013-05-03 00:00:00','10.177.92.2'),
('wahida','2013-05-18 00:00:00','10.177.92.2');

-- 
-- Structure for Table [VILLAGE]
-- 

CREATE TABLE IF NOT EXISTS village(
Vill_Code int  NOT NULL ,
Vill_Name varchar(60),
Cir_Code int,
Vill_Name_Ass varchar(100)  CHARACTER SET utf8 COLLATE utf8_unicode_ci ,
Revenue_Village bit,
 PRIMARY KEY (Vill_Code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [VILLAGE]
-- 

INSERT INTO village(Vill_Code,Vill_Name,Cir_Code,Vill_Name_Ass,Revenue_Village) VALUES
('0','-','0','ন','1'),
('1','Charia','1','চৰিঅ','1'),
('2','Panigaon','2','পনিগওঁ','1'),
('3','Churchuri   ','2','চুৰচুৰি ','1'),
('4','Khakhrisal','2','খখৃসল','1'),
('5','Kothalkuchi','6','কোথল্কুচি','1'),
('6','Khatanam Barbhag','6','খতনম বৰ্ভগ','1'),
('7','Jugarbari','7','জুগৰ্বৰি','1'),
('8','Uttarkuchi','7','উত্তৰ্কুচি','1'),
('9','Purna Kamdev','7','পুৰ্ন কমদেৱ','1'),
('10','Akhara','9','অখৰ','1'),
('11','Dahkaunia','9','দহকৌনিঅ','1'),
('12','Murmela','4','মুৰ্মেল','1'),
('13','Dahkaunia','9','দহকৌনিঅ','1'),
('14','Akhara','9','অখৰ','1'),
('15','Dhamdhama','8','ধমধম','1'),
('16','Piplibari','2','পিপ্লিবৰি','1'),
('17','Khata Rupia Bathan','2','খত ৰুপিঅ বথন','1'),
('18','Mularkuchi ','2','মুলাৰকুচি ','1'),
('19','Nannattari','4','নন্নত্তৰি','1'),
('20','Barpipaliya','1','বৰ্পিপলিয়','1'),
('21','Barkhanajan','1','বৰ্খনজন','1'),
('22','Nankarbhaira','1','নঙ্কৰ্ভৈৰ','1'),
('23','Nalbari Town Barsilakuti part','1','নল্বৰি তোৱন বৰ্সিলকুতি পৰত','1'),
('24','Pub-Kalakuchi','1','পুবকলকুচি','1'),
('25','Barnagar Banekuchi','6','বৰ্নগৰ বনেকুচি','1'),
('26','Baridatara','7','বৰিদতৰ','1'),
('27','Jugurkuchi','7','জুগুৰ্কুচি','1'),
('28','Akana','5','অকন','1'),
('29','Gatiyan','5','গতিয়ন','1'),
('30','Sataibari','5','সতৈবৰি','1'),
('31','1 No. Sagarkuchi','5','১ নং সগৰ্কুচি','1'),
('32','4 No. Bhelamari','3','৪ নং ভেলমৰি','1'),
('33','4 No. Barbala','3','৪ নং বৰ্বল','1'),
('34','2 No. Bhelengimari','3','২ নং ভেলেঙিমৰি','1'),
('35','Balikuchi','3','বলিকুচি','1'),
('36','Kharkaldi','3','খৰ্কলদি','1'),
('37','Sandheli','6','সন্ধেলি','1'),
('38','Kismat','7','কিস্মত','1'),
('39','Bihampur   ','2','বিহামপুৰ ','1'),
('40','Simoliya','2','সিমোলিয়','1'),
('41','Mohkhali','2','মোহখলি','1'),
('42','Barhelacha   ','2','বৰহেলাচা ','1'),
('43','Koihati','2','কৈহতি','1'),
('44','Fulguri   ','2','ফুলগুৰি ','1'),
('45','Baragra','1','বৰগ্ৰ','1'),
('46','Moiradanga','1','মৈৰদঙ','1'),
('47','Bhuyarkuchi','1','ভুয়ৰ্কুচি','1'),
('48','Barkura','1','বৰ্কুৰ','1'),
('49','Katahkuchi','1','কতহকুচি','1'),
('50','Barsanikuchi','1','বৰ্সনিকুচি','1'),
('51','Sondha','1','সোন্ধ','1'),
('52','Tantrasankara','1','তনত্রসঙ্কৰ','1'),
('53','Paschim Khatar Kalakuchi','1','পস্ক্িম খতৰ কলকুচি','1'),
('54','Amayapur','1','অময়পুৰ','0'),
('55','Rajakhat Banekuchi','6','ৰজখত বনেকুচি','1'),
('56','Parakuchi','7','পৰকুচি','1'),
('57','Barsimaliya','7','বৰ্সিমলিয়','1'),
('58','Bala','7','বল','1'),
('59','Panbari','5','পনবৰি','1'),
('60','Bilpar','5','বিল্পৰ','1'),
('61','Niz-Khagata','5','নিজখগত','1'),
('62','1 No. Numualatima','5','১ নং নুমুঅলতিম','1'),
('63','Bhelamari','5','ভেলমৰি','1'),
('64','Bhadrabangal','5','ভদ্ৰবঙল','1'),
('65','Ghokuchi Gathiyakuchi','5','ঘোকুচি গথিয়কুচি','1'),
('66','2 No. Balarttari','3','২ নং বলৰ্ত্তৰি','1'),
('67','Natun Saprapara','3','নতুন সপ্ৰপৰ','1'),
('68','Tegherittari','3','তেঘেৰিত্তৰি','1'),
('69','Bamunditarri','3','বমুন্দিতৰৃ','1'),
('70','4 No. Kaplabori','3','৪ নং কপ্লবোৰি','1'),
('71','1 No. Larkuchi','3','১ নং লৰ্কুচি','1'),
('72','Pub Kaija','3','পুব কৈজ','1'),
('73','Peradhara','3','পেৰধৰ','1'),
('74','Nanke Pub Kajia','3','নঙ্কে পুব কজিঅ','1'),
('75','Samarkuchi','7','সমৰ্কুচি','1'),
('76','Barigaon','5','বৰিগওঁ','1'),
('77','Mahina','8','মহিন','1'),
('78','Nadla','2','নদল','1'),
('79','Ratanpur','4','ৰতনপুৰ','1'),
('80','Bakuwajari','4','বকুৱজৰি','1'),
('81','Kendukuchi','1','কেন্দুকুচি','1'),
('82','Porakuchi','1','পোৰকুচি','1'),
('83','Bangnabari','6','বংনবৰি','1'),
('84','Khudra Dingdingi','7','খুদ্ৰ দিং্দিঙি','1'),
('85','Katuriya','5','কতুৰিয়','1'),
('86','Patkata','5','পত্কত','1'),
('87','Majusiral','5','মজুসিৰল','1'),
('88','Gargari','5','গৰ্গৰি','1'),
('89','Dihjari','5','দিহজৰি','1'),
('90','Sutarkuchi','3','সুতৰ্কুচি','1'),
('91','5 No. Barbala','3','৫ নং বৰ্বল','1'),
('92','2 No. Bartola','3','২ নং বৰ্তোল','1'),
('93','BhelaKhaiti','3','ভেলখৈতি','1'),
('94','Mukalmua','3','মুকল্মুঅ','1'),
('95','Dagapara','3','দগপৰ','1'),
('96','Lauthari','3','লৌথৰি','1'),
('97','Suradi','9','সুৰদি','1'),
('98','Panigaon','2','পনিগওঁ','1'),
('99','Gadira','2','গদিৰ','1'),
('100','Pakhura','2','পখুৰ','1'),
('101','Bari','2','বৰি','1'),
('102','Gandhiya','2','গন্ধিয়','1'),
('103','Niz-Namati','4','নিজনমতি','1'),
('104','Barbari','4','বৰ্বৰি','1'),
('105','Haribhanga','4','হৰিভঙ','1'),
('106','Barsarkuchi','1','বৰ্সৰ্কুচি','1'),
('107','Khatkatara','1','খত্কতৰ','1'),
('108','Kshudrachenikuchi','1','ক্ষুদ্ৰচেনিকুচি','1'),
('109','Makaldaba','1','মকলদব','1'),
('110','Janigog','1','জনিগোগ','1'),
('111','Kendukuchi','6','কেন্দুকুচি','1'),
('112','Towmura','6','তোৱমুৰ','1'),
('113','Kathalbari','6','কথল্বৰি','1'),
('114','Barkhetri Banekuchi','6','বৰ্খেত্রি বনেকুচি','1'),
('115','Moura','7','মৌৰ','1'),
('116','Nakheti','7','নখেতি','1'),
('117','Katpuha','7','কত্পুহ','1'),
('118','Narikuchi','5','নৰিকুচি','1'),
('119','Katakia','5','কতকিঅ','1'),
('120','Niz-Borigog','5','নিজবোৰিগোগ','1'),
('121','3 No. Balitara','5','৩ নং বলিতৰ','1'),
('122','Barbhag Nalbari','5','বৰ্ভগ নল্বৰি','1'),
('123','Badani Akhiya','3','বদনি অখিয়','1'),
('124','Angradi','3','অং্ৰদি','1'),
('125','Barsuliya','3','বৰ্সুলিয়','1'),
('126','Bhanganmari PGR','3','ভঙন্মৰি পগৰ','1'),
('127','Khaslihapara','3','খসলিহপৰ','1'),
('128','Naptipara','3','নপ্তিপৰ','1'),
('129','Ahara','3','অহৰ','1'),
('130','1 No. Kakankuchi','3','১ নং ককঙ্কুচি','1'),
('131','2 No. Kakankuchi','3','২ নং ককঙ্কুচি','1'),
('132','1 No Narua','3','১ নো নৰুঅ','1'),
('133','Kaldi','3','কলদি','1'),
('134','1 No. Kaplabori','3','১ নং কপ্লবোৰি','1'),
('135','2 No. Kaplabori','3','২ নং কপ্লবোৰি','1'),
('136','Damdampathar','3','দমদম্পথৰ','1'),
('137','Banpura','3','বনপুৰ','1'),
('138','Rampur','3','ৰম্পুৰ','1'),
('139','Sidalkuchi','3','সিদল্কুচি','1'),
('140','Barjhar','9','বৰ্ঝৰ','1'),
('141','Mahina','5','মহিন','1'),
('142','Larakuchi','2','লৰকুচি','1'),
('143','Amani   ','2','আমনি ','1'),
('144','Gamerimuri   ','2','গামেৰিমুৰি ','1'),
('145','Sariyhtali','1','সৰিয়হতলি','1'),
('146','Dhekiyabari','1','ধেকিয়বৰি','1'),
('147','Gobindapur','1','গোবিন্দপুৰ','1'),
('148','Khatkatara','1','খত্কতৰ','1'),
('149','Jamtola','1','জমতোল','1'),
('150','Teresiya','1','তেৰেসিয়','1'),
('151','Pajipar','1','পজিপৰ','1'),
('152','Japarkuchi','1','জপৰ্কুচি','1'),
('153','Jaymangla','1','জয়মংল','1'),
('154','Chandakuchi','1','চন্দকুচি','1'),
('155','Burinagar','6','বুৰিনগৰ','1'),
('156','Bajaliudaypur','7','বজলিউদয়পুৰ','1'),
('157','Bausiudaypur','7','বৌসিউদয়পুৰ','1'),
('158','Baghmara','5','বঘমৰ','1'),
('159','Satra','5','সত্র','1'),
('160','Hahdali','5','হহদলি','1'),
('161','Bangaon','5','বঙওঁ','1'),
('162','2 No. Sagarkuchi','5','২ নং সগৰ্কুচি','1'),
('163','Lawtola','3','লৱতোল','1'),
('164','Loharkatha','3','লোহৰ্কথ','1'),
('165','Sabhamari','3','সভমৰি','1'),
('166','Baramara','3','বৰমৰ','1'),
('167','Narayanpur','3','নৰয়নপুৰ','1'),
('168','Diruwa','3','দিৰুৱ','1'),
('169','Ghruwabahapathar','3','ঘ্ৰুৱবহপথৰ','1'),
('170','Balarsor','3','বলৰ্সোৰ','1'),
('171','Bausiyapara','6','বৌসিয়পৰ','1'),
('172','Deharkuchi','7','দেহৰ্কুচি','1'),
('173','Billeswar','2','বিল্লেস্বৰ','1'),
('174','Ghilajari(Solmara)','2','ঘিলজৰিসোল্মৰ','1'),
('175','Bihampur   ','2','বিহামপুৰ ','1'),
('176','Bhathuakhana','4','ভথুঅখন','1'),
('177','Saktipara','4','সক্তিপৰ','1'),
('178','Bhutkatara','1','ভুত্কতৰ','1'),
('179','Bistupur','1','বিস্তুপুৰ','1'),
('180','Deharkatara','1','দেহৰ্কতৰ','1'),
('181','Nalbari Town Khatabari part','1','নল্বৰি তোৱন খতবৰি পৰত','1'),
('182','Jaha','1','জহ','1'),
('183','Niz-Bahjani','1','নিজবহজনি','1'),
('184','Tilana','1','তিলন','1'),
('185','Banbhag Solmari','6','বনভগ সোল্মৰি','1'),
('186','Bangalmur','7','বঙল্মুৰ','1'),
('187','Ulabari','7','উলবৰি','1'),
('188','2 No. Sonkuria','7','২ নং সোঙ্কুৰিঅ','1'),
('189','Bithamahal','5','বিথমহল','1'),
('190','Burburi','5','বুৰ্বুৰি','1'),
('191','Nagaon','5','নগওঁ','1'),
('192','Uttarbarsiral','5','উত্তৰ্বৰ্সিৰল','1'),
('193','Keheruya','5','কেহেৰুয়','1'),
('194','Sahan Bistupur','5','সহন বিস্তুপুৰ','1'),
('195','3 No. Barbala','3','৩ নং বৰ্বল','1'),
('196','Sapkata','3','সপকত','1'),
('197','Kandhbari','3','কন্ধবৰি','1'),
('198','Boithabhanga','3','বৈথভঙ','1'),
('199','Barnibari','3','বৰ্নিবৰি','1'),
('200','Kasuwapathar','3','কসুৱপথৰ','1'),
('201','Gariaya Aungraddi','3','গৰিঅয় ঊং্ৰদ্দি','1'),
('202','Kolputa','3','কোল্পুত','1'),
('203','Batsar   ','2','বাটসৰ ','1'),
('204','Goalpara','2','গোঅল্পৰ','1'),
('205','Gangapur   ','2','গঙ্গাপুৰ ','1'),
('206','Niz Chamata   ','2','নিজ চামতা ','1'),
('207','2 No. Nathkuchi','4','২ নং নথকুচি','1'),
('208','Sathikuchi','4','সথিকুচি','1'),
('209','Katlabarkuchi','1','কতলবৰ্কুচি','1'),
('210','Bardhantali','1','বৰ্ধন্তলি','1'),
('211','Khudrapipaliya','1','খুদ্ৰপিপলিয়','1'),
('212','Gobindapur','1','গোবিন্দপুৰ','1'),
('213','Balakuchi','1','বলকুচি','1'),
('214','Kendukuchi','1','কেন্দুকুচি','1'),
('215','Paikarkuchi','1','পৈকৰ্কুচি','1'),
('216','Guwakuchi','1','গুৱকুচি','1'),
('217','Balikuchi','1','বলিকুচি','1'),
('218','Balilecha','1','বলিলেচ','1'),
('219','Nalbarigaon','1','নল্বৰিগওঁ','1'),
('220','Saplekuchi','6','সপ্লেকুচি','1'),
('221','Ukhura','7','উখুৰ','1'),
('222','Athgariya','7','অথগৰিয়','1'),
('223','Tarmatha','7','তৰ্মথ','1'),
('224','Ghoungarkuchi','5','ঘৌঙৰ্কুচি','1'),
('225','2 No. Nimualatima','5','২ নং নিমুঅলতিম','1'),
('226','1 No. Balitara','5','১ নং বলিতৰ','1'),
('227','Sonkuriha','5','সোঙ্কুৰিহ','1'),
('228','3 No. Sagarkuchi','5','৩ নং সগৰ্কুচি','1'),
('229','Kalardiya VGR','3','কলৰ্দিয় ৱগৰ','1'),
('230','1 No. Natun Saprapara','3','১ নং নতুন সপ্ৰপৰ','1'),
('231','Bamun Aungraddi','3','বমুন ঊং্ৰদ্দি','1'),
('232','Jowarddi','6','জোৱৰ্দ্দি','1'),
('233','Kariya','7','কৰিয়','1'),
('234','Suradi','9','সুৰদি','1'),
('235','Kendubari','2','কেন্দুবৰি','1'),
('236','Khelua','2','খেলুঅ','1'),
('237','Pahalangpara','2','পহলং্পৰ','1'),
('238','Mathurapur','4','মথুৰপুৰ','1'),
('239','Jalkhana','4','জলখন','1'),
('240','Gobaradal','4','গোবৰদল','1'),
('241','Khudrakatra','1','খুদ্ৰকত্র','1'),
('242','Khudra Katla Barkuchi','1','খুদ্ৰ কতল বৰ্কুচি','1'),
('243','Katahkuchi','1','কতহকুচি','1'),
('244','Khudrasankara','1','খুদ্ৰসঙ্কৰ','1'),
('245','Majdiya','1','মজদিয়','1'),
('246','Budrukuchi','1','বুদ্ৰুকুচি','1'),
('247','Khudrasankara','1','খুদ্ৰসঙ্কৰ','1'),
('248','Danguapara','6','দঙুঅপৰ','1'),
('249','Dalbari Kaniha','5','দল্বৰি কনিহ','1'),
('250','Ponar Kauniya','5','পোনৰ কৌঞ','1'),
('251','Namati','5','নমতি','1'),
('252','Baralkuchi','5','বৰল্কুচি','1'),
('253','Madhapur','5','মধপুৰ','1'),
('254','Panimajkuchi','5','পনিমজকুচি','1'),
('255','Burlitpara','3','বুৰ্লিত্পৰ','1'),
('256','Tupkarsar','3','তুপকৰ্সৰ','1'),
('257','1 No. Jaysagar','3','১ নং জয়সগৰ','1'),
('258','Khudra Sinadi','3','খুদ্ৰ সিনদি','1'),
('259','Nadia','3','নদিঅ','1'),
('260','Lawtolipar','3','লৱতোলিপৰ','1'),
('261','Bargasa','7','বৰ্গস','1'),
('262','Datara','5','দতৰ','1'),
('263','Bangaon   ','2','বনগাওঁ ','1'),
('264','Bhoiraghol   ','2','ভৈৰাঘোল ','1'),
('265','Solmari','2','সোল্মৰি','1'),
('266','Doloigaon','4','দোলৈগওঁ','1'),
('267','Bhurkuchi','4','ভুৰ্কুচি','1'),
('268','Tihu Town','4','তিহু তোৱন','1'),
('269','Alengidal','1','অলেঙিদল','1'),
('270','Niz-Banekuchi','6','নিজবনেকুচি','1'),
('271','Simaliya','7','সিমলিয়','1'),
('272','Ranakuchi','7','ৰনকুচি','1'),
('273','Raymadha','7','ৰয়মধ','1'),
('274','Dokoha','7','দোকোহ','1'),
('275','Guwakuchi','5','গুৱকুচি','1'),
('276','Niz-Barsiral','5','নিজবৰ্সিৰল','1'),
('277','Balipara','5','বলিপৰ','1'),
('278','Khatikuchi','5','খতিকুচি','1'),
('279','Galdighala','3','গলদিঘল','1'),
('280','1 No. Balarttari','3','১ নং বলৰ্ত্তৰি','1'),
('281','Tilardiya','3','তিলৰ্দিয়','1'),
('282','1 No. Bhelamari','3','১ নং ভেলমৰি','1'),
('283','Bhelengimari A Block','3','ভেলেঙিমৰি অ বলোক','1'),
('284','Meruwattari','3','মেৰুৱত্তৰি','1'),
('285','Darangipara','3','দৰঙিপৰ','1'),
('286','Bamunbori','3','বমুনবোৰি','1'),
('287','Belbeli','3','বেল্বেলি','1'),
('288','Besimari','6','বেসিমৰি','1'),
('289','3 No Bartala','3','৩ নো বৰ্তল','1'),
('290','4 No Bartala','3','৪ নো বৰ্তল','1'),
('291','Chamata   ','2','চামতা ','1'),
('292','Kaithalkuchi   ','2','কৈঠালকুচি ','1'),
('293','Kahikuchi','7','কহিকুচি','1'),
('294','Sanikuchi','7','সনিকুচি','1'),
('295','Khudra Khetri Barni','2','খুদ্ৰ খেত্রি বৰ্নি','1'),
('296','Bagurihati   ','2','বগুৰিহাটি ','1'),
('297','Dangardi','2','দঙৰ্দি','1'),
('298','1 No. Nathkuchi','4','১ নং নথকুচি','1'),
('299','Saribari','1','সৰিবৰি','1'),
('300','1 No. Sonkuriha','7','১ নং সোঙ্কুৰিহ','1'),
('301','Panbari','7','পনবৰি','1'),
('302','Arangmow','7','অৰংমোৱ','1'),
('303','Barajol','5','বৰজোল','1'),
('304','Naherbari','5','নহেৰ্বৰি','1'),
('305','Habalakha','5','হবলখ','1'),
('306','Jabjabkuchi','5','জবজবকুচি','1'),
('307','Puran Akhiya','3','পুৰন অখিয়','1'),
('308','Kaurekhaiti','3','কৌৰেখৈতি','1'),
('309','3 No. Bhelengimari','3','৩ নং ভেলেঙিমৰি','1'),
('310','Bhelengimari B Block','3','ভেলেঙিমৰি ব বলোক','1'),
('311','Bakrikuchi','3','বকৃকুচি','1'),
('312','Roumari','3','ৰৌমৰি','1'),
('313','Bihdiya','7','বিহদিয়','1'),
('314','Kothara','5','কোথৰ','1'),
('315','2 No. Bardhanara','5','২ নং বৰ্ধনৰ','1'),
('316','Purnadowsapara','7','পুৰ্নদোৱসপৰ','1'),
('317','Rupiya Bathan','2','ৰুপিয় বথন','1'),
('318','Bargaon','4','বৰ্গওঁ','1'),
('319','Bali','4','বলি','1'),
('320','Balikariya','1','বলিকৰিয়','1'),
('321','Balakuchi','1','বলকুচি','1'),
('322','Sondha kairara','1','সোন্ধ কৈৰৰ','1'),
('323','Barmurikona','1','বৰ্মুৰিকোন','1'),
('324','Nalbari Town','1','নল্বৰি তোৱন','1'),
('325','Arara','1','অৰৰ','1'),
('326','Mugkuchi','1','মুগকুচি','1'),
('327','Bhadra','1','ভদ্ৰ','1'),
('328','Khukhundi','6','খুখুন্দি','1'),
('329','Khudrakulhati','7','খুদ্ৰকুলহতি','1'),
('330','Kayakuchi','5','কয়কুচি','1'),
('331','Bhanukuchi','5','ভনুকুচি','1'),
('332','Chilling','5','চিল্লিং','1'),
('333','Kayajeni','5','কয়জেনি','1'),
('334','Kundargaonjabarihati','5','কুন্দৰ্গওঞ্জবৰিহতি','1'),
('335','Nagaon','5','নগওঁ','1'),
('336','4 No. Balitara','5','৪ নং বলিতৰ','1'),
('337','Sungar Bari','3','সুঙৰ বৰি','1'),
('338','Napara Pam','3','নপৰ পম','1'),
('339','Puran Saprapara','3','পুৰন সপ্ৰপৰ','1'),
('340','Paikan Banmaza','3','পৈকন বন্মজ','1'),
('341','Paikan Dirua','3','পৈকন দিৰুঅ','1'),
('342','2 No. Larkuchi','3','২ নং লৰ্কুচি','1'),
('343','Damalgaon','3','দমল্গওঁ','1'),
('344','2 No. Narua','3','২ নং নৰুঅ','1'),
('345','1 No. Bardhanara','5','১ নং বৰ্ধনৰ','1'),
('346','Amara','5','অমৰ','1'),
('347','Niz Pakowa   ','2','নিজ পকোৱা ','1'),
('348','Jagara   ','2','জাগাৰ ','1'),
('349','Dahudi','2','দহুদি','1'),
('350','Sukekuchi','2','সুকেকুচি','1'),
('351','Khudramakhibaha','4','খুদ্ৰমখিবহ','1'),
('352','Piplibari','4','পিপ্লিবৰি','1'),
('353','Barbhagjari','4','বৰ্ভগজৰি','1'),
('354','Nandagaon','1','নন্দগওঁ','1'),
('355','Dakhin Bejara','1','দখিন বেজৰ','1'),
('356','Pandula','7','পন্দুল','1'),
('357','Morowa','7','মোৰোৱ','1'),
('358','Sathamou','5','সথমৌ','1'),
('359','Paisara','5','পৈসৰ','1'),
('360','Arara','5','অৰৰ','1'),
('361','Narayangaon','5','নৰয়ঙওঁ','1'),
('362','Hanapara','3','হনপৰ','1'),
('363','Adabari','3','অদবৰি','1'),
('364','1 No. Barbala','3','১ নং বৰ্বল','1'),
('365','Kurihamari','3','কুৰিহমৰি','1'),
('366','1 No. Bhelengimari','3','১ নং ভেলেঙিমৰি','1'),
('367','Mularghat','3','মুলৰ্ঘত','1'),
('368','2 No. Daulashal','3','২ নং দৌলশল','1'),
('369','Amrattari','3','অম্ৰত্তৰি','1'),
('370','Koltali','3','কোলতলি','1'),
('371','Bangnaputa','3','বংনপুত','1'),
('372','Madhupur','6','মধুপুৰ','1'),
('373','Arikuchi','7','অৰিকুচি','1'),
('374','Bhabanipur','7','ভবনিপুৰ','1'),
('375','Dhurkuchi','5','ধুৰ্কুচি','1'),
('376','Larmabatakuchi','7','লৰ্মবতকুচি','1'),
('377','Barnardi   ','2','বৰনৰ্দী ','1'),
('378','Bari','2','বৰি','1'),
('379','Niztapa','2','নিজতপ','1'),
('380','Nakhara','4','নখৰ','1'),
('381','Nizkhana','4','নিজখন','1'),
('382','Paramankhoua','4','পৰমঙখৌঅ','1'),
('383','Pitanipara','1','পিতনিপৰ','1'),
('384','Niz-Batahgila','1','নিজবতহগিল','1'),
('385','Barpipaliya','1','বৰ্পিপলিয়','1'),
('386','Namdonga','1','নমদোঙ','1'),
('387','Kardoitola','1','কৰ্দৈতোল','1'),
('388','Dhamdhama','1','ধমধম','1'),
('389','Madanmahan Sakhowa','1','মদন্মহন সখোৱ','1'),
('390','Barbarara','7','বৰ্বৰৰ','1'),
('391','Pajipar','7','পজিপৰ','1'),
('392','Kalag','7','কলগ','1'),
('393','Ratkuchi','7','ৰত্কুচি','1'),
('394','Rampur Ajagara','5','ৰম্পুৰ অজগৰ','1'),
('395','Dalua','5','দলুঅ','1'),
('396','Kundargaon','5','কুন্দৰ্গওঁ','1'),
('397','Paschim Nalbari','5','পস্ক্িম নল্বৰি','1'),
('398','Barbistupur','5','বৰ্বিস্তুপুৰ','1'),
('399','Khudra Bistupur','5','খুদ্ৰ বিস্তুপুৰ','1'),
('400','2 No. Natun Saprapara','3','২ নং নতুন সপ্ৰপৰ','1'),
('401','1 No. Bartola','3','১ নং বৰ্তোল','1'),
('402','Chanda','3','চন্দ','1'),
('403','2 No. Jaysagar','3','২ নং জয়সগৰ','1'),
('404','Batamari','3','বতমৰি','1'),
('405','1 No. ghorashal','3','১ নং ঘোৰশল','1'),
('406','Khagrakati','3','খগ্ৰকতি','1'),
('407','Barjabarihati','5','বৰ্জবৰিহতি','1'),
('408','Thanpatkuchi','7','থনপত্কুচি','1'),
('409','Barkhetri Barni ','2','বৰক্ষেত্রি বৰ্নি ','1'),
('410','Kathala','2','কথল','1'),
('411','Bamunbori','4','বমুনবোৰি','1'),
('412','Dhantola','1','ধন্তোল','1'),
('413','Khudrapipaliya','1','খুদ্ৰপিপলিয়','1'),
('414','Balikaria Kharjara','1','বলিকৰিঅ খৰ্জৰ','1'),
('415','Deharkalakuchi','1','দেহৰ্কলকুচি','1'),
('416','Sarubarara','7','সৰুবৰৰ','1'),
('417','Nanoi','7','ননৈ','1'),
('418','Dingdingi','7','দিং্দিঙি','1'),
('419','Majarbari','5','মজৰ্বৰি','1'),
('420','Chenikuchi','5','চেনিকুচি','1'),
('421','Tinipukhuri','5','তিনিপুখুৰি','1'),
('422','4 No. Sagarkuchi','5','৪ নং সগৰ্কুচি','1'),
('423','3 No. Natun Saprapara','3','৩ নং নতুন সপ্ৰপৰ','1'),
('424','3 No. Kaplabori','3','৩ নং কপ্লবোৰি','1'),
('425','Kharsitha','6','খৰ্সিথ','1'),
('426','Satma','7','সতম','1'),
('427','Dipta','9','দিপ্ত','1'),
('428','Sandhali','2','সন্ধলি','1'),
('429','Dehar Balowa   ','2','দেহৰ বলোৱা ','1'),
('430','Mohbiyeni   ','2','মোহবিয়েনি ','1'),
('431','Kakaya','2','ককয়','1'),
('432','Ranakuchi','4','ৰনকুচি','1'),
('433','Barmakhibaha','4','বৰ্মখিবহ','1'),
('434','Bhojkuchi','4','ভোজকুচি','1'),
('435','Khudra Agra','1','খুদ্ৰ অগ্ৰ','1'),
('436','Paila','1','পৈল','1'),
('437','Kumarikata','1','কুমৰিকত','1'),
('438','Madhapur','1','মধপুৰ','1'),
('439','Sonkani','7','সোঙ্কনি','1'),
('440','Dhaniyagog','7','ধঞগোগ','1'),
('441','Kotalkuchi','7','কোতল্কুচি','1'),
('442','Barkuriha','7','বৰ্কুৰিহ','1'),
('443','Rangafali','5','ৰঙফলি','1'),
('444','2 No. Balitara','5','২ নং বলিতৰ','1'),
('445','Pub-Barsiral','5','পুববৰ্সিৰল','1'),
('446','Nilpur','5','নিল্পুৰ','1'),
('447','Jugurkuchi Sripur','5','জুগুৰ্কুচি শ্রীপুৰ','1'),
('448','Hamlakur','3','হমলকুৰ','1'),
('449','Sakirghat','3','সকিৰ্ঘত','1'),
('450','satemari','3','সতেমৰি','1'),
('451','Sarusuliya','3','সৰুসুলিয়','1'),
('452','Bardhap','3','বৰ্ধপ','1'),
('453','Ghruwabahagaon','3','ঘ্ৰুৱবহগওঁ','1'),
('454','1 No. Daulashal','3','১ নং দৌলশল','1'),
('455','3 No. Larkuchi','3','৩ নং লৰ্কুচি','1'),
('456','2 No. Ghorashal','3','২ নং ঘোৰশল','1'),
('457','Paschim Kaija','3','পস্ক্িম কৈজ','1'),
('458','Madhya Kaija','3','মধ্য কৈজ','1'),
('459','Kalarsor','3','কলৰ্সোৰ','1'),
('460','Balijar','6','বলিজৰ','1'),
('461','Bejkuchi','7','বেজকুচি','1'),
('462','Dhamdhama','5','ধমধম','1'),
('463','Nilacha','2','নিলচ','1'),
('464','Kutnikuch','2','কুত্নিকুচ','1'),
('465','Lakhopur','2','লখোপুৰ','1'),
('466','Thuthikata   ','2','ঠুঠিকাটা ','1'),
('467','Belsar   ','2','বেলসৰ ','1'),
('468','Chengnoi','1','চেংনৈ','1'),
('469','Garamara','1','গৰমৰ','1'),
('470','Namati','1','নমতি','1'),
('471','Haripur','1','হৰিপুৰ','1'),
('472','Nalbari Town Barsilakuti Part','1','নল্বৰি তোৱন বৰ্সিলকুতি পৰত','1'),
('473','Sahpur','1','সহপুৰ','1'),
('474','Jajiyabari','1','জজিয়বৰি','1'),
('475','Digheli','1','দিঘেলি','1'),
('476','Dokuchi','1','দোকুচি','1'),
('477','Barajara','1','বৰজৰ','1'),
('478','Kasimpur','6','কসিম্পুৰ','1'),
('479','Kaithalkuchi','6','কৈথল্কুচি','1'),
('480','Barkulhati','7','বৰ্কুলহতি','1'),
('481','Kamarkuchi','7','কমৰ্কুচি','1'),
('482','Barbukiya','7','বৰ্বুকিয়','1'),
('483','Sato Alliya','5','সতো অল্লিয়','1'),
('484','Barghopa','5','বৰ্ঘোপ','1'),
('485','Ghoga','3','ঘোগ','1'),
('486','2 No. Bhelamari','3','২ নং ভেলমৰি','1'),
('487','3 No. Bhelamari','3','৩ নং ভেলমৰি','1'),
('488','2 No. Barbala','3','২ নং বৰ্বল','1'),
('489','Adattari','3','অদত্তৰি','1'),
('490','Haulighat','3','হৌলিঘত','1'),
('491','Mugddi','3','মুগদ্দি','1'),
('492','Narpara','5','নৰ্পৰ','1'),
('493','Barkhala','7','বৰ্খল','1'),
('494','Dipta','9','দিপ্ত','1'),
('495','Barjhar','9','বৰ্ঝৰ','1'),
('496','Parowa','1','পৰোৱ','1'),
('497','Ie   ','0','ঈে ','0'),
('498','Gopal Bazar   ','0','গোপাল বাজাৰ ',NULL),
('1000','Nakheti','8',NULL,'1'),
('1001','madhapur','9','মাধাপুৰa','0');
-- FOREIGN KEY


-- 
-- Foreign Key for Table [AREAOFWORK]
--

ALTER TABLE areaofwork ADD CONSTRAINT areaofwork_ibfk_1 FOREIGN KEY (Branch_Code) REFERENCES branch_section(Branch_Code);

-- 
-- Foreign Key for Table [BAKIJAI_CASEDATE]
--

ALTER TABLE bakijai_casedate ADD CONSTRAINT bakijai_casedate_ibfk_1 FOREIGN KEY (Case_Id) REFERENCES bakijai_main(Case_Id);
ALTER TABLE bakijai_casedate ADD CONSTRAINT bakijai_casedate_ibfk_2 FOREIGN KEY (Notice_Type) REFERENCES noticetype(CODE);

-- 
-- Foreign Key for Table [BAKIJAI_MAIN]
--

ALTER TABLE bakijai_main ADD CONSTRAINT bakijai_main_ibfk_1 FOREIGN KEY (Circle) REFERENCES circle(Cir_code);
ALTER TABLE bakijai_main ADD CONSTRAINT bakijai_main_ibfk_2 FOREIGN KEY (Mouza) REFERENCES mouza(Mouza_Code);
ALTER TABLE bakijai_main ADD CONSTRAINT bakijai_main_ibfk_3 FOREIGN KEY (Vill_Code) REFERENCES village(Vill_Code);
ALTER TABLE bakijai_main ADD CONSTRAINT bakijai_main_ibfk_4 FOREIGN KEY (Polst_Code) REFERENCES police_station(Code);
ALTER TABLE bakijai_main ADD CONSTRAINT bakijai_main_ibfk_5 FOREIGN KEY (Bank) REFERENCES bank_master(Bank_Name);
ALTER TABLE bakijai_main ADD CONSTRAINT bakijai_main_ibfk_6 FOREIGN KEY (Bank,Branch) REFERENCES bankbranch(Bank,Branch);

-- 
-- Foreign Key for Table [BAKI_PAYMENT]
--

ALTER TABLE baki_payment ADD CONSTRAINT baki_payment_ibfk_1 FOREIGN KEY (Case_id) REFERENCES bakijai_main(Case_Id);

-- 
-- Foreign Key for Table [BANKBRANCH]
--

ALTER TABLE bankbranch ADD CONSTRAINT bankbranch_ibfk_1 FOREIGN KEY (Bank) REFERENCES bank_master(Bank_Name);

-- 
-- Foreign Key for Table [MOUZA]
--

ALTER TABLE mouza ADD CONSTRAINT mouza_ibfk_1 FOREIGN KEY (Cir_Code) REFERENCES circle(Cir_code);

-- 
-- Foreign Key for Table [PETITION_MASTER]
--

ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_1 FOREIGN KEY (Circle_Code) REFERENCES circle(Cir_code);
ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_2 FOREIGN KEY (Mauza_Code) REFERENCES mouza(Mouza_Code);
ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_3 FOREIGN KEY (vill_code) REFERENCES village(Vill_Code);
ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_4 FOREIGN KEY (PS_Code) REFERENCES police_station(Code);

-- 
-- Foreign Key for Table [PWD]
--

ALTER TABLE pwd ADD CONSTRAINT pwd_ibfk_1 FOREIGN KEY (Branch_Code) REFERENCES branch_section(Branch_Code);
ALTER TABLE pwd ADD CONSTRAINT pwd_ibfk_2 FOREIGN KEY (ROLL) REFERENCES roll(Roll);

-- 
-- Foreign Key for Table [UPDATE_HISTORY]
--

ALTER TABLE update_history ADD CONSTRAINT update_history_ibfk_1 FOREIGN KEY (Case_Id) REFERENCES bakijai_main(Case_Id);

-- 
-- Foreign Key for Table [USERLOGIN]
--

ALTER TABLE userlogin ADD CONSTRAINT userlogin_ibfk_1 FOREIGN KEY (uid) REFERENCES pwd(UID);

-- 
-- Foreign Key for Table [VILLAGE]
--

ALTER TABLE village ADD CONSTRAINT village_ibfk_1 FOREIGN KEY (Cir_Code) REFERENCES circle(Cir_code);

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

-- (Area_Code,Area_Name,Branch_Code)

INSERT INTO areaofwork values(1,'New Case Registration',1);
INSERT INTO areaofwork values(2,'Collection Updation',1);
INSERT INTO areaofwork values(3,'Issue Certificate',1);
INSERT INTO areaofwork values(4,'Bank Deposit Updation',1);
INSERT INTO areaofwork values(5,'Print Jamabandi',2);
INSERT INTO areaofwork values(6,'Entry Dak',3);
INSERT INTO areaofwork values(7,'Enter Petition',4);
INSERT INTO areaofwork values(8,'Process Certificate(PRC,Caste,etc)',4);
INSERT INTO areaofwork values(9,'Issue Certificate',4);
INSERT INTO areaofwork values(10,'Issue Notice',1);
INSERT INTO areaofwork values(11,'Update Old Payment',1);
INSERT INTO areaofwork values(12,'Process Eroll',4);
INSERT INTO areaofwork values(13,'Process Jamabandi',4);
INSERT INTO areaofwork values(14,'Process Legal Heir',4);
INSERT INTO areaofwork values(15,'Case Particular Modification',1);
INSERT INTO areaofwork values(16,'Interest Updation',1);
INSERT INTO areaofwork values(17,'High Court Case',6);
INSERT INTO areaofwork values(18,'Process Bakijai',4);
INSERT INTO areaofwork values(19,'Edit Petition',4);

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
 PRIMARY KEY (Case_Id,Day)
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
 PRIMARY KEY (Case_ID)
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

-- (RSL,Bank,Branch)

INSERT INTO bankbranch values(NULL,'AFC','Nalbari');
INSERT INTO bankbranch values(1,'AGVB','Bangaon');
INSERT INTO bankbranch values(NULL,'AGVB','Barajol');
INSERT INTO bankbranch values(2,'AGVB','Barama');
INSERT INTO bankbranch values(3,'AGVB','Barni');
INSERT INTO bankbranch values(4,'AGVB','Barnibari');
INSERT INTO bankbranch values(5,'AGVB','Chamata');
INSERT INTO bankbranch values(6,'AGVB','Dhamdhama');
INSERT INTO bankbranch values(7,'AGVB','Dwarkuchi');
INSERT INTO bankbranch values(8,'AGVB','Ghagrapar');
INSERT INTO bankbranch values(10,'AGVB','Gopal Bazar, Nalbari');
INSERT INTO bankbranch values(11,'AGVB','Haribhanga');
INSERT INTO bankbranch values(12,'AGVB','Jagara');
INSERT INTO bankbranch values(13,'AGVB','Joysagar');
INSERT INTO bankbranch values(14,'AGVB','Kaithalkuchi');
INSERT INTO bankbranch values(15,'AGVB','Kaplabari');
INSERT INTO bankbranch values(16,'AGVB','Karia');
INSERT INTO bankbranch values(17,'AGVB','Marowa');
INSERT INTO bankbranch values(18,'AGVB','Nalbari');
INSERT INTO bankbranch values(19,'AGVB','Rampur');
INSERT INTO bankbranch values(20,'AGVB','Solmara');
INSERT INTO bankbranch values(21,'AGVB','Tihu');
INSERT INTO bankbranch values(22,'AGVB','Tihu Chowk');
INSERT INTO bankbranch values(NULL,'Allahabad Bank','Balitara');
INSERT INTO bankbranch values(23,'Allahabad Bank','Nalbari');
INSERT INTO bankbranch values(24,'Apex Bank','Nalbari');
INSERT INTO bankbranch values(25,'Apex Bank','Tihu');
INSERT INTO bankbranch values(NULL,'ASDC','Nalbari');
INSERT INTO bankbranch values(26,'Bank of India','Adabari');
INSERT INTO bankbranch values(27,'Bank of India','Bahjani');
INSERT INTO bankbranch values(28,'Bank of India','Loharkatha');
INSERT INTO bankbranch values(NULL,'Bank of India','Nalbari');
INSERT INTO bankbranch values(NULL,'Bijoya Bank','Nalbari');
INSERT INTO bankbranch values(0,'Canara Bank','Gopal Bazar');
INSERT INTO bankbranch values(29,'Canara Bank','Nalbari');
INSERT INTO bankbranch values(30,'CBI','Baharghat');
INSERT INTO bankbranch values(NULL,'CBI','Banbhag');
INSERT INTO bankbranch values(31,'CBI','Belsor');
INSERT INTO bankbranch values(NULL,'CBI','Datara');
INSERT INTO bankbranch values(32,'CBI','Dhamdhama');
INSERT INTO bankbranch values(33,'CBI','Ghagrapar');
INSERT INTO bankbranch values(0,'CBI','Kalag');
INSERT INTO bankbranch values(34,'CBI','Mukalmua');
INSERT INTO bankbranch values(35,'CBI','Nalbari');
INSERT INTO bankbranch values(36,'CBI','Nathkuchi');
INSERT INTO bankbranch values(NULL,'CBI','Nayabasti');
INSERT INTO bankbranch values(NULL,'DFDC','Nalbari');
INSERT INTO bankbranch values(NULL,'EMTC','Nalbari');
INSERT INTO bankbranch values(NULL,'Fishery','Nalbari');
INSERT INTO bankbranch values(NULL,'Forest','Nalbari');
INSERT INTO bankbranch values(59,'HDFC','Nalbari');
INSERT INTO bankbranch values(NULL,'HMT','Nalbari');
INSERT INTO bankbranch values(NULL,'Housing','Nalbari');
INSERT INTO bankbranch values(60,'ICICI Bank','Harimandir Chowk');
INSERT INTO bankbranch values(NULL,'MACT','Nalbari');
INSERT INTO bankbranch values(NULL,'MIDC','Nalbari');
INSERT INTO bankbranch values(58,'Mini Co-Operative Bank','Barbhag Kalag');
INSERT INTO bankbranch values(NULL,'Misc','-');
INSERT INTO bankbranch values(NULL,'Misc','Nalbari');
INSERT INTO bankbranch values(NULL,'NMB','Nalbari');
INSERT INTO bankbranch values(38,'PNB','Amayapur');
INSERT INTO bankbranch values(39,'PNB','Barajol');
INSERT INTO bankbranch values(0,'PNB','Barama');
INSERT INTO bankbranch values(40,'PNB','Nalbari');
INSERT INTO bankbranch values(57,'Post Office','Nalbari');
INSERT INTO bankbranch values(56,'SBI','Bazar Branch');
INSERT INTO bankbranch values(41,'SBI','Kalag');
INSERT INTO bankbranch values(42,'SBI','Kamarkuchi');
INSERT INTO bankbranch values(43,'SBI','Makhibaha');
INSERT INTO bankbranch values(44,'SBI','Mukalmua');
INSERT INTO bankbranch values(45,'SBI','Nalbari');
INSERT INTO bankbranch values(NULL,'SBI','Piplibari');
INSERT INTO bankbranch values(56,'SBI','Tihu');
INSERT INTO bankbranch values(NULL,'SCDC','Nalbari');
INSERT INTO bankbranch values(NULL,'Syndicate Bank','Nalbari');
INSERT INTO bankbranch values(56,'UBI','Nalbari');
INSERT INTO bankbranch values(NULL,'UCO','Mukalmua');
INSERT INTO bankbranch values(48,'UCO','Nalbari');
INSERT INTO bankbranch values(49,'UCO','Tihu');
INSERT INTO bankbranch values(51,'Union Bank','Nalbari');
INSERT INTO bankbranch values(52,'Union Bank','Rangia');
INSERT INTO bankbranch values(0,'Union Co-Operative Bank','Tihu');
INSERT INTO bankbranch values(54,'Urban Cooperative Bank','Chamata');
INSERT INTO bankbranch values(53,'Urban Cooperative Bank','Nalbari');

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

-- (Bank_Name,BType)

INSERT INTO bank_master values('aaaaa','Financial');
INSERT INTO bank_master values('AFC','Financial');
INSERT INTO bank_master values('AGVB','Financial');
INSERT INTO bank_master values('Allahabad Bank','Financial');
INSERT INTO bank_master values('Apex Bank','Financial');
INSERT INTO bank_master values('ASDC','Non Financial');
INSERT INTO bank_master values('Bank of India','Financial');
INSERT INTO bank_master values('Bijoya Bank','Financial');
INSERT INTO bank_master values('Canara Bank','Financial');
INSERT INTO bank_master values('CBI','Financial');
INSERT INTO bank_master values('DFDC','Non Financial');
INSERT INTO bank_master values('EMTC','Non Financial');
INSERT INTO bank_master values('Fishery','Non Financial');
INSERT INTO bank_master values('Forest','Non Financial');
INSERT INTO bank_master values('HDFC','Financial');
INSERT INTO bank_master values('HMT','Non Financial');
INSERT INTO bank_master values('Housing','Non Financial');
INSERT INTO bank_master values('ICICI Bank','Financial');
INSERT INTO bank_master values('MACT','Non Financial');
INSERT INTO bank_master values('MIDC','Non Financial');
INSERT INTO bank_master values('Mini Co-Operative Bank','Financial');
INSERT INTO bank_master values('MISC','Non Financial');
INSERT INTO bank_master values('NIL',NULL);
INSERT INTO bank_master values('NMB','Non Financial');
INSERT INTO bank_master values('PGB','Nalbari');
INSERT INTO bank_master values('PNB','Financial');
INSERT INTO bank_master values('Post Office','Financial');
INSERT INTO bank_master values('SBI','Financial');
INSERT INTO bank_master values('SCDC','Non Financial');
INSERT INTO bank_master values('Syndicate Bank','Financial');
INSERT INTO bank_master values('UBI','Financial');
INSERT INTO bank_master values('UCO','Financial');
INSERT INTO bank_master values('Union Bank','Financial');
INSERT INTO bank_master values('Union Co-Operative Bank','Financial');
INSERT INTO bank_master values('Urban Cooperative Bank','Financial');
INSERT INTO bank_master values('wwwew','Financial');

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

-- (Branch_Code,Branch_Name)

INSERT INTO branch_section values(0,'All Branch');
INSERT INTO branch_section values(1,'Bakijai');
INSERT INTO branch_section values(2,'Revenue');
INSERT INTO branch_section values(3,'Personnel');
INSERT INTO branch_section values(4,'Administration(PFC)');
INSERT INTO branch_section values(5,'Magistracy');
INSERT INTO branch_section values(6,'PA');

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

-- (Cir_code,Circle,Circle_Ass)

INSERT INTO circle values(0,'-','.');
INSERT INTO circle values(1,'Nalbari','নলবাৰী');
INSERT INTO circle values(2,'Paschim Nalbari','পশ্চিম নলবাৰী');
INSERT INTO circle values(3,'Barkhetry Circle','বৰক্ষেত্রী');
INSERT INTO circle values(4,'Tihu','টিহু');
INSERT INTO circle values(5,'Ghagrapar','ঘগ্ৰাপাৰ');
INSERT INTO circle values(6,'Banekuchi','বানেকুচি');
INSERT INTO circle values(7,'Barbhag','বৰভাগ');
INSERT INTO circle values(8,'Baganpara','বাগানপাৰা');
INSERT INTO circle values(9,'Barama','বৰমা');
INSERT INTO circle values(10,'Goreswar',NULL);
INSERT INTO circle values(11,'dhasd','ffff');
INSERT INTO circle values(12,'LLL',NULL);

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
-- Structure for Table [MONTHNAME]
-- 

CREATE TABLE IF NOT EXISTS monthname(
monthcode int  NOT NULL ,
montheng varchar(20),
no_days int,
 PRIMARY KEY (monthcode)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



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
-- Structure for Table [NOTICETYPE]
-- 

CREATE TABLE IF NOT EXISTS noticetype(
CODE int  DEFAULT '0'   NOT NULL ,
NOTICEDETAIL varchar(30),
 PRIMARY KEY (CODE)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



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
-- Structure for Table [PETITION_CHANGED]
-- 

CREATE TABLE IF NOT EXISTS petition_changed(
Pet_yr char(4)  NOT NULL ,
Pet_type varchar(2)  NOT NULL ,
Pet_no bigint  NOT NULL ,
Applicant varchar(70)  NOT NULL ,
Father varchar(60),
Mother varchar(50),
 PRIMARY KEY (Pet_yr,Pet_no)
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
ServiceId varchar(2),
 PRIMARY KEY (Code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [PETITION_TYPE]
-- 

-- (Code,Detail,Running,Xohari_ServiceId,Abvr,Fees,ServiceId)

INSERT INTO petition_type values('BK','Bakijai Clearence Certificate','Y',0,'Bakijai',20,NULL);
INSERT INTO petition_type values('BR','Birth Certificate','N',0,'Birth',0,NULL);
INSERT INTO petition_type values('CT','Caste Certificate','Y',0,'Caste',0,'34');
INSERT INTO petition_type values('DH','Death Certificate','N',0,'Death',0,NULL);
INSERT INTO petition_type values('DM','Domicile Certificate','N',0,'Domicile',0,NULL);
INSERT INTO petition_type values('ER','Certified Electoral Roll ','Y',0,'E. Roll',20,NULL);
INSERT INTO petition_type values('JB','Jamabandi Copy','Y',0,'Jamabandi',0,NULL);
INSERT INTO petition_type values('LH','Legal Heir Certificate(Next to Kin)','Y',0,'Legal Heir',0,'36');
INSERT INTO petition_type values('LV','Land Valuation Certificate','N',0,'Land Value',0,NULL);
INSERT INTO petition_type values('NC','Non Creme Layer Certificate','Y',0,'Non Creamy',0,'35');
INSERT INTO petition_type values('PR','Permenant Residence Certificate','Y',0,'PRC',50,'42');

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
-- Dumping Data for Table [POLICE_STATION]
-- 

-- (Code,Name,Name_Ass)

INSERT INTO police_station values(0,'-','-');
INSERT INTO police_station values(1,'Nalbari','নলবাৰী');
INSERT INTO police_station values(2,'Barbhag','বৰভাগ');
INSERT INTO police_station values(3,'Ghagrapar','ঘগ্ৰাপাৰৰপৰপৰdd');
INSERT INTO police_station values(4,'Belsor','বেলশৰ');
INSERT INTO police_station values(5,'Mukalmua','মুকালমুৱা');
INSERT INTO police_station values(6,'Tihu','টিহু');
INSERT INTO police_station values(7,'Barama','-');

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

-- (UID,PWD,ROLL,Active,FullName,Branch_Code,FirstLogin,Area)

INSERT INTO pwd values('anamika','Dbpdqnqhk',2,'Y','Anamika Chakrabarty',3,'N','6');
INSERT INTO pwd values('Anupam','CBPXTFSj',2,'Y','Anupam Talukdar',4,'N','7,9');
INSERT INTO pwd values('DA','?ecf',3,'Y','Assistant for DAK Status Updation',0,'N','0');
INSERT INTO pwd values('hriday','Citlhfj',2,'Y','Hriday Bhatta',6,'N','17');
INSERT INTO pwd values('mamoni','Anqqmh',2,'Y','Mamani Garo',1,'N','1,2,4,10,16');
INSERT INTO pwd values('Naba','@omqg',2,'Y','Naba Kishor Nath',1,'N','1,2,3,4,10,16');
INSERT INTO pwd values('root','Cokf457j',0,'Y','System User',0,'N','0');
INSERT INTO pwd values('super','Etwsiw79;l',2,'Y','super User',0,'N','0');
INSERT INTO pwd values('wahida','Ftwqjqu~m{m',2,'Y','Wahida Rahman',1,'N','1,2,10');

-- 
-- Structure for Table [RELATION]
-- 

CREATE TABLE IF NOT EXISTS relation(
Rel_name varchar(20)  NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Dumping Data for Table [RELATION]
-- 

-- (Rel_name)

INSERT INTO relation values('Son of');
INSERT INTO relation values('Daughter of');
INSERT INTO relation values('Wife of');

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

-- (Roll,Description)

INSERT INTO roll values(0,'Administrator');
INSERT INTO roll values(2,'Super User');
INSERT INTO roll values(3,'General Operator');
INSERT INTO roll values(4,'Guest');

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

-- (Code,Detail)

INSERT INTO sex values('F','Female');
INSERT INTO sex values('M','Male');
INSERT INTO sex values('O','Other');

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

-- (Slno,detail)

INSERT INTO subcaste values(1,'Mukhi');
INSERT INTO subcaste values(2,'Nath');
INSERT INTO subcaste values(3,'Napit');
INSERT INTO subcaste values(4,'Dhobi');
INSERT INTO subcaste values(5,'Bania');
INSERT INTO subcaste values(6,'Jalo');
INSERT INTO subcaste values(7,'Sutradhar');
INSERT INTO subcaste values(8,'Hira');
INSERT INTO subcaste values(9,'Jogi');
INSERT INTO subcaste values(10,'Namasudra');
INSERT INTO subcaste values(11,'Kaibarta');
INSERT INTO subcaste values(12,'Basfor');
INSERT INTO subcaste values(13,'Mali');
INSERT INTO subcaste values(14,'Jalkeot');
INSERT INTO subcaste values(15,'Muchi');
INSERT INTO subcaste values(16,'Harijon');
INSERT INTO subcaste values(17,'Rishi');

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
 PRIMARY KEY (Session_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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

-- (Vill_Code,Vill_Name,Cir_Code,Vill_Name_Ass,Revenue_Village)

INSERT INTO village values(0,'-',0,'.',1);
INSERT INTO village values(1,'Chariya   ',1,'চৰিয়া ',1);
INSERT INTO village values(2,'Panigaon   ',2,'পানীগাওঁ ',1);
INSERT INTO village values(3,'Churchuri   ',2,'চুৰচুৰি ',1);
INSERT INTO village values(4,'Khakhrisal   ',2,'খখৃসল ',1);
INSERT INTO village values(5,'   ',6,' ',1);
INSERT INTO village values(6,'Khatanam Barbhag   ',6,'খাটানাম বৰভাগ ',1);
INSERT INTO village values(7,'Jugarbari   ',7,'জুগৰবৰি ',1);
INSERT INTO village values(8,'Uttarkuchi   ',7,'উত্তৰকুচি ',1);
INSERT INTO village values(9,'Purna Kamdev',7,'পুৰ্ন কমদেৱ',1);
INSERT INTO village values(10,'Akhara   ',9,'আখৰা ',1);
INSERT INTO village values(11,'Dahkaniya ',9,'দহকনিয়া ',1);
INSERT INTO village values(12,'Murmela   ',4,'মুৰমেলা ',1);
INSERT INTO village values(15,'Dhamdhama   ',8,'ধমধমা ',1);
INSERT INTO village values(16,'Piplibari   ',2,'পিপলিবাৰি ',1);
INSERT INTO village values(17,'Khata Rupiya Bathan      ',2,'খাটা ৰূপিয়া বাঠান  ',1);
INSERT INTO village values(18,'Mularkuchi   ',2,'মুলাৰকুচি ',1);
INSERT INTO village values(19,'Nannatari   ',4,'নান্নতাৰি ',1);
INSERT INTO village values(21,'Barkhanajan   ',1,'বৰখানজান ',1);
INSERT INTO village values(22,'Nankarbhaira   ',1,'নানকাৰভৈৰা ',1);
INSERT INTO village values(24,'Pub Kalakuchi   ',1,'পূব কালাকুচি ',1);
INSERT INTO village values(25,'Barnagar Banekuchi   ',6,'বৰনগৰ বানেকুচি ',1);
INSERT INTO village values(26,'Baridatara   ',7,'বৰিদতৰা ',1);
INSERT INTO village values(27,'Jugurkuchi   ',7,'জুগুৰকুচি ',1);
INSERT INTO village values(28,'Akana   ',5,'অকনা ',1);
INSERT INTO village values(29,'Gatiyan   ',5,'গতিয়ান ',1);
INSERT INTO village values(30,'Chateibari   ',5,'চতেইবাৰি ',1);
INSERT INTO village values(31,'1 No. Sagarkuchi   ',5,'১ নং সাগৰকুচি ',1);
INSERT INTO village values(32,'4 No. Bhelamari   ',3,'৪ নং ভেলামাৰি ',1);
INSERT INTO village values(33,'4 No. Barbala',3,'৪ নং বৰ্বল',1);
INSERT INTO village values(34,'2 No. Bhelengimari   ',3,'২ নং ভেলেঙিমাৰি ',1);
INSERT INTO village values(35,'Balikuchi',3,'বলিকুচি',1);
INSERT INTO village values(36,'Khar Kaldi   ',3,'খাৰ কালদি ',1);
INSERT INTO village values(37,'Sandheli',6,'সন্ধেলি',1);
INSERT INTO village values(38,'Kismat ',7,'কিচমত ',1);
INSERT INTO village values(39,'Bihampur   ',2,'বিহামপুৰ ',1);
INSERT INTO village values(40,'Shimaliya   ',2,'শিমলিয়া ',1);
INSERT INTO village values(41,'Mohkhali',2,'মোহখলি',1);
INSERT INTO village values(42,'Barhelacha   ',2,'বৰহেলাচা ',1);
INSERT INTO village values(43,'Koihati   ',2,'কৈহাটি ',1);
INSERT INTO village values(44,'Fulguri   ',2,'ফুলগুৰি ',1);
INSERT INTO village values(45,'Bar Agra   ',1,'বৰ আগ্ৰা ',1);
INSERT INTO village values(46,'Moiradanga   ',1,'মৈৰাদঙ্গা ',1);
INSERT INTO village values(47,'Bhuyarkuchi ',1,'ভুঞাৰকুচি ',1);
INSERT INTO village values(48,'Barkura   ',1,'বৰকুৰা ',1);
INSERT INTO village values(49,'Katahkuchi   ',1,'কটাহকুচি ',1);
INSERT INTO village values(50,'Barchenikuchi   ',1,'বৰচেনিকুচি ',1);
INSERT INTO village values(51,'Sandha   ',1,'সন্ধা ',1);
INSERT INTO village values(52,'Tantrashankara   ',1,'তন্ত্রশঙ্কৰা ',1);
INSERT INTO village values(53,'Pashchim Khatar Kalakuchi   ',1,'পশ্চিম খাটাৰ কালাকুচি ',1);
INSERT INTO village values(54,'Amayapur   ',1,'অময়াপুৰ ',1);
INSERT INTO village values(55,'Rajakhat Banekuchi   ',6,'ৰাজাখাত বানেকুচি ',1);
INSERT INTO village values(56,'Porakuchi   ',7,'পোৰাকুচি ',1);
INSERT INTO village values(57,'Barshimaliya   ',7,'বৰশিমলিয়া ',1);
INSERT INTO village values(58,'Bala   ',7,'বালা ',1);
INSERT INTO village values(59,'Panbari   ',5,'পানবাৰি ',1);
INSERT INTO village values(60,'Bilpar   ',5,'বিলপাৰ ',1);
INSERT INTO village values(61,'Nizkhagata   ',5,'নিজখগটা ',1);
INSERT INTO village values(62,'1 No. Nimua Latima ',5,'১ নং নিমুৱা লটিমা  ',1);
INSERT INTO village values(63,'Bhelamari   ',5,'ভেলামাৰি ',1);
INSERT INTO village values(64,'Bhadrabangal   ',5,'ভদ্ৰবঙ্গাল ',1);
INSERT INTO village values(65,'Ghohkuchi Gathiyakuchi      ',5,'ঘোহকুচি গাঠিয়াকুচি  ',1);
INSERT INTO village values(66,'2 No. Balarttari   ',3,'২ নং বালাৰ্ত্তৰি ',1);
INSERT INTO village values(67,'Natun Chaprapara   ',3,'নতুন চাপ্ৰাপাৰা ',1);
INSERT INTO village values(68,'Tegherittari   ',3,'টেঘেৰিত্তাৰি ',1);
INSERT INTO village values(69,'Bamunditari   ',3,'বামুন্দিতাৰি ',1);
INSERT INTO village values(70,'4 No. Kaplabori',3,'৪ নং কাপলাবৰি',1);
INSERT INTO village values(71,'1 No. Larkuchi   ',3,'১ নং লাৰকুচি ',1);
INSERT INTO village values(72,'Pub Kajiya   ',3,'পূব কাজিয়া ',1);
INSERT INTO village values(73,'Peradhara   ',3,'পেৰাধৰা ',1);
INSERT INTO village values(74,'Nanke Pub Kajiya   ',3,'ননকে পূব কাজিয়া ',1);
INSERT INTO village values(75,'Samarkusi ',7,'চমাৰকুছি ',1);
INSERT INTO village values(76,'Barigaon   ',5,'বৰিগাওঁ ',1);
INSERT INTO village values(77,'Mahina   ',8,'মহিনা ',1);
INSERT INTO village values(78,'Nadla   ',2,'নদলা ',1);
INSERT INTO village values(79,'Ratanpur',4,'ৰতনপুৰ',1);
INSERT INTO village values(80,'Bakuwajari   ',4,'বকুৱাজাৰি ',1);
INSERT INTO village values(81,'Kendukuchi',1,'কেন্দুকুচি',1);
INSERT INTO village values(82,'Porakuchi   ',1,'পোৰাকুচি ',1);
INSERT INTO village values(83,'Bangnabari   ',6,'বাংনাবাৰি ',1);
INSERT INTO village values(84,'Khudra Dingdingi   ',7,'খুদ্ৰ দিংদিঙি ',1);
INSERT INTO village values(85,'Katuriya   ',5,'কাতুৰিয়া ',1);
INSERT INTO village values(86,'Patkata      ',5,'পাতকাটা  ',1);
INSERT INTO village values(87,'Majusiral   ',5,'মাজুসিৰাল ',1);
INSERT INTO village values(88,'Gargari      ',5,'গড়গড়ি  ',1);
INSERT INTO village values(89,'Dihjari   ',5,'দিহজাৰি ',1);
INSERT INTO village values(90,'Sutarkuchi   ',3,'সুতাৰকুচি ',1);
INSERT INTO village values(91,'5 No. Barbala   ',3,'৫ নং বৰবালা ',1);
INSERT INTO village values(92,'2 No. Bartola   ',3,'২ নং বৰতোলা ',1);
INSERT INTO village values(93,'Bhelakhaiti   ',3,'ভেলখাইতি ',1);
INSERT INTO village values(94,'Mukalmua ',3,'মুকালমুৱা ',1);
INSERT INTO village values(95,'Dagapara   ',3,'দাগাপাৰা ',1);
INSERT INTO village values(96,'Lauthari   ',3,'লাউথাৰি ',1);
INSERT INTO village values(97,'Suradi   ',9,'সুৰাদি ',1);
INSERT INTO village values(98,'Panigaon   ',2,'পানীগাওঁ ',1);
INSERT INTO village values(99,'Gadira',2,'গদিৰ',1);
INSERT INTO village values(100,'Pakhura',2,'পখুৰ',1);
INSERT INTO village values(101,'Bari',2,'বৰি',1);
INSERT INTO village values(102,'Gandhiya',2,'গন্ধিয়',1);
INSERT INTO village values(103,'Niz Namati   ',4,'নিজ নমাটি ',1);
INSERT INTO village values(104,'Barbari   ',4,'বৰবৰি ',1);
INSERT INTO village values(105,'Haribhanga   ',4,'হাৰিভাঙা ',1);
INSERT INTO village values(106,'Barsharkuchi   ',1,'বৰশৰকুচি ',1);
INSERT INTO village values(108,'Kshudrachenikuchi',1,'ক্ষুদ্ৰচেনিকুচি',1);
INSERT INTO village values(109,'Makaldaba   ',1,'মাকালদাবা ',1);
INSERT INTO village values(110,'Janigog   ',1,'জানিগোগ ',1);
INSERT INTO village values(111,'Kendukuchi',6,'কেন্দুকুচি',1);
INSERT INTO village values(112,'Toumura   ',6,'তৌমুৰা ',1);
INSERT INTO village values(113,'Kathalbari   ',6,'কঠালবাৰি ',1);
INSERT INTO village values(114,'Barkshetri Banekuchi   ',6,'বৰক্ষেত্রি বানেকুচি ',1);
INSERT INTO village values(115,'Moura',7,'মৌৰ',1);
INSERT INTO village values(116,'Nakheti',7,'নখেতি',1);
INSERT INTO village values(117,'Katpuha   ',7,'কতপুহা ',1);
INSERT INTO village values(118,'Narikuchi   ',5,'নাৰিকুচি ',1);
INSERT INTO village values(119,'Katakiya   ',5,'কটকিয়া ',1);
INSERT INTO village values(120,'Niz Barigog ',5,'নিজ বৰিগোগ ',1);
INSERT INTO village values(121,'3 No. Balitara   ',5,'৩ নং বালিতাৰা ',1);
INSERT INTO village values(122,'Barbhag Nalbari   ',5,'বৰভাগ নলবাৰি ',1);
INSERT INTO village values(123,'Badani Akhiya   ',3,'বদনি আখিয়া ',1);
INSERT INTO village values(124,'Angradi   ',3,'আংৰাদি ',1);
INSERT INTO village values(125,'Barchuliya   ',3,'বৰচুলিয়া ',1);
INSERT INTO village values(126,'Bhangnamari PGR',3,'ভাঙনামাৰি পি জি আৰ ',1);
INSERT INTO village values(127,'Khalihapara   ',3,'খালিহাপাৰা ',1);
INSERT INTO village values(128,'Naptipara   ',3,'নপ্তিপাৰা ',1);
INSERT INTO village values(129,'Ahara',3,'অহৰ',1);
INSERT INTO village values(130,'1 No. Kekankuchi   ',3,'১ নং কেকানকুচি ',1);
INSERT INTO village values(131,'2 No. Kekankuchi   ',3,'২ নং কেকানকুচি ',1);
INSERT INTO village values(132,'1 No. Naruwa   ',3,'১ নং নাৰুৱা ',1);
INSERT INTO village values(133,'Kaldi   ',3,'কালদি ',1);
INSERT INTO village values(134,'1 No. Kaplabari   ',3,'১ নং কাপলাবৰি ',1);
INSERT INTO village values(135,'2 No. Kaplabari      ',3,'২ নং কাপলাবৰি  ',1);
INSERT INTO village values(136,'Damdama Pathar   ',3,'দমদমা পথাৰ ',1);
INSERT INTO village values(137,'Banpura   ',3,'বনপুৰা ',1);
INSERT INTO village values(138,'Rampur   ',3,'ৰামপুৰ ',1);
INSERT INTO village values(139,'Sidalkuchi   ',3,'সিদালকুচি ',1);
INSERT INTO village values(140,'Barjhar   ',9,'বৰঝাৰ ',1);
INSERT INTO village values(141,'Mahina   ',5,'মহিনা ',1);
INSERT INTO village values(142,'Larakuchi   ',2,'লাৰকুচি ',1);
INSERT INTO village values(143,'Amani   ',2,'আমনি ',1);
INSERT INTO village values(144,'Gamerimuri   ',2,'গামেৰিমুৰি ',1);
INSERT INTO village values(145,'Sariyahtali',1,'সৰিয়হতলি',1);
INSERT INTO village values(146,'Dhekiyabari   ',1,'ধেকিয়াবাৰী ',1);
INSERT INTO village values(148,'Khat Katara   ',1,'খাট কটৰা ',1);
INSERT INTO village values(149,'Jamtola   ',1,'জামতোলা ',1);
INSERT INTO village values(150,'Teresiya   ',1,'তেৰেছিয়া ',1);
INSERT INTO village values(151,'Pajipar',1,'পজিপৰ',1);
INSERT INTO village values(152,'Japarkuchi   ',1,'জাপাৰকুচি ',1);
INSERT INTO village values(153,'Jaymangla   ',1,'জয়মঙ্গলা ',1);
INSERT INTO village values(154,'Chandakuchi   ',1,'চান্দকুচি ',1);
INSERT INTO village values(155,'Burinagar   ',6,'বুড়িনগৰ ',1);
INSERT INTO village values(156,'Bajali Udaypur   ',7,'বজালি উদয়পুৰ ',1);
INSERT INTO village values(157,'Bausi Udaypur   ',7,'বাউসি উদয়পুৰ ',1);
INSERT INTO village values(158,'Baghmara   ',5,'বাঘমাৰা ',1);
INSERT INTO village values(159,'Chatra   ',5,'চত্রা ',1);
INSERT INTO village values(160,'Hahdali   ',5,'হাহদলি ',1);
INSERT INTO village values(161,'Bangao   ',5,'বনগাও ',1);
INSERT INTO village values(162,'2 No. Sagarkuchi   ',5,'২ নং সাগৰকুচি ',1);
INSERT INTO village values(163,'Lautola   ',3,'লাউতোলা ',1);
INSERT INTO village values(164,'Loharkatha   ',3,'লোহাৰকাঠা ',1);
INSERT INTO village values(165,'Sabhamari   ',3,'সভামাৰি ',1);
INSERT INTO village values(166,'Baramara',3,'বৰমৰ',1);
INSERT INTO village values(167,'Narayanpur   ',3,'নাৰায়নপুৰ ',1);
INSERT INTO village values(168,'Diruwa   ',3,'দিৰুৱা ',1);
INSERT INTO village values(169,'Gharuwa Baha Pathar   ',3,'ঘৰুৱা বাহা পঠাৰ ',1);
INSERT INTO village values(170,'Balarsor   ',3,'বলৰসোৰ ',1);
INSERT INTO village values(171,'Bausiyapara   ',6,'বাউসিয়াপাৰা ',1);
INSERT INTO village values(172,'Deharkuchi   ',7,'দেহৰকুচি ',1);
INSERT INTO village values(173,'Billeshwar   ',2,'বিল্লেশ্বৰ ',1);
INSERT INTO village values(174,'Ghilajari (solmara)   ',2,'ঘিলাজাৰি সোলমাৰা ',1);
INSERT INTO village values(175,'Bihampur   ',2,'বিহামপুৰ ',1);
INSERT INTO village values(176,'Bhathuwakhana   ',4,'ভঠুৱাখানা ',1);
INSERT INTO village values(177,'Shaktipara   ',4,'শক্তিপাৰা ',1);
INSERT INTO village values(178,'BhutKatara ',1,'ভুত কটৰা ',1);
INSERT INTO village values(179,'Bishtupur   ',1,'বিষ্টুপুৰ ',1);
INSERT INTO village values(180,'Deharkatara   ',1,'দেহৰকটৰা ',1);
INSERT INTO village values(181,'Nalbari Town Khatabari Khanda ',1,'নলবাৰী টাউন খাটাবাৰী খণ্ড ',1);
INSERT INTO village values(182,'Jaha   ',1,'জাহা ',1);
INSERT INTO village values(183,'Niz Bahjani   ',1,'নিজ বাহজানি ',1);
INSERT INTO village values(184,'Tilana   ',1,'তিলানা ',1);
INSERT INTO village values(185,'Banbhag Solmari   ',6,'বনভাগ সোলমাৰি ',1);
INSERT INTO village values(186,'Bangalmur   ',7,'বঙ্গালমুৰ ',1);
INSERT INTO village values(187,'Ulabari   ',7,'উলাবড়ি ',1);
INSERT INTO village values(188,'2 No. Sonkuriha     ',7,'২ নং সোনকুৰিহা  ',1);
INSERT INTO village values(189,'Bhithamahal   ',5,'ভিথামহল ',1);
INSERT INTO village values(190,'Burburi   ',5,'বুৰবুৰি ',1);
INSERT INTO village values(192,'Uttar Barsiral   ',5,'উত্তৰ বৰসিৰাল ',1);
INSERT INTO village values(193,'Keheruya',5,'কেহেৰুয়',1);
INSERT INTO village values(194,'Sahan Bistupur   ',5,'সাহান বিস্তুপুৰ ',1);
INSERT INTO village values(195,'3 No. Barbala   ',3,'৩ নং বৰবালা ',1);
INSERT INTO village values(196,'Sapkata   ',3,'সাপকাতা ',1);
INSERT INTO village values(197,'Kandhbari   ',3,'কান্ধবাৰি ',1);
INSERT INTO village values(198,'Boithabhanga   ',3,'বৈঠাভঙ্গা ',1);
INSERT INTO village values(199,'Barnibari   ',3,'বৰ্নিবাৰি ',1);
INSERT INTO village values(200,'Kachuwapathar   ',3,'কচুৱাপথাৰ ',1);
INSERT INTO village values(201,'Gariya Angraddi   ',3,'গৰিয়া আংৰাদি',1);
INSERT INTO village values(202,'Kalputa   ',3,'কলপুতা ',1);
INSERT INTO village values(203,'Batsar   ',2,'বাটসৰ ',1);
INSERT INTO village values(204,'Goalpara ',2,'গোৱালপাৰা ',1);
INSERT INTO village values(205,'Gangapur   ',2,'গঙ্গাপুৰ ',1);
INSERT INTO village values(206,'Nizchamata   ',2,'নিজচামতা ',1);
INSERT INTO village values(207,'2 No. Nathkuchi   ',4,'২ নং নাঠকুচি ',1);
INSERT INTO village values(208,'Sathikuchi   ',4,'সাঠিকুচি ',1);
INSERT INTO village values(209,'Katlabarkuchi   ',1,'কটলা বৰকুচি ',1);
INSERT INTO village values(210,'Bardhantali   ',1,'বৰধানতলি ',1);
INSERT INTO village values(212,'Gobindapur',1,'গোবিন্দপুৰ',1);
INSERT INTO village values(213,'Balakuchi   ',1,'বলাকুচি ',1);
INSERT INTO village values(215,'Paikarkuchi   ',1,'পাইকাৰকুচি ',1);
INSERT INTO village values(216,'Guwakuchi   ',1,'গুৱাকুচি ',1);
INSERT INTO village values(217,'Balikuchi',1,'বলিকুচি',1);
INSERT INTO village values(218,'Balilecha',1,'বলিলেচ',1);
INSERT INTO village values(219,'Nalbari Gaon   ',1,'নলবাৰী গাওঁ ',1);
INSERT INTO village values(220,'Saplekuchi ',6,'চাপ্লেকুচি ',1);
INSERT INTO village values(221,'Ukhura   ',7,'উখুৰা ',1);
INSERT INTO village values(222,'Athghariya   ',7,'আঠঘৰিয়া ',1);
INSERT INTO village values(223,'Tarmatha   ',7,'তৰমথা ',1);
INSERT INTO village values(224,'Ghongarkuchi      ',5,'ঘোঙ্গৰকুচি  ',1);
INSERT INTO village values(225,'2 No. Nimua Latima ',5,'২ নং নিমুৱা লটিমা ',1);
INSERT INTO village values(226,'1 No. Balitara   ',5,'১ নং বালিতাৰা ',1);
INSERT INTO village values(227,'Sonkuriha   ',5,'সোনকুৰিহা ',1);
INSERT INTO village values(228,'3 No. Sagarkuchi   ',5,'৩ নং সাগৰকুচি ',1);
INSERT INTO village values(229,'Kalardiya VGR',3,'কালাৰ্দিয়া ভি জি আৰ ',1);
INSERT INTO village values(230,'1 No. Natun Chaprapara   ',3,'১ নং নতুন চাপ্ৰাপাৰা ',1);
INSERT INTO village values(231,'Bamun Angraddi      ',3,'বামুন আংৰাদি',1);
INSERT INTO village values(232,'Jowarddi   ',6,'জোৱাৰ্দ্দি ',1);
INSERT INTO village values(233,'Kariya   ',7,'কৰিয়া ',1);
INSERT INTO village values(235,'Kendubari   ',2,'কেন্দুবাৰী ',1);
INSERT INTO village values(236,'Khelua',2,'খেলুঅ',1);
INSERT INTO village values(237,'Pahalangpara ',2,'পহলংপাৰা ',1);
INSERT INTO village values(238,'Mathurapur   ',4,'মথুৰাপুৰ ',1);
INSERT INTO village values(239,'Jalkhana   ',4,'জলখানা ',1);
INSERT INTO village values(240,'Gobradal ',4,'গোবৰাদল  ',1);
INSERT INTO village values(241,'Khudrakatra   ',1,'খুদ্ৰকটৰা ',1);
INSERT INTO village values(242,'Khudra Katla Barkuchi   ',1,'খুদ্ৰ কটলা বৰকুচি ',1);
INSERT INTO village values(245,'Majdiya   ',1,'মাজদিয়া ',1);
INSERT INTO village values(246,'Budrukuchi',1,'বুদ্ৰুকুচি',1);
INSERT INTO village values(247,'Khudrashankara   ',1,'খুদ্ৰশঙ্কৰা ',1);
INSERT INTO village values(248,'Danguwapara   ',6,'দঙ্গুৱাপাৰা ',1);
INSERT INTO village values(249,'Dalbari Kaniha   ',5,'দলবাৰি কনিহা ',1);
INSERT INTO village values(250,'Ponar Kaniya ',5,'পোনৰ কনিঞা ',1);
INSERT INTO village values(251,'Namati   ',5,'নমাটি ',1);
INSERT INTO village values(252,'Baralkuchi   ',5,'বৰলকুচি ',1);
INSERT INTO village values(253,'Madhapur   ',5,'মাধাপুৰ ',1);
INSERT INTO village values(254,'Panimajkuchi   ',5,'পানিমাজকুচি ',1);
INSERT INTO village values(255,'Burlitpara ',3,'বুৰলিতপাৰ ',1);
INSERT INTO village values(256,'Tupkarchar   ',3,'তুপকৰচৰ ',1);
INSERT INTO village values(257,'1 No. Jaysagar   ',3,'১ নং জয়সগাৰ ',1);
INSERT INTO village values(258,'Khudra Chinadi   ',3,'খুদ্ৰ চিনাদি ',1);
INSERT INTO village values(259,'Nadiya   ',3,'নদিয়া ',1);
INSERT INTO village values(260,'Lautolipar   ',3,'লাউতোলিপাৰ ',1);
INSERT INTO village values(261,'Bargasa   ',7,'বৰগাছা ',1);
INSERT INTO village values(262,'Datara   ',5,'দতৰা ',1);
INSERT INTO village values(263,'Bangaon   ',2,'বনগাওঁ ',1);
INSERT INTO village values(264,'Bhoiraghol',2,'ভৈৰঘোল',1);
INSERT INTO village values(265,'Solmari   ',2,'সোলমাৰি ',1);
INSERT INTO village values(266,'Daloigaon   ',4,'দলৈগাওঁ ',1);
INSERT INTO village values(267,'Bhurkuchi   ',4,'ভূৰকুচি ',1);
INSERT INTO village values(268,'Tihu Town ',4,'টিহু টাউন ',1);
INSERT INTO village values(269,'Elengidal   ',1,'এলেঙ্গিদল ',1);
INSERT INTO village values(270,'Niz Banekuchi   ',6,'নিজ বানেকুচি ',1);
INSERT INTO village values(271,'Shimaliya   ',7,'শিমলীয়া ',1);
INSERT INTO village values(272,'Ranakuchi   ',7,'ৰনাকুচি ',1);
INSERT INTO village values(273,'Raymadha   ',7,'ৰায়মাধা ',1);
INSERT INTO village values(274,'Dokoha   ',7,'ডোকোহা ',1);
INSERT INTO village values(275,'Guwakuchi   ',5,'গুৱাকুচি ',1);
INSERT INTO village values(276,'Niz-Barsiral',5,'নিজবৰ্সিৰল',1);
INSERT INTO village values(277,'Balipara   ',5,'বলিপাৰা ',1);
INSERT INTO village values(278,'Khatikuchi   ',5,'খাটিকুচি ',1);
INSERT INTO village values(279,'Galdighala   ',3,'গলদিঘলা ',1);
INSERT INTO village values(280,'1 No. Balarttari   ',3,'১ নং বলাৰ্ত্তৰি ',1);
INSERT INTO village values(281,'Tilardiya   ',3,'তিলাৰদিয়া ',1);
INSERT INTO village values(282,'1 No. Bhelamari   ',3,'১ নং ভেলামাৰি ',1);
INSERT INTO village values(283,'Bhelengimari A Block ',3,'ভেলেঙিমাৰি এ ব্লক ',1);
INSERT INTO village values(284,'Meruwattari   ',3,'মেৰুৱাত্তৰি ',1);
INSERT INTO village values(285,'Darangipara   ',3,'দৰঙিপাৰা ',1);
INSERT INTO village values(286,'Bamunbori',3,'বমুনবোৰি',1);
INSERT INTO village values(287,'Belbeli   ',3,'বেলবেলি ',1);
INSERT INTO village values(288,'Bechimari ',6,'বেচিমাৰি ',1);
INSERT INTO village values(289,'3 No. Bartala   ',3,'৩ নং বৰতলা ',1);
INSERT INTO village values(290,'4 No. Bartala   ',3,'৪ নং বৰতলা ',1);
INSERT INTO village values(291,'Chamata   ',2,'চামতা ',1);
INSERT INTO village values(292,'Kaithalkuchi   ',2,'কৈঠালকুচি ',1);
INSERT INTO village values(293,'Kahikuchi   ',7,'কাহিকুচি ',1);
INSERT INTO village values(294,'Sanekuchi   ',7,'সানেকুচি ',1);
INSERT INTO village values(295,'Khudra Kshetri Barni   ',2,'খুদ্ৰ ক্ষেত্রী বৰ্ণী ',1);
INSERT INTO village values(296,'Bagurihati   ',2,'বগুৰিহাটি ',1);
INSERT INTO village values(297,'Dangardi   ',2,'দাঙ্গৰদি ',1);
INSERT INTO village values(298,'1 No. Nathkuchi   ',4,'১ নং নাঠকুচি ',1);
INSERT INTO village values(299,'Cherabari   ',1,'চেৰাবাৰি ',1);
INSERT INTO village values(300,'1 No. Sonkuriha     ',7,'১ নং সোনকুৰিহা  ',1);
INSERT INTO village values(301,'Panbari   ',7,'পানবাৰি ',1);
INSERT INTO village values(302,'Arangmou     ',7,'আৰঙ্গমৌ  ',1);
INSERT INTO village values(303,'Barajol   ',5,'বৰাজোল ',1);
INSERT INTO village values(304,'Naherbari   ',5,'নাহেৰবাৰি ',1);
INSERT INTO village values(305,'Habalakha   ',5,'হবলখা ',1);
INSERT INTO village values(306,'Jabjabkuchi',5,'জবজবকুচি',1);
INSERT INTO village values(307,'Puran Akhiya   ',3,'পুৰণ আখিয়া ',1);
INSERT INTO village values(308,'Kaure Khaiti   ',3,'কাউৰে খাইতি ',1);
INSERT INTO village values(309,'3 No. Bhelengimari',3,'৩ নং ভেলেঙিমৰি',1);
INSERT INTO village values(310,'Bhelengimari B Block ',3,'ভেলেঙিমাৰি বি ব্লক ',1);
INSERT INTO village values(311,'Bakrikuchi',3,'বকৃকুচি',1);
INSERT INTO village values(312,'Roumari   ',3,'ৰৌমাৰি ',1);
INSERT INTO village values(313,'Bihdiya   ',7,'বিহদিয়া ',1);
INSERT INTO village values(314,'Kathara   ',5,'কঠৰা ',1);
INSERT INTO village values(315,'2 No. Bardhanara   ',5,'২ নং বৰধনৰা ',1);
INSERT INTO village values(316,'Purnadai Chapra   ',7,'পুৰ্নদৈ চাপ্ৰা ',1);
INSERT INTO village values(317,'Rupiya Bathan   ',2,'ৰূপিয়া বাঠান ',1);
INSERT INTO village values(318,'Bargaon   ',4,'বৰগাওঁ ',1);
INSERT INTO village values(319,'Bali   ',4,'বালি ',1);
INSERT INTO village values(320,'Balikariya   ',1,'বলিকৰিয়া ',1);
INSERT INTO village values(322,'Sandha Kairara   ',1,'সন্ধা কৈৰাৰা ',1);
INSERT INTO village values(323,'Barmurikona   ',1,'বৰমুৰিকোনা ',1);
INSERT INTO village values(324,'Nalbari Taun   ',1,'নলবাৰী টাউন ',1);
INSERT INTO village values(325,'Arara   ',1,'অৰৰা ',1);
INSERT INTO village values(326,'Mugkuchi',1,'মুগকুচি',1);
INSERT INTO village values(327,'Bhadra',1,'ভদ্ৰ',1);
INSERT INTO village values(328,'Khukhundi',6,'খুখুন্দি',1);
INSERT INTO village values(329,'Khudra Kulhati   ',7,'খুদ্ৰ কুলহাটি ',1);
INSERT INTO village values(330,'Kaniyakuchi ',5,'কঞাকুচি ',1);
INSERT INTO village values(331,'Bhanukuchi   ',5,'ভানুকুচি ',1);
INSERT INTO village values(332,'Chiling   ',5,'চিলিং',1);
INSERT INTO village values(333,'Kayajeni   ',5,'কয়াজেনি ',1);
INSERT INTO village values(334,'Kundargaon Jabarihati   ',5,'কুন্দৰগাওঁ জবৰিহাটি ',1);
INSERT INTO village values(335,'Nagaon   ',5,'নগাওঁ ',1);
INSERT INTO village values(336,'4 No. Balitara   ',5,'৪ নং বালিতাৰা ',1);
INSERT INTO village values(337,'Chungarbari   ',3,'চুঙ্গৰবৰি ',1);
INSERT INTO village values(338,'Napara Pam   ',3,'নপৰা পাম ',1);
INSERT INTO village values(339,'Puran Chaprapara   ',3,'পুৰন চাপ্ৰাপাৰা ',1);
INSERT INTO village values(340,'Paikan Banmaza   ',3,'পাইকান বনমাজা ',1);
INSERT INTO village values(341,'Paikan Diruwa   ',3,'পাইকান দিৰুৱা ',1);
INSERT INTO village values(342,'2 No. Larkuchi   ',3,'২ নং লাৰকুচি ',1);
INSERT INTO village values(343,'Damalgao   ',3,'দমলগাও ',1);
INSERT INTO village values(344,'2 No. Naruwa   ',3,'২ নং নাৰুৱা ',1);
INSERT INTO village values(345,'1 No. Bardhanara   ',5,'১ নং বৰধনৰা ',1);
INSERT INTO village values(346,'Amara   ',5,'অমৰা ',1);
INSERT INTO village values(347,'Niz Pakowa   ',2,'নিজ পকোৱা ',1);
INSERT INTO village values(348,'Jagara     ',2,'জাগৰা  ',1);
INSERT INTO village values(349,'Dahudi   ',2,'দাহুদি ',1);
INSERT INTO village values(350,'Sukekuchi',2,'সুকেকুচি',1);
INSERT INTO village values(351,'Khudra Makhibaha   ',4,'খুদ্ৰ মাখিবাহা ',1);
INSERT INTO village values(352,'Piplibari   ',4,'পিপলিবাৰি ',1);
INSERT INTO village values(353,'Barbhagjari   ',4,'বৰভাগজাৰি ',1);
INSERT INTO village values(354,'Nandagaon   ',1,'নন্দগাওঁ ',1);
INSERT INTO village values(355,'Dakshin Bejera   ',1,'দক্ষিণ বেজেৰা ',1);
INSERT INTO village values(356,'Pandula   ',7,'পাণ্ডুলা ',1);
INSERT INTO village values(357,'Marowa   ',7,'মৰোৱা ',1);
INSERT INTO village values(358,'Sathamou   ',5,'সথামৌ ',1);
INSERT INTO village values(359,'Paichara   ',5,'পৈচৰা ',1);
INSERT INTO village values(360,'Arara   ',5,'অৰৰা ',1);
INSERT INTO village values(361,'Narayan Gaon   ',5,'নাৰায়ন গাওঁ ',1);
INSERT INTO village values(362,'Hanapara   ',3,'হানাপাৰা ',1);
INSERT INTO village values(363,'Adabari   ',3,'আদবাৰি ',1);
INSERT INTO village values(364,'1 No. Barbala   ',3,'১ নং বৰবালা ',1);
INSERT INTO village values(365,'Kurihamari   ',3,'কুৰিহামাৰি ',1);
INSERT INTO village values(366,'1 No. Bhelengimari   ',3,'১ নং ভেলেঙিমাৰি ',1);
INSERT INTO village values(367,'Mularghat   ',3,'মুলাৰঘাত ',1);
INSERT INTO village values(368,'2 No. Daulashal   ',3,'২ নং দৌলাশাল ',1);
INSERT INTO village values(369,'Amrattari   ',3,'আম্ৰাত্তাৰি ',1);
INSERT INTO village values(370,'Kalatali   ',3,'কলাতলি ',1);
INSERT INTO village values(371,'Bangnaputa   ',3,'বাংনাপুতা ',1);
INSERT INTO village values(372,'Madhupur',6,'মধুপুৰ',1);
INSERT INTO village values(373,'Arikuchi   ',7,'আৰিকুচি ',1);
INSERT INTO village values(374,'Bhabanipur   ',7,'ভবানিপুৰ ',1);
INSERT INTO village values(375,'Dhurkuchi   ',5,'ধুৰকুচি ',1);
INSERT INTO village values(376,'Larma Batakuchi   ',7,'লৰমা বটাকুচি ',1);
INSERT INTO village values(377,'Barnardi   ',2,'বৰনৰ্দী ',1);
INSERT INTO village values(378,'Bari',2,'বৰি',1);
INSERT INTO village values(379,'Niz Tapa   ',2,'নিজ টাপা ',1);
INSERT INTO village values(380,'Nakhara   ',4,'নখৰা ',1);
INSERT INTO village values(381,'Nizkhana   ',4,'নিজখানা ',1);
INSERT INTO village values(382,'Parmankhowa   ',4,'পৰমানখোৱা ',1);
INSERT INTO village values(383,'Pitanipara     ',1,'পিতনিপাৰা  ',1);
INSERT INTO village values(384,'Niz Batahgila   ',1,'নিজ বতাহগিলা ',1);
INSERT INTO village values(385,'Barpipaliya   ',1,'বৰপিপলিয়া ',1);
INSERT INTO village values(386,'Namdonga   ',1,'নামদোঙ্গা ',1);
INSERT INTO village values(387,'Kardoitola',1,'কৰ্দৈতোল',1);
INSERT INTO village values(388,'Dhamdhama',1,'ধমধম',1);
INSERT INTO village values(389,'Madanmohan Sakhowa   ',1,'মদনমোহন সখোৱা ',1);
INSERT INTO village values(390,'Barbarara   ',7,'বৰবৰৰা ',1);
INSERT INTO village values(391,'Pajipar   ',7,'পাজিপৰ ',1);
INSERT INTO village values(392,'Kalag   ',7,'কালাগ ',1);
INSERT INTO village values(393,'Ratkuchi   ',7,'ৰাতকুচি ',1);
INSERT INTO village values(394,'Rampur Ajagara   ',5,'ৰামপুৰ আজগৰা ',1);
INSERT INTO village values(395,'Daluwa   ',5,'দলুৱা ',1);
INSERT INTO village values(396,'Kundargaon   ',5,'কুন্দৰগাওঁ ',1);
INSERT INTO village values(397,'Pashim Nalbari ',5,'পশ্চিম নলবাৰি ',1);
INSERT INTO village values(398,'Bar Bistupur   ',5,'বৰ বিস্তুপুৰ ',1);
INSERT INTO village values(399,'Khudra Bistupur',5,'খুদ্ৰ বিস্তুপুৰ',1);
INSERT INTO village values(400,'2 No. Natun Chaprapara   ',3,'২ নং নতুন চাপ্ৰাপাৰা ',1);
INSERT INTO village values(401,'1 No. Bartola   ',3,'১ নং বৰতোলা ',1);
INSERT INTO village values(402,'Chanda   ',3,'চন্দা ',1);
INSERT INTO village values(403,'2 No. Jaysagar   ',3,'২ নং জয়সাগৰ ',1);
INSERT INTO village values(404,'Baitamari   ',3,'বৈতামাৰি ',1);
INSERT INTO village values(405,'1 No. ghorashal',3,'১ নং ঘোৰশল',1);
INSERT INTO village values(406,'Khagrakati   ',3,'খাগ্ৰাকাতি ',1);
INSERT INTO village values(407,'Barjbarihati   ',5,'বৰজবৰিহাতি ',1);
INSERT INTO village values(408,'Thanpatkuchi   ',7,'থানপাতকুচি ',1);
INSERT INTO village values(409,'Barkhetri Barni ',2,'বৰক্ষেত্রী বৰ্ণি ',1);
INSERT INTO village values(410,'Kathala   ',2,'কঠলা ',1);
INSERT INTO village values(411,'Bamunbari   ',4,'বামুনবৰি ',1);
INSERT INTO village values(412,'Dhantola   ',1,'ধনতোলা ',1);
INSERT INTO village values(413,'Khudrapipaliya',1,'খুদ্ৰপিপলিয়',1);
INSERT INTO village values(414,'Balikariya Kharjara   ',1,'বালিকৰিয়া খাৰজাৰা ',1);
INSERT INTO village values(415,'Deharkalakuchi   ',1,'দেহৰকালাকুচি ',1);
INSERT INTO village values(416,'Sarubarara   ',7,'সৰুবৰৰা ',1);
INSERT INTO village values(417,'Nanoi',7,'ননৈ',1);
INSERT INTO village values(418,'Dingdingi   ',7,'দিংদিঙি ',1);
INSERT INTO village values(419,'Majarbari   ',5,'মাজৰবৰি ',1);
INSERT INTO village values(420,'Chenikuchi',5,'চেনিকুচি',1);
INSERT INTO village values(421,'Tinipukhuri',5,'তিনিপুখুৰি',1);
INSERT INTO village values(422,'4 No. Sagarkuchi   ',5,'৪ নং সাগৰকুচি ',1);
INSERT INTO village values(423,'3 No. Natun Chaprapara   ',3,'৩ নং নতুন চাপ্ৰাপাৰা ',1);
INSERT INTO village values(424,'3 No. Kaplabori',3,'৩ নং কাপলাবৰি',1);
INSERT INTO village values(425,'Kharsitha   ',6,'খাৰসিথা ',1);
INSERT INTO village values(426,'Chatama   ',7,'চতমা ',1);
INSERT INTO village values(427,'Dipta   ',9,'দিপ্তা ',1);
INSERT INTO village values(428,'Sandheli   ',2,'সন্ধেলি ',1);
INSERT INTO village values(429,'Dehar Balowa   ',2,'দেহৰ বলোৱা ',1);
INSERT INTO village values(430,'Mohbiyeni   ',2,'মোহবিয়েনি ',1);
INSERT INTO village values(431,'Kakaya',2,'ককয়',1);
INSERT INTO village values(432,'Ranakuchi   ',4,'ৰনাকুচি ',1);
INSERT INTO village values(433,'Barmakhibaha   ',4,'বৰমাখিবাহা ',1);
INSERT INTO village values(434,'Bhojkuchi',4,'ভোজকুচি',1);
INSERT INTO village values(435,'Khudra Agra   ',1,'খুদ্ৰ আগ্ৰা ',1);
INSERT INTO village values(436,'Payla   ',1,'পয়লা ',1);
INSERT INTO village values(437,'Kumarikata   ',1,'কুমৰিকাটা ',1);
INSERT INTO village values(438,'Madhapur   ',1,'মাধাপুৰ ',1);
INSERT INTO village values(439,'Sonkani   ',7,'সোনকানি ',1);
INSERT INTO village values(440,'Dhaniyagog ',7,'ধনিয়াগোগ ',1);
INSERT INTO village values(441,'Kotalkuchi   ',7,'কোটালকুচি ',1);
INSERT INTO village values(442,'Barkuriha   ',7,'বৰকুৰিহা ',1);
INSERT INTO village values(443,'Rangafali   ',5,'ৰঙাফালি ',1);
INSERT INTO village values(444,'2 No. Balitara   ',5,'২ নং বালিতাৰা ',1);
INSERT INTO village values(445,'Pub Barsiral   ',5,'পুব বৰসিৰাল ',1);
INSERT INTO village values(446,'Nilpur   ',5,'নিলপুৰ ',1);
INSERT INTO village values(447,'Jugurkuchi Sripur   ',5,'জুগুৰকুচি শ্রীপুৰ ',1);
INSERT INTO village values(448,'Hamlakur   ',3,'হামলাকুৰ ',1);
INSERT INTO village values(449,'Chakirghat   ',3,'চাকিৰ্ঘাট ',1);
INSERT INTO village values(450,'Chatemari   ',3,'চতেমাৰি ',1);
INSERT INTO village values(451,'Sarusuliya   ',3,'সৰুসুলিয়া ',1);
INSERT INTO village values(452,'Bardhap   ',3,'বৰধাপ ',1);
INSERT INTO village values(453,'Gharuwa Bahagaon   ',3,'ঘৰুৱা বাহাগাওঁ ',1);
INSERT INTO village values(454,'1 No. Daulashal   ',3,'১ নং দৌলাশাল ',1);
INSERT INTO village values(455,'3 No. Larkuchi   ',3,'৩ নং লাৰকুচি ',1);
INSERT INTO village values(456,'2 No. Ghorashal   ',3,'২ নং ঘোৰাশাল ',1);
INSERT INTO village values(457,'Pachim Kajiya ',3,'পশ্চিম কাজিয়া ',1);
INSERT INTO village values(458,'Madhya Kajiya   ',3,'মধ্য কাজিয়া ',1);
INSERT INTO village values(459,'Kalarchar   ',3,'কালৰচৰ ',1);
INSERT INTO village values(460,'Balijar   ',6,'বালিজাৰ ',1);
INSERT INTO village values(461,'Bejkuchi',7,'বেজকুচি',1);
INSERT INTO village values(462,'Dhamdhama   ',5,'ধমধমা ',1);
INSERT INTO village values(463,'Nalicha   ',2,'নলিচা ',1);
INSERT INTO village values(464,'Kutnikuchi   ',2,'কুটনিকুচি ',1);
INSERT INTO village values(465,'Lakhopur',2,'লখোপুৰ',1);
INSERT INTO village values(466,'Thuthikata   ',2,'থুঠিকাটা ',1);
INSERT INTO village values(467,'Belsor ',2,'বেলসৰ ',1);
INSERT INTO village values(468,'Chengnoi',1,'চেংনৈ',1);
INSERT INTO village values(469,'Garemara   ',1,'গৰেমাৰা ',1);
INSERT INTO village values(470,'Namati   ',1,'নমাটি ',1);
INSERT INTO village values(471,'Haripur',1,'হৰিপুৰ',1);
INSERT INTO village values(472,'Nalbari Town Barshilakuti Khanda ',1,'নলবাৰী টাউন বৰশিলাকুটি খণ্ড ',1);
INSERT INTO village values(473,'Sahpur   ',1,'সাহপুৰ ',1);
INSERT INTO village values(474,'Jajiyabari   ',1,'জাজিয়বাৰি ',1);
INSERT INTO village values(475,'Digheli   ',1,'দিঘেলী ',1);
INSERT INTO village values(476,'Doukuchi   ',1,'দৌকুচি ',1);
INSERT INTO village values(477,'Bar Ajara ',1,'বৰ আজৰা ',1);
INSERT INTO village values(478,'Kasimpur   ',6,'কাসিমপুৰ ',1);
INSERT INTO village values(479,'Kaithalkuchi   ',6,'কৈঠালকুচি ',1);
INSERT INTO village values(480,'Barkulhati   ',7,'বৰকুলহাটি ',1);
INSERT INTO village values(481,'Kamarkuchi   ',7,'কমাৰকুচি ',1);
INSERT INTO village values(482,'Barbukiya   ',7,'বৰবুকিয়া ',1);
INSERT INTO village values(483,'Choto Alliya   ',5,'চোতো আল্লিয়া ',1);
INSERT INTO village values(484,'Barghopa   ',5,'বৰঘোপা ',1);
INSERT INTO village values(485,'Ghoga   ',3,'ঘোগা ',1);
INSERT INTO village values(486,'2 No. Bhelamari   ',3,'২ নং ভেলামাৰি ',1);
INSERT INTO village values(487,'3 No. Bhelamari   ',3,'৩ নং ভেলামাৰি ',1);
INSERT INTO village values(488,'2 No. Barbala   ',3,'২ নং বৰবালা ',1);
INSERT INTO village values(489,'Adattari   ',3,'আদাত্তাৰি ',1);
INSERT INTO village values(490,'Haulighat   ',3,'হাউলিঘাট ',1);
INSERT INTO village values(491,'Mugdi   ',3,'মুগদি ',1);
INSERT INTO village values(492,'Narapara   ',5,'নাৰাপাৰা ',1);
INSERT INTO village values(493,'Barkhala   ',7,'বৰখলা ',1);
INSERT INTO village values(496,'Parowa',1,'পৰোৱ',1);
INSERT INTO village values(497,'Bidyapur   ',1,'বিদ্যাপুৰ ',0);
INSERT INTO village values(498,'Banekuchi      ',6,'বানেকুচি  ',1);
INSERT INTO village values(500,'D.C Office Nalbari ',1,'ডি চি অফিচ নলবাৰি ',0);
INSERT INTO village values(501,'Gopal Bazar   ',1,'গোপাল বাজাৰ ',NULL);
INSERT INTO village values(502,NULL,3,NULL,NULL);
INSERT INTO village values(503,'Makhibaha   ',4,'মাখিবাহা ',NULL);
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
-- Foreign Key for Table [BANK_DEPOSIT]
--

ALTER TABLE bank_deposit ADD CONSTRAINT bank_deposit_ibfk_1 FOREIGN KEY (Case_id) REFERENCES bakijai_main(Case_Id);

-- 
-- Foreign Key for Table [DAK_ENTRY]
--

ALTER TABLE dak_entry ADD CONSTRAINT dak_entry_ibfk_1 FOREIGN KEY (Branch_code) REFERENCES branch_section(Branch_Code);

-- 
-- Foreign Key for Table [MOUZA]
--

ALTER TABLE mouza ADD CONSTRAINT mouza_ibfk_1 FOREIGN KEY (Cir_Code) REFERENCES circle(Cir_code);

-- 
-- Foreign Key for Table [OFFICER_CHAIN]
--

ALTER TABLE officer_chain ADD CONSTRAINT officer_chain_ibfk_1 FOREIGN KEY (Case_Id) REFERENCES bakijai_main(Case_Id);
ALTER TABLE officer_chain ADD CONSTRAINT officer_chain_ibfk_2 FOREIGN KEY (Officer_Code) REFERENCES officer(Slno);

-- 
-- Foreign Key for Table [PETITION_MASTER]
--

ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_1 FOREIGN KEY (Pet_type) REFERENCES petition_type(Code);

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

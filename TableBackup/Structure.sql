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
-- Structure for Table [BRANCH_SECTION]
-- 

CREATE TABLE IF NOT EXISTS branch_section(
Branch_Code int  NOT NULL ,
Branch_Name varchar(40)  NOT NULL ,
 PRIMARY KEY (Branch_Code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



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
 PRIMARY KEY (Dak_id,Recvd_yr)
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
 PRIMARY KEY (FDate)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [HC_BRANCH]
-- 

CREATE TABLE IF NOT EXISTS hc_branch(
Code int  NOT NULL ,
Name varchar(30)  NOT NULL ,
 PRIMARY KEY (Code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [HC_CASEMASTER]
-- 

CREATE TABLE IF NOT EXISTS hc_casemaster(
Serial bigint  NOT NULL ,
Case_No varchar(50)  NOT NULL ,
Brief_History varchar(500)  NOT NULL ,
Present_Status varchar(200)  NOT NULL ,
File_No varchar(100),
Due_dateParaWise date  NOT NULL ,
Closed varchar(1)  DEFAULT 'N'   NOT NULL ,
Dep_code int  NOT NULL ,
Branch_code int  NOT NULL ,
Last_Date date,
Signed_By varchar(50),
T3 varchar(2),
T4 varchar(2),
T5 varchar(2),
 PRIMARY KEY (Serial)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [HC_CASETRANSACTION]
-- 

CREATE TABLE IF NOT EXISTS hc_casetransaction(
Case_id bigint  NOT NULL ,
RSL int  NOT NULL ,
NextDue_Date date,
Submit_date date  NOT NULL ,
Signed_by varchar(50)  NOT NULL ,
Entry_date date,
Present_status varchar(200),
T3 varchar(2),
T4 varchar(2),
 PRIMARY KEY (Case_id,RSL)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [HC_DEPARTMENT]
-- 

CREATE TABLE IF NOT EXISTS hc_department(
Code int  NOT NULL ,
Name varchar(100)  NOT NULL ,
 PRIMARY KEY (Code)
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
 PRIMARY KEY (Pet_yr,Pet_no,Slno)
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
Status varchar(15)  DEFAULT 'Pending' ,
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
 PRIMARY KEY (Pet_yr,Pet_no)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [PETITION_STATUS]
-- 

CREATE TABLE IF NOT EXISTS petition_status(
Status varchar(15)  NOT NULL ,
 PRIMARY KEY (Status)
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
ServiceId varchar(10),
 PRIMARY KEY (Code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



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
 PRIMARY KEY (Cal_yr,Cal_month)
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
-- Structure for Table [RELATION]
-- 

CREATE TABLE IF NOT EXISTS relation(
Rel_name varchar(20)  NOT NULL ,
ARTPS bit
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
-- Structure for Table [SEX]
-- 

CREATE TABLE IF NOT EXISTS sex(
Code varchar(1)  NOT NULL ,
Detail varchar(8),
 PRIMARY KEY (Code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [SHEET2]
-- 

CREATE TABLE IF NOT EXISTS sheet2(
Circle int,
Case_id int
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- 
-- Structure for Table [SUBCASTE]
-- 

CREATE TABLE IF NOT EXISTS subcaste(
Slno int  NOT NULL ,
detail varchar(30),
 PRIMARY KEY (Slno)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



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


-- FOREIGN KEY


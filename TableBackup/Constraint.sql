
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
-- Foreign Key for Table [HC_CASEMASTER]
--

ALTER TABLE hc_casemaster ADD CONSTRAINT hc_casemaster_ibfk_1 FOREIGN KEY (Branch_code) REFERENCES hc_branch(Code);
ALTER TABLE hc_casemaster ADD CONSTRAINT hc_casemaster_ibfk_2 FOREIGN KEY (Dep_code) REFERENCES hc_department(Code);

-- 
-- Foreign Key for Table [HC_CASETRANSACTION]
--

ALTER TABLE hc_casetransaction ADD CONSTRAINT hc_casetransaction_ibfk_1 FOREIGN KEY (Case_id) REFERENCES hc_casemaster(Serial);

-- 
-- Foreign Key for Table [LEGAL_HEIR]
--

ALTER TABLE legal_heir ADD CONSTRAINT legal_heir_ibfk_1 FOREIGN KEY (Pet_yr,Pet_no) REFERENCES petition_master(Pet_yr,Pet_no);

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

ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_1 FOREIGN KEY (Status) REFERENCES petition_status(Status);
ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_2 FOREIGN KEY (Pet_type) REFERENCES petition_type(Code);
ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_3 FOREIGN KEY (Circle_Code) REFERENCES circle(Cir_code);
ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_4 FOREIGN KEY (Mauza_Code) REFERENCES mouza(Mouza_Code);
ALTER TABLE petition_master ADD CONSTRAINT petition_master_ibfk_5 FOREIGN KEY (PS_Code) REFERENCES police_station(Code);

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
-- Foreign Key for Table [VILLAGE]
--

ALTER TABLE village ADD CONSTRAINT village_ibfk_1 FOREIGN KEY (Cir_Code) REFERENCES circle(Cir_code);

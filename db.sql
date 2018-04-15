create table login_admin(id varchar(10), password varchar(20), primary key (id)); 
insert into login_admin values ('admin','password');

create table login(mis varchar(9), password varchar(20), status int(1) NOT NULL DEFAULT '1', primary key (mis)); 

create table faculty (mis varchar(9) , fname varchar(20) not null, lname varchar(20) not null, email varchar(50), mobile varchar(10), primary key (mis));

create table requested (mis varchar(9) , fname varchar(20) not null, lname varchar(20) not null, email varchar(50), mobile varchar(10), password varchar(20) , status int(1) NOT NULL DEFAULT '0', primary key (mis));

create table pers1 (mis varchar(9),mname varchar(10), gender varchar(10),dob date, father_fname varchar(20), father_lname varchar(20), mother_fname varchar(20), mother_lname varchar(20), religion varchar(20), nationality varchar(20), caste varchar(20), passport_no varchar(20), aadhar_no varchar(20), pan_no varchar(20), foreign key(mis) references faculty(mis)  on delete cascade);

create table address (mis varchar(9), add1 varchar(50), add2 varchar(50), add3 varchar(50),city varchar(20),state varchar(20),district varchar(20),pin varchar(10), foreign key(mis) references faculty(mis)  on delete cascade );

create table college_design (mis varchar(9), design varchar(50), apptype varchar(50), prog varchar(50), doj date, cousre varchar(20), foreign key(mis) references faculty(mis)  on delete cascade );

create table pers_quali (mis varchar(9), quali varchar(50), area_special varchar(50), exp_months varchar(50), exp_years varchar(20), foreign key(mis) references faculty(mis)  on delete cascade );

create table fbank_details (mis varchar(9), bank_name varchar(20), bank_accno varchar(20), ifsc varchar(20), foreign key(mis) references faculty(mis)  on delete cascade );

create table uploads(id int auto_increment, mis varchar(9), title varchar(100), type varchar(10), date_on_doc date , date_of_upload timestamp, location varchar(50),description varchar(100), primary key (id),foreign key(mis) references faculty(mis)  on delete cascade);

create table drafts(id int auto_increment, mis varchar(9), title varchar(100), type varchar(10), date_on_doc date , date_of_upload timestamp, location varchar(50),description varchar(100), primary key (id),foreign key(mis) references faculty(mis)  on delete cascade);

create table messages(id int auto_increment, mis varchar(9), title varchar(100), date_of_upload timestamp ,description varchar(100), primary key (id),foreign key(mis) references faculty(mis)  on delete cascade);

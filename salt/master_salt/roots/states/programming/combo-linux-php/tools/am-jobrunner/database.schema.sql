# Need apache web server
## need phpmyadmin
## there is a phppgadmin
## there is a phpldapadmin
## there is a phpsysinfo
## there is a phpqrcode
## there is a php-timer

# need php5
# need php5-cli
# don't remember if I wanted php5-readline
# wanted php5-curl?
# need php5-mysqlnd # native driver
# need mysql
#   sudo apt-get install mysql-server-5.6 # (I removed it in option of phpmyadmin's database, but I'm presented with an option to use the one previously installed/setup with phpmyadmin...) - I'm going for ease of use


# install phpmyadmin - get it all (I know we want to streamline it later ...)
# phpmyadmin installs these packages
#   dbconfig-common javascript-common libapache2-mod-php5 libjs-codemirror
#  libjs-jquery-cookie libjs-jquery-event-drag libjs-jquery-metadata
#  libjs-jquery-mousewheel libjs-jquery-tablesorter libjs-jquery-ui libmcrypt4
#  php-gettext php5-cli php5-common php5-gd php5-json php5-mcrypt php5-mysql
#  php5-readline phpmyadmin
# Choosing apache2 (between apache2 and lighthttpd)
# RAWR can't connect to the database!!!! SKIPPING QUESTIONS
# it's okay, I can just install a database separately ...
# okay, I have my database installed, I need to go back and set up my database
# I need to untar my jdk and move my selenium server (split the screen)!
# root@mysql:/opt# tar zxvf /tmp/jdk.tar.gz
# root@mysql:/opt# mv /tmp/selenium-server.jar /opt/selenium-server.jar
# symlink was broken because it was already there ... (didn't handle that case)\
# vagrant@mysql:/opt# export DISPLAY=:1; /opt/java/bin/java  -jar /opt/selenium-server.jar # (should be done as user we want this logic to run under ...)

# need to setup phpmyadmin
# phpinfo?
# symlink didn't work (had to redo the file)
# installed unzip - downloaded phpmyadmin zip file
# json extension is missing
# sudo php5enmod json
# restart apache
# need selenium
#   root@salt-master:/srv/salt/roots/states/programming/java/tools/selenium# cp selenium-server-standalone-3.8.1.jar /tmp/selenium-server.jar
#   set the password to 'password' but that didn't work
#   had to increase the memory to 2 gigs of ram - reinstall
#   set the password to 'easypeasy1'
# need java
#   root@salt-master:/srv/salt/roots/states/programming/java# cp jdk-8u151-linux-x64.tar.gz /tmp/jdk.tar.gz
# need git (sudo apt-get install git)
# need firefox
# need fluxbox?
# need to export display
# need copy of my current ssh key for github (to use as my user)

# Downloaded Firefox onto desktop
# not compatible with quantum

# /usr/bin/php /vagrant/code/am_jobrunner/cli_job_runner/cli_job_runner.php


# drop database weedmaps_github_data
create database weedmaps_github_data;

create table tbl_repository (
	repository_id int not null auto_increment,
    repository_name varchar(255),
    local_directory_path varchar(255),
    github_path varchar(255),
    github_clone_path varchar(255),
    circle_status_api_key varchar(255),
    circle_status_url varchar(255),
	active ENUM('N', 'Y'),
	primary key (repository_id)
);
insert into tbl_repository
	( repository_name, local_directory_path, github_path, circle_status_api_key, circle_status_url, active)
	values
	('Weedmaps API', 
		'/home/vagrant/code/weedmaps/api', 
		'https://github.com/GhostGroup/weedmaps_api', 
		'git@github.com:GhostGroup/weedmaps.git', 
		'47cf58e2329fe70446897e379adb72c69d37b20c', 
		'https://circle.weedmaps.com/gh/GhostGroup/weedmaps_api', 
		'Y');
	
# Create an API token to get project status/permissions
# Core - d4f10ad8a520b1708cf04d29cfe02991e0113a49
# https://circleci.com/gh/GhostGroup/weedmaps/tree/bug%2FCOR-1065.svg?style=svg&circle-token=d4f10ad8a520b1708cf04d29cfe02991e0113a49
# https://circleci.com/gh/GhostGroup/weedmaps.svg?style=svg&circle-token=d4f10ad8a520b1708cf04d29cfe02991e0113a49
# API - 47cf58e2329fe70446897e379adb72c69d37b20c
# https://circle.weedmaps.com/gh/GhostGroup/weedmaps_api.svg?style=svg&circle-token=47cf58e2329fe70446897e379adb72c69d37b20c
# https://circle.weedmaps.com/gh/GhostGroup/weedmaps_api/tree/release%2F3.2.0.svg?style=svg&circle-token=47cf58e2329fe70446897e379adb72c69d37b20c
# Moonshot - 26f8dda41c8af0147820f31a15b2bc8e44171ff8
# https://circle.weedmaps.com/gh/GhostGroup/moonshot.svg?style=svg&circle-token=26f8dda41c8af;

create table tbl_sha_data (
	sha_id int not null auto_increment,
	repository_id int not null,
    sha_value varchar(255),
    branch_name varchar(255),
    date_created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_updated datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_removed datetime,
	primary key (sha_id)
);


# drop database weedmaps_infrastructure;
create database weedmaps_infrastructure;

create table tbl_servers (
	server_id int not null auto_increment,
	server_type_id int not null,
    private_ip_address varchar(255),
    public_ip_address varchar(255),
    private_dns_entry varchar(255),
    public_dns_entry varchar(255),
    server_instance_type varchar(255),
    date_created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_updated datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_removed datetime,
	primary key (sha_id)
);
insert
create table tbl_servers_types (
	server_type_id int not null auto_increment,
    server_type varchar(255),
    date_created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_updated datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_removed datetime,
	primary key (server_type_id)
);

create table tbl_environment (
	environment_id int not null auto_increment,
    environment_name varchar(255),
    date_created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_updated datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_removed datetime,
	primary key (environment_id)
);
insert into tbl_environment
	set
	environment_name = 'performance';
insert into tbl_environment
	set
	environment_name = 'production';
insert into tbl_environment
	set
	environment_name = 'staging';
insert into tbl_environment
	set
	environment_name = 'acceptance';

#	drop database am_jobrunner;
create database am_jobrunner;
use am_jobrunner;
CREATE TABLE users
(
	user_id int not null auto_increment,
	first_name varchar(255),
	last_name varchar(255),
	email varchar(255),
	password varchar(255),
	role_id int,
	active ENUM('N', 'Y'),
	primary key (user_id)
);
insert into users
	(first_name, last_name, email, password, role_id, active)
	values
	('Abby', 'Malson', 'amalson@weedmaps.com', 'password', 1, 'Y');
CREATE TABLE role
(
	role_id int not null auto_increment,
	role_name varchar(255),
	active ENUM('N', 'Y'),
	primary key (role_id)
);
insert into role
	( role_name, active)
	values
	('admin', 'Y');

# drop table job_group;
CREATE TABLE job_group
(
	job_group_id int not null auto_increment,
	friendly_name varchar(255) not null ,
	user_id int not null,
	date_job_submitted  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	date_job_completed datetime,
    primary key (job_group_id)
);
# ALTER TABLE `job_group` CHANGE `date_job_submitted` `date_job_submitted` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
insert into job_group
	( friendly_name, user_id)
	values
	('admin-test', 1);

CREATE TABLE cli_jobs
(
	cli_jobs_id int not null auto_increment,
	job_group_id int not null,
	friendly_name varchar(255) not null ,
	user_id int not null,
	cli_job_type_id int not null,
	params text,
	date_job_submitted datetime  NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	date_job_completed datetime,
	result_parsed varchar(255),
	results_full text,
    primary key (cli_jobs_id)
);

insert into cli_jobs
	( job_group_id, friendly_name, user_id, cli_job_type_id, params)
	values
	('1', 'admin-test1-cli_job', 1, 1, '');

#CREATE TABLE cli_worker_status
#(	
#	cli_worker_status_id int not null auto_increment,
#	cli_job_type_id INT not null,
#	cli_jobs_id INT not null,
#	result_parsed varchar(255),
#	results_full text,
#    primary key(cli_worker_status_id)
#);

CREATE TABLE cli_job_type
(
	cli_job_type_id int not null auto_increment,
	friendly_name varchar(255),
	absolute_path_to_execute_job varchar(255),
  cli_worker_name varchar(255) NOT NULL,
	parameters varchar(255), # should be a json text type ...?
     PRIMARY KEY (cli_job_type_id) 
);

#CREATE TABLE `cli_job_type` (
#  `cli_job_type_id` int(11) NOT NULL,
#  `friendly_name` varchar(255) DEFAULT NULL,
#  `absolute_path_to_execute_job` varchar(255) DEFAULT NULL,
#  `cli_worker_name` varchar(255) NOT NULL,
#  `parameters` varchar(255) DEFAULT NULL
#) ENGINE=InnoDB DEFAULT CHARSET=latin1;


insert into cli_job_type
	( friendly_name, absolute_path_to_execute_job, parameters)
	values
	('admin-test1', '/home/vagrant/code/am_jobrunner/admin-test', '');
# ALTER TABLE `CLI_JOB_TYPE` ADD `friendly_name` VARCHAR(255) NOT NULL ;

CREATE TABLE web_job_type
(
	web_job_type_id int not null auto_increment,
	friendly_name varchar(255),
	absolute_path_to_execute_job varchar(255), # This will kick off a cli job/selenium job
	parameters varchar(255), # should be a json text type ...?
     PRIMARY KEY (web_job_type_id) 
     # How do you comment to the table so it's on the table?
     # These are Selenium Workers
);

CREATE TABLE web_workers
(
	web_worker_id int not null auto_increment,
	friendly_name varchar(255),
	display INT,
	active ENUM('N', 'Y'),
     PRIMARY KEY (web_worker_id)
);

CREATE TABLE cli_workers
(
	cli_worker_id int not null auto_increment,
	friendly_name varchar(255),
	screen INT,
	active ENUM('N', 'Y'),
     PRIMARY KEY (cli_worker_id)
);

CREATE TABLE web_workers
(
	web_worker_status_id INT not null auto_increment,
	web_job_type_id INT not null,
	result_parsed varchar(255),
	results_full text,
	status ENUM('WAITING', 'RUNNING', 'FINISHED'),
     PRIMARY KEY (web_worker_status_id)
);

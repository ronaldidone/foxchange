
CREATE TABLE payment_methods
(
	id_payment_method    INTEGER NOT NULL,
	name                 VARCHAR(200) NULL,
	status               CHAR(18) NULL,
	PRIMARY KEY (id_payment_method)
);



CREATE TABLE users
(
	id_user              integer unsigned AUTO_INCREMENT,
	first_name           varchar(32) NOT NULL DEFAULT '',
	last_name            varchar(32) NOT NULL DEFAULT '',
	email                varchar(256) NOT NULL DEFAULT '',
	status               char(1) NOT NULL DEFAULT '1',
	is_admin             char(1) NOT NULL DEFAULT '0',
	language             varchar(64) NULL,
	deleted              char(1) NOT NULL DEFAULT '0',
	debit_base           decimal(10,2) NOT NULL DEFAULT 0.00,
	debit_extra1         decimal(10,2) NULL DEFAULT 0.00,
	debit_extra2         decimal(10,2) NOT NULL DEFAULT 0.00,
	debit_extra3         decimal(10,2) NOT NULL DEFAULT 0.00,
	debit_extra4         decimal(10,2) NOT NULL DEFAULT 0.00,
	debit_extra5         decimal(10,2) NOT NULL DEFAULT 0.00,
	password             char(128) NOT NULL DEFAULT '',
	salt                 char(128) NOT NULL DEFAULT '',
	validation_code      varchar(50) NULL,
	created              datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	updated              datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	verify_status        char(1) NOT NULL DEFAULT '0',
	paypal               varchar(100) NOT NULL DEFAULT '',
	card                 varchar(50) NOT NULL DEFAULT '',
	bitcoin              varchar(100) NOT NULL DEFAULT '',
	skrill               varchar(100) NOT NULL DEFAULT '',
	payza                varchar(100) NOT NULL DEFAULT '',
	advcash              varchar(100) NOT NULL DEFAULT '',
	perfect_m            varchar(100) NOT NULL DEFAULT '',
	swift                text(65535) NOT NULL DEFAULT '',
	neteller             text(65535) NOT NULL DEFAULT '',
	uphold               text(65535) NOT NULL DEFAULT '',
	payeer               text(65535) NOT NULL DEFAULT '',
	airtm                text(65535) NOT NULL DEFAULT '',
	payoneer             text(65535) NOT NULL DEFAULT '',
	webmoney             text(65535) NOT NULL DEFAULT '',
	company              varchar(150) NOT NULL DEFAULT '',
	country              varchar(100) NOT NULL DEFAULT '',
	zip                  varchar(50) NOT NULL DEFAULT '',
	city                 varchar(100) NOT NULL DEFAULT '',
	address_1            text(65535) NOT NULL DEFAULT '',
	address_2            text(65535) NOT NULL DEFAULT '',
	time                 integer NOT NULL DEFAULT 0,
	fraud                char(1) NOT NULL DEFAULT '0',
	phone                varchar(50) NOT NULL DEFAULT '',
	method_login         char(1) NOT NULL DEFAULT '1',
	login_token          varchar(100) NOT NULL DEFAULT '',
	2fa_login            varchar(100) NOT NULL DEFAULT '',
	login_status         char(1) NOT NULL DEFAULT '1',
	ip_address           varchar(100) NOT NULL DEFAULT '',
	oauth_provider       varchar(100) NOT NULL DEFAULT '',
	oauth_uid            varchar(255) NOT NULL DEFAULT '',
	status_ATM           integer NULL DEFAULT 0
 AUTO_INCREMENT = 8,
	PRIMARY KEY (id_user)
);



CREATE TABLE users_payment_accounts
(
	id_users_accounts    CHAR(18) NOT NULL,
	id_payment_method    INTEGER NOT NULL,
	id_user              integer unsigned NOT NULL,
	account              VARCHAR(200) NOT NULL,
	status               CHAR(1) NOT NULL,
	flg_active_cashier   CHAR(1) NULL,
	PRIMARY KEY (id_users_accounts),
	FOREIGN KEY R_7 (id_payment_method) REFERENCES payment_methods (id_payment_method),
	FOREIGN KEY R_8 (id_user) REFERENCES users (id_user)
);



CREATE TABLE vouchers
(
	id                   integer unsigned AUTO_INCREMENT,
	code                 varchar(100) NOT NULL DEFAULT '',
	date_creature        datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	creator              varchar(200) NOT NULL DEFAULT '',
	amount               decimal(10,2) NOT NULL DEFAULT 0.00,
	currency             varchar(100) NOT NULL DEFAULT '',
	date_activation      datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	activator            varchar(200) NOT NULL DEFAULT '',
	status               char(1) NOT NULL DEFAULT '1'
 AUTO_INCREMENT = 1,
	PRIMARY KEY (id)
);



CREATE TABLE verification
(
	id                   integer unsigned AUTO_INCREMENT,
	code                 varchar(100) NOT NULL DEFAULT '',
	date                 datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	id_card              text(65535) NOT NULL DEFAULT '',
	id_revers            text(65535) NOT NULL DEFAULT '',
	id_address           text(65535) NOT NULL DEFAULT '',
	business_address     text(65535) NOT NULL DEFAULT '',
	status               char(1) NOT NULL DEFAULT '0',
	comment              text(65535) NOT NULL DEFAULT '',
	user                 varchar(150) NOT NULL DEFAULT ''
 AUTO_INCREMENT = 2,
	PRIMARY KEY (id)
);



CREATE TABLE user_cashier
(
	id_user_cashier___xxx integer AUTO_INCREMENT,
	id_user              integer unsigned NOT NULL DEFAULT 0,
	paypal               integer NULL DEFAULT 0,
	card                 integer NULL DEFAULT 0,
	bitcoin              integer NULL DEFAULT 0,
	skrill               integer NULL DEFAULT 0,
	payza                integer NULL DEFAULT 0,
	adv_cash             integer NULL DEFAULT 0,
	perfect_m            integer NULL DEFAULT 0,
	swift                integer NULL DEFAULT 0,
	neteller             integer NULL DEFAULT 0,
	uphold               integer NULL DEFAULT 0,
	payeer               integer NULL DEFAULT 0,
	airtm                integer NULL DEFAULT 0,
	payoneer             integer NULL DEFAULT 0,
	webmoney             integer NULL DEFAULT 0,
	activo               integer NULL DEFAULT 1
 AUTO_INCREMENT = 3,
	PRIMARY KEY (id_user_cashier___xxx),
	FOREIGN KEY R_13 (id_user) REFERENCES users (id_user)
);



CREATE TABLE transactions
(
	id                   integer unsigned AUTO_INCREMENT,
	time                 datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	type                 char(1) NOT NULL DEFAULT '1',
	sum                  decimal(10,2) NOT NULL DEFAULT 0.00,
	amount               decimal(10,2) NOT NULL DEFAULT 0.00,
	amount_sent_cashier  decimal(10,2) NULL DEFAULT 0.00,
	amount_deposit       decimal(10,2) NOT NULL DEFAULT 0.00,
	amount_received_deposit decimal(10,2) NOT NULL DEFAULT 0.00,
	amount_withdraw      decimal(10,2) NOT NULL DEFAULT 0.00,
	amount_received_withdraw decimal(10,2) NOT NULL DEFAULT 0.00,
	fee                  decimal(10,2) NOT NULL DEFAULT 0.00,
	currency             varchar(128) NOT NULL DEFAULT '',
	status               char(1) NOT NULL DEFAULT '1',
	sender               varchar(128) NOT NULL DEFAULT '',
	receiver             varchar(128) NOT NULL DEFAULT '',
	deposit_account      text(65535) NOT NULL DEFAULT '',
	withdraw_account     text(65535) NOT NULL DEFAULT '',
	user_comment         text(65535) NOT NULL DEFAULT '',
	admin_comment        text(65535) NOT NULL DEFAULT '',
	label                varchar(128) NOT NULL DEFAULT '',
	ip_address           varchar(128) NOT NULL DEFAULT '',
	protect              varchar(100) NOT NULL DEFAULT 'none',
	protect_attempts     integer NOT NULL DEFAULT 0,
	merchant             integer NOT NULL DEFAULT 0,
	payer_fee            char(1) NOT NULL DEFAULT '0',
	id_cashier           integer NULL DEFAULT 0,
	id_deposit_cashier   varchar(255) NULL,
	id_deposit_method    INTEGER NOT NULL,
	id_withdraw_method   INTEGER NOT NULL
 AUTO_INCREMENT = 7,
	PRIMARY KEY (id),
	FOREIGN KEY R_3 (id_deposit_method) REFERENCES payment_methods (id_payment_method),
	FOREIGN KEY R_5 (id_withdraw_method) REFERENCES payment_methods (id_payment_method)
);



CREATE TABLE tickets_comments
(
	id                   integer unsigned AUTO_INCREMENT,
	id_ticket            varchar(100) NOT NULL DEFAULT '',
	date                 datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	user                 varchar(100) NOT NULL DEFAULT '',
	role                 char(1) NOT NULL DEFAULT '0',
	comment              text(65535) NOT NULL DEFAULT ''
 AUTO_INCREMENT = 1,
	PRIMARY KEY (id)
);



CREATE TABLE tickets
(
	id                   integer unsigned AUTO_INCREMENT,
	code                 varchar(100) NOT NULL DEFAULT '',
	date                 datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	user                 varchar(100) NOT NULL DEFAULT '',
	status               char(1) NOT NULL DEFAULT '0',
	title                text(65535) NOT NULL DEFAULT '',
	message              text(65535) NOT NULL DEFAULT ''
 AUTO_INCREMENT = 1,
	PRIMARY KEY (id)
);



CREATE TABLE sms_template
(
	id                   integer unsigned AUTO_INCREMENT,
	title                text(65535) NOT NULL DEFAULT '',
	message              text(65535) NOT NULL DEFAULT '',
	status               char(1) NOT NULL DEFAULT '0'
 AUTO_INCREMENT = 21,
	PRIMARY KEY (id)
);



CREATE TABLE settings_withdrawal
(
	id                   integer unsigned AUTO_INCREMENT,
	fee_fix              decimal(10,2) NOT NULL DEFAULT 0.00,
	fee                  decimal(10) NOT NULL DEFAULT 0,
	terms                text(65535) NOT NULL DEFAULT '',
	start_verify         char(1) NOT NULL DEFAULT '0',
	standart_verify      char(1) NOT NULL DEFAULT '0',
	expanded_verify      char(1) NOT NULL DEFAULT '0',
	status               char(1) NOT NULL DEFAULT '0',
	debit_base           char(1) NOT NULL DEFAULT '0',
	debit_extra1         char(1) NOT NULL DEFAULT '0',
	debit_extra2         char(1) NOT NULL DEFAULT '0',
	debit_extra3         char(1) NOT NULL DEFAULT '0',
	debit_extra4         char(1) NOT NULL DEFAULT '0',
	debit_extra5         char(1) NOT NULL DEFAULT '0',
	minimum_debit_base   decimal(10,2) NOT NULL DEFAULT 0.00,
	maximum_debit_base   decimal(10,2) NOT NULL DEFAULT 0.00,
	minimum_debit_extra1 decimal(10,2) NOT NULL DEFAULT 0.00,
	maximum_debit_extra1 decimal(10,2) NOT NULL DEFAULT 0.00,
	minimum_debit_extra2 decimal(10,2) NOT NULL DEFAULT 0.00,
	maximum_debit_extra2 decimal(10,2) NOT NULL DEFAULT 0.00,
	minimum_debit_extra3 decimal(10,2) NOT NULL DEFAULT 0.00,
	maximum_debit_extra3 decimal(10,2) NOT NULL DEFAULT 0.00,
	minimum_debit_extra4 decimal(10,2) NOT NULL DEFAULT 0.00,
	maximum_debit_extra4 decimal(10,2) NOT NULL DEFAULT 0.00,
	minimum_debit_extra5 decimal(10,2) NOT NULL DEFAULT 0.00,
	maximum_debit_extra5 decimal(10,2) NOT NULL DEFAULT 0.00,
	id_payment_method    INTEGER NOT NULL
 AUTO_INCREMENT = 15,
	PRIMARY KEY (id),
	FOREIGN KEY R_2 (id_payment_method) REFERENCES payment_methods (id_payment_method)
);



CREATE TABLE settings_deposit
(
	id                   integer unsigned AUTO_INCREMENT,
	fee_fix              decimal(10,2) NOT NULL DEFAULT 0.00,
	fee                  decimal(10,2) NOT NULL DEFAULT 0.00,
	start_verify         char(1) NOT NULL DEFAULT '0',
	standart_verify      char(1) NOT NULL DEFAULT '0',
	expanded_verify      char(1) NOT NULL DEFAULT '0',
	status               char(1) NOT NULL DEFAULT '0',
	debit_base           char(1) NOT NULL DEFAULT '0',
	debit_extra1         char(1) NOT NULL DEFAULT '0',
	debit_extra2         char(1) NOT NULL DEFAULT '0',
	debit_extra3         char(1) NOT NULL DEFAULT '0',
	debit_extra4         char(1) NOT NULL DEFAULT '0',
	debit_extra5         char(1) NOT NULL DEFAULT '0',
	minimum_debit_base   decimal(10,2) NOT NULL DEFAULT 0.00,
	maximum_debit_base   decimal(10,2) NOT NULL DEFAULT 0.00,
	minimum_debit_extra1 decimal(10,2) NOT NULL DEFAULT 0.00,
	maximum_debit_extra1 decimal(10,2) NOT NULL DEFAULT 0.00,
	minimum_debit_extra2 decimal(10,2) NOT NULL DEFAULT 0.00,
	maximum_debit_extra2 decimal(10,2) NOT NULL DEFAULT 0.00,
	minimum_debit_extra3 decimal(10,2) NOT NULL DEFAULT 0.00,
	maximum_debit_extra3 decimal(10,2) NOT NULL DEFAULT 0.00,
	minimum_debit_extra4 decimal(10,2) NOT NULL DEFAULT 0.00,
	maximum_debit_extra4 decimal(10,2) NOT NULL DEFAULT 0.00,
	minimum_debit_extra5 decimal(10,2) NOT NULL DEFAULT 0.00,
	maximum_debit_extra5 decimal(10,2) NOT NULL DEFAULT 0.00,
	ac_debit_base        text(65535) NOT NULL DEFAULT '',
	ac_debit_extra1      text(65535) NOT NULL DEFAULT '',
	ac_debit_extra2      text(65535) NOT NULL DEFAULT '',
	ac_debit_extra3      text(65535) NOT NULL DEFAULT '',
	ac_debit_extra4      text(65535) NOT NULL DEFAULT '',
	ac_debit_extra5      text(65535) NOT NULL DEFAULT '',
	api_value1           varchar(100) NOT NULL DEFAULT '',
	api_value2           varchar(100) NOT NULL DEFAULT '',
	id_payment_method    INTEGER NOT NULL
 AUTO_INCREMENT = 17,
	PRIMARY KEY (id),
	FOREIGN KEY R_1 (id_payment_method) REFERENCES payment_methods (id_payment_method)
);



CREATE TABLE settings
(
	id                   integer unsigned AUTO_INCREMENT,
	name                 varchar(128) NOT NULL DEFAULT '',
	input_type           char(9) NOT NULL DEFAULT 'input',
	options              text(65535) NULL,
	is_numeric           char(1) NOT NULL DEFAULT '0',
	show_editor          char(1) NOT NULL DEFAULT '0',
	input_size           char(6) NULL,
	translate            char(1) NOT NULL DEFAULT '0',
	help_text            varchar(256) NULL,
	validation           varchar(128) NOT NULL DEFAULT '',
	sort_order           tinyint unsigned NOT NULL DEFAULT 0,
	label                varchar(128) NOT NULL DEFAULT '',
	value                text(65535) NULL,
	last_update          datetime NULL,
	updated_by           integer unsigned NULL
 AUTO_INCREMENT = 19,
	PRIMARY KEY (id)
);



CREATE TABLE pages
(
	id                   integer AUTO_INCREMENT,
	name                 text(65535) NOT NULL DEFAULT '',
	content              text(65535) NOT NULL DEFAULT '',
	translite            char(1) NOT NULL DEFAULT '0'
 AUTO_INCREMENT = 10,
	PRIMARY KEY (id)
);



CREATE TABLE orders
(
	id                   integer unsigned AUTO_INCREMENT,
	code                 varchar(100) NOT NULL DEFAULT '',
	date                 datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	id_item              integer NOT NULL DEFAULT 0,
	id_merchant          integer NOT NULL DEFAULT 0,
	id_transaction       integer NOT NULL DEFAULT 0,
	user                 varchar(200) NOT NULL DEFAULT ''
 AUTO_INCREMENT = 1,
	PRIMARY KEY (id)
);



CREATE TABLE merchant_categories
(
	id                   integer unsigned AUTO_INCREMENT,
	code                 varchar(100) NOT NULL DEFAULT '',
	date                 datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	status               char(1) NOT NULL DEFAULT '0',
	name                 text(65535) NOT NULL DEFAULT '',
	img                  text(65535) NOT NULL DEFAULT ''
 AUTO_INCREMENT = 10,
	PRIMARY KEY (id)
);



CREATE TABLE merchants_categories
(
	id                   integer unsigned AUTO_INCREMENT,
	id_merchant          integer NOT NULL DEFAULT 0,
	name                 text(65535) NOT NULL DEFAULT '',
	status               char(1) NOT NULL DEFAULT '1',
	user                 varchar(200) NOT NULL DEFAULT ''
 AUTO_INCREMENT = 1,
	PRIMARY KEY (id)
);



CREATE TABLE merchants
(
	id                   integer unsigned AUTO_INCREMENT,
	date                 datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	name                 text(65535) NOT NULL DEFAULT '',
	user                 varchar(300) NOT NULL DEFAULT '',
	link                 text(65535) NOT NULL DEFAULT '',
	status_link          text(65535) NOT NULL DEFAULT '',
	success_link         text(65535) NOT NULL DEFAULT '',
	fail_link            text(65535) NOT NULL DEFAULT '',
	password             text(65535) NOT NULL DEFAULT '',
	status               char(1) NOT NULL DEFAULT '1',
	comment              text(65535) NOT NULL DEFAULT '',
	logo                 text(65535) NOT NULL DEFAULT '',
	category             varchar(200) NOT NULL DEFAULT '',
	show_category        char(1) NOT NULL DEFAULT '0',
	note_payment         text(65535) NOT NULL DEFAULT '',
	fee                  decimal(10,2) NOT NULL DEFAULT 0.00,
	fix_fee              decimal(10,2) NOT NULL DEFAULT 0.00,
	payeer_fee           char(1) NOT NULL DEFAULT '0',
	test_mode            char(1) NOT NULL DEFAULT '0'
 AUTO_INCREMENT = 1,
	PRIMARY KEY (id)
);



CREATE TABLE login_attempts
(
	ip                   varchar(20) NOT NULL DEFAULT '',
	attempt              datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
);



CREATE TABLE items
(
	id                   integer unsigned AUTO_INCREMENT,
	name                 text(65535) NOT NULL DEFAULT '',
	about                text(65535) NOT NULL DEFAULT '',
	category_id          integer NOT NULL DEFAULT 0,
	merchant_id          integer NOT NULL DEFAULT 0,
	availability         integer NOT NULL DEFAULT 0,
	img                  text(65535) NOT NULL DEFAULT '',
	download_link        text(65535) NOT NULL DEFAULT '',
	status               char(1) NOT NULL DEFAULT '1',
	user                 varchar(100) NOT NULL DEFAULT '',
	price                decimal(10,2) NOT NULL DEFAULT 0.00,
	currency             varchar(100) NOT NULL DEFAULT ''
 AUTO_INCREMENT = 1,
	PRIMARY KEY (id)
);



CREATE TABLE invoices
(
	id                   integer unsigned AUTO_INCREMENT,
	code                 varchar(100) NOT NULL DEFAULT '',
	date                 datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	name                 text(65535) NOT NULL DEFAULT '',
	info                 text(65535) NOT NULL DEFAULT '',
	amount               decimal(10,2) NOT NULL DEFAULT 0.00,
	fee                  decimal(10,2) NOT NULL DEFAULT 0.00,
	total                decimal(10,2) NOT NULL DEFAULT 0.00,
	currency             varchar(100) NOT NULL DEFAULT '',
	sender               varchar(200) NOT NULL DEFAULT '',
	receiver             varchar(200) NOT NULL DEFAULT '',
	status               char(1) NOT NULL DEFAULT '1'
 AUTO_INCREMENT = 1,
	PRIMARY KEY (id)
);



CREATE TABLE events
(
	id                   integer unsigned AUTO_INCREMENT,
	type                 char(1) NOT NULL DEFAULT '1',
	user                 varchar(100) NOT NULL DEFAULT '',
	ip                   varchar(100) NOT NULL DEFAULT '',
	date                 datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	code                 varchar(100) NOT NULL DEFAULT ''
 AUTO_INCREMENT = 72,
	PRIMARY KEY (id)
);



CREATE TABLE email_templates
(
	id                   integer unsigned AUTO_INCREMENT,
	title                text(65535) NOT NULL DEFAULT '',
	message              text(65535) NOT NULL DEFAULT '',
	status               char(1) NOT NULL DEFAULT '0'
 AUTO_INCREMENT = 34,
	PRIMARY KEY (id)
);



CREATE TABLE emails
(
	id                   integer unsigned AUTO_INCREMENT,
	name                 varchar(64) NOT NULL DEFAULT '',
	email                varchar(256) NOT NULL DEFAULT '',
	title                varchar(128) NOT NULL DEFAULT '',
	message              text(65535) NOT NULL DEFAULT '',
	created              datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	read                 datetime NULL,
	read_by              integer unsigned NULL
 AUTO_INCREMENT = 1,
	PRIMARY KEY (id)
);



CREATE TABLE disputes_comment
(
	id                   integer unsigned AUTO_INCREMENT,
	id_dispute           integer NOT NULL DEFAULT 0,
	time                 datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	user                 varchar(200) NOT NULL DEFAULT '',
	role                 char(1) NOT NULL DEFAULT '1',
	comment              text(65535) NOT NULL DEFAULT ''
 AUTO_INCREMENT = 1,
	PRIMARY KEY (id)
);



CREATE TABLE disputes
(
	id                   integer unsigned AUTO_INCREMENT,
	transaction          integer NOT NULL DEFAULT 0,
	time_transaction     datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	time_dispute         datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	claimant             varchar(200) NOT NULL DEFAULT '',
	defendant            varchar(200) NOT NULL DEFAULT '',
	status               char(1) NOT NULL DEFAULT '1',
	amount               decimal(10,2) NOT NULL DEFAULT 0.00,
	fee                  decimal(10,2) NOT NULL DEFAULT 0.00,
	sum                  decimal(10,2) NOT NULL DEFAULT 0.00,
	currency             varchar(200) NOT NULL DEFAULT '',
	title                char(1) NOT NULL DEFAULT '1',
	message              text(65535) NOT NULL DEFAULT ''
 AUTO_INCREMENT = 1,
	PRIMARY KEY (id)
);



CREATE TABLE currencys
(
	id                   integer AUTO_INCREMENT,
	base_name            varchar(256) NOT NULL DEFAULT '',
	base_code            varchar(128) NOT NULL DEFAULT '',
	extra1_check         integer NOT NULL DEFAULT 0,
	extra1_name          varchar(256) NOT NULL DEFAULT '',
	extra1_code          varchar(128) NOT NULL DEFAULT '',
	extra1_rate          decimal(10,2) NOT NULL DEFAULT 0.00,
	extra2_check         integer NOT NULL DEFAULT 0,
	extra2_name          varchar(256) NOT NULL DEFAULT '',
	extra2_code          varchar(256) NOT NULL DEFAULT '',
	extra2_rate          decimal(10,2) NOT NULL DEFAULT 0.00,
	extra3_check         integer NOT NULL DEFAULT 0,
	extra3_name          varchar(256) NOT NULL DEFAULT '',
	extra3_code          varchar(128) NOT NULL DEFAULT '',
	extra3_rate          decimal(10,2) NOT NULL DEFAULT 0.00,
	extra4_check         integer NOT NULL DEFAULT 0,
	extra4_name          varchar(256) NOT NULL DEFAULT '',
	extra4_code          varchar(128) NOT NULL DEFAULT '',
	extra4_rate          decimal(10,2) NOT NULL DEFAULT 0.00,
	extra5_check         integer NOT NULL DEFAULT 0,
	extra5_name          varchar(256) NOT NULL DEFAULT '',
	extra5_code          varchar(128) NOT NULL DEFAULT '',
	extra5_rate          decimal(10,2) NOT NULL DEFAULT 0.00,
	fee                  decimal(10,2) NOT NULL DEFAULT 0.00,
	fee_fix              decimal(10,2) NOT NULL DEFAULT 0.00,
	api_extra1           char(1) NOT NULL DEFAULT '0',
	api_extra2           char(1) NOT NULL DEFAULT '0',
	api_extra3           char(1) NOT NULL DEFAULT '0',
	api_extra4           char(1) NOT NULL DEFAULT '0',
	api_extra5           char(1) NOT NULL DEFAULT '0'
 AUTO_INCREMENT = 2,
	PRIMARY KEY (id)
);



CREATE TABLE ci_sessions
(
	id                   varchar(128) NOT NULL DEFAULT '',
	ip_address           varchar(45) NOT NULL DEFAULT '',
	timestamp            integer unsigned NOT NULL DEFAULT 0,
	data                 blob(65535) NOT NULL DEFAULT '',
	PRIMARY KEY (id)
);



CREATE TABLE cashier_chat
(
	id                   integer AUTO_INCREMENT,
	id_transaccion       integer NOT NULL DEFAULT 0,
	id_user              integer NULL,
	message              varchar(255) NULL,
	fecha_hora           timestamp NULL
 AUTO_INCREMENT = 32,
	PRIMARY KEY (id)
);



CREATE TABLE carts
(
	id                   integer unsigned AUTO_INCREMENT,
	id_item              integer NOT NULL DEFAULT 0,
	id_merchant          integer NOT NULL DEFAULT 0,
	user                 varchar(200) NOT NULL DEFAULT '',
	date                 datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
 AUTO_INCREMENT = 1,
	PRIMARY KEY (id)
);



CREATE TABLE captcha
(
	captcha_id           bigint unsigned AUTO_INCREMENT,
	captcha_time         integer unsigned NOT NULL DEFAULT 0,
	ip_address           varchar(16) NOT NULL DEFAULT '0',
	word                 varchar(20) NOT NULL DEFAULT ''
 AUTO_INCREMENT = 1,
	PRIMARY KEY (captcha_id)
);



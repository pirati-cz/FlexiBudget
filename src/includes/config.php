<?php
/**
 * Flexibudget - Application config file.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */
define('LOG_NAME', 'Flexibudget');
define('LOG_TYPE', 'syslog');

/*
 * Výchozí odesilatel zpráv
 * Default mail sender
 */
define('EMAIL_FROM', 'flexibudget@localhost');

/*
 * URL Flexibee API
 */
define('FLEXIBEE_URL', 'https://localhost:5434');
/*
 * Uživatel FlexiBee API
 */
define('FLEXIBEE_LOGIN', 'admin');
/*
 * Heslo FlexiBee API
 */

define('FLEXIBEE_PASSWORD', 'admin123');
/*
 * Společnost v FlexiBee
 */

define('FLEXIBEE_COMPANY', 'ceska_piratska_strana');

//Database

/**
 * Database server host
 */
define('DB_SERVER', 'localhost');
/**
 * Database username
 */
define('DB_SERVER_USERNAME', 'flexibudget');
/**
 * Database password
 */
define('DB_SERVER_PASSWORD', 'flexibudget');
/**
 * Database name
 */
define('DB_DATABASE', 'flexibudget');
/**
 * Database port
 */
define('DB_PORT', 5432);
/**
 * Database type
 */
define('DB_TYPE', 'pgsql');

//Mailing

/**
 * Where send info about new sign ups
 */
define('SEND_INFO_TO', 'root@localhost');
/**
 * Default sender address
 */
define('SEND_MAILS_FROM', 'flexibudget@pirati.cz');

/**
 * #267 Hotfix
 */

define('Auth_OpenID_RAND_SOURCE',null);


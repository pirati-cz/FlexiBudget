<?php
/**
 * FlexiBudget - Application init.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */

namespace FlexiBudget;

require_once 'includes/config.php';
require_once '../vendor/autoload.php';

//Initialise Gettext
$langs  = [
    'en_US' => ['en', 'English (International)'],
    'cs_CZ' => ['cs', 'Česky (Čeština)'],
];
$locale = 'en_US';
if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $locale = \locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);
}
if (isset($_GET['locale'])) {
    $locale = preg_replace('/[^a-zA-Z_]/', '', substr($_GET['locale'], 0, 10));
}
foreach ($langs as $code => $lang) {
    if ($locale == $lang[0]) {
        $locale = $code;
    }
}
setlocale(LC_ALL, $locale.'.UTF-8');
bind_textdomain_codeset('flexibudget', 'UTF-8');
putenv("LC_ALL=$locale.UTF-8");
if (file_exists('../i18n')) {
    bindtextdomain('flexibudget', '../i18n');
}
textdomain('flexibudget');

session_start();

/**
 * User Object 
 * @global User
 */
$oUser = \Ease\Shared::user();

if (!\Ease\Shared::isCli()) {
    /* @var $oPage \Sys\WebPage */
    $oPage = new ui\WebPage();
}
    
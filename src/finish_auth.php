<?php
/**
 * FlexiBudget - OpenID stage I.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */

namespace FlexiBudget;

require_once 'includes/Init.php';


require_once "./includes/common.php";

$consumer = getConsumer();

$oiduser = new User();



// Complete the authentication process using the server's
// response.
$return_to = getReturnTo();
$response  = $consumer->complete($return_to);

// Check the response status.
if ($response->status === Auth_OpenID_CANCEL) {
    // This means the authentication was cancelled.
    $msg = 'Verification cancelled.';
} else if ($response->status === Auth_OpenID_FAILURE) {
    // Authentication failed; display the error message.
    $msg = "OpenID authentication failed: ".$response->message;
} else if ($response->status === Auth_OpenID_SUCCESS) {
    // This means the authentication succeeded; extract the
    // identity URL and Simple Registration data (if it was
    // returned).
    $openid = $response->getDisplayIdentifier();

    $oPage->addStatusMessage(sprintf('You have successfully verified '.
            '<a href="%s">%s</a> as your identity.', $openid, $openid),
        'success');

    if ($response->endpoint->canonicalID) {
        $escaped_canonicalID = escape($response->endpoint->canonicalID);
        $success             .= '  (XRI CanonicalID: '.$escaped_canonicalID.') ';
    }

    $sreg_resp = \Auth_OpenID_SRegResponse::fromSuccessResponse($response);

    $sreg = $sreg_resp->contents();

    $oiduser->setDataValue('email', $sreg['email']);
    $oiduser->setDataValue('login', $sreg['nickname']);

    $oiduser->setDataValue('oididentity', $openid);
    if (strstr($sreg['fullname'], ' ')) {
        list($firstname, $lastname) = explode(' ', $sreg['fullname']);
        $oiduser->setDataValue('firstname', $firstname);
        $oiduser->setDataValue('lastname', $lastname);
    }

    $oiduser->setmyKeyColumn('login');
    if (is_null($oiduser->loadFromSQL())) {
        $oiduser->setmyKeyColumn('id');
        $oiduser->saveToSQL();
    } else {
        $oiduser->setmyKeyColumn('id');
    }



    $pape_resp = \Auth_OpenID_PAPE_Response::fromSuccessResponse($response);

    if ($pape_resp) {
        if ($pape_resp->auth_policies) {
            $success .= "<p>The following PAPE policies affected the authentication:</p><ul>";

            foreach ($pape_resp->auth_policies as $uri) {
                $escaped_uri = escape($uri);
                $success     .= "<li><tt>$escaped_uri</tt></li>";
            }

            $success .= "</ul>";
        } else {
            $success .= "<p>No PAPE policies affected the authentication.</p>";
        }

        if ($pape_resp->auth_age) {
            $age     = escape($pape_resp->auth_age);
            $success .= "<p>The authentication age returned by the ".
                "server is: <tt>".$age."</tt></p>";
        }

        if ($pape_resp->nist_auth_level) {
            $auth_level = escape($pape_resp->nist_auth_level);
            $success    .= "<p>The NIST auth level returned by the ".
                "server is: <tt>".$auth_level."</tt></p>";
        }
    } else {
        $success .= "<p>No PAPE response was sent by the provider.</p>";
    }
    $oPage->addStatusMessage($success);
}

if (!is_null($oiduser->getMyKey())) {
    $oiduser->loginSuccess();
    \Ease\Shared::user($oiduser);
    $oPage->redirect('index.php');
}



$oPage->addItem(new ui\PageTop(_('FlexiBudget')));





$oPage->addItem(new ui\PageBottom());
$oPage->draw();

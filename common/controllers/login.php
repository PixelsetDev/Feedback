<?php

ob_start();

$app = new Boa\App();
$Portal = new Boa\Authentication\PortalSSO();

session_start();

if (isset($_SESSION['token'])) {
    header('Location: /account');
    ob_end_flush();
    exit;
}

$Login = $Portal->Login();
if ($Login) {
    $User = $Portal->Authenticate();
} else {
    header('Location: /error?code=1&origin=login');
    ob_end_flush();
    exit;
}

if (!$User) {
    header('Location: /error?code=2&origin=login');
    ob_end_flush();
    exit;
}

$_SESSION['name'] = $User->name;
$_SESSION['email'] = $User->email;
$_SESSION['avatar'] = $User->avatar;
$_SESSION['uuid'] = $User->uuid;

if ($User->uuid == null || $User->uuid == "") {
    session_destroy();
    session_unset();
    header('Location: /error?code=3&origin=login');
} else {
    header('Location: /account');
}

ob_end_flush();
exit;
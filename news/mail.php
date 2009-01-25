<?php
/**
 * News
 *
 * $Id: mail.php 1174 2009-01-19 15:11:03Z duck $
 *
 * Copyright Obala d.o.o. (www.obala.si)
 *
 * @author  Duck <duck@obala.net>
 * @package News
 */
require_once dirname(__FILE__) . '/lib/base.php';

$id = Util::getFormData('id');
$row = $news->get($id);
if ($row instanceof PEAR_Error) {
    $notification->push($row);
    header('Location: ' . Horde::applicationUrl('browse.php'));
    exit;
}

/* Error handler */
function _error($msg)
{
    $GLOBALS['notification']->push($msg, 'horde.error');
    header('Location: ' . News::getUrlFor('news', $GLOBALS['id']));
    exit;
}

if (!Auth::isAuthenticated()) {
    _error(_("Only authenticated users can send mails."));
}

$to = Util::getFormData('email');
if (empty($to)) {
    _error(_("No mail entered."));
    exit;
}

$from = $prefs->getValue('from_addr');
if (empty($from)) {
    _error(_("You have no email set."));
    exit;
}

$body = sprintf(_("%s would you like to invite you to read the news\n Title: %s\n\n Published: %s \nLink: %s"),
                Auth::getAuth(),
                $row['title'],
                $row['publish'],
                News::getUrlFor('news', $id, true, -1));

$mail = new Horde_Mime_Mail($row['title'], $body, $to, $from, NLS::getCharset());
$result = $mail->send($conf['mailer']['type'], $conf['mailer']['params']);
if ($result instanceof PEAR_Error) {
    $notification->push($result);
} else {
    $notification->push(sprintf(_("News succesfully send to %s"), $to), 'horde.success');
}

header('Location: ' . News::getUrlFor('news', $id));
exit;
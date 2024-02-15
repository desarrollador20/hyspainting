<?php
require_once('modules/Emails/Email.php');
//require_once( 'include/phpmailer/class.phpmailer.php' );
require_once('vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once('modules/EmailTemplates/EmailTemplate.php');
require_once( 'modules/OutboundEmailAccounts/OutboundEmailAccounts.php' );

class EmailCustom
{


    function prepareMail(): PHPMailer\PHPMailer\PHPMailer
    {

        LoggerManager::getLogger()->security('*****INGRESA MAIL******');


        $admin = new Administration();
        $admin->retrieveSettings();
        LoggerManager::getLogger()->security($admin->settings);
        //$mail = new PHPMailer();
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        if ($admin->settings['mail_sendtype'] == 'SMTP') {

            $mail->isSMTP();

            $mail->Host = $admin->settings['mail_smtpserver'];
            $mail->Port = $admin->settings['mail_smtpport'];

            if ($admin->settings['mail_smtpauth_req']) {
                $mail->SMTPAuth = true;
                $mail->Username = $admin->settings['mail_smtpuser'];
                $mail->Password = $admin->settings['mail_smtppass'];
            }

            $mail->Mailer        = "smtp";
            $mail->SMTPKeepAlive = true;
            $mail->From          = $admin->settings['notify_fromaddress'];
            $mail->FromName      = $admin->settings['notify_fromname'];
            $mail->ContentType   = "text/plain"; //"text/html"

            $mail->IsHTML(true);

            if ($admin->settings['mail_smtpssl'] == 1) {
                $mail->SMTPSecure = "ssl";
            } //  Used instead of TLS when only POP mail is selected

            if ($admin->settings['mail_smtpssl'] == 2) {
                $mail->SMTPSecure = "tls";
            } //  Used instead of TLS when only POP mail is selected
        } else {
            $mail->mailer = "sendmail";
        }

        return $mail;
    }

    public function sendEmailWithAttachments(string $email, string $msg, string $subject, $attachments = array())
    {
        $mail = $this->prepareMail();

        //$mail->From = "info@tenebit.com.co"; //TB: QUITAR PARA PRODUCTIVO EL FROM ESTA QUEMADO DEDSDE NEPS print_r($mail);

        $emails = explode(",", $email);
        foreach ($emails as $email) {
            $mail->addAddress($email);
        }

        $mail->Subject = utf8_decode($subject);
        $mail->Body    = utf8_decode(html_entity_decode($msg));


        foreach ($attachments as $attachment)
            if ($attachment != null) {
                $mail->AddAttachment($attachment);
            }

        return $mail->Send();
    }
}

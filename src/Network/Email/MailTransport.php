<?php
namespace Ora\Email\Network\Email;

use Cake\Network\Email\Email as CakeEmail;
use Cake\Network\Email\MailTransport as CakeTransport;

class MailTransport extends CakeTransport
{
    public function send(CakeEmail $email)
    {
        $profile = $email->profile();
        
        if (!isset($profile['inline']) || $profile['inline'] === true) {
            $email->inlineCss();
        }
        
        parent::send($email);
    }
}

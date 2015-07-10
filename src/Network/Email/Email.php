<?php
namespace Ora\Email\Network\Email;

use Ora\Email\Network\Email\MailTransport;
use Cake\Network\Email\Email as CakeEmail;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class Email extends CakeEmail
{
    public function __construct($config = null)
    {
        parent::__construct($config);
        
        $profile = $this->profile();
        $this->viewVars($profile['template']);
        $this->transport(new MailTransport());
    }
    
    public function inlineCss()
    {
        $message = $this->_message;
        
        $i = 0;
        foreach ($message as $key => $row) {
            if (stristr($row, $this->_boundary)) {
                $i++;
            }
            
            if ($i == 2) {
                break;
            }
        }
        
        $split = array_slice($message, 0, $key + 4);

        $html = new CssToInlineStyles();
        $html->setHtml($this->message('html'));
        $html->setUseInlineStylesBlock();
        $inline = $html->convert();
        
        $this->_message = array_merge($split, explode(PHP_EOL, $inline), ['--'.$this->_boundary.'--', '']);
    }
}

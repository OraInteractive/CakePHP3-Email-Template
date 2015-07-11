<?php
namespace Ora\Email\Network\Email;

use Cake\Network\Email\Email as CakeEmail;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class Email extends CakeEmail
{
    public function __construct($config = null)
    {
        parent::__construct($config);
        
        $profile = $this->profile();
        $this->viewVars($profile['template']);
    }
    
    protected function _renderTemplates($content)
    {
        $rendered = parent::_renderTemplates($content);
        $profile = $this->profile();
        
        if (
            (!isset($profile['inline']) || $profile['inline'] === true)
            && !empty($rendered['html'])
        ) {
            $html = new CssToInlineStyles();
            $html->setHtml($rendered['html']);
            $html->setUseInlineStylesBlock();
            $rendered['html'] = $html->convert();
        }
        
        return $rendered;
    }
}

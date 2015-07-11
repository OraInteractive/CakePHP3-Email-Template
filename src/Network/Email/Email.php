<?php
namespace Ora\Email\Network\Email;

use Cake\Network\Email\Email as CakeEmail;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use \Minify_HTML;
use \CssMin;

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
        
        if (!empty($rendered['html'])) {
            if (!empty($profile['inline']) && $profile['inline'] === true) {
                $html = new CssToInlineStyles();
                $html->setHtml($rendered['html']);
                $html->setUseInlineStylesBlock();
                $rendered['html'] = $html->convert();
            }
            
            if (!empty($profile['clean']) && $profile['clean'] === true) {
                $rendered['html'] = preg_replace('/<!--(.|\s)*?-->/', '', $rendered['html']);
            }
            
            if (!empty($profile['minify']) && $profile['minify'] === true) {
                $rendered['html'] = Minify_HTML::minify($rendered['html'], ['cssMinifier' => 'CssMin::minify']);
            }
        }

        return $rendered;
    }
}

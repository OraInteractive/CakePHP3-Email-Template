<?php
namespace Ora\Email\View\Helper;

use Cake\Event\Event;
use Cake\View\Helper;
use Cake\View\View;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

/**
 * Helper to add data to email template.
 *
 * @author Andre Sugai
 */
class EmailHelper extends Helper
{
    public $_defaultConfig = [
        'modifiers' => [
            'inline' => false,
            'clean' => false,
        ],
        'template' => [
            'backgroundColor' => '#FFFFFF',
            'defaultColor' => '#FFFFFF',
            'fontColor' => '#000000',
            'foregroundColor' => '#CECECE',
            'company' => '',
            'logo' => '',
            'homeLink' => '',
            'facebookLink' => '',
            'twitterLink' => '',
        ],
    ];
    
    protected $_emailType;
    
    /**
     * Get the View callbacks this helper is interested in.
     *
     * @return array
     */
    public function implementedEvents()
    {
        return [
            'View.beforeRenderFile' => 'beforeRenderFile',
            'View.beforeLayout' => 'beforeLayout',
            'View.afterLayout' => 'afterLayout',
        ];
    }
    
    /**
     * Sets the _emailType based on file the layoutFile.
     *
     * @param \Cake\Event\Event $event The event that is occuring
     * @param string $layoutFile The layout file url
     * @return void
     */
    public function beforeRenderFile(Event $event, $layoutFile)
    {
        $file = explode(DS, $layoutFile);
        $this->_emailType = $file[count($file) - 2];
    }
    
    /**
     * Sets View Blocks with data.
     *
     * @param \Cake\Event\Event $event The event that is occuring
     * @param string $layoutFile The layout file url
     * @return void
     */
    public function beforeLayout(Event $event, $layoutFile)
    {
        if ('text' == $this->getType()) {
            return;
        }
        
        if (!empty($this->_config['template'])) {
            foreach ($this->_config['template'] as $block => $viewVar) {
                $this->setBlock($block, $viewVar);
            }
        }
    }
    
    /**
     * Applies HTML modifiers.
     *
     * @param \Cake\Event\Event $event The event that is occuring
     * @param string $layoutFile The layout file url
     * @return void
     */
    public function afterLayout(Event $event, $layoutFile)
    {
        if ('text' == $this->getType()) {
            return;
        }
        
        if (!empty($this->_config['modifiers'])) {
            $content = $this->_View->Blocks->get('content');
            
            foreach ($this->_config['modifiers'] as $modifier => $config) {
                if ($config && in_array($modifier, ['inline', 'clean'])) {
                    $content = call_user_func_array([$this, $modifier], [$content, $config]);
                }
            }

            $this->_View->Blocks->set('content', $content);
        }
    }
    
    /**
     * Returns the _emailType.
     *
     * @return string email type
     */
    public function getType()
    {
        return $this->_emailType;
    }
    
    /**
     * Inlines CSS from style elements.
     *
     * @param string $content Html with CSS in style elements
     * @param array|bool $config Configuration for inline
     * @return string Html with inlined CSS attributes
     */
    public function inline($content, $config)
    {
        $html = new CssToInlineStyles();
        $html->setHtml($content);
        $html->setUseInlineStylesBlock();
        
        return $html->convert();
    }
    
    /**
     * Cleans html of comments.
     *
     * @param string $content Html with comments
     * @param array|bool $config Configuration for clean
     * @return string Html without comments
     */
    public function clean($content, $config)
    {
        $htmlRegex = !empty($config['htmlRegex']) ? $config['htmlRegex'] : '/<!--(.|\s)*?-->/';
        $content = preg_replace($htmlRegex, '', $content);
        
        $cssRegex = !empty($config['cssRegex']) ? $config['cssRegex'] : '!/\*[^*]*\*+([^/][^*]*\*+)*/!';
        $content = preg_replace($cssRegex, '', $content);
        
        return $content;
    }
    
    /**
     * Sets a _View->Block with data for the template.
     *
     * @param string $block Name of block to set
     * @param string $data Data for block
     * @return void
     */
    public function setBlock($block, $data)
    {
        if (in_array($block, ['homeLink', 'logo'])) {
            $data = $this->{$block}($data);
        }
        
        if (in_array($block, ['facebookLink', 'twitterLink'])) {
            $data = $this->{$block}($data, $this->getColor('font'));
        }

        $this->_View->Blocks->set($block, $data);
    }
    
    /**
     * Return a color from the template configuration.
     *
     * @param string $color Color name
     * @return string Hex color with leading #
     */
    public function getColor($color)
    {
        $template = $this->_config['template'];
        return !empty($template[$color . 'Color']) ? $template[$color . 'Color'] : $template['defaultColor'];
    }
    
    /**
     * Return a formatted header image.
     *
     * @param string $url Url of image
     * @return string Formatted image tag
     */
    public function logo($url)
    {
        return "<img src=\"$url\" id=\"headerImage\" />";
    }
    
    /**
     * Return a formatted homepage link.
     *
     * @param string $url Url of image
     * @return string Formatted homepage link tag
     */
    public function homeLink($url)
    {
        return "<a href=\"$url\" target=\"_blank\">$url</a>";
    }
    
    /**
     * Return a formatted facebook link.
     *
     * @param string $url Url of image
     * @param string $fillColor Fill color to use for svg image
     * @return string Formatted facebook link tag
     */
    public function facebookLink($url, $fillColor)
    {
        return "<a href=\"$url\" class=\"socialLink\" target=\"_blank\"><svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"
	 viewBox=\"0 0 36 36\" enable-background=\"new 0 0 36 36\" xml:space=\"preserve\">
<path id=\"XMLID_2_\" fill-rule=\"evenodd\" clip-rule=\"evenodd\" fill=\"$fillColor\" d=\"M18,0.2C8.1,0.2,0,8.2,0,18s8.1,17.8,18,17.8
	c9.9,0,18-8,18-17.8S27.9,0.2,18,0.2z M21.8,18h-2.4v8.6h-3.6V18h-1.8v-3h1.8v-1.8c0-2.4,1-3.9,4-3.9h2.4v3h-1.5
	c-1.1,0-1.2,0.4-1.2,1.2l0,1.5h2.8L21.8,18z\"/>
</svg> Facebook</a>";
    }
    
    /**
     * Return a formatted twitter link.
     *
     * @param string $url Url of image
     * @param string $fillColor Fill color to use for svg image
     * @return string Formatted twitter link tag
     */
    public function twitterLink($url, $fillColor)
    {
        return "<a href=\"$url\" class=\"socialLink\" target=\"_blank\"><svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"
	 viewBox=\"0 0 36 36\" enable-background=\"new 0 0 36 36\" xml:space=\"preserve\">
<path id=\"XMLID_4_\" fill-rule=\"evenodd\" clip-rule=\"evenodd\" fill=\"$fillColor\" d=\"M18,0.4c-9.9,0-18,8-18,17.8S8.1,36,18,36
	c9.9,0,18-8,18-17.8S27.9,0.4,18,0.4z M26.6,13.9c0,0.2,0,0.4,0,0.6c0,5.8-4.5,12.4-12.6,12.4c-2.5,0-4.8-0.7-6.8-2
	c0.3,0,0.7,0.1,1.1,0.1c2.1,0,4-0.7,5.5-1.9c-1.9,0-3.6-1.3-4.1-3c0.3,0.1,0.5,0.1,0.8,0.1c0.4,0,0.8-0.1,1.2-0.2
	c-2-0.4-3.6-2.2-3.6-4.3c0,0,0,0,0-0.1c0.6,0.3,1.3,0.5,2,0.5c-1.2-0.8-2-2.1-2-3.6c0-0.8,0.2-1.6,0.6-2.2c2.2,2.6,5.5,4.4,9.1,4.6
	c-0.1-0.3-0.1-0.7-0.1-1c0-2.4,2-4.4,4.4-4.4c1.3,0,2.4,0.5,3.2,1.4c1-0.2,2-0.6,2.8-1.1c-0.3,1-1,1.9-1.9,2.4
	c0.9-0.1,1.8-0.3,2.5-0.7C28.2,12.5,27.5,13.2,26.6,13.9z\"/>
</svg> Twitter</a>";
    }
}

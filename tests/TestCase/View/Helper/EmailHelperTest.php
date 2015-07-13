<?php
namespace Ora\Email\Test\TestCase\View\Helper;

use Cake\Core\Configure;
use Cake\Network\Email\Email;
use Cake\Network\Request;
use Cake\Routing\Router;
use Cake\TestSuite\TestCase;
use Cake\View\Helper\HtmlHelper;
use \DOMDocument;
use Ora\Email\View\Helper\EmailHelper;

class TestEmailHelper extends EmailHelper
{    
    public function setType($type)
    {
        $this->_emailType = $type;
    }
    
    public function getBlock($block)
    {
        return $this->_View->Blocks->get($block);
    }
    
    public function setContent($content)
    {
        return $this->_View->Blocks->set('content', $content);
    }
}

class EmailHelperTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $controller = $this->getMock('Cake\Controller\Controller', ['redirect']);
        $this->View = $this->getMock('Cake\View\View', array('append'));
        $this->Email = new TestEmailHelper($this->View, [
            'modifiers' => [
                'inline' => true,
                'clean' => true,
            ],
            'template' => [
                'backgroundColor' => '#AAAAAA',
                'defaultColor' => '#BBBBBB',
                'fontColor' => '#CCCCCC',
                'foregroundColor' => '#DDDDDD',
                'company' => 'Example LLC',
                'logo' => 'http://example.com/logo.png',
                'homeLink' => 'http://example.com',
                'facebookLink' => 'http://facebook.com/example',
                'twitterLink' => 'http://twitter.com/example',
            ],
        ]);
        $this->Email->request = new Request();
        $this->Email->request->webroot = '';

        Configure::write('App.namespace', 'TestApp');
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->Email, $this->View);
    }

    public function testBeforeRenderFile()
    {
        $event = $this->getMock('Cake\Event\Event', [], [$this->View]);
        $viewFileText = '/path/to/app/Template/Email/text/welcome.ctp';
        $viewFileHtml = '/path/to/app/Template/Email/html/welcome.ctp';
        
        $this->Email->beforeRenderFile($event, $viewFileText);
        $this->assertEquals('text', $this->Email->getType());

        $this->Email->beforeRenderFile($event, $viewFileHtml);
        $this->assertEquals('html', $this->Email->getType());
    }
    
    public function testBeforeLayout()
    {
        $config = $this->Email->config('template');
        $event = $this->getMock('Cake\Event\Event', [], [$this->View]);
        
        $viewFile = '/path/to/app/Template/Email/text/welcome.ctp';
        $this->assertEmpty($this->Email->beforeLayout($event, $viewFile));
        
        $viewFile = '/path/to/app/Template/Email/html/welcome.ctp';
        $this->Email->beforeLayout($event, $viewFile);
        
        $this->assertEquals($config['backgroundColor'], $this->Email->getBlock('backgroundColor'));
        $this->assertEquals($config['defaultColor'], $this->Email->getBlock('defaultColor'));
        $this->assertEquals($config['fontColor'], $this->Email->getBlock('fontColor'));
        $this->assertEquals($config['foregroundColor'], $this->Email->getBlock('foregroundColor'));
        $this->assertEquals($config['company'], $this->Email->getBlock('company'));
        
        $this->assertEquals($this->Email->logo($config['logo']), $this->Email->getBlock('logo'));
        $this->assertEquals($this->Email->homeLink($config['homeLink']), $this->Email->getBlock('homeLink'));
        $this->assertEquals($this->Email->facebookLink($config['facebookLink'], $config['fontColor']), $this->Email->getBlock('facebookLink'));
        $this->assertEquals($this->Email->twitterLink($config['twitterLink'], $config['fontColor']), $this->Email->getBlock('twitterLink'));
    }
    
    public function testAfterLayout()
    {
        $event = $this->getMock('Cake\Event\Event', [], [$this->View]);
        $html = '<style type="text/css">/*Testing*/p{font-size:20px;}</style><!--Comment--><p>Hello</p>';
        $htmlInlineClean = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html><head><style type="text/css">p{font-size:20px;}</style></head><body><p style="font-size: 20px;">Hello</p></body></html>
';

        $viewFile = '/path/to/app/Template/Email/text/welcome.ctp';
        $this->Email->setType('text');
        $this->Email->setContent($html);
        $this->Email->afterLayout($event, $viewFile);
        $this->assertEquals($html, $this->Email->getBlock('content'));

        $viewFile = '/path/to/app/Template/Email/html/welcome.ctp';
        $this->Email->setType('html');
        $this->Email->setContent($html);
        $this->Email->afterLayout($event, $viewFile);
        $this->assertEquals($htmlInlineClean, $this->Email->getBlock('content'));
    }
    
    public function testInline()
    {
        $html = '<style type="text/css">p{font-size:20px;}</style><p>Hello</p>';
        $htmlInline = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html><head><style type="text/css">p{font-size:20px;}</style></head><body><p style="font-size: 20px;">Hello</p></body></html>
';

        $this->assertEquals($htmlInline, $this->Email->inline($html, []));
    }
    
    public function testClean()
    {
        $html = '/* CSS Comment */Success<!-- HTML Comment -->';
        $htmlClean = 'Success';
        $this->assertEquals($htmlClean, $this->Email->clean($html, []));
    }
    
    public function testSetBlock()
    {
        $title = 'Example';
        $this->Email->setBlock('title', $title);
        $this->assertEquals($title, $this->Email->getBlock('title'));
    }
    
    public function testGetColor()
    {
        $config = $this->Email->config('template');
        $this->assertEquals($config['defaultColor'], $this->Email->getColor('default'));
        $this->assertEquals($config['defaultColor'], $this->Email->getColor('unknown'));
    }
    
    public function testLogo()
    {
        $logo = $this->Email->config('template.logo');
        $logoImg = $this->Email->logo($logo);
        
        $dom = new DOMDocument;
        $dom->loadHTML($logoImg);
        $elem = $dom->getElementsByTagName('img')->item(0);
        
        $this->assertEquals($logo, $elem->getAttribute('src'));
    }
    
    public function testHomeLink()
    {
        $link = $this->Email->config('template.homeLink');
        $homeLink = $this->Email->homeLink($link);

        $dom = new DOMDocument;
        $dom->loadHTML($homeLink);
        $elem = $dom->getElementsByTagName('a')->item(0);
        
        $this->assertEquals($link, $elem->getAttribute('href'));
        $this->assertEquals($link, $elem->nodeValue);
    }
    
    public function testFacebookLink()
    {
        $link = $this->Email->config('template.facebookLink');
        $facebookLink = $this->Email->facebookLink($link, '#CECECE');

        $dom = new DOMDocument;
        @$dom->loadHTML($facebookLink);
        $elem = $dom->getElementsByTagName('a')->item(0);

        $this->assertEquals($link, $elem->getAttribute('href'));
        $this->assertEquals(' Facebook', $elem->nodeValue);
    }
    
    public function testTwitterLink()
    {
        $link = $this->Email->config('template.twitterLink');
        $twitterLink = $this->Email->twitterLink($link, '#DEDEDE');

        $dom = new DOMDocument;
        @$dom->loadHTML($twitterLink);
        $elem = $dom->getElementsByTagName('a')->item(0);
        
        $this->assertEquals($link, $elem->getAttribute('href'));
        $this->assertEquals(' Twitter', $elem->nodeValue);
    }
}

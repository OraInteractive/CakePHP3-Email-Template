<?php
namespace Ora\Email\Test\Sample;

use Cake\Network\Email\Email;
use Cake\TestSuite\TestCase;

class EmailTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Email::configTransport('test', ['className' => 'Debug']);
        $this->Email = new Email([
            'transport' => 'test',
            'to' => 'example+to@example.com',
            'from' => 'example+from@example.com',
            'charset' => 'utf-8',
            'headerCharset' => 'utf-8',
            'layout' => 'Ora/Email.default',
            'emailFormat' => 'both',
            'helpers' => [
                'Ora/Email.Email' => [
                    'modifiers' => [
                        'inline' => true,
                        'clean' => true,
                    ],
                    'template' => [
                        'company' => 'My Company LLC',
                        'fontColor' => '#000000',
                        'backgroundColor' => '#FFFFFF',
                        'foregroundColor' => '#CECECE',
                        'logo' => 'https://s3.amazonaws.com/assets.myapp.com/email/logo.png',
                        'homeLink' => 'http://myapp.com',
                        'facebookLink' => 'http://facebook.com/myapp',
                        'twitterLink' => 'http://twitter.com/myapp',
                    ],
                ],
            ],
        ]);
    }

    public function tearDown()
    {
        parent::tearDown();
        Email::dropTransport('test');
        unset($this->Email);
    }

    public function testSend()
    {
        $this->Email->viewVars(['title' => 'Welcome!', 'user' => ['email' => 'example+to@example.com']]);
        $this->Email->template('welcome');

        $result = $this->Email->send();
        $expected = ['headers', 'message'];

        $this->assertEquals($expected, array_keys($result));
    }
}

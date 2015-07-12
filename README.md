# CakePHP3-Email-Template

[![Latest Stable Version](https://poser.pugx.org/orainteractive/cakephp3-email-template/v/stable)](https://packagist.org/packages/orainteractive/cakephp3-email-template)
[![License](https://poser.pugx.org/orainteractive/cakephp3-email-template/license)](https://packagist.org/packages/orainteractive/cakephp3-email-template)
[![Total Downloads](https://poser.pugx.org/orainteractive/cakephp3-email-template/downloads)](https://packagist.org/packages/orainteractive/cakephp3-email-template)

## About

Email Template for CakePHP3 is based on [HTML Email Layouts by MailChimp](https://github.com/mailchimp/Email-Blueprints).

Specifically, using a modified version of the [Base Boxed Basic Query](https://github.com/mailchimp/email-blueprints/blob/master/responsive-templates/base_boxed_basic_query.html) resposive template.

##Installation

The recommended installation way is through [Composer](https://getcomposer.org).

    $ composer require orainteractive/cakephp3-email-template

Load the plugin in `config/bootstrap.php`:

    Plugin::load('Ora/Email');

Update your email configuration in `config/app.php`, example shows `default` configuration:

    'Email' => [
    	'default' => [
    		'transport' => 'default',
    		'from' => 'you@localhost',
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
    	],
    ],

## Documentation

The following properties can be used to modify the HTML prior to sending:

| Property | Default | Description                   |
| -------- | ------- | ------------                  |
| clean    | false   | Removes HTML and CSS comments |
| inline   | false   | Inlines CSS                   |

Inline CSS uses [tijsverkoyen/css-to-inline-styles](https://github.com/tijsverkoyen/CssToInlineStyles)

The following properties can be used in the template configuration:

| Property        | Default | Description                                   |
| ----------------| ------- | --------------------------------------------- |
| backgroundColor | #FFFFFF | Background color for email                    |
| company         |         | Name of the company (ex. Ora Interactive LLC) |
| facebookLink    |         | Facebook URL for app                          |
| fontColor       | #000000 | Fond color for the email                      |
| foregroundColor | #FFFFFF | Foreground color for email                    |
| homeLink        |         | URL of app homepage                           |
| logo            |         | Full path URL for logo                        |
| twitterLink     |         | Twitter URL for app                           |

## Usage

In your app, send Emails as normal:

    use Cake\Network\Email\Email;
    ...
    $email = new Email('default');
    $email->to($user->email)
        ->subject('Welcome to my app!')
        ->template('welcome')
        ->send('Hope you enjoy using my app.');
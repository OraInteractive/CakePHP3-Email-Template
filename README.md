# CakePHP3-Email-Template

## About

Email Template for CakePHP3 is based on [HTML Email Layouts by MailChimp](https://github.com/mailchimp/Email-Blueprints)

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
            'layout' => 'Ora/Email.default',
            'emailFormat' => 'both',
            'inline' => true,
            'clean' => true,
            'minify' => true,
            'template' => [
                'company' => 'Ora Interactive LLC',
                'fontColor' => '#101010',
                'backgroundColor' => '#f8bb2a',
                'foregroundColor' => '#f8f8f8',
                'logo' => 'https://s3.amazonaws.com/assets.orainteractive.com/email/logo.png',
                'url' => 'http://orainteractive.com',
                'facebook' => 'http://facebook.com/orainteractive',
                'twitter' => 'http://twitter.com/orainteractive',
            ],
    	]
    ]

## Documentation

The following properties can be used to modify the HTML prior to sending:

Property | Default | Description
-------|---------|------------
inline |false|Inlines CSS using tijsverkoyen/css-to-inline-styles
clean |false|Remove HTML comments
minify |false|Minify CSS and HTML

The following properties can be used in the template configuration:

Property | Default | Description
-------|---------|------------
company | |Name of the company (ex. Ora Interactive LLC)
fontColor |#000000|Fond color for the email
backgroundColor |#FFFFFF|Background color for email
foregroundColor |#FFFFFF|Foreground color for email
logo | |Full path URL for logo
url | |URL of app homepage
facebook | |Facebook URL for app
twitter | |Twitter URL for app

## Usage

In your app, use the Email class:

    use Ora\Email\Network\Email\Email;
    
    $email = new Email('default');
    $email->to($user->email)
        ->subject('Welcome to my app!')
        ->template('welcome')
        ->send();
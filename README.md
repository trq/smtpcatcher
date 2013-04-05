# A Very Simple Smtp Mail Catcher

Inspired by the Ruby based http://mailcatcher.me project, I wanted something more light weight and written in PHP.

This is the basic start of that project.

Use this tool as a simple replacement for sendmail when testing local PHP scripts that need to send mail.

### Installation

Just edit your php.ini and point your sendmail_path to bin/smtpcatcher, eg;

```
sendmail_path = /path/to/bin/smtpcatcher
```

You could also edit this config option via a local .htaccess

```
php_value sendmail_path "/path/to/bin/smtpcatcher"
```

### View Sent Mail

Viewing sent email is easy, issue:

```
./path/to/bin/smtpcatcher -s
```

Then visit http://localhost:8100 in your browser.

### Sending Test Email

To check that smtpcatcher is working as expected and catching emails you can use it to send test emails:

```
./path/to/bin/smtpcatcher -t foo@foo.com "some test" "this is a test email"
```

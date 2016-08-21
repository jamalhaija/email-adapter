# Email Adapter
A simple wrapper for transactional email service. The target library is SparkPost, but it can be substituted and the `send()` method modified to fit the API of any other library. However, the implementation can remain the same as EmailAdapter exposes a simple set of methods:

```
setFrom($from)/getFrom() : The From email header field
setSubject($subject)/getSubject() : The email subject line
setBody($body)/getBody() : The HTML body

addRecepient($email) : Add an email address to the recepient list
addRecepients($emails) : Add multiple email addresses to the recepient list

send() : Send the email
```

Here's an example of how to use Sparkpost in conjunction with this adapter:

```php
//Dependencies
use SparkPost\SparkPost;
use GuzzleHttp\Client;
use Ivory\HttpAdapter\Guzzle6HttpAdapter;

//Construct the Sparkpost object
$httpAdapter = new Guzzle6HttpAdapter(new Client());
$apiObj = new SparkPost($httpAdapter, ['key'=>'<YOUR API KEY>']);

//Instantiate the EmailAdapter object
$email = new EmailAdapter($apiObj);

//Create email
$email->setFrom('sender@example.com');
$email->setSubject('Hello World!');
$email->setBody('<html><body><p>This is an HTML email.</p></body></html>');

//Add recepients
$email->addRecepients(['email1@example.com', 'email2@example.com', 'email3@example.com']);

//Send away
$email->send();
```

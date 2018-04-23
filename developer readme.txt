I have developed the APIs using php script.
I have used Slim Framework Restful Web service.
Slim is a PHP micro framework that helps you write simple yet powerful web applications and APIs.
More info about the slim framework can be found here: https://www.slimframework.com/
php code reference can be found here: http://php.net/manual/en/book.pdo.php

Development Steps (For starting to build your own API)
Install Slim Framework using the following steps:
1. Install Xampp on the machine.
2. Install composer on the machine.
3. Make a Project Directory on the following path:
C:\xampp\htdocs\{project name}
4. Open Command Prompt (cmd) and go to the Project Directory
5. Run the following command:
composer require slim/slim "^3.0"
6. You will notice that the composer has created some files inside the project directory
7. create a folder named public
8. create a folder named src
9. go to public folder and create a file: index.php
10. paste the following code inside of index.php

<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});
$app->run();
?>
<br>
Something went wrong :-(

11. Try running the basic service by using the following path on the browser:
http://localhost/transactions/public/index.php/hello/John
you can also try running the script by using your workstation's IP address
http://192.168.2.6/transactions/public/index.php/hello/John

12. Create a file named .htaccess in the public folder of the project
13. Paste the following lines in the file and save it:

RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule . index.php [L]

14. Add a virtual host to apache by doing the following:
a) Open the httpd-vhosts.conf file located inside the following directory
  C:\xampp\apache\conf\extra\httpd-vhosts.conf
b) Find the line that has "#NameVirtualHost *:80" and remove all the Hash # comments.
c) Add the below tags inside the file:
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs"
    ServerName localhost
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/transactions/public/"
    ServerName transactions
</VirtualHost>

15. Add a Server name by using the following steps:
a) Open Notepad in Administrator mode. (right click on notepad and run as administrator)
b) Go to C:\Windows\System32\drivers\etc
c) Open the file named hosts in the admin notepad
d) Enter the following at the bottom of the line
	127.0.0.1 transactions
	or
	<ipv4 address> projectname
16. Restart apache from the Xampp control pannel
17. Create a Database or import the mysql database dump inside the phpmysql

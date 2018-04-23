# sohail-khan
Following is a Restful Webservice that can enter Data into Database and retrieve information according to user input

Please scroll down to the bottom portion of this README for Prerequisites listing and Environment Setup.

PHP project is named "Transactions" - stored in the "transactions" folder
SoapUI Project is named "CustomerTransactions-soapui-project.xml" found in the root project folder

### Calling the APIs using soapUI
The Restful APIs can be called using any Restful Tool such as Postman, Rest Client, Easy Rest, etc. 
I have used SoapUI as a platform for calling the services because it provides advanced Test Automation features using Groovy Script.
I have added a simple Groovy script that will extract the Last Transacton ID from the Transaction List and process it further for calling other APIs

To use SoapUI to make the API Calls, Please follow the below steps:
1. Install SoapUI free version 5.4.0 from smartbear website. (https://www.soapui.org/downloads/soapui.html)
2. Open SoapUI and go to File->Import Project
3. Select the soapUI project XML file named "CustomerTransactions-soapui-project.xml" found in the project folder
4. Expand the project and open the testsuit named "SanityAutomationTestSuite".
5. Run the Testsuit and you will see the Execution results
6. SoapUI project also contains Various Assertions and steps for calling the API and validating the response.


## Following are the Resources and their Calling methods:

Endpoint : http://transactions

### 1. Get all Transactions:
Function: The API responds with all the list of Transctions that were recorded inside the database.
Verb: GET
Content-Type: application/json
Resource: /transactionservice/transaction

Sample Response:
[
      {
      "transaction_id": "1",
      "parent_id": "1",
      "amount": "20",
      "type": "Movie"
   },
      {
      "transaction_id": "2",
      "parent_id": "1",
      "amount": "30",
      "type": "cars"
   },
      {
      "transaction_id": "3",
      "parent_id": "1",
      "amount": "40.5",
      "type": "Clothing"
   }
]

### 2. Get Transaction Details from Database:
Function: It accepts one transaction ID in reqest and responds with details of that Transaction ID.
Verb: GET
Content-Type: application/json
Resource: /transactionservice/transaction/{transaction_id}

Sample Response:

[{
   "transaction_id": "9",
   "parent_id": "1",
   "amount": "13.6",
   "type": "Transportation"
}]

### 3. Get Transactions by Type
Function: Get Transaction list from database with a Type passed in the parameter
Verb: GET
Content-Type: application/json
Resource: /transactionservice/types/{type}

Sample Response:

[
      {
      "transaction_id": "2",
      "parent_id": "1",
      "amount": "30",
      "type": "cars"
   },
      {
      "transaction_id": "10",
      "parent_id": "1",
      "amount": "500.99",
      "type": "cars"
   }
]

### 4. Add a Transaction into Database
Function: The API Adds a Transaction into the database for the transction ID passed in the parameter.
Verb: PUT (Generally Add Operations are sent using POST however, I have used PUT as per the request)
Resource: /transactionservice/transaction/{transaction_id}

Sample Request:
{
	"amount":"500.99",
	"type":"cars",
	"parent_id":"1"
}

Sample Response:

{"text": "Customer Entry Added Successfully"}

### 5. List all transactions linked through a common parent_id
Function: This provides a List of all transactions that are transitively linked by their parent_id to transaction_id
verb: GET
Resource: /transactionservice/checklink/{transaction_id}

Sample Response:
[
      {
      "transaction_id": "5",
      "parent_id": "2",
      "amount": "49.9",
      "type": "Fuel"
   },
      {
      "transaction_id": "6",
      "parent_id": "2",
      "amount": "39.9",
      "type": "Movies"
   },
      {
      "transaction_id": "7",
      "parent_id": "2",
      "amount": "39.9",
      "type": "Movies"
   },
      {
      "transaction_id": "8",
      "parent_id": "2",
      "amount": "12.4",
      "type": "Transportation"
   }
]

### 6. Sum of 
Function This provides a sum of all transactions that are transitively linked by their parent_id to transaction_id
verb: GET
Resource: /transactionservice/sum/{transaction_id}

Sample Response:
[{"SUM(amount)": "242.39"}]


### Prerequisites :

1. Install Xampp ver. 1.8.3 or later in the "C:\xampp" directory 
(Alternatively you can install individual packages of 
Apache Version 2.4.9 and phpMyAdmin version 4.8.0 or later)
2. SoapUI Version 5.4.0 or above installed in the system
3. Composer for windows, installed (for Developers)
4. Slim framework installed (for Developers)

### Environment Setup:

1. Add a virtual host to apache by doing the following:
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


2. Add a Server name by using the following steps:
a) Open Notepad in Administrator mode. (right click on notepad and run as administrator)
b) Go to C:\Windows\System32\drivers\etc
c) Open the file named hosts in the admin notepad
d) Enter the following at the bottom of the file
	127.0.0.1 transactions
	or
	<ipv4 address> projectname
3. Change the phpmyadmin username and password to "root" and "root" by doin the following:
a) Go to the folder named "SupportFiles"
b) Copy the file named "config.inc.php"
c) Go open the phpMyAdmin folder and take a backup already existing config.inc.php file.
d) Paste the config.inc.php file provided in the SupportingFiles directory.

4. Add a host entry for the url (to make it easy to access it)
a) Open notepad as an Administrator
b) Go to C:\windows\system32\drivers\etc\
c) Open the hosts file in Administrator notepad
d) add the following line at the bottom of the file:
	127.0.0.1 transactions

5. Import the mysql database dump named "mtransactions.sql" inside the phpmyadmin console mySQL database

6. Paste the folder named "transactions" in the following directory:
	C:\xampp\htdocs

7. Restart apache from the Xampp control pannel

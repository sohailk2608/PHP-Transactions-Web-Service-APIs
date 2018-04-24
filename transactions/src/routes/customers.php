<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// Get all customers activity details
// Return - Array of Transaction details

$app->get('/transactionservice/transaction', 
function(Request $request, Response $response){
    $sql = "SELECT * FROM customeractivity";

    try{
        //get DB object
        $db = new db();
        //connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        //echo json_encode($customers);
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($customers));


    } catch(PDOException $e){
        
        return $response->withStatus(400)
        ->withHeader('Content-Type', 'application/json')
        ->write('{error":{"text": '.$e->getMessage().'"}'.'}');

    }
});

// Get Single Transaction Detail from Database
// Param - transaction_id
// Return - Array of Transaction details of the Transaction_ID passed in the parameter
$app->get('/transactionservice/transaction/{transaction_id}', 
function(Request $request, Response $response){
    $transaction_id =  $request->getAttribute('transaction_id');
    $sql = "SELECT * FROM customeractivity WHERE transaction_id = $transaction_id";

    try{
        //get DB object
        $db = new db();
        //connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($customer));

    } catch(PDOException $e){
        //echo '{error":{"text": '.$e->getMessage().'}';
        return $response->withStatus(400)
        ->withHeader('Content-Type', 'application/json')
        ->write('{error":{"text": '.$e->getMessage().'"}'.'}');
    }
});

// Get Transaction list from database with a Type passed in the parameter
// Param - Transaction type
// Return - Array of Transaction details of the Transaction type passed in the parameter
$app->get('/transactionservice/types/{type}',
function(Request $request, Response $response){
    $type =  $request->getAttribute('type');
    
    $sql = "SELECT * FROM customeractivity WHERE type like '%$type%'";
    
    try{
        //get DB object
        $db = new db();
        //connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($customer));

    } catch(PDOException $e){
        
        return $response->withStatus(400)
        ->withHeader('Content-Type', 'application/json')
        ->write('{error":{"text": '.$e->getMessage().'"}'.'}');
    }
});

// Add a Transaction for Customer ID
// Param - transaction_id, parent_id, transaction amount, transaction type
// Return - Success failure message for Transaction entry
$app->put('/transactionservice/transaction/{transaction_id}', 
function(Request $request, Response $response){
    $transaction_id =  $request->getAttribute('transaction_id');
    $parent_id =  $request->getParam('parent_id');
    $amount =  $request->getParam('amount');
    $type =  $request->getParam('type');
            
    $sql = "INSERT INTO customeractivity (transaction_id, parent_id, amount, type) VALUES (:transaction_id, :parent_id, :amount, :type);";

    try{
        //get DB object
        $db = new db();
        //connect
        $db = $db->connect();

        $stmt = $db ->prepare($sql);

        $stmt->bindParam(':transaction_id', $transaction_id);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':parent_id', $parent_id);

        echo $sql;


        $stmt->execute();

        //echo'{"notice":{"text":"Customer Entry Added Successfully"}}';
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write('{"text":"Customer Entry Added Successfully"}');
        
    } catch(PDOException $e){
        //echo '{error":{"text": '.$e->getMessage().'}';
        return $response->withStatus(400)
        ->withHeader('Content-Type', 'application/json')
        ->write('{error":{"text": '.$e->getMessage().'"}'.'}');
    }
});

// A List of all transactions that are transitively linked by their parent_id to transaction_id
// Param - transaction_id
// Return - Array of Transactions that are transitively linked by their parent_id to the transaction_id
$app->get('/transactionservice/checklink/{transaction_id}', 
function(Request $request, Response $response){
    $transaction_id =  $request->getAttribute('transaction_id');
    $sql = "SELECT * FROM `customeractivity` WHERE parent_id = (SELECT parent_id FROM `customeractivity` WHERE transaction_id = $transaction_id)";

    try{
        //get DB object
        $db = new db();
        //connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        

        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($customer));

    } catch(PDOException $e){
        
        return $response->withStatus(400)
        ->withHeader('Content-Type', 'application/json')
        ->write('{error":{"text": '.$e->getMessage().'"}'.'}');
    }
});

// A sum of all transactions that are transitively linked by their parent_id to transaction_id
// Param - transaction_id
// Return - A sum of Transactions that are transitively linked by their parent_id to the transaction_id
$app->get('/transactionservice/sum/{transaction_id}', 
function(Request $request, Response $response){
    $transaction_id =  $request->getAttribute('transaction_id');
    $sql = "SELECT SUM(amount) FROM `customeractivity` WHERE parent_id = (SELECT parent_id FROM `customeractivity` WHERE transaction_id = $transaction_id)";

    try{
        //get DB object
        $db = new db();
        //connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        

        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($customer));

    } catch(PDOException $e){
        
        return $response->withStatus(400)
        ->withHeader('Content-Type', 'application/json')
        ->write('{error":{"text": '.$e->getMessage().'"}'.'}');
    }
});


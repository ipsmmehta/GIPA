<?Php
/////// Update your database login details here /////
$dbhost_name = "localhost"; // Your host name 
$database = "itra_mis";       // Your database name
$username = "gaurav";            // Your login userid 
$password = "5PaF6wWsw6YAnzEw";            // Your password 
//////// End of database details of your server //////

// START OF AAJ Ki DATA 
    date_default_timezone_set("Asia/Kolkata");
    $aajki_date = date("Y-m-d H:i:s");
// END OF AAJ Ki DATA 
//////// Do not Edit below /////////
try {
$dbo = new PDO('mysql:host='.$dbhost_name.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?> 
 
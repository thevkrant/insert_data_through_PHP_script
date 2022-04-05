# How to insert data in existing table from and existing table through PHP script ?
## Database connection:
The collection of related data is called a database. XAMPP stands for cross-platform, Apache, MySQL, PHP, and Perl. It is among the simple light-weight local servers for website development. In PHP, we can connect to database using localhost XAMPP web server.

### Syntax:
```php
<?php

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

// Create connection
$conn = new mysqli($servername,
	$username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: "
		. $conn->connect_error);
}

$sqlquery = "INSERT INTO table VALUES
	('John', 'Doe', 'john@example.com')"

if ($conn->query($sql) === TRUE) {
	echo "record inserted successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
```
## Error reporting:
The error_reporting() function sets the error_reporting directive at runtime. The error_reporting(E_ALL) is the most widely used among developers to show error messages because it is more readable and understandable.

### Syntax:
```php
error_reporting(E_ALL);
ini_set('display_errors', 0);
```
> Note: Change 0 to 1 in code for display the errors.

## 1. Create connection:
### Syntax:
```php
function createConnection()
{

	$host = "localhost or IP address";
	$dbname = "database_name";
	$dbuser = "username";
	$dbpass = "password";

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$con = mysqli_connect($host, $dbuser, $dbpass, $dbname);
	$con->set_charset("utf8");
	if (mysqli_connect_errno()) {
		//print mysqli_connect_errno()."ERROR IN MYSQL";
		print "Oops. Something has gone wrong. Please try again.";
		return null;
	}
	return $con;
}

function closeConnection($con)
{
	mysqli_close($con);
}
```

## 2. Update connection:
### Syntax:
```php
function updateConnection()
{

	$host = "localhost or IP address";
	$dbname = "database_name";
	$dbuser = "username";
	$dbpass = "password";

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$con2 = mysqli_connect($host, $dbuser, $dbpass, $dbname);
	$con2->set_charset("utf8");
	if (mysqli_connect_errno()) {
		//print mysqli_connect_errno()."ERROR IN MYSQL";
		print "Oops. Something has gone wrong. Please try again.";
		return null;
	}
	return $con2;
}

function closeupdateConnection($con2)
{
	mysqli_close($con2);
}
```

## 3. SQL select query and bind function for fetch data from tables:
### Syntax:
```php
$sql = "SELECT dt.state_id, tt.tehsil_id, dt.district_id, dt.district_name from tehsil_table tt join district_table dt on dt.district_id = tt.district_id";  // write your SQL query here.
$stmt = $con->prepare($sql);
$stmt->bind_result($state_id, $tehsil_id, $district_id, $district_name);  //veriables
$stmt->execute();
$stateArr1 = array();

while ($stmt->fetch()) {
	$state = new stdClass();
	$state->state_id = $state_id;
	$state->tehsil_id = $tehsil_id;
	$state->district_id = $district_id;
	$state->district_name = $district_name;

	array_push($stateArr1, $state);
}

$stmt->close();
```

## 4. SQL update query and bind function for update data to table:
### Syntax:
```php
foreach ($stateArr1 as $key => $value) {

	$tehsil_id = $value->tehsil_id;
	$district_id = $value->district_id;
	$state_id = $value->state_id;

	$update_sql = "update tehsil_table set state_id=? where tehsil_id=? and district_id=?";  // write your SQL query here.
	$stmt = $con2->prepare($update_sql);
	$stmt->bind_param("iii", $state_id, $tehsil_id, $district_id);
	$stmt->execute();
	$stmt->close();
	$i++;
}
```

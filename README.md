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

## First create connection:

### Syntax:

<?php
@session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);
date_default_timezone_set("Asia/Kolkata");

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
$con = createConnection();
$con2 = updateConnection();

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

//echo "<pre>";print_r($stateArr1);exit;

$i = 0;
echo "<br>Count ";
echo count($stateArr1);
echo "<br>";
echo " Start The time is " . date("h:i:s a");
echo "<br>";

foreach ($stateArr1 as $key => $value) {

	$tehsil_id = $value->tehsil_id;
	$district_id = $value->district_id;
	$state_id = $value->state_id;

	//echo "<pre>";print_r($value->state_id);

	$update_sql = "update tehsil_table set state_id=? where tehsil_id=? and district_id=?";  // write your SQL query here.
	$stmt = $con2->prepare($update_sql);
	$stmt->bind_param("iii", $state_id, $tehsil_id, $district_id);
	$stmt->execute();
	$stmt->close();
	$i++;
}

echo "<br>";
echo "ex count " . $i;
echo "<br>";
echo "End The time is " . date("h:i:s a");

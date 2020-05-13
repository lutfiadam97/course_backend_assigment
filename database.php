<?php

class Database
{
	function execute($query)
	{
		include("connection.php");
		if(mysqli_query($conn, $query)){
			mysqli_close($conn);
			return true;
		}
		mysqli_close($conn);
		return false;
	}

	function get($query)
	{
		include("connection.php");
		$result = $conn->query($query);
		if($result->num_rows > 0)
		{
			$conn->close();
			return $result;
		}
		$conn->close();
		return null;
	}

	function get_procedure_execute($procedure)
	{
		include("connection.php");
		return mysqli_query($conn,"Call ".$procedure);
	}
}
?>
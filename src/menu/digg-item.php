<?php

function get_new_pdo() {
	$config = array(
		"db" => array(
	        "driver"    => "mysql",
	        "host"      => "localhost",
			"port"		=> "3307",
	        "username"  => "wjlcn",
	        "password"  => "hello1234",
	        "database"  => "0575pw",
			"charset"	=> "utf-8"
		),
		"dbtest" => array(
	        "driver"    => "mysql",
	        "host"      => "localhost",
			"port"		=> "3306",
	        "username"  => "digg",
	        "password"  => "hello1234",
	        "database"  => "digg",
			"charset"	=> "utf-8"
		)
	);
	
	try {
		$db_config = $config["db"];
		$db_source = "{$db_config["driver"]}:dbname={$db_config["database"]};host={$db_config["host"]};port={$db_config["port"]};charset={$db_config["charset"]}";
		$pdo = new PDO($db_source, $db_config["username"], $db_config["password"]);
		return $pdo;
	} catch (PDOException $pdoe) {
		echo "Connection failed: " . $pdoe->getMessage();
		
		return null;
	}
}


function new_digg_item($desc, $price) {
	try {
		$pdo = get_new_pdo();
		$sql = "INSERT INTO digg_item (digg_item_name, digg_item_desc) VALUES (:name, :desc);";
		$statement = $pdo->prepare($sql);
		$result = $statement->execute(array(
			"name" => $desc,
			"desc" => $price
		));
		$id = $pdo->lastInsertId();

		//		$resultArray = $statement->fetchAll();
		//		return $resultArray;

		return $id;
	} catch (PDOException $pdoe) {
		echo "Connection failed: " . $pdoe->getMessage();
	}
}

function digg_digg_item($id) {
	try {
		$pdo = get_new_pdo();

		$sql = "UPDATE digg_item SET digg_item_recommend = digg_item_recommend + 1 WHERE digg_item_id =:id;";
		$statement = $pdo->prepare($sql);
		$statement->execute(array(
			"id" => $id
		));

		$sql = "SELECT digg_item_recommend FROM digg_item WHERE digg_item_id =:id;";
		$statement = $pdo->prepare($sql);
		$statement->execute(array(
			"id" => $id
		));

		$resultArray = $statement->fetch(PDO::FETCH_NUM);
		return $resultArray[0];
	} catch (PDOException $pdoe) {
		echo "Connection failed: " . $pdoe->getMessage();
	}
}

function index_digg_item() {
	try {
		$pdo = get_new_pdo();

		$sql = "SELECT digg_item_id AS id, digg_item_name AS name, digg_item_desc AS price, digg_item_recommend AS count FROM digg_item ORDER BY digg_item_recommend DESC, digg_item_desc ASC;";
		$statement = $pdo->prepare($sql);
		$statement->execute();

		$resultArray = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $resultArray;
	} catch (PDOException $pdoe) {
		echo "Connection failed: " . $pdoe->getMessage();
	}
}

if (isset($_GET["new"])) {
	$desc = $_POST["desc"];
	$price = $_POST["price"];

	$id = new_digg_item($desc, $price);
	$result = array(
		"id" => $id,
		"desc" => $desc,
		"price" => $price,
		"count" => 0
	);

	echo json_encode($result);
} else if (isset($_GET["digg"])) {
	$id = $_POST["id"];
	$digg = $_COOKIE[$id];

	$result = null;
	if (!$digg) {
		$count = digg_digg_item($id);

		$result = array(
			"id" => $id,
			"count" => $count,
			"digg" => true
		);

		setcookie($id, "digg", mktime().time() + 60 * 60 * 12);
	} else {
		$result = array(
			"id" => $id,
			"count" => $count,
			"digg" => false
		);
	}

	echo json_encode($result);
}
?>
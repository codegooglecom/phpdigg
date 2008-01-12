<?php
class DataSource {
	/* Data source name */
	private $dsn;

	private $username;
	private $password;

	private $pdo;

	public function __construct($dsn, $username, $password) {
		$this->dsn = $dsn;
		$this->username = $username;
		$this->password = $password;
			
		$this->pdo = NULL;
	}

	public function  getDsn() {
		return $this->dsn;
	}

	public function setDsn($dsn) {
		$this->dsn = $dsn;
	}

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		return $username;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function getPdo() {
		if (!$this->pdo) {
			try {
				$this->pdo = new PDO($this->dsn, $this->username, $this->password);
			} catch (PDOException $pdoe) {
				echo "Connection failed: " . $pdoe->getMessage();
			}
		}
			
		return $this->pdo;
	}
}
?>
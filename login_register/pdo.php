<?php
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=tesla_registration','harry', 'hesper833161');
	$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
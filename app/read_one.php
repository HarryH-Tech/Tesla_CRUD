<?php
	include 'header.php';
?>

	<div class='container'>
		
		<?php
			//get passed param value (record id in this case)
			$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
			
			try {
				   //prepare select query
				   $query = "SELECT id, name, description, price, image FROM products WHERE id = ? LIMIT 0,1";
				   $stmt = $pdo->prepare( $query );
				 
				   // this is the first question mark
				   $stmt->bindParam(1, $id);
				 
				   // execute our query
				   $stmt->execute();
				   
				   $row = $stmt -> fetch(PDO::FETCH_ASSOC);
				   
				   $name = $row['name'];
				   $description = $row['description'];
				   $price = $row['price'];
				   $image = htmlspecialchars($row['image'], ENT_QUOTES);
				   }
 
			// show error
			catch(PDOException $exception){
				die('ERROR: ' . $exception->getMessage());
			}
			?>
			
			<h1> Information on the <?php echo htmlspecialchars($name, ENT_QUOTES);  ?> </h1>
			<table class='table'>
				<tr>
					<td>Name</td>
					<td><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></td>
				</tr>
				<tr>
					<td>Description</td>
					<td><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></td>
				</tr>
				<tr>
					<td>Price</td>
					<td><?php echo htmlspecialchars($price, ENT_QUOTES);  ?></td>
				</tr>
					<td>Image</td>
					
						<td>
							<?php echo $image ? "<img src='uploads/{$image}' style='width:300px;' />" : "No image found.";  ?>
						</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<a href='index.php' class='btn btn-danger'>Back to main page</a>
					</td>
				</tr>
			<tr>
		</table>
	</body>
</html>	
				
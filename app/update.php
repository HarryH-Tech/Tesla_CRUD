<?php
	include 'header.php';
?>

<div class='container'>

<?php

	$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
	
	try {
	// prepare select query
    $query = "SELECT id, name, description, price, image FROM products WHERE id = ? LIMIT 0,1";
    $stmt = $pdo->prepare( $query );
     
    // this is the first question mark
    $stmt->bindParam(1, $id);
     
    // execute our query
    $stmt->execute();
     
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // values to fill up our form
    $name = $row['name'];
    $description = $row['description'];
    $price = $row['price'];
	$image = $row['image'];
				   

	}
 
	// show error
	catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
?>


<?php
	if($_POST) {
		try {
			$query = "UPDATE products SET name=:name,description=:description, price=:price WHERE id=:id";
			
			$stmt = $pdo->prepare($query);
			
			//form values
			$name=htmlspecialchars(strip_tags($_POST['name']));
			$description=htmlspecialchars(strip_tags($_POST['description']));
			$price=htmlspecialchars(strip_tags($_POST['price']));
			
			
			//bind params then execute the query
			$stmt -> bindParam(':name', $name);
			$stmt -> bindParam(':description', $description);
			$stmt -> bindParam(':price', $price);
			$stmt -> bindParam(':id', $id);
			
				   
			if($stmt -> execute()) {
				echo "<div class='alert alert-success'>Record was updated.</div>";
			}else{
				echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
			}
         
		}
		// show errors
		catch(PDOException $exception){
			die('ERROR: ' . $exception->getMessage());
		}
	}
	
	?>
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?id={$id}");?>" method="post">
    <table class='table table-responsive table-bordered'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type='text' name='price' value="<?php echo htmlspecialchars($price, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Image</td>
			
            <td>
				<?php echo $image ? "<img src='uploads/{$image}' style='width:300px;' />" : "No image found.";  ?>
				<br><br>
				<input type='file' name='image'/>
			</td>
	
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' style='margin:auto;' />
				<br>
                <a href='index.php' class='btn btn-danger'>Back to home page</a>
            </td>
        </tr>
    </table>
</form>





	
	
	
	
	
	
	
	
	
	
	
	
	
	



		</div>
	</body>
</html>
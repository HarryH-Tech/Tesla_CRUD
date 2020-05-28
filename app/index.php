<?php
	include 'header.php';
	
	// PAGINATION 
	// page is the current page, if there's nothing set, default is page 1
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	 
	// set records or rows of data per page
	$records_per_page = 5;
	 
	// calculate for the query LIMIT clause
	$from_record_num = ($records_per_page * $page) - $records_per_page;
?>

	<h1> Tesla Database </h1>
	<p> Welcome to the Tesla database. Here you can find information on cars produced by Tesla. </p>
	<br>

	<?php
		echo "<a href='create.php' class='btn btn-success'>Add Record</a><br>";
		

		// select data for current page
		$query = "SELECT id, name, description, price FROM products ORDER BY id DESC LIMIT :from_record_num, :records_per_page";
		 
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
		$stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);
		$stmt->execute();
	
		
		$num = $stmt -> rowCount();
		
		if($num > 0) {
		echo "<table class='table table-responsive'>";//start table
			echo"<tr>";
				echo "<th>Name</th>";
				echo "<th>Description</th>";
				echo "<th>Price</th>";
				echo "<th>Options</th>";
			echo "</tr>";
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				//extract row, this will make $row['firstname'] to just $firstname only
				extract($row);
				
				echo "<tr>";
				echo "<td>{$name}</td>";
				echo "<td>{$description}</td>";
				echo "<td>&#36;{$price}</td>";
				echo "<td>";
				
				//read one record
				echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>&nbsp;&nbsp;<br>";
				
				// we will use this links on next part of this post
				echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>&nbsp;&nbsp;<br>";
 
				// we will use this links on next part of this post
				echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>&nbsp;&nbsp;<br>";
        echo "</td>";
    echo "</tr>";
	}
echo "</table>";
		//Count total # of rows
		$query = "SELECT COUNT(*) as total_rows FROM products";
		$stmt = $pdo->prepare($query);
		
		$stmt->execute();
		
		//get total rows
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$total_rows = $row['total_rows'];
		
		$page_url = "index.php?";
		include_once "paging.php";
			
}


		
$action = isset($_GET['action']) ? $_GET['action'] : "";
 
// if it was redirected from delete.php
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}

?>

<script type='text/javascript'>
// confirm record deletion
function delete_user( id ){
     
    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok, 
        // pass the id to delete.php and execute the delete query
        window.location = 'delete.php?id=' + id;
    } 
}
</script>
</body>
</html>
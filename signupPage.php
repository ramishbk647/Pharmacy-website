 <?php 
					
							include('config.php');
							if(isset($_POST['submit'])){
							

							$sql = "INSERT INTO adminlogin (name, phoneNo, email, password)	VALUES ('" . $_POST["name"] ."','" . $_POST["phoneNo"] ."', '" . $_POST["email"] ."', '" . $_POST["password"] ."')";

							if ($conn->query($sql) === TRUE) {
							    echo "<script>alert('Thanks for your feedback!');</script>";
							} else {
							    echo "<script>alert('There was an Error')<script>";
							}

							$conn->close();
						}
					
 			?>
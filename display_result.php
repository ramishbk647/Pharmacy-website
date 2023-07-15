<!DOCTYPE html>
<html lang="en">

<head>
	<title>People's Health Pharmacy &mdash; Colorlib Template</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="img/png" href="images/logo.png"/>
	<link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
	
	<link rel="stylesheet" href="fonts/icomoon/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">

</head>

<body>
	<?php
		function GetFormStringValue(string $formArg) : string {
			if (!empty($_POST[$formArg])) {
				return $_POST[$formArg];
			} else {
				return '';
			}
		}
		
		function QueryDatabase(mysqli& $connection, string $query, array $arguments) : array {
			$returnValue = array();
			
			if (empty($arguments)) {
				$result = $connection->query($query);
				if ($result) {
					$returnValue[0] = true;
					$returnValue[1] = $result;
				} else {
					$returnValue[0] = $result;
					$returnValue[1] = $connection->error;
				}
			} else {
				$queryObj = $connection->prepare($query);
				if ($queryObj) {
					$queryObj->bind_param(str_repeat('s', count($arguments)), ...$arguments);
					$returnValue[0] = $queryObj->execute();
					if ($returnValue[0]) {
						$returnValue[1] = $queryObj->get_result();
					} else {
						$returnValue[1] = $queryObj->error;
					}
					$queryObj->close();
				} else {
					$returnValue[0] = $queryObj;
					$returnValue[1] = $connection->error;
				}
			}
			
			return $returnValue;
		}
		
		function CreateRecordsArray(mysqli_result& $recordsResult) : array {
			$records = array();
			$rowData = $recordsResult->fetch_assoc();
			while ($rowData) {
				$record = array();
				$record['saleTime'] = $rowData['saleTime'];
				$record['customer'] = $rowData['customer'];
				$record['taxAmount'] = $rowData['taxAmount'];
				$record['discountAmount'] = $rowData['discountAmount'];
				$record['product'] = $rowData['product'];
				$record['amount'] = $rowData['amount'];
				$record['price'] = $rowData['price'];
				$record['editLink'] = "<a href=\"sales_record_edit.php?id={$rowData['saleID']}\">Edit</a>";
				$record['deleteLink'] = "<a href=\"sales_record_delete.php?id={$rowData['saleID']}\">Delete</a>";
				
				$records[$rowData['saleID']] = $record;
				$rowData = $recordsResult->fetch_assoc();
			}
			return $records;
		}
		
		function DisplayRecordTable(array $records) {
			echo('<table>
			<tr>    <th>Time</th>    <th>Customer</th>    <th>Taxed Amount</th>    <th>Discounted Amount</th>    <th>Product</th>    <th>Amount</th>    <th>Price</th>    <th>Actions</th>    <th></th>    </tr>');
			foreach ($records as $record => $data) {
				echo("<tr>    <td>{$data['saleTime']}</td>    <td>{$data['customer']}</td>    <td>{$data['taxAmount']}</td>    <td>{$data['discountAmount']}</td>    <td>{$data['product']}</td>    <td>{$data['amount']}</td>    <td>{$data['price']}</td>    <td>{$data['editLink']}</td>    <td>{$data['deleteLink']}</td>    </tr>");
			}
			echo('</table>');
		}
		
		function GetDatabaseInformation(string $startDate, string $endDate, array& $resultArray) {
			$connection = new mysqli('localhost', 'root', '', 'salesrecords', 3306);
			if ($connection->connect_error) {
				return "Could not connect to the database: {$connection->connect_error}";
			}
			
			$results = QueryDatabase($connection, 'SELECT id FROM SalesRecords WHERE DATEDIFF(saleTime, ?) >= 0 AND DATEDIFF(saleTime, ?) <= 0', array($startDate, $endDate));
			
			if ($results[0]) {
				$rowData = $results[1]->fetch_assoc();
				if ($rowData) {
					// there is at least one result, gather needed ids
					// format: id => true, to ensure uniqueness
					$idsToFetch = array();
					do {
						$idsToFetch[$rowData['id']] = true;
						$rowData = $results[1]->fetch_assoc();
					} while ($rowData);
					
					// destruct the old query
					$results[1]->close();
					
					// now make a LONG query for making the table
					$query = 'SELECT SalesRecords.id AS saleID, saleTime, Customers.name AS customer, taxAmount, discountAmount, Products.name AS product, amount, price
						FROM SalesRecords
						LEFT OUTER JOIN SalesProducts ON SalesRecords.id = SalesProducts.saleID
						LEFT OUTER JOIN Products ON SalesProducts.productID = Products.id 
						LEFT OUTER JOIN Customers ON SalesRecords.customerID = Customers.id
						WHERE SalesRecords.id IN(';
					foreach ($idsToFetch as $idToFetch => $value) {
						$query = $query.$connection->real_escape_string($idToFetch).', ';
					}
					$query = substr($query, 0, -2);
					$query = $query.') ORDER BY SalesRecords.id';
					
					$results = QueryDatabase($connection, $query, array());
					if ($results[0]) {
						$resultArray = CreateRecordsArray($results[1]);
						$results[1]->close();
					} else {
						return 'Record retrival failed: '.$connection->error;
					}
					return false;
				}
				else
				{
					return 'No records found.';
				}
			} else {
				return 'Search failed: '.$results[1];
			}
			
			$connection->close();
		}
		
		$dateStart = GetFormStringValue('start_date');
		$dateEnd = GetFormStringValue('end_date');
		$records = array();
		$errorMsg = GetDatabaseInformation($dateStart, $dateEnd, $records);
	?>

	<div class="site-wrap">


		<div class="site-navbar py-2">

			<div class="search-wrap">
				<div class="container">
					<a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>

				</div>
			</div>

			<div class="container">
				<div class="d-flex align-items-center justify-content-between">
					<div class="logo">
						<div class="site-logo">
							<a href="index.html" class="company-logo"> <img src="images/logo.png" width= "48" height="48" alt="Image"></a>
							<a href="index.html" class="js-logo-clone">People's Health Pharmacy</a>
						</div>
					</div>
					<div class="main-nav d-none d-lg-block">
						<nav class="site-navigation text-right text-md-center" role="navigation">
							<ul class="site-menu js-clone-nav d-none d-lg-block">
								<li><a href="index.html">Home</a></li>
								<li><a href="shop.html">Store</a></li>
								<li class="active"><a href="login.html">Staff</a></li>
								<li><a href="contact.html">Contact</a></li>

							</ul>
						</nav>
					</div>
					<div class="search-bar">
					<input type="text" class="form-control" placeholder="Search keyword ">
					</div>
					
					<div class="icons">
						<a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="bg-light py-3">
			<div class="container">
				<div class="row">
					<div class="col-md-12 mb-0">
						<a href="index.html">Home</a> <span class="mx-2 mb-0">/</span>
						<strong class="text-black">Manager Module</strong>
					</div>
				</div>
			</div>
		</div>

		<div class="site-section">
			<div class="container">
				<?php
					if ($errorMsg)
					{
						echo('
						<div class="row">
							<div class="col-md-12">
								<h2 class="h3 mb-5 text-black">Records cannot be displayed: '.$errorMsg.'</h2>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<a href="sales_record_display.html">
										<button type="button" class="btn btn-primary btn-lg btn-block">Try Again</button>
									</a>
								</div>
							</div>		
							<div class="row">
								<div class="col-lg-12">
									<a href="index.html">
										<button type="button" class="btn btn-primary btn-lg btn-block">Back to Homepage</button>
									</a>
								</div>
							</div>		 
						</div>');
					}
					else
					{
						echo('
						<div class="row row_continue">
							<div class="col-md-12">
								<h2 class="h3 mb-5 text-black">Records retrieved:</h2>
							</div>');
						DisplayRecordTable($records);
						echo('
							<div class="row">
								<div class="col-lg-12">
									<a href="sales_record_display.html">
										<button type="button" class="btn btn-primary btn-lg btn-block">Continue</button>
									</a>
								</div>
							</div>				
						</div>');
					}
				?>
			</div>
		</div>


		<footer class="site-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-lg-3 mb-4 mb-lg-0">

						<div class="block-7">
							<h3 class="footer-heading mb-4">About Us</h3>
							<p>We are a small pharmacy based in Hawthorn. We offer various medicines, healthcare products, cosmetics and accessories.</p>
						</div>

					</div>
					<div class="col-lg-3 mx-auto mb-5 mb-lg-0">
						<h3 class="footer-heading mb-4">Quick Links</h3>
						<ul class="list-unstyled">
							<li><a href="index.html">Homepage</a></li>
							<li><a href="shop.html">Product Catalog</a></li>
							<li><a href="login.html">Employee Login</a></li>
							<li><a href="contact.html">Contact Us</a></li>
						</ul>
					</div>

					<div class="col-md-6 col-lg-3">
						<div class="block-5 mb-5">
							<h3 class="footer-heading mb-4">Contact Info</h3>
							<ul class="list-unstyled">
								<li class="address">52 Church St, Hawthorn VIC 3122, Australia</li>
								<li class="phone"><a href="tel://61398528700">+61 3 9852 8700</a></li>
								<li class="email"><a href="mailto:queries@phpinc.com">queries@phpinc.com</a></li>
							</ul>
						</div>


					</div>
				</div>
				
			</div>
		</footer>
	</div>

</body>

</html>
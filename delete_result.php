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
				$queryObj->bind_param(str_repeat('s', count($arguments)), ...$arguments);
				$returnValue[0] = $queryObj->execute();
				if ($returnValue[0]) {
					$returnValue[1] = $queryObj->get_result();
				} else {
					$returnValue[1] = $queryObj->error;
				}
				$queryObj->close();
			}
			
			return $returnValue;
		}
		
		function DeleteDatabaseInformation(string $saleID) {
			// order: $customer, $saleTime, $taxAmount, $discountAmount, $product, $amount, $price
			$returnHeader = 'An error occurred while updating the database:<br />';
			
			$connection = new mysqli('localhost', 'root', '', 'salesrecords', 3306);
			if ($connection->connect_error) {
				return "Failed to connect to the database. Technical details:<br />{$connection->connect_error}";
			}
			
			// modify the sales products
			$queryReturns = QueryDatabase(
				$connection,
				'DELETE FROM `SalesProducts` WHERE `saleID` = ?',
				array($saleID)
			);
			if (!$queryReturns[0]) {
				$connection->close();
				return $returnHeader.$queryReturns[1];
			}
			
			// and now the sales record
			$queryReturns = QueryDatabase(
				$connection,
				'DELETE FROM `SalesRecords` WHERE `id` = ?',
				array($saleID)
			);
			if (!$queryReturns[0]) {
				$connection->close();
				return $returnHeader.$queryReturns[1];
			}
			
			$connection->close();
			return false;
		}
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$errMsg = DeleteDatabaseInformation(GetFormStringValue('sale_id'));
		}
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
					if ($errMsg)
					{
						echo('<div class="row">
							<div class="col-md-12">
								<h2 class="h3 mb-5 text-black">Sales record deletion failed: '.$errMsg.'</h2>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<a href="sales_record_delete.php?id='.$saleID.'">
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
						echo('<div class="row row_continue">
							<div class="col-md-12">
								<h2 class="h3 mb-5 text-black">Sales Record Deletion Successfully!</h2>
							</div>
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
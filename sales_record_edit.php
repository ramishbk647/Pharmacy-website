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
		
		<header class="bg-light py-3">
			<div class="container">
				<div class="row">
					<div class="col-md-12 mb-0">
						<a href="index.html">Home</a> <span class="mx-2 mb-0">/</span>
						<strong class="text-black">Manager Module</strong>
					</div>
				</div>
			</div>
		</header>

		<article class="site-section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="h3 mb-5 text-black">Edit Record</h2>
					</div>
					<div class="col-md-12">
		
						<form action="edit_result.php" method="post">
						
							<div class="p-3 p-lg-5 border">
								<div class="form-group row">
									<div class="col-md-6">
										<label for="sale_time" class="text-black">Sale Time</label>
										<input type="datetime-local" class="form-control" id="sale_time" name="sale_time" />
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										If this is not specified, the current time and date will be assumed to be the sale time and date.
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="customer" class="text-black">Customer Name<span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="customer" name="customer" />
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="tax_amount" class="text-black">Taxed Amount</label>
										<input type="text" class="form-control" id="tax_amount" name="tax_amount" placeholder="0.00" />
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="discount_amount" class="text-black">Discounted Amount</label>
										<input type="text" class="form-control" id="discount_amount" name="discount_amount" placeholder="0.00" />
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="product" class="text-black">Product Name<span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="product" name="product" />
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="amount" class="text-black">Product Quantity<span class="text-danger">*</span></label>
										<input type="number" class="form-control" id="amount" name="amount" />
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="price" class="text-black">Price Per Product<span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="price" name="price" />
									</div>
								</div>
								<input type="hidden" id="sale_id" name="sale_id" value=<?php echo($_GET['id']); ?> />
								<div class="form-group row">
									<div class="col-lg-12">
										<input type="submit" class="btn btn-primary btn-lg btn-block" value="Edit Record" />
									</div>
								</div>
							</div>
						</form>
					</div>
					
				</div>
			</div>
		</article>


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
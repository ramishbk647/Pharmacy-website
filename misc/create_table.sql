CREATE TABLE `SalesRecords` (
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`customerID` INTEGER NOT NULL,
	`saleTime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`taxAmount` DECIMAL(8,2) NOT NULL,
	`discountAmount` DECIMAL(8,2) NOT NULL,
	
	PRIMARY KEY (`id`)
);

CREATE TABLE `SalesProducts` (
	`saleID` INTEGER NOT NULL,
	`productID` INTEGER NOT NULL,
	`amount` INTEGER NOT NULL,
	`price` DECIMAL(8,2) NOT NULL,
	
	PRIMARY KEY (`saleID`, `productID`)
);

CREATE TABLE `Products` (
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` CHAR(255) NOT NULL,
	`categoryID` SMALLINT NOT NULL,
	
	PRIMARY KEY (`id`)
);

CREATE TABLE `Categories` (
	`id` SMALLINT NOT NULL AUTO_INCREMENT,
	`name` CHAR(255) NOT NULL,
	
	PRIMARY KEY (`id`)
);

CREATE TABLE `Customers` (
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` CHAR(255) NOT NULL,
	
	PRIMARY KEY (`id`)
);

ALTER TABLE `SalesRecords`
	ADD FOREIGN KEY (`customerID`) REFERENCES `Customers` (`id`);

ALTER TABLE `SalesProducts`
	ADD FOREIGN KEY (`saleID`) REFERENCES `SalesRecords` (`id`),
	ADD FOREIGN KEY (`productID`) REFERENCES `Products` (`id`);

ALTER TABLE `Products`
	ADD FOREIGN KEY (`categoryID`) REFERENCES `Categories` (`id`);
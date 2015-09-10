CREATE TABLE  `customers` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`offer` VARCHAR( 100 ) NOT NULL ,
`advertiser` VARCHAR( 100 ) NOT NULL ,
`startdate` VARCHAR( 100 ) NOT NULL ,
`enddate` VARCHAR( 100 ) NOT NULL ,
`status` VARCHAR(100) NOT NULL,
`country` VARCHAR(100) NOT NULL  
) ENGINE = INNODB;


-- CREATE TABLE  `customers` (
-- `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
-- `name` VARCHAR( 100 ) NOT NULL ,
-- `email` VARCHAR( 100 ) NOT NULL ,
-- `mobile` VARCHAR( 100 ) NOT NULL
-- ) ENGINE = INNODB;



INSERT INTO `customers` (`id`, `offer`, `advertiser`, `startdate`, `enddate`, `status`, `country`) 
VALUES
(9, 'Back to School', 'Saks 5TH Ave', '08-15-2015', '09-20-2015','approved', 'US' ),
(10, 'Rugby World Cup', 'Macys', '08-05-2015', '09-20-2015','approved', 'US' ),
(12, 'Back to School', 'Shoemall.com', '08-15-2015', '09-20-2015','approved', 'US' ),
(13, 'London Fashion Week', 'JS Trunk', '08-08-2015', '09-20-2015','approved', 'US' ),
(14, 'Back to School', 'Bloomingdales', '08-06-2015', '09-20-2015','approved', 'US' ),
(15, 'Back to School', 'Saks 5TH Ave', '08-15-2015', '09-20-2015','approved', 'AUS' ),
(16, 'Rugby World Cup', 'Macys', '08-05-2015', '09-20-2015','notApproved', 'US'  ),
(8, 'Back to School', 'Shoemall.com', '08-15-2015', '09-20-2015','notApproved', 'AUS' ),
(17, 'Fashion Sale', 'JS Trunk', '08-08-2015', '09-20-2015','notApproved', 'CA' ),
(19, 'ASDKLJADS', 'Bloomingdales', '08-06-2015', '09-20-2015','notApproved', 'UK' ),
(20, 'AKSDJKJASD', 'Saks 5TH Ave', '08-15-2015', '09-20-2015','approved', 'UK' ),
(21, 'Rugby World Cup', 'Macys', '08-05-2015', '09-20-2015','approved', 'US' ),
(22, 'Fathers Day', 'Shoemall.com', '08-15-2015', '09-20-2015','approved', 'CA' ),
(23, 'London Fashion Week', 'JS Trunk', '08-08-2015', '09-20-2015','notApproved', 'CA' ),
(24, 'Mothers Day', 'Bloomingdales', '08-06-2015', '09-20-2015','notApproved', 'CA' );



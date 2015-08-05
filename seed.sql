CREATE TABLE  `customers` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`offer` VARCHAR( 100 ) NOT NULL ,
`advertiser` VARCHAR( 100 ) NOT NULL ,
`startdate` VARCHAR( 100 ) NOT NULL ,
`enddate` VARCHAR( 100 ) NOT NULL 
) ENGINE = INNODB;


-- CREATE TABLE  `customers` (
-- `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
-- `name` VARCHAR( 100 ) NOT NULL ,
-- `email` VARCHAR( 100 ) NOT NULL ,
-- `mobile` VARCHAR( 100 ) NOT NULL
-- ) ENGINE = INNODB;



INSERT INTO `customers` (`id`, `offer`, `advertiser`, `startdate`, `enddate`) VALUES
(9, 'Back to School', 'Saks 5TH Ave', '08-15-2015', '09-20-2015' ),
(10, 'Rugby World Cup', 'Macys', '08-05-2015', '09-20-2015' ),
(12, 'Back to School', 'Shoemall.com', '08-15-2015', '09-20-2015' ),
(13, 'London Fashion Week', 'JS Trunk', '08-08-2015', '09-20-2015' ),
(14, 'Back to School', 'Bloomingdales', '08-06-2015', '09-20-2015' ),
(15, 'Back to School', 'Saks 5TH Ave', '08-15-2015', '09-20-2015' ),
(16, 'Rugby World Cup', 'Macys', '08-05-2015', '09-20-2015' ),
(8, 'Back to School', 'Shoemall.com', '08-15-2015', '09-20-2015' ),
(17, 'Fashion Sale', 'JS Trunk', '08-08-2015', '09-20-2015' ),
(19, 'ASDKLJADS', 'Bloomingdales', '08-06-2015', '09-20-2015' ),
(20, 'AKSDJKJASD', 'Saks 5TH Ave', '08-15-2015', '09-20-2015' ),
(21, 'Rugby World Cup', 'Macys', '08-05-2015', '09-20-2015' ),
(22, 'Fathers Day', 'Shoemall.com', '08-15-2015', '09-20-2015' ),
(23, 'London Fashion Week', 'JS Trunk', '08-08-2015', '09-20-2015' ),
(24, 'Mothers Day', 'Bloomingdales', '08-06-2015', '09-20-2015' );



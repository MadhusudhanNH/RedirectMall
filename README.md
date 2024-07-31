Create schema named as redirectmall in MySQL and create a new table called tblusers by using below given statements.
 
CREATE SCHEMA `redirectmall` ;

CREATE TABLE `redirectmall`.`tblusers` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Person` varchar(90) NOT NULL,
  `EMailAddress` varchar(90) NOT NULL,
  `MobileNumber` varchar(90) NOT NULL,
  `City` varchar(45) NOT NULL,
  `StateUT` varchar(45) NOT NULL,
  `CreatedOn` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;

Connect database with PHP by using dbname, username, password present in config.php or you can add change as per your database credentials.

After successfull connection you can open index.php file.

Thank you.

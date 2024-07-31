Project Highlights:
1.It include 4 php files config.php, lib.php, index.php, logincontroller.php . each files have there respective roles.
2.It will allow you to do Log in, Sign Up, View all data of tblusers table and Log out functionalities.
3.Included Bootstrap CSS & JS CDN links for better appearence and resposive of application. 

Guidance for Database connection:
1- Create schema named as redirectmall in MySQL and create a new table called tblusers by using below given statements.
 
2- CREATE SCHEMA `redirectmall` ;

3- CREATE TABLE `redirectmall`.`tblusers` (
    `Id` int NOT NULL AUTO_INCREMENT,
    `Person` varchar(90) NOT NULL,
    `EMailAddress` varchar(90) NOT NULL,
    `MobileNumber` varchar(90) NOT NULL,
    `City` varchar(45) NOT NULL,
    `StateUT` varchar(45) NOT NULL,
    `CreatedOn` datetime NOT NULL,
    PRIMARY KEY (`Id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
4- Connect database with PHP by using dbname, username, password present in config.php or you can add change as per your database credentials.

After successfull connection you can open index.php file.

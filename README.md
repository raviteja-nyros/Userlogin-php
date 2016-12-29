# Userlogin-php

This is all about login with todo in PHP , MYSQL.

Important Points:

     *you need to have server PHP 5.5.9 or higher to run this;

     *Easy to understand the each and every part of code.

Just changes should be done if any in database.php

      Database: `crud`

      Table structure for table `customers`


      CREATE TABLE IF NOT EXISTS `customers` (
               `id` int(11) NOT NULL AUTO_INCREMENT,
               `name` varchar(200) NOT NULL,
               `email` varchar(200) NOT NULL,
               `mobile` varchar(100) NOT NULL,
               `teamname` varchar(200) NOT NULL,
               `skills` varchar(200) NOT NULL,
               `members` varchar(200) NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `name` (`name`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

**create and enjoy uploading files**

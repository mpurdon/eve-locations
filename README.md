eve-locations
=============

This is a super-simple CodeIgniter based project that provides locator result tracking for the Eve Online MMO.

To get started, copy application/config/database.php into application/config/development/database.php and update the database credentials to match your local environment.
You will want to copy the application/config/config.php into application/config/development/config.php as well. You should probably set up the 'base_url' configuration option as well.
These files will be ignored by git moving forward and should be all you need other than creating the database and running the following SQL:

    --
    -- Table structure for table `location`
    --
    
    CREATE TABLE IF NOT EXISTS `location` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `pilot` varchar(255) NOT NULL,
      `date` datetime NOT NULL,
      `station` varchar(255) NOT NULL,
      `system` varchar(255) NOT NULL,
      `constellation` varchar(255) NOT NULL,
      `region` varchar(255) NOT NULL,
      `ship_type` varchar(255) NOT NULL,
      PRIMARY KEY (`id`),
      KEY `pilot` (`pilot`),
      KEY `date` (`date`),
      KEY `station` (`station`),
      KEY `system` (`system`),
      KEY `constellation` (`constellation`),
      KEY `region` (`region`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
 
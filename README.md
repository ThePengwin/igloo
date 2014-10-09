igloo
=====

A simple shurt-url file hosting service

# Needs
- PHP 5.3+
- Composer
- Apache (it should be fine on any server if you direct _all_ traffic to index.php)

## Install notes

### Make this table
```sql
CREATE TABLE `files` (
  `id` varchar(45) NOT NULL,
  `mime` varchar(45) NOT NULL,
  `uploaded` int(13) NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

### Edit the config

edit the values in config-sample.php and save as config.php

### Done!


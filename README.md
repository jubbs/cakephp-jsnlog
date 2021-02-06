# JSNLog plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/j-s-n-log




```

Create Database table

CREATE TABLE `jsn_logs` (
`id` INT NOT NULL,
`l` VARCHAR(45) NULL,
`message` MEDIUMTEXT NULL,
`name` VARCHAR(45) NULL,
`stamp` VARCHAR(45) NULL,
`u` VARCHAR(45) NULL,
`created` DATETIME NULL,
PRIMARY KEY (`id`));

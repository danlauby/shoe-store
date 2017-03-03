# _Shoe Store_

#### Application allows a store to add shoes to their inventory and shoes to add stores at which they are sold.

#### By Dan Lauby

## Description

This program allows a store to keep track of which brands of shoes they sell and be able to find what stores sell which brand of shoes.

## _Application Specifications_

| Behavior | Input | Output |
|----------|-------|--------|
|Allow user to input a store name|"Trents Shoes"|"Trents Shoes"|
|Allow user to input a shoe brand name|"Puma"|"Puma"|
|Save a store name to database|"Trents Shoes"|"Trents Shoes"|
|Save a shoe brand name to database|"Puma"|"Puma"|
|Save all store names to database|"Trents Shoes", "Trents Awesome Shoes"|"Trents Shoes", "Trents Awesome Shoes"|
|Save all shoe brand names to database|"Puma", "Adidas"|"Puma", "Adidas"|
|Delete all store names to database|"Trents Shoes", "Trents Awesome Shoes"|" "|
|Delete all shoe brand names to database|"Puma", "Adidas"|" "|
|Allow user to update name of a store|"Trents Shoes"|"Trents Awesome Shoes"|
|Allow user to delete a store|"Trents Shoes"|" "|
|Find one store from all stores|FIND:"Trents Shoes" -> "Trents Shoes", "Trents Awesome Shoes"|FOUND:"Trents Shoes"|
|Find one brand of shoes from all brands of shoes|FIND:Puma -> "Puma", "Adidas"|FOUND:Puma|
|Get all brands for a store|STORE:Trents Shoes|STORE:Trents Shoes -> "Puma", "Adidas"|
|Get all stores for a brand of shoe|BRAND:Puma|BRAND:Puma -> "Trents Shoes", "Everday Shoes"|

## _mysql commands_

|command |Description|
|-------------|---------------------------------------------------|
|winpty c:/MAMP/bin/mysql/bin/mysql --host=localhost -uroot -proot |Open mysql|
|SHOW DATABASES|Show list of all databases|
|CREATE DATABASE shoes|Create new database|
|USE shoes|Change into shoes database|
|CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR(255))|Create a stores table with two columns|
|CREATE TABLE brands (id serial PRIMARY KEY, name VARCHAR(255))|Create a brands table with two columns|
|DESCRIBE stores|Check table columns and data-types|
|DESCRIBE brands|Check table columns and data-types|









## Setup/Installation Requirements

* Clone [shoe-store](https://github.com/danlauby/shoe-store) repository
* Download [Composer](https://getcomposer.org/)
* Run "composer install" in computer terminal
* Navigate into this project's "web" folder
* Run "php -S localhost:8000" in terminal to setup document root
* Open up web browser and navigate to the url "localhost:8000" to view functional program

## Known Bugs

None known.

## Support and contact details

Feel free to contact [Dan Lauby] (dmlauby@gmail.com) if any questions come up!

## Technologies Used

* PHP/Composer (dependencies)
* PHP/Silex (routing)
* PHPUnit (testing)
* MYSQL database
* HTML/Twig (templates)
* CSS/Bootstrap (interface)

### License

Copyright (c) 2017 Dan Lauby

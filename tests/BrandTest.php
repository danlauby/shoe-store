<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    // require_once "src/Store.php";

    $server = 'mysql:host=localhost:3306;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class BrandTest extends PHPUnit_Framework_TestCase
    {
        // protected function teardown()
        // {
        //
        // }

        function testGetName()
        {
            // Arrange
            $name = "Puma";
            $test_Brand = new Brand($name);

            // Act
            $result = $test_Brand->getName();

            // Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            // Arrange
            $name = "Puma";
            $test_Brand = new Brand($name);

            // Act
            $test_Brand->setName("Adidas");
            $result = $test_Brand->getName();

            // Assert
            $this->assertEquals("Adidas", $result);
        }

    }

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

        function testId()
        {
            // Arrange
            $name = "Puma";
            $id = 1;
            $test_Brand = new Brand($name, $id);

            //Act
            $result = $test_Brand->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

    }

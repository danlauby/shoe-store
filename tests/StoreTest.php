<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";
    // require_once "src/Brand.php";

    $server = 'mysql:host=localhost:3306;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StoreTest extends PHPUnit_Framework_TestCase
    {
    //    protected function teardown()
    //    {
    //
    //    }


        function testGetName()
        {
            // Arrange
            $name = "Trents Shoes";
            $test_Store = new Store($name);

            // Act
            $result = $test_Store->getName();

            // Assert
            $this->assertEquals($name, $result);
        }


        function testSetName()
        {
            // Arrange
            $name = "Trents Shoes";
            $test_Store = new Store($name);

            // Act
            $test_Store->setName("Trents Awesome Shoes");
            $result = $test_Store->getName();

            // Assert
            $this->assertEquals("Trents Awesome Shoes", $result);
        }

    }

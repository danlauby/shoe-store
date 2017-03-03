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
        protected function teardown()
        {
            Brand::deleteAll();
        }

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

        function testSave()
        {
            //Arrange
            $name = "Puma";
            $id = 1;
            $test_Brand = new Brand($name, $id);
            $test_Brand->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals($test_Brand, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $name = "Puma";
            $id = 1;
            $test_Brand = new Brand($name, $id);
            $test_Brand->save();

            $name2 = "Adidas";
            $id2 = 2;
            $test_Brand2 = new Brand($name2, $id2);
            $test_Brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_Brand, $test_Brand2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Puma";
            $id = 1;
            $test_Brand = new Brand($name, $id);
            $test_Brand->save();

            $name2 = "Adidas";
            $id2 = 2;
            $test_Brand2 = new Brand($name2, $id2);
            $test_Brand2->save();

            //Act
            Brand::deleteAll();

            //Assert
            $result = Brand::getAll();
            $this->assertEquals([], $result);
        }


    }

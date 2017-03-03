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

        protected function teardown()
        {
            Store::deleteAll();
        }


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

        function testGetId()
        {
            //Arrange
            $name = "Trents Shoes";
            $id = 1;
            $test_Store = new Store($name, $id);

            //Act
            $result = $test_Store->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function testSave()
        {
            //Arrange
            $name = "Trents Shoes";
            $id = 1;
            $test_Store = new Store($name, $id);
            $test_Store->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals($test_Store, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $name = "Trents Shoes";
            $id = 1;
            $test_Store = new Store($name, $id);
            $test_Store->save();

            $name2 = "Trents Awesome Shoes";
            $id2 = 2;
            $test_Store2 = new Store($name2, $id2);
            $test_Store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_Store, $test_Store2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Trents Shoes";
            $id = 1;
            $test_Store = new Store($name, $id);
            $test_Store->save();

            $name2 = "Trents Awesome Shoes";
            $id2 = 2;
            $test_Store2 = new Store($name2, $id2);
            $test_Store2->save();

            //Act
            Store::deleteAll();

            //Assert
            $result = Store::getAll();
            $this->assertEquals([], $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = "Trents Shoes";
            $id = 1;
            $test_Store = new Store($name, $id);
            $test_Store->save();
            $new_name = "Trents Awesome Shoes";

            //Act
            $test_Store->update($new_name);

            //Assert
            $this->assertEquals("Trents Awesome Shoes", $test_Store->getName());
        }


    }

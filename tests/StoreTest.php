<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost:3306;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StoreTest extends PHPUnit_Framework_TestCase
    {

        protected function teardown()
        {
            Store::deleteAll();
            Brand::deleteAll();
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


        function testDelete()
        {
            //Arrange
            $name = "Trents Shoes";
            $id = 1;
            $test_Store = new Store($name, $id);
            $test_Store->save();

            $brand_name = "Puma";
            $id2 = 2;
            $test_Brand = new Brand($brand_name, $id2);
            $test_Brand->save();

            //Act
            $test_Store->addBrand($test_Brand);
            $test_Store->delete();

            //Assert
            $this->assertEquals([], $test_Brand->getStores());
        }


        function testAddBrand()
        {
            //Arrange
            $name = "Trents Shoes";
            $id = 1;
            $test_Store = new Store($name, $id);
            $test_Store->save();

            $name = "Puma";
            $id = 1;
            $new_Brand = new Brand($name, $id);
            $new_Brand->save();

            // Act
            $test_Store->addBrand($new_Brand);

            // Assert
            $this->assertEquals($test_Store->getBrands(), [$new_Brand]);
        }

        function testGetBrands()
        {
            //Arrange
            $name = "Trents Shoes";
            $id = 1;
            $test_Store = new Store($name, $id);
            $test_Store->save();

            $brand_name = "Puma";
            $id2 = 2;
            $new_Brand = new Brand($name, $id2);
            $new_Brand->save();

            $brand_name2 = "Adidas";
            $id3 = 3;
            $new_Brand2 = new Brand($brand_name2, $id3);
            $new_Brand2->save();

            // Act
            $test_Store->addBrand($new_Brand);
            $test_Store->addBrand($new_Brand2);

            // Assert
            $this->assertEquals($test_Store->getBrands(), [$new_Brand, $new_Brand2]);
        }

        function testFind()
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
            $result = Store::find($test_Store->getId());

            //Assert
            $this->assertEquals($test_Store, $result);
        }

    }

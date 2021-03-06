<?php

    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app['debug'] = true;
    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app->register(new Silex\Provider\TwigServiceProvider(),
    array('twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    // Link to store or brand pages
    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.html.twig', ['stores' => Store::getAll(),
                                                        'brands' => Brand::getAll()]);
                                                        });

    // List all stores, form to add a store and a form to delete all stores
    $app->get('/stores', function() use ($app) {
        return $app['twig']->render('stores.html.twig', ['stores' => Store::getAll()]);
    });

    // Individual store page, with form to add brand or update store info
    $app->get('/store/{id}', function($id) use ($app) {
        $current_store = Store::find($id);
        return $app['twig']->render('store.html.twig', ['current_store' => $current_store,
                                                        'brands' => $current_store->getBrands(),
                                                        'related_brands' => $current_store->getBrands(),
                                                        'all_brands' => Brand::getAll()]);
                                                        });

    // Add brands that are sold at current store on individual store page
    $app->post('/brand/add', function() use ($app) {
           $current_store = Store::find($_POST['store_id']);
           $current_brand = Brand::find($_POST['brand_id']);
           $current_store->addBrand($current_brand);
           return $app['twig']->render('store.html.twig', ['current_store' => $current_store,
                                                           'stores' => Store::getAll(),
                                                           'related_brands' => $current_store->getBrands(),
                                                           'all_brands' => Brand::getAll()]);
                                                           });

    $app->get('/store/{id}/edit', function($id) use ($app) {
        $current_store = Store::find($id);
        return $app['twig']->render('store_edit.html.twig', [ 'current_store' => $current_store,]);
    });

    $app->patch("store/{id}/edit", function($id) use ($app) {
        $store_name = $_POST['store_name'];
        // $find_author = Author::find($name);
        $current_store = Store::find($id);
        $current_store->update($store_name);
        return $app['twig']->render('store.html.twig' , ['store' => $current_store,
                                                           'related_brands' => $current_store->getBrands(),
                                                           'current_store' => $current_store,
                                                           'all_brands' => Brand::getAll()]);
                                                           });


    // List all brands, form to add a brand of shoe and a form to delete all brands
    $app->get("/brands" , function() use ($app) {
        return $app ['twig']->render('brands.html.twig', ['brands' => Brand::getAll()]);
    });

    // Individual brand page, with form to add store or update brand info
    $app->get('/brand/{id}', function($id) use ($app) {
        $current_brand = Brand::find($id);
        return $app['twig']->render('brand.html.twig', ['current_brand' => $current_brand,
                                                        'stores' => $current_brand->getStores(),
                                                        'related_stores' => $current_brand->getStores(),
                                                        'all_stores' => Store::getAll()]);
                                                        });

    // Add stores that sell current brand on individual brand page
    $app->post('/store/add', function() use ($app) {
        $current_store = Store::find($_POST['store_id']);
        $current_brand = Brand::find($_POST['brand_id']);
        $current_brand->addStore($current_store);
        return $app['twig']->render('brand.html.twig', ['current_brand' => $current_brand,
                                                        'brands' => Brand::getAll(),
                                                        'related_stores' => $current_brand->getStores(),
                                                        'all_stores' => Store::getAll()]);
                                                        });

    // Redirect to '/stores' to add new store to stores list
    $app->post("/store/create", function() use ($app) {
        $new_Store = new Store(filter_var($_POST['store_name'], FILTER_SANITIZE_MAGIC_QUOTES));
        $new_Store->save();
        return $app->redirect('/stores');
    });

    // Redirect to '/stores' when all stores are deleted
    $app->post('/stores/delete', function() use ($app) {
        Store::deleteAll();
        return $app->redirect('/stores');
    });

    // Redirect to '/brands' to add a new brand of shoe to brands list
    $app->post("/brand/create", function() use ($app) {
        $new_Brand = new Brand(filter_var($_POST['brand_name'], FILTER_SANITIZE_MAGIC_QUOTES));
        $new_Brand->save();
        return $app->redirect('/brands');
    });

    // Redirect to '/stores' when all stores are deleted
    $app->post('/brands/delete', function() use ($app) {
        Brand::deleteAll();
        return $app->redirect('/brands');
    });


    return $app;

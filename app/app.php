<?php

    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:3306;dbname=shoes';
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
        return $app['twig']->render('index.html.twig', ['stores' => Store::getAll(), 'brands' => Brand::getAll()]);
    });

    // List all stores, form to add a store and a form to delete all stores
    $app->get('/stores', function() use ($app) {
        return $app['twig']->render('stores.html.twig', ['stores' => Store::getAll()]);
    });

    // List all brands, form to add a brand of shoe and a form to delete all brands
    $app->get("/brands" , function() use ($app) {
        return $app ['twig']->render('brands.html.twig', ['brands' => Brand::getAll()]);
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

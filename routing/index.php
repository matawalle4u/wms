<?php
    include('route.php');

    $route = new Route();
    $route->add("/about");
    print_r($route);
    $route->submit();
?>

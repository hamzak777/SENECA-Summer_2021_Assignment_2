<?php
/**
 * Call the create(), update() and delete() methods with a $_GET key of "action" and a value which matches the name of the method being called.
 * First require our villainController class to create a new instance of our Controller.
 * Then a switch statement to check the value for the "action" key and call the corresponding method in response.
 */
require 'villainController.php';

$controller = new villainController;

$action = $_GET['action'];

switch ($action) {
    case 'create':
        $controller->create($_POST);
        break;
    case 'update':
        $controller->update($_POST);
        break;
    case 'delete':
        $controller->delete($_POST);
        break;
    // If the key does not match any of the methods then the file will just redirect back to the "view" page.
    default:
        header('Location: views/view-villains.php');
        exit();
}
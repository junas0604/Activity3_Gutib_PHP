<?php
    include 'functions.php'; // Include the functions file for database operations.

    // Check if the 'Submit' button is clicked for adding a new menu item.
    if (isset($_POST['submit'])) {
        $menuName = trim($_POST['menuName']);
        $menuDesc = trim($_POST['menuDesc']);
        addMenu($menuName, $menuDesc); // Call the function to add a new menu item.
    }

    // Check if the 'Edit' button is clicked for updating an existing menu item.
    if (isset($_POST['edit'])) {
        $id = trim($_POST['id']);
        $menuName = trim($_POST['menuName']);
        $menuDesc = trim($_POST['menuDesc']);
        updateMenuData($menuName, $menuDesc, $id); // Call the function to update the menu item.
    }

    // Check if the 'Delete' button is clicked to delete a menu item.
    if (isset($_POST['delete'])) {
        $id = trim($_POST['delete']);
        deleteMenuData($id); // Call the function to delete the menu item.
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
</body>
</html>

<?php
    function establishDatabaseConnection()
    {
        try {
            // If it doesn't work, change '3306' to your MySQL port
            return new PDO('mysql:host=localhost:3306;dbname=pos_lauron', 'root', '');
        } catch (PDOException $exception) {
            echo "Connection Error: ", $exception->getMessage();
        }
    }

    // Create
    function addMenu($menuName, $menuDescription)
    {
        $db = establishDatabaseConnection();
        $sql = "INSERT INTO ref_menu(menu_name, menu_desc) VALUES(?, ?)";
        $statement = $db->prepare($sql);
        if ($statement->execute(array($menuName, $menuDescription))) {
            // Success - Display SweetAlert
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Menu item added!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'addMenu.php'; // Redirect to the main page
                    }
                });
            </script>";
        } else {
            // Error - Display SweetAlert
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to add item!',
                });
            </script>";
        }
        $db = null;
    }

    function viewMenuData()
    {
        $db = establishDatabaseConnection();
        $sql = "SELECT * FROM ref_menu ORDER BY id ASC";
        $statement = $db->prepare($sql);
        $statement->execute();
        $menuItems = $statement->fetchAll(PDO::FETCH_ASSOC);
        $db = null;
        return $menuItems;
    }

    function viewMenuDataJSON()
    {
        $db = establishDatabaseConnection();
        $sql = "SELECT * FROM ref_menu ORDER BY id ASC";
        $statement = $db->prepare($sql);
        $statement->execute();
        $menuItems = $statement->fetchAll(PDO::FETCH_ASSOC);
        $jsonResult = json_encode($menuItems);
        echo $jsonResult;
        $db = null;
        return $menuItems;
    }

    function updateMenuData($menuName, $menuDescription, $id)
    {
        $db = establishDatabaseConnection();
        $sql = "UPDATE ref_menu SET menu_name=?, menu_desc=? WHERE id=?";
        $statement = $db->prepare($sql);
        if ($statement->execute([$menuName, $menuDescription, $id])) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Menu item updated!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'addMenu.php'; // Redirect to the main page
                    }
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update item!',
                });
            </script>";
        }
        $db = null;
    }

    function deleteMenuData($id)
    {
        $db = establishDatabaseConnection();
        $sql = "DELETE FROM ref_menu WHERE id=?";
        $statement = $db->prepare($sql);
        if ($statement->execute([$id])) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Menu item deleted!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'addMenu.php'; // Redirect to the main page
                    }
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to delete item!',
                });
            </script>";
        }
        $db = null;
    }

    function searchMenuData($id)
    {
        $db = establishDatabaseConnection();
        $sql = "SELECT * FROM ref_menu WHERE id=?";
        $statement = $db->prepare($sql);
        $statement->execute(array($id));
        $menuItem = $statement->fetch(PDO::FETCH_ASSOC);
        $db = null;
        return $menuItem ?: [];
    }
?>

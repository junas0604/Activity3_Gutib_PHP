<?php
    include 'crud_operations.php'; // Include the CRUD operations file.

    if (isset($_POST['submit'])) {
        $menuName = trim($_POST['menuName']);
        $menuDesc = trim($_POST['menuDesc']);
        addMenu($menuName, $menuDesc);
    }

    if (isset($_POST['edit'])) {
        $id = trim($_POST['id']);
        $menuName = trim($_POST['menuName']);
        $menuDesc = trim($_POST['menuDesc']);
        updateMenuData($menuName, $menuDesc, $id);
    }

    if (isset($_POST['delete'])) {
        $id = trim($_POST['delete']);
        deleteMenuData($id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>GUTIB, JUNAS NAZARITO ACTIVITY 3</title>
</head>
<body>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Add Menu</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="crud_operations.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="menuName">Menu Name:</label>
                                <input type="text" class="form-control" id="menuName" name="menuName" required />
                            </div>
                            <div class="form-group">
                                <label for="menuDesc">Menu Description:</label>
                                <textarea class="form-control" id="menuDesc" name="menuDesc" rows="3" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Menu Name</th>
                    <th>Menu Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $menuItems = viewMenuData();
                foreach ($menuItems as $menuItem) {
                    echo "<tr>";
                    echo "<td>" . $menuItem['id'] . "</td>";
                    echo "<td>" . $menuItem['menu_name'] . "</td>";
                    echo "<td>" . $menuItem['menu_desc'] . "</td";
                ?>
                <td>
                    <form method="post" enctype="multipart/form-data" action="?edit_id=<?php echo $menuItem['id']; ?>" style="display: inline;">
                        <input type="hidden" name="edit" value="<?php echo $menuItem['id']; ?>">
                        <button type="button" data-toggle="modal" data-target="#editMenuModal" data-menu-id="<?php echo $menuItem['id']; ?>" data-menu-name="<?php echo $menuItem['menu_name']; ?>" data-menu-desc="<?php echo $menuItem['menu_desc']; ?>" class="btn btn-info">EDIT</button>
                    </form>
                    <form method="post" style="display: inline;">
                        <input type="hidden" name="delete" value="<?php echo $menuItem['id']; ?>">
                        <button type="button" data-toggle="modal" data-target="#deleteMenuModal" data-menu-id="<?php echo $menuItem['id']; ?>" class="btn btn-danger">DELETE</button>
                    </form>
                </td>
                <?php
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <!-- Edit Menu Modal -->
    <div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
        <!-- Rest of your Edit Modal code here... -->
    </div>
    <!-- End Edit Menu Modal -->

    <!-- Delete Menu Modal -->
    <div class="modal fade" id="deleteMenuModal" tabindex="-1" role="dialog" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
        <!-- Rest of your Delete Modal code here... -->
    </div>
    <!-- End Delete Menu Modal -->
</body>
</html>

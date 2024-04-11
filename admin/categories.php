<?php 
    include "layouts/side_nav.php";
    require "../dbconnect.php";

    $sql = "SELECT * FROM categories";
    // echo $sql;
    // $stmt = $conn->query($sql);
    $stmt = $conn->prepare($sql); //more secure
    $stmt->execute();
    $categories = $stmt->fetchAll();
    // var_dump($posts);
?>
    <main>
        <div class="container-fluid px-4">
            <div class="mt-3">
                <h1 class="mt-4">Posts</h1>
                <a href="create_category.php" class="btn btn-lg btn-primary float-end">Create Category</a>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Categories</li>
            </ol>
        
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Categories
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                       <tbody>
                            <?php
                                foreach($categories as $category){
                            ?>
                                <tr>
                                    <td><?= $category['name']?></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-warning">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </td>
                                </tr>

                            <?php } ?>
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

<?php
    include "layouts/footer.php";
?>
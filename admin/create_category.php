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
                <h1 class="mt-4">Categories</h1>
                <a href="post.php" class="btn btn-lg btn-danger float-end">Cancel</a>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="index.php">Categories</a></li>
                <li class="breadcrumb-item active">Categories</li>
            </ol>
        
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Create Category
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        
                        
                        <div>
                            <button type="submit" class="btn btn-primary" type="button">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php
    include "layouts/footer.php";
?>
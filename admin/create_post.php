<?php 

ini_set('display_error',1);
ini_set('display_starting_errors',1);
error_reporting(E_ALL);

   
    require "../dbconnect.php";

    // $sql = "SELECT posts.*, categories.name as c_name, users.name as u_name FROM posts INNER JOIN categories ON categories.id=posts.category_id INNER JOIN users ON users.id = posts.user_id";
    // echo $sql;
    // $stmt = $conn->query($sql);
    // $stmt = $conn->prepare($sql); //more secure
    // $stmt->execute();
    // $posts = $stmt->fetchAll();
    // var_dump($posts);
    
    

    //Accept the added input data
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $title = $_POST['title'];
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];
        $user_id = 2;
        $image_array = $_FILES['image']; //written as array

        // echo"$title and $category_id and $user_id and $description";
        // print_r($image);

        //file upload
        if(isset($image_array) && $image_array['size']>0){ //can't use 'isset' when compare
            $folder_name = 'images/';  //images folder အောက်မှာ
            $image_path = $folder_name.$image_array['name']; //images/123.png //$dir(images folder).$image_array['name](image_name)
            $tmp_name = $image_array['tmp_name']; //Serverမှာ Create မလုပ်ခင် ယာယီသိမ်းထားတာ
            move_uploaded_file($tmp_name, $image_path);//move_upload_file from $tmp_name to $image_path
            // ပီးရင် photo က "images" Folder ထဲရောက်သွားမယ်။
        }

        // bindParam မသုံးဘဲနဲ့ sql queryထဲမှာ ဘဲရေးလဲရ။
        //sql = "INSERT INTO posts(title,image,user_id,category_id,description) VALUES ('title','image_path,'user_id','category_id','description')"; 
        // $stmt = $conn->prepare($sql);
        // $stmt->execute();

        // bindParam နဲ့ သုံးရင် Database ကို ":" နဲ့ယူခဲ့
        $sql = "INSERT INTO posts (title,image,user_id,category_id,description) VALUES (:title, :image_path, :user_id, :category_id, :description)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':image_path', $image_path);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':description', $description);

        $stmt->execute();

        header("location: posts.php");
    }else{
        include "layouts/side_nav.php";
        $sql = "SELECT * FROM categories";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll();
        // var_dump($categories);
    }
    
?>
    <main>
        <div class="container-fluid px-4">
            <div class="mt-3">
                <h1 class="mt-4">Posts</h1>
                <a href="post.php" class="btn btn-lg btn-danger float-end">Cancel</a>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="posts.php">Posts</a></li>
                <li class="breadcrumb-item active">Posts</li>
            </ol>
        
            <div class="card mb-4">
                
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Create Posts
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="category_id">Categories</label>
                            <select class="form-select" id="category_id" name="category_id" aria-label="Default select example">
                                <option selected>Choose....</option>
                                <?php 
                                    foreach($categories as $category){
                                ?>
                                    <option value="<?= $category['id']?>"><?= $category['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="file" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <textarea name="description" class="form-control" id="description"></textarea>
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
<?php

if (isset($_POST['submit'])) {

    // create errors = array
    $errors = array(
        "name" => "",
        "favorite_foods" => "",
        "bio" => "",
        "img_src" => "",
    );

    // get POST info
    $name = htmlspecialchars($_POST['name']);
    $favorite_foods = htmlspecialchars($_POST['favorite_foods']);
    $bio = htmlspecialchars($_POST['bio']);
    $img_src = $_FILES["img_src"]["name"];

    if (empty($name)) {
        $errors['name'] = "A name is required.";
    } else {
        if (!preg_match('/^[a-z\s]+$/i', $name)) {
            // echo "there is a name";
            $errors["name"] = "illegal characters";
        }
    }

    if (empty($favorite_foods)) {
        // if the name is empty
        $errors['favorite_foods'] = "A food item is required";
    } else {
        if (!preg_match('/^[a-z\s]+$/i', $name)) {
            // echo there is a name
            $errors["favorite-foods"] = "illegal characters";
        }
    }

    if (empty($bio)) {
        $errors['bio'] = "A bio is required.";
    }

    // Handle file upload target directory
    $target_dir = "./assets/images/";

    // Target uploaded image file
    $image_file = $target_dir . basename($_FILES["img_src"]["name"]);

    // Get uploaded file extension so we can test to make sure it's an image
    $image_file_type = strtolower(pathinfo($image_file, PATHINFO_EXTENSION));

    // Test image for errors
    // image exists
    if (empty($img_src)) {
        $errors["img_src"] = "An image is required.";
    } else {

        // Check that the image file is an actual image

        $size_check = @getimagesize($_FILES["img_src"]["tmp_name"]);
        $file_size = $_FILES["img_src"]["size"];
        if (!$size_check) {
            $errors["img_src"] = "File is not an image.";
        }

        // file size

        else if ($file_size > 500000) {
            $errors["img_src"] = "File cannot be larger than 500kb";
        }

        // file type (if it's an image)
        else if (
            $image_file_type != "jpg"
            && $image_file_type != "png"
            && $image_file_type != "jpeg"
            && $image_file_type != "gif"
            && $image_file_type != "webp"
            && $image_file_type != "webp"
        ) {
            $errors["img_src"] = "Sorry, only JPG, JPEG, PNG, GIF, or WEBP files are allowed.";
        }

        // check if file already exists
        else if (move_uploaded_file($_FILES["img_src"]['tmp_name'], $image_file)) {
        } else {
            $errors["img_src"] = "Sorrym there weas an error uploading your file.";
        }
    }

    if (!array_filter($errors)) {

        require('./config/db.php');

        $sql = "INSERT INTO ducks (name, favorite_foods, bio, img_src) VALUES ($name, $favorite_foods, $bio, $img_src)";

        mysqli_query($conn, $sql);
    }
}

?>

<?php
$page_title = "Create a Duck";
include('./components/head.php');
?>

<body>
    <?php
    include('./components/nav.php');
    ?>

    <section class="create-form flex">
        <div class="duck-container flex">
            <form action="./create-duck.php" id="create-duck" class="form-info flex" enctype="multipart/form-data" method="POST">
                <div class="form-intro">
                    <h1>Want a new duck?</h1>
                    <p>Fill out the form to add a new duck!</p>
                </div>
                <div class="input-group flex">
                    <label for="name">Duck's Name</label>
                    <?php
                    if (isset($errors['name'])) {
                        echo "<div class = 'error'>" . $errors["name"] . "</div>";
                    }
                    ?>
                    <input type="text" id="name" name="name" placeholder="Daffy">
                </div>
                <div class="input-group flex">
                    <label for="foods">Favorite Foods (Separate multiple with comma)</label>
                    <?php
                    if (isset($errors['favorite_foods'])) {
                        echo "<div class='error'>" . $errors["favorite_foods"] . "</div>";
                    }
                    ?>
                    <input type="text" id="favorite_foods" name="favorite_foods" placeholder="Eggs, ham, cheese">
                </div>
                <div class="input-group flex">
                    <label for="img_src">Duck's Picture</label>
                    <input type="file" id="image" name="img_src">
                </div>
                <div class="input-group flex">
                    <label for="bio">Biography</label>
                    <?php
                    if (isset($errors['bio'])) {
                        echo "<div class='error'>" . $errors["bio"] . "</div>";
                    }
                    ?>
                    <input type="text" id="bio" name="bio" rows="10" placeholder="Tell us about your duck!">
                </div>
                <div class="input-group">
                    <input type="submit" id="submit" value="Submit">
                </div>
            </form>
        </div>
    </section>
</body>
<?php

if (isset($_POST['submit'])) {

    echo "post worked";

    $errors = array(
        "name" => "",
        "favorite_foods" => "",
        "bio" => ","
    );

    $name = htmlspecialchars($_POST['name']);
    $favorite_foods = htmlspecialchars($_POST['favorite_foods']);
    $bio = htmlspecialchars($_POST['bio']);

    if(empty($name)) {
        $errors['name'] = "A name is required.";
    } else {
        if

    }

    if (preg_match('/^[a-z\s]+$/i', $name)) {
        // echo "the name is formatted correctly";
    } else {
        $errors["name"] = "The name has illegal characters";
    }

    if (preg_match('/^[a-z,\s]+$/i', $name)) {
        // echo "the name is formatted correctly";
    } else {
        $errors["favorite_foods"] = "Favorite foods must be separated by a comma.";
    }

    print_r($errors);
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

    <section class="create-form">
        <div class="container flex">
            <form action="./create-duck.php" id="create-duck" method="POST">
                <div class="form-intro">
                    <h1>Want a new duck?</h1>
                    <p>Fill out the gotm to add a new duck!</p>
                </div>
                <div class="input-group">
                    <label for="name">Duck's Name</label>
                    <input type="text" id="name" name="name" placeholder="Daffy">
                </div>
                <div class="input-group">
                    <label for="foods">Favorite Foods (Separate multiple with comma)</label>
                    <input type="text" id="favorite_foods" name="favorite_foods" placeholder="Eggs, ham, cheese">
                </div>
                <div class="input-group">
                    <label for="bio">Biography</label>
                    <input type="text" id="bio" name="bio" rows="10" placeholder="Small duck who grew up in the big city.">
                    <div class="input-group">
<button></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>
<?php

$duck_is_live = false;
require('./config/db.php');

if (isset($_POST['delete'])) {

    $id_to_delete = (int)$_POST['id_to_delete'];

    $delete_sql = "DELETE FROM ducks WHERE id=$id_to_delete";

    mysqli_query($conn, $delete_sql);
}

if (isset($_GET['id'])) {
    // Assign a variable to the ID
    $id = htmlspecialchars($_GET['id']);

    // Create a query to select the intended duck from the db
    $sql = "SELECT id, name, favorite_foods, bio, img_src FROM ducks WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $duck = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);

    if (isset($duck['id'])) {
        $duck_is_live = "true";
    }
}
?>

<?php
$page_title = "Duck Profile";
include('./components/head.php');
?>

<body>
    <?php
    include('./components/nav.php');
    ?>
    <?php if ($duck_is_live) : ?>
        <section class="flex profile">
            <div class="profile-picture">
                <img src="<?php echo $duck['img_src']; ?>" alt="duck.">
            </div>
            <div class="flex duck-info">
                <h2><?php echo $duck['name']; ?></h2>
                <h3>Favorite Foods:</h3>
                <p><?php echo $duck['favorite_foods']; ?></p>
                <p><?php echo $duck['bio']; ?></p>
            </div>
            <form action="./profile.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $duck['id']; ?>">
                <input type="submit" name="delete" value="Delete Duck">
            </form>
        </section>
    <?php else : ?>

        <section class="no-duck">
            <h1>Sorry this duck does not exist.</h1>
        </section>

    <?php endif ?>
</body>
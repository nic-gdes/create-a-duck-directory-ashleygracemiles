<?php

include('./config/db.php');


/******** EXECUTE QUERIES ON THE DATABASE TO RETRIEVE DATA *********/
// write query for all ducks ( SELECT name, favorite_foods, imgsrc FROM ducks )
$sql = "SELECT name,favorite_foods,img_src FROM ducks";

// make query and get result
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$ducks = mysqli_fetch_all($result, MYSQLI_ASSOC);

/******** WRAP UP DATABASE CONNECTION *********/
// free the result from memory
mysqli_free_result($result);

// close the connection to the database
mysqli_close($conn);

// print_r($data);
// foreach ($ducks as $duck) {
//     echo $duck['favorite_foods'];
// }
?>

<?php
$page_title = "Home";
include('./components/head.php');
?>

<body>

    <?php
    include('./components/nav.php');
    ?>

    <section class="flex home-welcome">
        <h2>Welcome to the GDES Duck Directory!</h2>
        <div class="welcome-overlay"></div>
    </section>

    <section class="flex my-ducks">
        <h3>My Ducks</h3>
        <div class="flex duck-cards">
            <?php foreach ($ducks as $duck) : ?>
                <div class="flex card">
                    <div class="image-section"><img src="<?php echo $duck['img_src']; ?>" alt=""></div>
                    <div class="flex duck-content">
                        <h4><?php echo $duck['name']; ?></h4>
                        <h5>Favorite Foods</h5>
                        <?php
                        $foods_list = explode(',', $duck['favorite_foods']);
                        ?>
                        <ul class="flex food-list">
                            <?php foreach ($foods_list as $food) : ?>
                                <li><?php echo $food ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach ?>

    </section>

</body>

</html>
<?php
session_start();
$photos = glob('uploads/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

foreach ($photos as $photo) {
    echo '<div class="col-lg-4 col-md-6 col-sm-12 photo-container">';
    echo '<img src="' . $photo . '" class="img-fluid" alt="Photo">';
    
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
        echo '<form action="photo.php" method="POST" style="display:inline-block;">';
        echo '<input type="hidden" name="file" value="' . $photo . '">';
        echo '<button type="submit" name="delete" class="delete-button">Delete</button>';
        echo '</form>';
    }

    echo '</div>';
}
?>

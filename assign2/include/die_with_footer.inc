<?php
// Function to error out but still draw the footer -- Marcus
function die_with_footer($death_string){
    echo "<p>$death_string</p>";
    include 'include/footer.inc';
    die();
}?>
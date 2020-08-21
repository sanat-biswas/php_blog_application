<?php

$con = mysqli_connect('localhost', 'root', '', 'blog');
if ($con) {
    return 0;
} else {
    return 1;
}
?>

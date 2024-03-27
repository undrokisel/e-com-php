<?php

include ('server/connection.php');


if (isset ($_POST['contact_us'])) {
    header('location: contact.php?contact_us_success');
} else {
    header('location: contact.php?error=что-то пошло не так');
}


?>
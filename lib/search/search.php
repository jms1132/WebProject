<?php
    include "../../db/db_connector.php";

    $inputSearch = $_POST['inputSearch'];

    $sql = "SELECT * FROM `board` WHERE `subject` = $inputSearch";
    $result = mysqli_query($connect, $sql);

?>
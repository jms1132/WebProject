<?php

include "../../db/db_connector.php";

session_start();
$comment_num  = $_GET["comment_num"];
$depth  = $_GET["depth"];
$group_num = $_GET['num'];
$page  = $_GET["page"];
$group_num = (int)$group_num;

var_dump($comment_num);
var_dump($group_num);
$sql="DELETE FROM `temporary_comment` where comment_num=$comment_num";
mysqli_query($connect, $sql); //위의 쿼리문을 실행한 결과값을 result에 레코드셋으로 저장을 하게된다.

echo "
<script>
 location.href='./temporary_board_view.php?num=$group_num&page=$page';
</script>";
 ?>

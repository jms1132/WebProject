
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="../../css/board/board.css">
  <!-- Bootstrap core CSS -->
  <link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../../css/main/small-business.css" rel="stylesheet">
  <style>
    .map_wrap, .map_wrap * {margin:0; padding:0;font-family:'Malgun Gothic',dotum,'돋움',sans-serif;font-size:12px;}
    .map_wrap {position:relative;width:100%;height:200px;}
    #category {position:absolute;top:10px;left:10px;border-radius: 5px; border:1px solid #909090;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.4);background: #fff;overflow: hidden;z-index: 2;}
    #category li {float:left;list-style: none;width:50px;border-right:1px solid #acacac;padding:6px 0;text-align: center; cursor: pointer;}
    #category li.on {background: #eee;}
    #category li:hover {background: #ffe6e6;border-left:1px solid #acacac;margin-left: -1px;}
    #category li:last-child{margin-right:0;border-right:0;}
    #category li span {display: block;margin:0 auto 3px;width:27px;height: 28px;}
    #category li .category_bg {background:url(http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/places_category.png) no-repeat;}
    #category li .pharmacy {background-position: -10px -72px;}
    #category li.on .category_bg {background-position-x:-46px;}
    img {vertical-align: unset;}
  </style>
  <?php include "../../lib/common_page/main_style.php";?>
  <script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=2bc44b6ace455f7c953f89057af1aeae&libraries=services"></script>
  <!-- <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="../../js/main/pop_up_menu.js"></script>
</head>

<body>
  <?php include "../../lib/common_page/header.php" ?>
  <!-- header -->
  <div class="board_header">
    <div id="board_header_div">
      <p><a href="board_form.php">BOARD</a></p>
    </div>
  </div>
  <!-- nav -->
  <div class="board_nav">
    <div id="board_nav_box">
      <div id="board_box_message">
        <p><span>"__"</span> 개의 게시물이 있습니다 !</p>
      </div>
      <div id="board_box_writing">
        <p><a href="board_writing.php">+ 글쓰기</a></p>
      </div>
      <div id="board_box_mypost">
        <p><a href="board_myboard_form.php">내 게시글 보기</a></p>
      </div>
      <div id="board_box_viewall">
        <p><a href="board_form.php">전체보기</a></p>
      </div>
    </div>
  </div>
  <!-- center -->
  <?php
    $num  = $_GET["num"];

    $con = mysqli_connect("localhost", "root", "123456", "joo_db");
    $sql = "select * from board where num=$num";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_array($result);
    $id      = $row["id"];
    $name      = $row["name"];
    $regist_day = $row["regist_day"];
    $category = $row["category"];
    $subject    = $row["subject"];
    $content    = $row["content"];
    $file_name    = $row["file_name"];
    $file_type    = $row["file_type"];
    $file_copied  = $row["file_copied"];
    $locationX = $row["locationX"];
    $locationY = $row["locationY"];
    $hit = $row["hit"];

    $content = str_replace(" ", "&nbsp;", $content);
    $content = str_replace("\n", "<br>", $content);

    $new_hit = $hit + 1;
    $sql = "update board set hit=$new_hit where num=$num";
    mysqli_query($con, $sql);
  ?>
  <div class="board_myboard_widen">
    <form name="board_write" action="board_modify.php" method="post" enctype="multipart/form-data" style="display:inline-block;">
      <div id="board_myboard_widen_box">
        <div id="board_myboard_widen_photo">
          <?php
                if ($file_name) {
                    $real_name = $file_copied;
                    $file_path = "../../data/".$real_name;
                    $file_size = filesize($file_path);
                    }
            ?>

          <img id="Preview_img" src=<?=$file_path?>>

        </div>
        <div id="board_myboard_widen_top">
          <span id="board_myboard_widen_top_p_span">TITLE :</span> <span id="myboard_widen_title_span"><?=$subject?></span><br>
           <span id="board_myboard_widen_top_p_span">MEMBER_ID :</span> <span id="myboard_widen_memberId_span"><?=$name?></span><br>
           <span id="board_myboard_widen_top_p_span">DATE :</span> <span id="myboard_widen_date_span"><?=$regist_day?></span><br>
        </div>
        <div id="board_myboard_widen_center">
          <p><span id="myboard_widen_content_span"><?=$content?></span></p>
        </div>

      <!-- 지도 div -->
        <div id="board_location_box" style="position: relative;">
        <div class="map_wrap">
    <div id="map" style="width:100%;height:100%;position:relative;overflow:hidden;"></div>
    <ul id="category">

        <li id="PM9" data-order="2">
            <span class="category_bg pharmacy"></span>
            동물병원
        </li>

    </ul>
</div>
        </div>
      </div>
      <div id="board_myboard_widen_button_box">
        <button type="button"><a href="board_myboard_rewrite.php?num=<?=$num?>">Edit</a></button>
        <button type="button"><a href="#">Delete</a></button>
      </div>
    </form>

<!-- 댓글 -->
    <div id="board_widen_comment_box">
      <div id="board_widen_comment_input_box">
        <div id="board_widen_comment_input_span">
          <p>댓글 <span>1000</span>개</p>
        </div>
        <div id="board_widen_comment_input_text">
          <img class="imgsetting" id="board_widen_comment_input_text_image" src="../../img/board/default_proflie.png" >
          <textarea id="input_comment_area" rows="1" onkeydown="resize(this)" onkeyup="resize(this)" placeholder="Comment"></textarea>
          <input type="button" value="Add">
        </div>
      </div>
      <div id="board_widen_comment_show_text">
          <img class="imgsetting" src="../../img/board/default_proflie.png">
        <div id="board_widen_comment_show_text_member">
          <span>작성자명</span><br>
          <span>댓글 내용이 옵니다</span><br>
          <span>날짜</span>&nbsp;&nbsp;<span style="cursor:pointer"  onclick="hide();">▼ 답글</span>
        </div>
      </div>
<!--대댓글-->
      <div id="board_widen_comment_input_retext_box">
        <div id="board_widen_comment_input_retext">
          <img class="imgsetting" id="board_widen_comment_input_retext_image" src="../../img/board/default_proflie.png">
          <textarea id="input_comment_rearea" rows="1" onkeydown="resize(this)" onkeyup="resize(this)" placeholder="Comment"></textarea>
          <input type="button" value="Add">
        </div>
      </div>

      <div id="board_widen_comment_viewmore_click">
        <img src="../../img/board/default_proflie.png">
        <div id="board_widen_comment_show_text_member">
          <span>작성자명</span><br>
          <span>댓글 내용이 옵니다</span><br>
          <span>날짜</span>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <?php include "../../lib/common_page/footer.php" ?>
  </footer>

  <script src="../../js/board/board.js"></script>
  <script src="../../js/board/board_map_view.js"></script>

</body>

</html>

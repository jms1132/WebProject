<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="../../css/board/board.css">
  <!-- Bootstrap core CSS -->
  <link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../../css/main/small-business.css" rel="stylesheet">

  <style>
    form { display: inline-block; }

    #header_box { width: 1100px; margin: 0 auto; }

    #header_box div { display: inline-block; }

    header { position: fixed; top: 0; width: 100%; background-color: antiquewhite; }

    #icon_box { margin-left: 190px; }

    #search { width: 700px; height: 50px; font-size: 20px; }

    header span { display: inline-block; width: 45px; height: 45px; }

    #login_icon { background-image: url(""); }

    #info_icon { background-image: url(""); }

    #btn_search { height: 45px; width: 45px; background-image: url("../../img/main/search1.png"); border: none; background-color: none; outline: none; }

    header a { width: 45px; height: 52px; padding: 0; margin: 0; display: inline-block; vertical-align: middle; }

    #btn_home { background-image: url("../../img/main/home1.png"); }

    #btn_info { background-image: url("../../img/main/info1.png"); }

    #btn_login { background-image: url("../../img/main/key1.jpg"); }

    .no-flex { flex: none; }

    .col-lg-7 { width: 450px; }

    #menu_bar { height: 48px; background-color: #443e58; font-size: 16px; }

    #menu_bar ul { width: 1200px; margin: 0 auto; padding: 14px 0 0 40px; }

    #menu_bar li { display: inline; margin-left: 10.5%; color: white; }

    #pop_up { display: none; position: absolute; top: 54px; right: 128px; background-color: antiquewhite; }
    #pop_log { display: none; position: absolute; top: 54px; right: 128px; background-color: antiquewhite; }
    #pop_box { width: 350px; height: 250px; }

    #pop_box ul { width: 50%; float: left; list-style: none; padding-left: 5px; }

    #pop_box li { text-align: center; }
    #pop_login ul { width: 100%; list-style: none; padding-left: 5px; }
    #pop_login{ width: 150px; }
    .reply { margin-left: 213px; }
    body{ padding-top: 67px; }
    .map_wrap {
            position: relative;
            width: 100%;
            height: 200px;
        }

        .title {
            font-weight: bold;
            display: block;
        }

        .hAddr {
            position: absolute;
            left: 10px;
            top: 10px;
            border-radius: 2px;
            background: #fff;
            background: rgba(255, 255, 255, 0.8);
            z-index: 1;
            padding: 5px;
        }

        #centerAddr {
            display: block;
            margin-top: 2px;
            font-weight: normal;
        }

        .bAddr {
            padding: 5px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }


  </style>
  <script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=2bc44b6ace455f7c953f89057af1aeae&libraries=services"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
  <script src="../../js/main/pop_up_menu.js"></script>
</head>
  <body>
    <header>
      <?php include "../../lib/common_page/header.php" ?>
    </header>

    <div class="board_header">
      <div id="board_header_div">
        <p><a href="board_form.php?num=''&page=''">BOARD</a></p>
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
    <!-- action="board_myboard_form.php?id=yy&pw=ii" -->
<<<<<<< HEAD
    <?php
    $num  = $_GET["num"];
    $page = $_GET["page"];

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

    var_dump($file_name);
=======
    <?php
    $num  = $_GET["num"];
    $page = $_GET["page"];

    $con = mysqli_connect("localhost", "root", "123456", "joo_db");
    $sql = "select * from board where num=$num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $id      = $row["id"];
    $name      = $row["name"];
    $regist_day = $row["regist_day"];
    $subject    = $row["subject"];
    $content    = $row["content"];
    $file_name    = $row["file_name"];
    $file_type    = $row["file_type"];
    $file_copied  = $row["file_copied"];
    $locationX = $row["locationX"];
    $locationY = $row["locationY"];
    $hit = $row["hit"];
>>>>>>> 87d0581d0e20af93c07a815879de01e6b7dd238a
?>
    <div class="board_myboard_rewrite">
      <form  name="board_myboard_rewrite" method="post" action="board_modify.php" enctype="multipart/form-data">
        <div id="board_myboard_rewrite_box">
          <div id="board_myboard_rewrite_photo">
            <?php
                  if ($file_name) {
                      $real_name = $file_copied;
                      $file_path = "../../data/".$real_name;
                      $file_size = filesize($file_path);
                      }
              ?>
            <input type='file' id="Preview_img" name="upfile" value='<?=$file_name?>'/>
            <img id="blah" src=<?=$file_path?>>
          </div>
          <div id="board_myboard_rewrite_top">
            <input id="myboard_rewrite_title" name="subject" type="text" placeholder="Title" value="<?=$subject?>">
          <!--  <span id="div_myboard_rewrite_spandiv">MemberId :<span id="memberid"><?=$id?></span> </span>-->
          <select id="category_write" name="category">
              <?php
                switch ($category) {
                case '찾아요':
                  ?>
                  <option value="찾아요" selected="selected" >찾아요</option>
                  <option value="데리고 있어요">데리고 있어요</option>
                  <option value="자유게시판">자유게시판</option>
                  <option value="흐흐흐">흐흐흐</option>
                  <?php
                  break;
                  case '데리고있어요' :
                  ?>
                  <option value="찾아요" >찾아요</option>
                  <option value="데리고 있어요"selected="selected">데리고 있어요</option>
                  <option value="자유게시판">자유게시판</option>
                  <option value="흐흐흐">흐흐흐</option>
                  <?php
                  break;
                  case '자유게시판' :
                  ?>
                  <option value="찾아요" >찾아요</option>
                  <option value="데리고 있어요">데리고 있어요</option>
                  <option value="자유게시판"selected="selected">자유게시판</option>
                  <option value="흐흐흐">흐흐흐</option>
                  <?php
                  break;
                  case '흐흐흐' :
                   ?>
                   <option value="찾아요" >찾아요</option>
                   <option value="데리고 있어요">데리고 있어요</option>
                   <option value="자유게시판">자유게시판</option>
                   <option value="흐흐흐"selected="selected">흐흐흐</option>
                   <?php
                   default:
                   break;
                 }
                  ?>
          </select>
          </div>
          <div id="board_myboard_rewrite_center">
            <textarea id="board_myboard_rewrite_content" name="content"  placeholder="Content"><?=$content?></textarea>
          </div>
          <div id="board_location_box">
          <div class="map_wrap">
        <div id="map_write" style="width:100%;height:100%;position:relative;overflow:hidden;"></div>
        <div class="hAddr" style="position: absolute;left: 10px;top: 10px;border-radius: 2px;background: #fff;
            background: rgba(255, 255, 255, 0.8);z-index: 1;padding: 5px;">
            <span class="title">지도중심기준 행정동 주소정보</span>
            <span id="centerAddr"></span>
        </div>
    </div>
          </div>
        </div>
        <div id="board_myboard_rewrite_bottom">
          <button id="board_myboard_rewrite_upload" type="button"  onclick="check_input()">UpLoad</button>
        </div>
      </form>

    </div>

    <footer>
      <?php include "../../lib/common_page/footer.php" ?>
    </footer>
  <script src="../../js/board/board.js"></script>
  <script src="../../js/board/board_map_write.js"></script>
  </body>
</html>

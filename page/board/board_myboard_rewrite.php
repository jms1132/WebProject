<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="../../css/board/board.css">
  <link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="../../js/main/pop_up_menu.js"></script>
  <script>
   // <!-- board에서 입력하지 않은 칸이 있는지 확인 -->
  function valid_check_input() {
    if (!document.board_myboard_rewrite.subject.value) {
      alert("제목을 입력하세요!");
      document.board_myboard_rewrite.subject.focus();
      return;
    }
    if (!document.board_myboard_rewrite.content.value) {
      alert("내용을 입력하세요!");
      document.board_myboard_rewrite.content.focus();
      return;
    }
    document.board_myboard_rewrite.submit();
  }
  </script>
</head>

  <body>
    <!-- header -->
    <?php include "../../lib/common_page/header.php" ?>
    <section>
      <!-- nav -->
      <?php include "../../lib/board/nav/board_nav.php" ?>
    <?php
      $num  = $_GET["num"];
      $sql = "select * from board where num=$num";
      $result=mysqli_query($connect,$sql);
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
    ?>
    <!-- center -->
    <div class="board_myboard_rewrite">
      <form  name="board_myboard_rewrite" method="post" action="board_modify.php?num=<?=$num?>" enctype="multipart/form-data">
        <div id="board_myboard_rewrite_box">
          <div id="board_myboard_rewrite_photo">
            <?php
                  if ($file_name) {
                      $real_name = $file_copied;
                      $file_path = "../../data/".$real_name;
                      $file_size = filesize($file_path);
                      }
              ?>
            <input type='file' id="Preview_img" name="upfile" value='<?=$file_name?>' onerror="imagedefault(this)"/>
            <img id="blah" src='<?=$file_path?>'>
          </div>
          <div id="board_myboard_rewrite_top">
            <input id="myboard_rewrite_title" name="subject" type="text" placeholder="Title" value="<?=$subject?>">
          <select id="category_write" name="category">
              <?php
                switch ($category) {
                case '찾아요':
                  ?>
                  <option value="찾아요" selected="selected" >찾아요</option>
                  <option value="데리고 있어요">데리고 있어요</option>
                  <?php
                  break;
                  case '데리고있어요' :
                  ?>
                  <option value="찾아요" >찾아요</option>
                  <option value="데리고 있어요"selected="selected">데리고 있어요</option>
                  <?php
                  break;
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
            <input id="locationY" name="locationY" type="text" value="" hidden>
            <input id="locationX" name="locationX" type="text" value="" hidden>
          </div>
        </div>
        <div id="board_myboard_rewrite_bottom">
          <button id="board_myboard_rewrite_upload" type="button"  onclick="valid_check_input()">UpLoad</button>
        </div>
      </form>
    </div>
</section>
    <footer>
      <?php include "../../lib/common_page/footer.php" ?>
    </footer>
  <script src="../../js/board/board.js"></script>
  <script src="../../js/board/board_map_write.js"></script>
  </body>
</html>

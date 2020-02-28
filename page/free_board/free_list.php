<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="../../css/free/free.css">
    <link rel="stylesheet" href="../../css/free/free_list.css">
    <script src="../../js/free/free_list.js" charset="utf-8"></script>
  </head>
  <body>
    <div class="">
      <table>
        <tbody>
          <tr>
            <td>
              <div>
                <select class="" id="category_select" onchange="change_category();">
                  <option value>카테고리</option>
                  <option value="잡담" >잡담</option>
                  <option value="질문">질문</option>
                </select>
                <a href="#">추천글</a>
                <ul class="total_ul" style="float: right;">
                  <li><a href="#" onclick="goList();">목록</a></li>
                  <li><a href="./free_write_form.php">글쓰기</a></li>
                </ul>
              </div>
            </td>
          </tr>
          <tr>
            <td class="table_border"></td>
          </tr>
          <!-- 실제 리스트 시작 -->
          <tr>
            <td>
              <form class="" action="index.html" method="post">
                <input type="hidden" name="" value="">
                <table id="input_table">
                  <thead class="">
                    <tr class="back_tr bottom_tr">
                      <td class="col1">번호</td>
                      <td class="col2">제목</td>
                      <td class="col3">글쓴이</td>
                      <td class="col4">등록일</td>
                      <td class="col5">조회</td>
                      <td class="col6">추천</td>
                    </tr>
                  </thead>
                  <?php
                    // include_once "../../db/db_connector_main.php";
                    $connect = mysqli_connect("localhost","root","123456","test");
                    $page=(isset($_GET["page"]))?$_GET["page"]:1;
                    $scale=(isset($_GET["scale"]))?$_GET["scale"]:20;
                    $page_num=10;
                    $new_cate=(isset($_GET["new_cate"]))?$_GET["new_cate"]:0;
                    if ($new_cate==="1") {
                      unset($_GET["category"]);
                    }
                    $category=(isset($_GET["category"]))?$_GET["category"]:" ";
                    if ($category===" ") {
                      $sql = "select * from free";
                    }else {
                      $sql = "select * from free where category='$category'";
                    }
                    $result = mysqli_query($connect,$sql);
                    $total_record = mysqli_num_rows($result);
                    $total_page=ceil($total_record/$scale);

                    $block = ceil($page/$page_num);

                    $start_page = (($block-1) * $page_num)+1;
                    $end_page = $start_page + $page_num -1;
                    if ($end_page>$total_page) {
                      $end_page=$total_page;
                    }
                    $start = ($page-1) * $scale;
                    $number = $total_record - $start;
                    for ($i=$start; $i <$start+$scale && $i < $total_record ; $i++) {
                      mysqli_data_seek($result,$i);
                      $row = mysqli_fetch_array($result);
                      $num = $row["num"];
                      $name = $row["name"];
                      $q_category = $row["category"];
                      $subject = $row["subject"];
                      $total_subject = "[".$q_category."] ".$subject;
                      $content = $row["content"];
                      $regist_day = $row["regist_day"];
                      $time = substr($regist_day,12,5);
                      $hit = $row["hit"];
                      $chu = $row["chu"];
                      ?>
                  <tbody>
                    <tr class="bottom_tr">
                      <td class="col1"><?=$num?></td>
                      <td class="col2" style="text-align: left;}"><a href="#"><?=$total_subject?></a></td>
                      <td class="col3"><?=$name?></td>
                      <td class="col4"><?=$time?></td>
                      <td class="col5"><?=$hit?></td>
                      <td class="col6"><?=$chu?></td>
                    </tr>
                  </tbody>
                  <?php
                    $number --;
                    }
                    mysqli_close($connect);
                  ?>
                </table>
              </form>
            </td>
          </tr>
          <tr>
            <td style="text-align: right;" class="back_tr"><a href="./free_write_form.php">글쓰기</a></td>
          </tr>
          <tr>
            <td class="table_border"></td>
          </tr>
          <tr>
            <td>
              <form class="" action="index.html" method="post">
                <table>
                  <tr class="back_tr page_tr total_ul" style="width: 700px;">
                    <?php
                      if ($page<=1) {
                        echo "<td><b></b></td>";
                      }else {
                        if ($category===" ") {
                          echo "<td><a href='free_list.php'>처음</a></td>";
                        }else {
                          echo "<td><a href='free_list.php?category=$category'>처음</a></td>";
                        }
                      }
                      if ($block<=1) {
                        echo "<td></td>";
                      }else {
                        $new_page = $start_page -1;
                        if ($category===" ") {
                          echo "<td><a href='free_list.php?page=$new_page'><b> ◀ 이전 </b></a></td>";
                        }else {
                          echo "<td><a href='free_list.php?category=$q_category&page=$new_page'><b> ◀ 이전 </b></a></td>";
                        }
                      }
                      for ($i=$start_page; $i <=$end_page; $i++) {
                        if ($page == $i) {
                          echo "<td><b>&nbsp;$i&nbsp;</b></td>";
                        }else {
                          if ($category===" ") {
                            echo "<td><a href='free_list.php?page=$i'>&nbsp;$i&nbsp;</a></td>";
                          }else {
                            echo "<td><a href='free_list.php?category=$q_category&page=$i'>&nbsp;$i&nbsp;</a></td>";
                          }
                        }
                      }
                      if ($total_page>=2 && $page != $total_page) {
                        $new_page = $end_page+1;
                        if ($category===" ") {
                          echo "<td><a href='free_list.php?page=$new_page'><b> 다음 ▶ </b></a></td>";
                        }else {
                          echo "<td><a href='free_list.php?category=$q_category&page=$new_page'><b> 다음 ▶ </b></a></td>";
                        }
                      }else {
                        echo "<td></td>";
                      }
                      if ($page>=$total_page) {
                        echo "<td><b></b></td>";
                      }else {
                        if ($category===" ") {
                          echo "<td><a href='free_list.php?page=$total_page'> 마지막 </a></td>";
                        }else {
                          echo "<td><a href='free_list.php?category=$q_category&page=$total_page'> 마지막 </a></td>";
                        }
                      }
                   ?>
                   <td>
                     <ul id="search_ul">
                       <li><select class="" name="">
                         <option value="subject">제목</option>
                         <option value="content">내용</option>
                         <option value="name">이름</option>
                         <option value="category">카테고리</option>
                       </select> </li>
                       <li><input type="text" name="" value="" style="width: 100px;"> </li>
                       <li><a href="#">검색</a></li>
                     </ul>
                   </td>
                  </tr>
                </table>
              </form>
            </td>
          </tr>
          <tr>
            <td class="table_border"></td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>

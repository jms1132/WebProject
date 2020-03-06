<!-- 댓글 -->
<!--
삭제 할땐 내가 단 댓글만 지울수 있고 다른 사람의 댓글은 지울수 없다
내가 쓴 댓글은 삭제버튼이 생겨져 있다
내가 쓴 댓글의 이미지는 기본 이미지와 다르다(색상을 주어 눈에 띄게 보임)
삭제 -  댓글에 삭제를 하면 대댓긇도 없어진다
전 글을 삭제하면 다음글이 이전글위치에 있어야 한다
 -->
 <?php
 $num = $_GET["num"];

 ?>
  <?php
      $passFlag=false;
      $sql = "SELECT * FROM (SELECT * FROM `comment` ORDER BY `group_num` DESC, `comment_num`) `comment` WHERE `group_num` = $num group by `depth`, `comment_num` ORDER BY `comment_num`, `depth`";
    // 코멘트 테이블(그룹넘버로 내림차순, 코멘트 넘버로 오름차순)을 한 테이블에서 그룹넘버가 10인
    // 데이터만 가져오는데 뎁스로 그룹바이를 해서 정렬해서 가져오고 코멘트 넘버로도 구룹 바이로 해서 가져온후
    // 코멘트 넘버로 오름차순으로 가져옴
      $result = mysqli_query($connect, $sql);
      $commentpost_num = mysqli_num_rows($result);

      if ($commentpost_num) {
          for ($i = 0; $i < $commentpost_num; $i++) {
              $row = mysqli_fetch_array($result);
              $id         = $row["id"];
              $regist_day = $row["regist_day"];
              $content    = $row["content"];
              ?>
        <script>
        // 댓글 숨기기 기능
          var flag = false;
            function hide(text) {
              if(!flag) {
                document.getElementById(text).style.display = 'none';
                flag = true;
              } else {
                document.getElementById(text).style.display = 'inline-block';
                flag = false;
              }
            }
            //댓글을 삭제 시 사용하는 함수
            function remove(text){
              var result = confirm("댓글을 삭제 하시겠습니까?");
              if(result){
                alert("삭제 완료 페이지를 다시 불러 옵니다!");
                document.getElementById(text).submit();
              }else{
                alert("삭제 취소");
              }
            }
            //대댓글을 삭제 시 사용하는 함수
            function reremove(text,x){
              var result = confirm("댓글을 삭제 하시겠습니까?");
              if(result){
                alert("삭제 완료 페이지를 다시 불러 옵니다!");
                document.getElementById(text).submit();
              }else{
                alert("삭제 취소");
              }
            }
        </script>
        <!-- basic comment input -->
        <div class="board_widen_comment_box">
          <form name="comment_form" action="../../lib/comment/comment_insert.php?num=<?=$num?>"  method="post">
            <div id="board_widen_comment_input_box">
              <div id="board_widen_comment_input_span">
                <p>댓글 <span><?=$commentpost_num?></span>개</p>
              </div>
              <div id="board_widen_comment_input_text">
                <img class="imgsetting" id="board_widen_comment_input_text_image" src="../../img/board/default_proflie.png" >
                <textarea name="content" id="input_comment_area" rows="1" onkeydown="resize(this)" onkeyup="resize(this)" placeholder="Comment"></textarea>
                <button type="submit" id="submit" name="button">Add</button>
              </div>
            </div>
        </form>
            <?php
            // 해당 게시판 group_num 의 뎃글의 갯수를 가져와 보여준다
               for ($i=0; $i<$commentpost_num; $i++) {
                   mysqli_data_seek($result, $i);
                   $row = mysqli_fetch_array($result);
                   $deleteNum =    $row['num'];
                   $id =           $row["id"];
                   $regist_day =   $row["regist_day"];
                   $content =      $row["content"];
                   $depth =        $row["depth"];
                   $ord =          $row["ord"];
                   $comment_num =  $row['comment_num'];
                   ?>

                  <?php
                  if ($depth & $passFlag === false) {
                    //대댓글이 있을때
                      $sql1 = "SELECT * FROM `comment` WHERE `group_num` = $num AND `comment_num` = $comment_num AND `depth` = $depth";
                      $result1 = mysqli_query($connect, $sql1);
                      $recomment_num = mysqli_num_rows($result1);
                      //대댓글 보여주기
                      for ($j = 0; $j < $recomment_num; $j++) {
                          mysqli_data_seek($result1, $j);
                          $row = mysqli_fetch_array($result1);
                          $d_num =           $row["num"];
                          $recomment_id =            $row["id"];
                          $recomment_regist_day =    $row["regist_day"];
                          $recomment_content =       $row["content"];
                          $recomment_group_num =     $row["group_num"];
                          $recomment_comment_num =   $row["comment_num"];
                          $recomment_ord =           $row["ord"];
                          ?>
                  <!--대댓글-->
                  <form id = "remove_recomment<?=$i?><?=$j?>" action="../../lib/comment/recomment_delete.php?num=<?=$num?>&d_num=<?=$d_num?>&group_num=<?=$recomment_group_num?>&comment_num=<?=$recomment_comment_num?>&ord=<?=$recomment_ord?>" method="post" style="display : block;">
                      <div id="board_widen_comment_viewmore_click<?=$j?>" class="board_widen_comment_viewmore_click">
                        <img src="../../img/board/default_proflie.png">
                        <div id="board_widen_comment_show_text_member">
                          <span><?=$recomment_id?></span><br>
                          <input type="hidden" name="id" value="<?=$recomment_id?>">
                          <span><?=$recomment_content?></span><br>
                          <input type="hidden" name="re_content" value="<?=$recomment_content?>">
                          <span><?=$recomment_regist_day?></span>
                          <input type="hidden" name="date" value="<?=$recomment_regist_day?>">
                          <?php
                          if(isset($_SESSION['userid'])){
                            if($_SESSION['userid']==$recomment_id){
                              ?>
                          <button type="button" class="comment_delete_btn" onclick="reremove('remove_recomment<?=$i?><?=$j?>',<?=$d_num?>);">삭제</button>
                          <?php
                              }
                            }
                       ?>
                        </div>
                      </div>
                  </form>
                  <?php
                      }
                      $passFlag = true;
                  } else {
                    //대댓글이 없을때
                      $passFlag = false;
                       ?>
                      <!-- comment show & recomment input -->
                      <form id = "remove_comment<?=$i?>" action="../../lib/comment/comment_delete.php?num=<?=$num?>&comment_num=<?=$comment_num?>&delete_num=<?=$deleteNum?>" method="post">
                        <div id="board_widen_comment_show_text">
                          <img class="imgsetting" src="../../img/board/default_proflie.png">
                          <div id="board_widen_comment_show_text_member">
                            <span id ="id"><?=$id?></span><br>
                            <input type="hidden" name="id" value="<?=$id?>">
                            <span id ="re_content"><?=$content?></span><br>
                            <input type="hidden" name="re_content" value="<?=$content?>">
                            <span id ="date"><?=$regist_day?></span>&nbsp;&nbsp;
                            <span id = "reple_comment" style="cursor:pointer"  onclick="hide('board_widen_comment_input_retext_box<?=$i?>');">▼ 답글</span>
                            <?php
                            if(isset($_SESSION['userid'])){
                              if($_SESSION['userid']==$id){
                                ?>
                                  <button type='button' class='comment_delete_btn' onclick="remove('remove_comment<?=$i?>');">삭제</button>
                                <?php
                              }
                            }
                             ?>
                            <input type="hidden" name="date" value="<?=$regist_day?>">
                          </div>
                        </div>
                      </form>
                     <form name = "recomment_form" action="../../lib/comment/comment_insert.php?num=<?=$num?>&mode=recomment&comment_num=<?=$comment_num?>&depth=<?=$depth?>&ord=<?=$ord?>" method="post">
                       <div id="board_widen_comment_input_retext_box<?=$i?>" style="margin-left : 60px; display : none;">
                         <div id="board_widen_comment_input_retext">
                           <img class="imgsetting" id="board_widen_comment_input_retext_image" src="../../img/board/default_proflie.png">
                           <textarea name="content" id="input_comment_area" rows="1" onkeydown="resize(this)" onkeyup="resize(this)" placeholder="Comment"></textarea>
                           <button type="submit" id="submit" name="button" >Add</button><br>
                         </div>
                       </div>
                     </form>
                      <?php
                  } ?>
                   <?php
               } ?>
           </div>
        <?php
          }
      } else {
          ?>
        <div class="board_widen_comment_box">
          <form name="comment_form" action="../../lib/comment/comment_insert.php?num=<?=$num?>"  method="post">
            <div id="board_widen_comment_input_box">
              <div id="board_widen_comment_input_span">
                <p>댓글 <span><?=$commentpost_num?></span>개</p>
              </div>
              <div id="board_widen_comment_input_text">
                <img class="imgsetting" id="board_widen_comment_input_text_image" src="../../img/board/default_proflie.png" >
                <textarea name="content" id="input_comment_area" rows="1" onkeydown="resize(this)" onkeyup="resize(this)" placeholder="Comment"></textarea>
                <button type="submit" name="button">Add</button>
              </div>
            </div><br><br><br><br>
        <?php
      }
      mysqli_close($connect);

   ?>

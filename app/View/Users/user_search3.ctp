<body>
<?php echo $this->Html->css(['home','link_text']); ?>
<div id="main">
  <?php $_POST = array(); ?>
  <?php $i=0; ?>
  <?php $j=0; ?>
  <?php
    //commentがPOSTされているなら
    if(isset($_GET["searchname"])){
      //エスケープしてから表示
      $tmp = htmlspecialchars($_GET["searchname"]);


      if(empty($userlists)){ ?>

          <p>友だちを見つけて、フォローしましょう！</p>
          <?php echo $tmp . 'というユーザーはいません'; ?>
          <form method="GET">
            <input name="searchname" />
            <input type="submit" value="検索" />
          </form>


      <?php }else{ ?>

        <p>友だちを見つけて、フォローしましょう！</p>
        <form method="GET">
          <input name="searchname" />
          <input type="submit" value="検索" />
        </form>

        <?php print($tmp); ?>の検索結果

        <?php $page = 0;
        if(isset($_GET['page'])){
        $page = $_GET['page'];
        }?>
        <?php if(count($newdatas)<=10){
          $j=1;
        }
        foreach($newdatas as $newdata): ?>
          <?php if($i >=10){
            $j++;
            if(isset($_GET['page'])){
              $j += $_GET['page'];
            }
            break;
          }else{
            if(isset($newdatas[$i+10*$page])){ ?>
              <div class="box tweet">
                <?php $usern = $userlists[count($newdatas)-10*($page)-$i-1]["Users"]["username"]; ?>
                <?php //classが利かない?>
                <?php echo $this->Html->link($usern,array('action'=>'userpage/'.$usern),array('class'=>'link_text'));?>
                </br>
                <?php //投稿がないとエラー?>
                <?php print(h($newdatas[count($newdatas)-10*($page)-$i-1]["Datas"]["message"])); ?>
                <?php //echo $this->Html->link('Follow',array('action'=>'userfollow/'.$usern),array('class'=>'link_text'));?>
                <?php $check = 0;?>
                <?php //  ユーザーネームを含むか確認。もっとスマートにできるはず。
                foreach($follows as $follow){
                  if($follow['Relation']['follow'] === $usern){
                    $check = 1;
                  }
                } ?>
                <?php if($check === 0){ ?>
                  <form method="POST">
                    <input type="hidden" name="followname" value="<?php echo $usern;?>">
                    <input type="submit" value="Follow" />
                  </form>
                <?php } ?>
              </div>
              <?php $i++;
            }else{
              $j++;
              if(isset($_GET['page'])){
                $j += $_GET['page'];
              }
              break;
            }
          } ?>
        <?php endforeach; ?>


      <?php }



    } else {
  ?>
      <p>友だちを見つけて、フォローしましょう！</p>
      <form method="GET">
        <input name="searchname" />
        <input type="submit" value="検索" />
      </form>
  <?php
    }
  ?>

  <div class="box box4">
    <?php if($j>1){
      $k = $j-2;
      echo $this->Html->link('前の10件', '/users/user_search3/?page='.$k,array('class'=>'link_text'));
    }
    if(isset($newdatas[10*$j])){
      echo $this->Html->link('次の10件', '/users/user_search3/?page='.$j,array('class'=>'link_text'));
    }?>
  </div>


</div>
</body>

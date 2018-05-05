<body>
<?php echo $this->Html->css(['home','link_text']); ?>
<div id="main">
      <div class="box box2">
      <?php print(h($pagename)); ?>は<?php print(count($relations))?>人にフォローされています
      <?php $page = 0;
      if(isset($_GET['page'])){
      $page = $_GET['page'];
      }?>
      <?php $i=0; ?>
      <?php $j=0; ?>
      <?php if(count($relations)<=10){
        $j=1;
      }
      foreach($relations as $relation): ?>
        <?php if($i >=10){
          $j++;
          if(isset($_GET['page'])){
            $j += $_GET['page'];
          }
          break;
        }else{
          if(isset($relations[$i+10*$page])){ ?>
            <div class="box tweet">
              <?php
              print(h($relations[count($relations)-10*($page)-$i-1]["Relation"]["username"])); ?>
              </br>
              <?php print(h($newdatas[count($relations)-10*($page)-$i-1]["Datas"]["message"])); ?>
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
    </div>

    <div class = "box status">
      <?php print(h($pagename)); ?>
      </br>
      <div class = "detail1">
        <?php echo $this->Html->link(count($follows), '/users/follow/'.$pagename, array('class'=>'link_text'));?>
        </br>
        フォローしている
      </div>
      <div class = "detail2">
        <?php echo $this->Html->link(count($followers), '/users/follower/'.$pagename, array('class'=>'link_text'));?>
        </br>
        フォローされている
      </div>
      <div class = "detail3">
        <?php echo $this->Html->link(count($mydatas), '/users/tweet/'.$pagename, array('class'=>'link_text'));?>
        </br>
        投稿数
      </div>
    </div>

      <div class="box box4">
        <?php if($j>1){
          $k = $j-2;
          echo $this->Html->link('前の10件', '/users/follow/?page='.$k,array('class'=>'link_text'));
        }
        if(isset($relations[10*$j])){
          echo $this->Html->link('次の10件', '/users/follow/?page='.$j,array('class'=>'link_text'));
        }?>
      </div>
    </div>
  </div>
</div>
</body>

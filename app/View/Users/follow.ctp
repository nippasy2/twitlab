<body>
<?php echo $this->Html->css(['home','link_text','next','status']); ?>
<div id="main">
      <div class="box main_box">
      <?php print(h($pagename)); ?>は<?php print(count($relations))?>人をフォローしています
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
            <div class="box tweets">
              <?php $usern = $relations[count($relations)-10*($page)-$i-1]["Relation"]["follow"] ?>
              <?php echo $this->Html->link($usern,array('action'=>'userpage/'.$usern),array('class'=>'link_text'));?>
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

      <div class="box pagination">
        <?php if($j>1){
          $k = $j-2;
          echo $this->Html->link('前の10件', './follow/' .$pagename. '?page='.$k,array('class'=>'next'));
        }
        if(isset($relations[10*$j])){
          echo $this->Html->link('次の10件', './follow/' .$pagename. '?page='.$j,array('class'=>'next'));
        }?>
      </div>

    </div>

    <div class = "box status_frame">
        <?php echo $this->element('Users/myfollower',["user"=>$user]); ?>
    </div>
    <div class="clearfix"></div>

    </div>
  </div>
</div>
</body>

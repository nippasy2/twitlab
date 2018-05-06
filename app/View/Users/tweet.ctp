<body>
<?php echo $this->Html->css(['home','link_text','next','status']); ?>
<div id="main">
      <div class="box main_box">
        <h3><?php print(h($pagename)); ?>のツイート</h3>
        <?php $page = 0;
        if(isset($_GET['page'])){
        $page = $_GET['page'];
        }?>
        </br>
        <?php $i=0; ?>
        <?php $j=0; ?>
        <?php if(count($mydatas)<=10){
          $j=1;
        }
        foreach($mydatas as $data):
          if($i >=10){
            $j++;
            if(isset($_GET['page'])){
              $j += $_GET['page'];
            }
            break;
          }else{
            if(isset($mydatas[$i+10*$page])){ ?>
              <div class="box tweets">
                <?php print(h($mydatas[count($mydatas)-10*($page)-$i-1]["Data"]["name"])); ?>
                </br>
                <?php print(h($mydatas[count($mydatas)-10*($page)-$i-1]["Data"]["message"])); ?>
              </div>
              <?php $i++;
            }else{
              $j++;
              if(isset($_GET['page'])){
                $j += $_GET['page'];
              }
              break;
            }
          }
        endforeach; ?>

        <div class="box pagination">
          <?php if($j>1){
            $k = $j-2;
            echo $this->Html->link('前の10件', './tweet/' .$pagename. '?page='.$k,array('class'=>'next'));
          }
          if(isset($mydatas[10*$j])){
            echo $this->Html->link('次の10件', './tweet/' .$pagename. '?page='.$j,array('class'=>'next'));
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

<body>
<?php echo $this->Html->css(['home','link_text','status','next','button','textarea']); ?>
<div id="main">
      <div class="box main_box">
        <?php $page = 0;
        if(isset($_GET['page'])){
        $page = $_GET['page'];
        }?>
        <div class="box text3">
          <h3><?php echo $pagename ?>のつぶやき</h3>
        </div>
        <?php $i=0; ?>
        <?php $j=0; ?>
        <?php if(count($mydatas)<=10){
          $j=1;
        }
        foreach($mydatas as $mydata): ?>
          <?php if($i >=10){
            $j++;
            if(isset($_GET['page'])){
              $j += $_GET['page'];
            }
            break;
          }else{
            if(isset($mydatas[$i+10*$page])){ ?>
              <div class="box tweets">
                <?php if($mydatas[count($mydatas)-10*($page)-$i-1]["Data"]["name"] === $user['username']){?>
                  <div class='trash'>
                  <?php //https://nodoame.net/archives/5715 ?>
                  <?php $id = ($mydatas[count($mydatas)-10*($page)-$i-1]["Data"]['id']);?>
                  <?php $alert = 'Sure you want to delete this tweet? There is NO undo!'; ?>
                  <?php echo $this->Html->link($this->Html->image('trash.png',['height'=>'20']),array('action'=>'delete/'.$id),array('escape'=>false),$alert);?>
                  </div>
                  <?php print(h($mydatas[count($mydatas)-10*($page)-$i-1]["Data"]["name"])); ?>
                <?php }else{ ?>
                <?php $usern = $mydatas[count($mydatas)-10*($page)-$i-1]["Data"]["name"]; ?>
                <?php //classが利かない?>
                <?php echo $this->Html->link($usern,array('action'=>'userpage/'.$usern),array('class'=>'link_text'));?>
                <?php } ?>
                </br>
                <?php print(h($mydatas[count($mydatas)-10*($page)-$i-1]["Data"]["message"])); ?>
                </br>
                <?php print(h($mydatas[count($mydatas)-10*($page)-$i-1]["Data"]["created"])); ?>
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
            echo $this->Html->link('前の10件', './userpage/' .$pagename. '?page='.$k,array('class'=>'next'));
          }
          if(isset($mydatas[10*$j])){
            echo $this->Html->link('次の10件', './userpage/' .$pagename. '?page='.$j,array('class'=>'next'));
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

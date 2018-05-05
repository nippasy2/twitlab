<body>
<?php echo $this->Html->css(['home','link_text','status','next','button','textarea']); ?>
<div id="main">
    <div class="box">
        <h3>いまなにしてる？</h3>

        <?php print(
          //http://www-creators.com/archives/2496
          $this->Form->create('Data') .
          //$this->Form->input('name',array('label' => '','required'=>false)) .
          $this->Form->input('message',array('label' => '','required'=>false,'class'=>'textarea')) .
          $this->Form->button('投稿する',array('required'=>false,'class' =>'tweet')) .
          $this->Form->end()
        ); ?>

      </br>
      </br>
      </br>

        <b>最新のつぶやき：</b>
        <?php print(h($mydatas[count($mydatas)-1]["Data"]["message"])); ?>
      </br>
        <?php print(h($mydatas[count($mydatas)-1]["Data"]["created"])); ?>
      </div>

      <div class="box box2">
        <?php $page = 0;
        if(isset($_GET['page'])){
        $page = $_GET['page'];
        }?>
        <div class="box text3">
          <h3>ホーム</h3>
        </div>
        <?php $i=0; ?>
        <?php $j=0; ?>
        <?php if(count($datas)<=10){
          $j=1;
        }
        foreach($datas as $data): ?>
          <?php if($i >=10){
            $j++;
            if(isset($_GET['page'])){
              $j += $_GET['page'];
            }
            break;
          }else{
            if(isset($datas[$i+10*$page])){ ?>
              <div class="box tweets">
                <?php if($datas[count($datas)-10*($page)-$i-1]["Datas"]["name"] === $user['username']){?>
                  <div class='trash'>
                  <?php //https://nodoame.net/archives/5715 ?>
                  <?php $id = ($datas[count($datas)-10*($page)-$i-1]["Datas"]['id']);?>
                  <?php $alert = 'Sure you want to delete this tweet? There is NO undo!'; ?>
                  <?php echo $this->Html->link($this->Html->image('trash.png',['height'=>'20']),array('action'=>'delete/'.$id),array('escape'=>false),$alert);?>
                  </div>
                  <?php print(h($datas[count($datas)-10*($page)-$i-1]["Datas"]["name"])); ?>
                <?php }else{ ?>
                <?php $usern = $datas[count($datas)-10*($page)-$i-1]["Datas"]["name"]; ?>
                <?php //classが利かない?>
                <?php echo $this->Html->link($usern,array('action'=>'userpage/'.$usern),array('class'=>'link_text'));?>
                <?php } ?>
                </br>
                <?php print(h($datas[count($datas)-10*($page)-$i-1]["Datas"]["message"])); ?>
                </br>
                <?php print(h($datas[count($datas)-10*($page)-$i-1]["Datas"]["created"])); ?>
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

      <div class = "box status_frame">
        <?php print(h($user['username'])); ?>
        </br>
        <div class = "detail">
          <?php echo count($follows);?>
          </br>
          <?php echo $this->Html->link('フォローしている', '/users/follow/'.$user['username'], array('class'=>'link_text'));?>
        </div>
        <div class = "detail">
          <?php echo count($followers);?>
          </br>
          <?php echo $this->Html->link('フォローされている', '/users/follower/'.$user['username'], array('class'=>'link_text'));?>
        </div>
        <div class = "detail">
          <?php echo count($mydatas);?>
          </br>
          <?php echo $this->Html->link('投稿数', '/users/tweet/'.$user['username'], array('class'=>'link_text'));?>
        </div>
      </div>

      <div class="box box4">
        <?php if($j>1){
          $k = $j-2;
          echo $this->Html->link('前の10件', '/users/home/?page='.$k,array('class'=>'next'));
        }
        if(isset($datas[10*$j])){
          echo $this->Html->link('次の10件', '/users/home/?page='.$j,array('class'=>'next'));
        }?>
      </div>
    </div>
  </div>
</div>
</body>

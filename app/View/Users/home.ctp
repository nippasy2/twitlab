<body>
<?php echo $this->Html->css(['home','link_text','status','next','button','tweet_input']); ?>
<div id="main">
    <div id="tweet_box">
        <h3>いまなにしてる？</h3>
        <?php print($this->Form->create('Data')); ?>
        <?php print($this->Form->input('message',array('label' => '','required'=>false,'class'=>'tweet_body'))); ?>
        <div id="tweet_box_recent_tweet">
            <?php if(isset($mydatas[count($mydatas)-1]["Data"]["message"])):?>
            <b>最新のつぶやき：</b>
            <?php print(h($mydatas[count($mydatas)-1]["Data"]["message"])); ?>
            </br>
            <?php print(h($mydatas[count($mydatas)-1]["Data"]["created"])); ?>
            <?php endif; ?>
        </div>
        <div class="tweet_btn">
            <?php print($this->Form->button('投稿する',array('required'=>false,'class' =>'tweet'))); ?>
        </div>
        <div class="clearfix"></div>
        <?php print($this->Form->end()); ?>
    </div>

      <div class="main_box">
          <div class="box home_box">
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
                                  <b><?php print(h($datas[count($datas)-10*($page)-$i-1]["Datas"]["name"])); ?></b>
                              <?php }else{ ?>
                                  <?php $usern = $datas[count($datas)-10*($page)-$i-1]["Datas"]["name"]; ?>
                                  <?php //classが利かない?>
                                  <b><?php echo $this->Html->link($usern,array('action'=>'userpage/'.$usern),array('class'=>'link_text'));?></b>
                              <?php } ?>
                              </br>
                              <?php print(h($datas[count($datas)-10*($page)-$i-1]["Datas"]["message"])); ?>
                              </br>
                              <?php
                              //～分前の実装
                              //https://qiita.com/wgkoro@github/items/eee4e6854535d62ca55b
                              $time = $datas[count($datas)-10*($page)-$i-1]["Datas"]["created"];
                              $now = time();
                              $diff_sec   = $now - strtotime($time);

                              if($diff_sec < 60){
                                  $time   = $diff_sec;
                                  $unit   = "秒前";
                              }
                              elseif($diff_sec < 3600){
                                  $time   = $diff_sec/60;
                                  $unit   = "分前";
                              }
                              elseif($diff_sec < 86400){
                                  $time   = $diff_sec/3600;
                                  $unit   = "時間前";
                              }
                              else{
                                  $time   = $diff_sec/86400;
                                  $unit   = "日前";
                              }
                              //最大単位を日とした?>
                              <font size='2px' color='gray'><?php echo (int)$time . $unit;?></font>
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
          <div class="box pagination">
              <?php if($j>1){
                  $k = $j-2;
                  echo $this->Html->link('前の10件', '/users/home/?page='.$k,array('class'=>'next'));
              }?>
              <?php if(isset($datas[10*$j])){
                  echo $this->Html->link('次の10件', '/users/home/?page='.$j,array('class'=>'next'));
              }?>
              <div class="clearfix"></div>
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

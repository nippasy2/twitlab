<body>
<?php echo $this->Html->css(['home','link_text']); ?>
<div id="main">
  <?php if(is_null($userlists)){ ?>
    友だちを見つけて、フォローしましょう！
    <div class="box box2">
        ついったーに登録済みの友だちを検索できます。
        </br>
        <?php echo($message) ?>というユーザーはいません
        </br>
        <?php print(
        //結果が一致しないとリダイレクトされてしまう
        //createとinputの引数が同じだとselectになってしまう
        $this->Form->create('usersearch', array('type' => 'get')).
        $this->Form->input('searchname', array('label' => false,'style' => 'width:400px', 'required' => false, 'div' => false)).
        $this->Form->button('検索', array('required'=>false,'class' =>'button')).
        $this->Form->end()
        ); ?>
      </div>

  <?php }elseif(empty($userlists)){ ?>
  友だちを見つけて、フォローしましょう！
  <div class="box box2">
      ついったーに登録済みの友だちを検索できます。
      </br>
      誰を検索しますか？
      </br>
      <?php print(
      //結果が一致しないとリダイレクトされてしまう
      //createとinputの引数が同じだとselectになってしまう
      $this->Form->create('usersearch', array('type' => 'get')).
      $this->Form->input('searchname', array('label' => false,'style' => 'width:400px', 'required' => false, 'div' => false)).
      $this->Form->button('検索', array('required'=>false,'class' =>'button')).
      $this->Form->end()
      ); ?>
    </div>

  <?php }else{ ?>
    <div class="box box2">
    <?php $page = 0;
    if(isset($_GET['page'])){
    $page = $_GET['page'];
    print($page);
    }?>
    <?php $i=0; ?>
    <?php $j=0; ?>
    <?php if(is_null($userlists)){

    }else{
      if(count($userlists)<=10){
        $j=1;
      }
      foreach($userlists as $userlist): ?>
        <?php if($i >=10){
          $j++;
          if(isset($_GET['page'])){
            $j += $_GET['page'];
          }
          break;
        }else{
          if(isset($userlists[$i+10*$page])){ ?>
            <div class="box tweet">
              <?php print(h($userlists[count($userlists)-10*($page)-$i-1]["Users"]["name"])); ?>
              </br>
              <?php print(h($newdatas[count($userlists)-10*($page)-$i-1]["Datas"]["message"])); ?>
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
      endforeach;
    } ?>

  </div>

    </div>
      <div class="box box4">
        <?php if($j>1){
          $k = $j-2;
          echo $this->Html->link('前の10件', '/users/home/?page='.$k,array('class'=>'link_text'));
        }
        if(isset($datas[10*$j])){
          echo $this->Html->link('次の10件', '/users/home/?page='.$j,array('class'=>'link_text'));
        }?>
      </div>
<?php } ?>
</body>

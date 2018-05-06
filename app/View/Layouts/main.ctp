  <head>
    <?php echo $this->Html->charset(); ?>
    <title><?php echo $title_for_layout; ?> / ついったー</title>
    <?php echo $this->Html->css(['main','roundbox','link_text']); ?>
  </head>
  <body>
  <div id="container">
    <div id="header">
      <div id="header_menu" class="roundbox">
        <?php
          if(isset($user)):
            echo $this->Html->link('ホーム', '/users/home/index',array('class'=>'link_text'));
            echo '&nbsp';
            echo $this->Html->link('友だちを検索', '/users/user_search3',array('class'=>'link_text'));
            echo '&nbsp';
            echo $this->Html->link('ログアウト', '/users/logout',array('class'=>'link_text'));
          else:
            echo $this->Html->link('ホーム', '/users/home/index',array('class'=>'link_text'));
            echo '&nbsp';
            echo $this->Html->link('ユーザ登録', '/users/register',array('class'=>'link_text'));
            echo '&nbsp';
            echo $this->Html->link('ログイン', '/users/login',array('class'=>'link_text'));
          endif;
        ?>
      </div>
      <div id="header_logo">
        <?php echo $this->Html->image('logo.png',array('height'=>'50','url' => array('action' => 'index'))); ?>
      </div>
    </div>
      <div id="content">
          <?php echo $this->fetch('content'); ?>
      </div>
  </body>

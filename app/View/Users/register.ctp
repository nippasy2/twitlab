<h1 style="display: inline">ついったーに参加しましょう</h1>
<h5 style="display: inline">もうついった－に登録していますか？</h5>
<?php
  echo '&nbsp';
  echo $this->Html->link('ログイン', '/users/login',array('class'=>'link_text'));
?>
<?php echo $this->Html->css(['button']); ?>
<?php print(
  $this->Form->create('User') .
  $this->Form->input('name',array('label' => '名前','required'=>false)) .
  $this->Form->input('username',array('label' => 'ユーザ名','required'=>false)) .
  $this->Form->input('password',array('label' => 'パスワード','required'=>false)) .
  $this->Form->input('password_confirm',array('label' => 'パスワード（確認）','required'=>false)) .
  $this->Form->input('email',array('label' => 'メールアドレス','required'=>false)) .
  $this->Form->button('アカウントを作成する',array('required'=>false,'class' =>'button')) .
  $this->Form->end()
); ?>

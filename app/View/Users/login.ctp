<h1>ログイン</h1>
<?php echo $this->Html->css(['button']); ?>
<?php print(
  $this->Form->create('User') .
  $this->Form->input('username',array('label' => 'ユーザー名','required'=>false)) .
  $this->Form->input('password',array('label' => 'パスワード','required'=>false)) .
  $this->Form->button('ログイン',array('required'=>false,'class' =>'button')) .
  $this->Form->end()
); ?>

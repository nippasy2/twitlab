<h1>ログイン</h1>
<?php echo $this->Html->css(['button','form']); ?>
<?php print(
  $this->Form->create('User') .
  $this->Form->input('username',array('label' => 'ユーザーID','required'=>false,'class' =>'form')) .
  $this->Form->input('password',array('label' => 'パスワード','required'=>false,'class' =>'form')) .
  $this->Form->button('ログイン',array('required'=>false,'class' =>'button')) .
  $this->Form->end()
); ?>

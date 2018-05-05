<h1>ついったーに参加しました</h1>

<?php print(h($user['username'])); ?><h3>さんはついったーに参加されました。</h3>

<h3>ログインをクリックしてログインしつぶやいてください。</h3>

<?php print(
  $this->Form->create('User') .
  $this->Form->button('ついったーにログイン',array('required'=>false,'class' =>'button')) .
  $this->Form->end()
); ?>

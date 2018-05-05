いまなにしてる？
<?php print(h($user['username'])); ?>さん
<?php print(
  $this->Form->create('Data') .
  //$this->Form->input('name',array('label' => '','required'=>false)) .
  $this->Form->input('message',array('label' => '','required'=>false)) .
  $this->Form->button('投稿する',array('required'=>false,'class' =>'button')) .
  $this->Form->end()
); ?>

<?php foreach($datas as $data): ?>
  <?php print(h($data["Datas"]["name"]) . ' (' . h($data["Datas"]["message"]) . ')'); ?>
</br>
<?php endforeach; ?>

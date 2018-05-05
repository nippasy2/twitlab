<h1><?php print(h($name)); ?>さんの投稿一覧</h1>
<?php foreach($datas as $data): ?>
  <?php print(h($data["Datas"]["message"]) . ' (' . h($data["Datas"]["created"]) . ')'); ?>
<?php endforeach; ?>

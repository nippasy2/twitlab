<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class Data extends AppModel {
  var $useTable = 'datas';
  //入力チェック機能
  public $validate = array(
    'message' => array(
      array(
        'rule' => 'notBlank',
        'message' => 'ツイートを入力してください',
      ),
      array(
        'rule' => array('between', 1, 140),
        'message' => '140文字以内でツイートしてください。'
      ),
    )
  );

}

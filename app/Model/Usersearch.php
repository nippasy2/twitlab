<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class Usersearch extends AppModel {
  var $useTable = false;
  //入力チェック機能
  public $validate = array(
    'message' => array(
      array(
        'rule' => 'notBlank',
        'message' => 'ユーザ名を入力してください',
      ),
    )
  );

}

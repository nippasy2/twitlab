<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
  //入力チェック機能
  public $validate = array(
    'name' => array(
      array(
        'rule' => 'notBlank',
        'message' => '名前を入力してください',
      ),
      array(
        'rule' => array('between', 4, 20),
        'message' => '名前は4文字以上20文字以内にしてください。'
      ),
    ),
    'username' => array(
      array(
        'rule' => 'notBlank',
        'message' => 'ユーザー名を入力してください',
      ),
      array(
        'rule' => 'isUnique', //重複禁止
        'message' => '既に使用されている名前です。'
      ),
      array(
        'rule' => 'alphaNumeric',
        'message' => 'ユーザー名は半角英数字にしてください。'
      ),
      array(
        'rule' => array('between', 4, 20),
        'message' => 'ユーザー名は4文字以上20文字以内にしてください。'
      ),
    ),
    'password' => array(
      array(
        'rule' => 'alphaNumeric',
        'message' => 'パスワードは半角英数字にしてください。'
      ),
      array(
        'rule' => array('between', 4, 8),
        'message' => 'パスワードは4文字以上8文字以内にしてください。'
      ),
      array(
        'rule' => 'passwordConfirm',
        'message' => 'パスワードが一致していません'
      ),
    ),
    'password_confirm' => array(
      array(
        'rule' => 'notBlank',
        'message' => 'パスワード（確認）を入力してください',
      ),
    ),
    'email' => array(
      array(
        'rule' => 'notBlank',
        'message' => 'メールアドレスを入力してください',
      ),
      array(
        'rule' => array('between', 1, 100),
        'message' => 'メールアドレスは100文字以内にしてください。'
      ),
    ),
  );

  public function passwordConfirm($check){

      //２つのパスワードフィールドが一致する事を確認する
      if($this->data['User']['password'] === $this->data['User']['password_confirm']){
          return true;
      }else{
          return false;
      }

  }

  public function beforeSave($options = array()) {
    $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
    return true;
  }

}

<?php
App::uses('AppController', 'Controller');

class DatasController extends AppController {

  public function index() {
    $this->set('message','Hello');
  }

  public function posts($name){
  // WHERE name = $name に対応
  $options = array('conditions' => array('name' => $name));
  // SELECT * FROM datas に対応
  $this->loadModel('Datas');
  $datas = $this->Datas->find('all', $options);

  $this->set('datas', $datas);
  $this->set('name', $name);
  }

}

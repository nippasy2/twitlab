<?php
App::uses('AppController', 'Controller');

class HomeController extends AppController {

  public $uses = array('Data');
  public $components = array('Price');

  public function submit() {
    $name = $this->params['data']['name'];
    $message = $this->params['data']['message'];

    $result = $this->Datas->submit($name, $message);
    if ($result) {
      $this->redirect('index');
    }

  public function index(){
    $this->set('user', $this->Auth->user());
    // SELECT * FROM datas に対応
    $this->loadModel('Datas');
    $datas = $this->Datas->find('all');

    $this->set('datas', $datas);
    }
  }
}

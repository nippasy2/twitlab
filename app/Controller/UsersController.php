<?php
//status部分の構造化をしたい

App::uses('AppController', 'Controller');

class UsersController extends AppController {

  //読み込むコンポーネントの指定
  public $components = array('Session', 'Auth');

  //どのアクションが呼ばれてもはじめに実行される関数
  public function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow('register', 'login');
  }

  //ログイン後にリダイレクトされるアクション
  public function index(){
    if($this->Auth->login()){
      $name = $this->Auth->user();
      $this->redirect(array('action' => 'home'));
    }
    else{
      $this->redirect('register');
    }
  }

  public function delete($id){
    $this->loadModel('Datas');
    debug($id);
    if($this->Datas->delete($id)){
      $this->redirect(array('action' => 'home'));
      debug($this->Datas->find('all'));
    }
  }

  public function userfollow($username){
    $tmp1 = $this->Auth->user();
    $this->loadModel('Relations');
    debug($username);
    if($this->Relations->save(array('username'=>$tmp1['username'],'follow'=>$username))){
      $this->redirect(array('action' => 'user_search2'));
    }
  }

  public function home(){
    if($this->Auth->login()){
      $this->set('user', $this->Auth->user());//Viewへuserを渡す

      $tmp1 = $this->Auth->user();

      //自分の投稿を表示
      $options = array('conditions' => array('name' =>  $tmp1['username']));
      // SELECT * FROM datas に対応
      $this->loadModel('Data');
      $mydatas = $this->Data->find('all', $options);

      //debug($mydatas);

      $this->set('mydatas', $mydatas);

      if($this->request->is('post')){
          //$this->loadModel('Data');
          //$tmp1 = $this->Auth->user();
          $tmp2 = $this->request->data;
          $this->Data->save(array('name'=>$tmp1['username'],'message'=>$tmp2));
          if($this->Data->save($this->request->data)){
            //$this->Session->setFlash('入力完了');   //成功したら入力完了と表示
            $this->redirect(array('action'=>'index'));    //続けてindexページを表示
          }
          else{
              $this->Session->setFlash('入力失敗');   //失敗したら入力失敗と表示
          }
        }

      // SELECT * FROM datas に対応
      $this->loadModel('Datas');
      $datas = $this->Datas->find('all');

      $this->set('datas', $datas);
      // debug($datas);

      $this->loadModel('Relation');
      $options = array('conditions' => array('username' =>  $tmp1['username']));
      // SELECT * FROM datas に対応
      $follows = $this->Relation->find('all', $options);
      $this->set('follows', $follows);
      $options = array('conditions' => array('follow' =>  $tmp1['username']));
      // SELECT * FROM datas に対応
      $followers = $this->Relation->find('all', $options);
      $this->set('followers', $followers);
    }else{
      $this->redirect('login');
    }
  }

  public function userpage($username){
    if($this->Auth->login()){
      $this->set('pagename', $username);
      $this->set('user', $this->Auth->user());//Viewへuserを渡す

      //自分の投稿を表示
      $options = array('conditions' => array('name' =>  $username));
      // SELECT * FROM datas に対応
      $this->loadModel('Data');
      $mydatas = $this->Data->find('all', $options);

      //debug($mydatas);

      $this->set('mydatas', $mydatas);

      if($this->request->is('post')){
          //$this->loadModel('Data');
          //$tmp1 = $this->Auth->user();
          $tmp2 = $this->request->data;
          $this->Data->save(array('name'=>$username,'message'=>$tmp2));
          if($this->Data->save($this->request->data)){
            //$this->Session->setFlash('入力完了');   //成功したら入力完了と表示
            $this->redirect(array('action'=>'index'));    //続けてindexページを表示
          }
          else{
              $this->Session->setFlash('入力失敗');   //失敗したら入力失敗と表示
          }
        }

      // SELECT * FROM datas に対応
      $this->loadModel('Datas');
      $datas = $this->Datas->find('all');

      $this->set('datas', $datas);
      // debug($datas);

      $this->loadModel('Relation');
      $options = array('conditions' => array('username' =>  $username));
      // SELECT * FROM datas に対応
      $follows = $this->Relation->find('all', $options);
      $this->set('follows', $follows);
      $options = array('conditions' => array('follow' =>  $username));
      // SELECT * FROM datas に対応
      $followers = $this->Relation->find('all', $options);
      $this->set('followers', $followers);
    }else{
      $this->redirect('login');
    }
  }

  public function register(){
  	//$this->requestにPOSTされたデータが入っている
  	//POSTメソッドかつユーザ追加が成功したら
    if($this->request->is('post') && $this->User->save($this->request->data)){
      //ログイン
      //$this->request->dataの値を使用してログインする規約になっている
      $this->Auth->login();
      $this->redirect('registered');
    }
  }

  public function registered(){
    $this->set('user', $this->Auth->user());
    $this->redirect('login');
  }

  public function user_search2(){

    $tmp1 = $this->Auth->user();
    if($this->request->is('post')){
      $tmp2 = $this->request->data;
      debug($tmp2);

      //自分を除く部分一致
      $options = array('conditions' => array('username LIKE' =>  '%' . $tmp2['searchname']. '%','username !=' => $tmp1['username']));

      $this->loadModel('Users');
      $userlists = $this->Users->find('all', $options);

      $this->set('userlists', $userlists);

      $this->loadModel('Datas');
      $newdatas = [];

      for ($count = 0; $count < count($userlists); $count++){
        $options = array('conditions' => array('name' =>  $userlists[$count]['Users']['name']));
        $newdatas[] = $this->Datas->find('first',$options);
      }

      $datas = $this->Datas->find('all');
      $this->set('newdatas', $newdatas);

    }

      $this->loadModel('Data');

      $options = array('conditions' => array('name' =>  $tmp1['username']));
      $mydatas = $this->Data->find('all', $options);
      $this->set('mydatas', $mydatas);

      $this->loadModel('Relation');
      $options = array('conditions' => array('username' =>  $tmp1['username']));
      // SELECT * FROM datas に対応
      $follows = $this->Relation->find('all', $options);
      $this->set('follows', $follows);
      $options = array('conditions' => array('follow' =>  $tmp1['username']));
      // SELECT * FROM datas に対応
      $followers = $this->Relation->find('all', $options);
      $this->set('followers', $followers);

  }

  public function user_search3(){

    $tmp1 = $this->Auth->user();
    if(empty($this->request->query('searchname'))){}else{
      $tmp2 = $this->request->query('searchname');
      //debug($tmp2);

      //自分を除く部分一致
      $options = array('conditions' => array('username LIKE' =>  '%' . $tmp2. '%','username !=' => $tmp1['username']));

      $this->loadModel('Users');
      $userlists = $this->Users->find('all', $options);

      $this->set('userlists', $userlists);

      $this->loadModel('Datas');
      $newdatas = [];

      for ($count = 0; $count < count($userlists); $count++){
        $options = array('conditions' => array('name' =>  $userlists[$count]['Users']['name']));
        $newdatas[] = $this->Datas->find('first',$options);
      }
      //debug($newdatas);

      $datas = $this->Datas->find('all');
      $this->set('newdatas', $newdatas);

      //debug($this->request->data);

      if(empty($this->request->data)){}else{
        $tmp3 = $this->request->data;
        $this->loadModel('Relations');
        //debug($tmp3);
        if($this->Relations->save(array('username'=>$tmp1['username'],'follow'=>$tmp3['followname']))){
          $this->redirect(array('action' => 'user_search3?searchname='.$tmp2));
        }
      }

    }

      $this->loadModel('Data');

      $options = array('conditions' => array('name' =>  $tmp1['username']));
      $mydatas = $this->Data->find('all', $options);
      $this->set('mydatas', $mydatas);

      $this->loadModel('Relation');
      $options = array('conditions' => array('username' =>  $tmp1['username']));
      // SELECT * FROM datas に対応
      $follows = $this->Relation->find('all', $options);

      //foreach($follows as $follow){
      //  $follows2;
      //  $follows2[] = $follow['Relation']['follow'];
      //}

      $this->set('follows', $follows);
      //debug($follows);
      //debug($follows2);



      $options = array('conditions' => array('follow' =>  $tmp1['username']));
      // SELECT * FROM datas に対応
      $followers = $this->Relation->find('all', $options);
      $this->set('followers', $followers);

  }




  public function follow($username){
    $this->set('pagename',$username);
    //$tmp1 = $this->Auth->user();
    $tmp1 = $username;
    $options = array('conditions' => array('username' =>  $tmp1));
    // SELECT * FROM datas に対応
    $this->loadModel('Relation');
    $relations = $this->Relation->find('all', $options);
    $this->set('relations', $relations);

    $options = array('conditions' => array('username' =>  $tmp1));
    // SELECT * FROM datas に対応
    $follows = $this->Relation->find('all', $options);
    $this->set('follows', $follows);

    $options = array('conditions' => array('follow' =>  $tmp1));
    // SELECT * FROM datas に対応
    $followers = $this->Relation->find('all', $options);
    $this->set('followers', $followers);

    $this->loadModel('Datas');
    $newdatas = [];

    for ($count = 0; $count < count($relations); $count++){
      $options = array('conditions' => array('name' =>  $relations[$count]['Relation']['follow']));
      $newdatas[] = $this->Datas->find('first',$options);
    }

    $datas = $this->Datas->find('all');
    $this->set('newdatas', $newdatas);
    // debug($datas);

    $options = array('conditions' => array('name' =>  $tmp1));
    $mydatas = $this->Datas->find('all',$options);
    $this->set('mydatas', $mydatas);
  }

  public function follower($username){
    $this->set('pagename',$username);
    //$tmp1 = $this->Auth->user();
    $tmp1 = $username;
    $options = array('conditions' => array('follow' =>  $tmp1));
    // SELECT * FROM datas に対応
    $this->loadModel('Relation');
    $relations = $this->Relation->find('all', $options);
    $this->set('relations', $relations);

    $options = array('conditions' => array('username' =>  $tmp1));
    // SELECT * FROM datas に対応
    $follows = $this->Relation->find('all', $options);
    $this->set('follows', $follows);

    $options = array('conditions' => array('follow' =>  $tmp1));
    // SELECT * FROM datas に対応
    $followers = $this->Relation->find('all', $options);
    $this->set('followers', $followers);

    $this->loadModel('Datas');
    $newdatas = [];

    for ($count = 0; $count < count($relations); $count++){
      $options = array('conditions' => array('name' =>  $relations[$count]['Relation']['username']));
      $newdatas[] = $this->Datas->find('first',$options);
    }

    $datas = $this->Datas->find('all');
    $this->set('newdatas', $newdatas);
    // debug($datas);

    $options = array('conditions' => array('name' =>  $tmp1));
    $mydatas = $this->Datas->find('all',$options);
    $this->set('mydatas', $mydatas);
  }

  public function tweet($username){
    $this->set('pagename',$username);

    if($this->Auth->login()){
      $this->set('user', $this->Auth->user());//Viewへuserを渡す

      //$tmp1 = $this->Auth->user();
      $tmp1 = $username;

      //自分の投稿を表示
      $options = array('conditions' => array('name' =>  $tmp1));
      // SELECT * FROM datas に対応
      $this->loadModel('Data');
      $mydatas = $this->Data->find('all', $options);

      //debug($mydatas);

      $this->set('mydatas', $mydatas);

      if($this->request->is('post')){
          //$this->loadModel('Data');
          //$tmp1 = $this->Auth->user();
          $tmp2 = $this->request->data;
          $this->Data->save(array('name'=>$tmp1,'message'=>$tmp2));
          if($this->Data->save($this->request->data)){
            //$this->Session->setFlash('入力完了');   //成功したら入力完了と表示
            $this->redirect(array('action'=>'index'));    //続けてindexページを表示
          }
          else{
              $this->Session->setFlash('入力失敗');   //失敗したら入力失敗と表示
          }
        }

      // SELECT * FROM datas に対応
      $this->loadModel('Datas');
      $datas = $this->Datas->find('all');

      $this->set('datas', $datas);
      // debug($datas);

      $this->loadModel('Relation');
      $options = array('conditions' => array('username' =>  $tmp1));
      // SELECT * FROM datas に対応
      $follows = $this->Relation->find('all', $options);
      $this->set('follows', $follows);
      $options = array('conditions' => array('follow' =>  $tmp1));
      // SELECT * FROM datas に対応
      $followers = $this->Relation->find('all', $options);
      $this->set('followers', $followers);
    }else{
      $this->redirect('login');
    }
  }

  public function login(){
    if($this->request->is('post')) {
      if($this->Auth->login())
        return $this->redirect('index');
      else
        $this->Session->setFlash('ログイン失敗');
    }
  }

  public function logout(){
    $this->Auth->logout();
    $this->redirect('login');
  }

}

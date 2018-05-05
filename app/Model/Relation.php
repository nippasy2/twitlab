<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class Relation extends AppModel {
  var $useTable = 'relations';
}

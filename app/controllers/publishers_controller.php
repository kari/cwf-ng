<?php

class PublishersController extends AppController {
	var $name = 'Publishers';
  var $scaffold;

  function view($id = null) {
    $this->set('publisher', $this->Publisher->read('',$id));
  }
  
}
?>
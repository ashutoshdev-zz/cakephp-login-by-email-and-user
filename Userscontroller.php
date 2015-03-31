<?php
/* Cakephp 2
 * Login with email or username
 * Link: http://www.netboy.pl/2011/08/cakephp-auth-component-login-with-username-or-e-mail/#comment-9560
 */

public function login() {
  if($this->request->is('post')) {
    App::Import('Utility', 'Validation');
    if( isset($this->data['User']['username']) && 
	Validation::email($this->data['User']['username'])) {
      $this->request->data['User']['email'] = $this->data['User']['username'];
      $this->Auth->authenticate['Form'] = array('fields' =>
						array('username' => 'email'));
    }
    if(!$this->Auth->login()) {
      $this->Session->setFlash(__('Invalid username or password, try again'));
    } else {
      $this->redirect($this->Auth->redirect());
    }
  }
}
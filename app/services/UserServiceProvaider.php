<?php

namespace Services;

class UserServiceProvider extends APIServiceProvider {

    
  public function register()
  {
      $app = $this->app;
       $this->app->bind('user_provaider', function () use ($app) {
            return new UserServiceProvider($app);
        });
  }
  
  
  /**
   * appeal to the api to check the user is logged
   * 
   * @return boolean
   * @throws \Exception
   */
  public function islogged(){
      $userin = $this->_makeAPIRequest(\Config::get('usercurl.islogged'), "POST", $this->getCookieHash());
        if ($userin['data']->success) { 
            return true;
        } else {
            throw new \Exception('You mast authorisation');
        }
  }
  
  
  /**
   * method to exit the user accesses the api
   * 
   * @return boolean
   * @throws \Exception
   */
  public function logout(){
      $data = $this->_makeAPIRequest(\Config::get('usercurl.logout'), "POST", $this->getCookieHash());
      if($data['success']){
          return true;
      } else {
           throw new \Exception('Some log out problem :(!');
      }
  }
  
  /**
   * Method produces a registered user and 
   * notifies the appropriate registration status
   * 
   * @param array $data
   * @return array
   * @throws \Exception
   */
  public function registration($data){
      $result = $this->_makeAPIRequest(\Config::get('usercurl.registration'), "POST", $data);
      if ($result['success']) {
            return $result['data'];
        } else {
            throw new \Exception('Some problem');
        }
  }
  
  
  /**
   * appeal to the api for user logon
   * 
   * @param array $data
   * @return array
   * @throws \Exception
   */
  public function login($data){
            $result = $this->_makeAPIRequest(\Config::get('usercurl.login'), "POST", $data);
      if ($result['success']) {
            return $result['data'];
        } else {
            throw new \Exception('Some problem');
        }
  }
 
}

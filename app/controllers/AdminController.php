<?php

class AdminController extends BaseController {

    public function __construct() {
        $url = Request::url();
        try {
            App::make('user_provaider')->islogged();
            if ($this->walking(Route::currentRouteName())) {
                $this->beforeFilter(function() {
                    return App::abort(403);
                });
            }
        } catch (\Exception $e) {
            $this->beforeFilter(function() use ($url) {
                $return_url = array(
                    'url' => $url,
                );
                return Redirect::route('login', $return_url);
            });
        }
    }
    
    /**
     * This method get user role and if user have several role 
     * then method contact the following method to connect these roles
     * 
     * @return boolean or array
     */
    protected function roles() {
        try {
            $roles = App::make('user_provaider')->roles();

            if (count($roles) > 1) {
                return $this->comparisonArray($roles);
            } else {
                return $userrole[$roles[0]];
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * This method return true or false if user do not have
     * permission goin this url
     * 
     * @param String $realurl
     * @return boolean
     */
    protected function walking($realurl) {
        $flag = true;
        $roles = $this->roles();
        foreach ($roles as $role) {
            if ($role == $realurl) {
                $flag = false;
            }
        }
        return $flag;
    }
    
    /**
     * This method get user role and return real user role if 
     * this user have several role
     * 
     * @param array $roles
     * @return array
     */
    protected function comparisonArray($roles) {
        $userrole = array(
            'admin' => Config::get('userrole.admin'),
            'manager' => Config::get('userrole.manager'),
            'editor' => Config::get('userrole.editor'),
            'editor1' => Config::get('userrole.editor'),
            'editor2' => Config::get('userrole.editor'),
        );
        foreach ($roles as $role) {
            $userroles[] = $userrole[$role];
        }
        foreach ($userroles as $comparis) {
            foreach ($comparis as $compar) {
                $result[] = $compar;
            }
        }
        return array_unique($result);
    }
}

<?php

class AdminController extends BaseController {

    public function __construct() {
        $url = Request::url();
        try {
            App::make('user_provaider')->islogged();
            if ($this->walking(Route::currentRouteName())) {
                $this->beforeFilter(function() {
                    //return Redirect::to(URL::previous());
                    return Redirect::route('home');
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

    protected function roles() {
        $userrole = array(
            'admin' => Config::get('userrole.admin'),
            'manager' => Config::get('userrole.manager'),
            'editor' => Config::get('userrole.editor'),
        );
        try {

            $roles = App::make('user_provaider')->roles();

            if (count($roles) > 1) {
                foreach ($roles as $role) {
                    $userroles[] = $userrole[$role];
                }
                $max = 0;
                foreach ($userroles as $role) {
                    if ($max <= count($role)) {
                        $max = count($role);
                        $rerurn_route = $role;
                    }
                }
                return $rerurn_route;
            } else {
                return $userrole[$roles[0]];
            }
        } catch (\Exception $e) {
            return false;
        }
    }

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

}

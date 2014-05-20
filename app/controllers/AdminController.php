<?php

class AdminController extends BaseController {

    public function __construct() {
        try {
            App::make('user_provaider')->islogged();
        } catch (\Exception $e) {
            $url = Request::url();
            if (URL::route('login') != $url && URL::route('registration') != $url) {
                $this->beforeFilter(function() {
                    return Redirect::route('login');
                });
            }
        }
    }

}

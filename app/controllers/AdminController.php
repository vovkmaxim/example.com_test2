<?php

class AdminController extends BaseController {

    public function __construct() {
        try {
            App::make('user_provaider')->islogged();
        } catch (\Exception $e) {
            $url = Request::url();
            if ('http://example.com/api-login' != $url && 'http://example.com/api-registration' != $url) {
                $this->beforeFilter(function() {
                    return Redirect::route('login');
                });
            }
        }
    }

}

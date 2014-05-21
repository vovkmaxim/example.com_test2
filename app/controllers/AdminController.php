<?php

class AdminController extends BaseController {

    public function __construct() {
        try {
            App::make('user_provaider')->islogged();
        } catch (\Exception $e) {
            $url = Request::url();
                $this->beforeFilter(function() use ($url){
                    $return_url = array(
                        'url' => $url,
                    );
                    return Redirect::route('login',$return_url);
                });
        }
    }

}

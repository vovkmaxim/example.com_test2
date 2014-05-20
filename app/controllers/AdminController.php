<?php

class AdminController extends BaseController {

	public function __construct() {
            try {
                App::make('user_provaider')->islogged();
            } catch (\Exception $e) {
                $news = array(
                    "error" => $e->getMessage()
                );
                return View::make('getErrorApi', $news);
            }
        }

}
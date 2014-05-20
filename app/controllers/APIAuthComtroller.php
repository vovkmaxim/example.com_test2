<?php

class APIAuthComtroller extends AdminController {

    /**
     * This method show displey log ih form
     * 
     * @return \Illuminate\View\View
     */
    public function apiloginForm() {
        $returnurl = array(
            'url' => URL::previous()
        );
        return View::make('apiloginForm',$returnurl);
    }

    /**
     * This method show displey log ih form
     * 
     * @return \Illuminate\View\View
     */
    public function apiregistrationForm() {
        return View::make('apiregistrationForm');
    }

    public function logout() {

        try {
            if (App::make('user_provaider')->logout()) {
                Cookie::queue('userHASH', NULL);
                Cookie::queue('userID', NULL);
                return Redirect::to('api-login');
            }
        } catch (\Exception $e) {
            $error = array(
                "error" => $e->getMessage()
            );
            return Redirect::to('api-login')->withErrors($error);
        }
    }

    /**
     * Method produces a registered user and 
     * notifies the appropriate registration status
     * 
     * @return \Illuminate\View\View
     */
    public function registration() {
        $password = Input::get('password');
        $username = Input::get('username');
        $email = Input::get('email');
        $validator = Validator::make(
                        array(
                    'password' => $password,
                    'username' => $username,
                    'email' => $email,
                        ), array(
                    'email' => 'required|email',
                    'password' => 'required|alphaNum|min:3',
                    'username' => 'required'
                        )
        );

        if ($validator->fails()) {
            return Redirect::to('api-registration')
                            ->withErrors($validator);
        } else {
            $data = array(
                "password" => $password,
                "username" => $username,
                "email" => $email
            );
            try {
                $result = App::make('user_provaider')->registration($data);

                if ($result->success) {
                    return Redirect::to('api-login');
                } else {
                    $error = array(
                        'error' => $result->message
                    );
                    return Redirect::to('api-registration')
                                    ->withErrors($error);
                }
            } catch (\Exception $e) {
                $error = array(
                    "error" => $e->getMessage()
                );
                return Redirect::to('api-registration')
                                ->withErrors($error);
            }
        }
    }

    /**
     * Method coupled with api sending login and password 
     * received by post to verify the existence Users
     * 
     * @return \Illuminate\View\View return result log in users in system
     */
    public function login() {
        $password = Input::get('password');
        $username = Input::get('username');
        $redirect = Input::get('redirect');
        $remember = Input::get('remember-me');
        $validator = Validator::make(
                        array(
                    'password' => $password,
                    'username' => $username,
                        ), array(
                    'password' => 'required',
                    'username' => 'required'
                        )
        );
        if ($validator->fails()) {
            return Redirect::to('api-login')
                            ->withErrors($validator);
        } else {

            $data = array(
                'username' => $username,
                'password' => $password
            );

            try {
                $result = App::make('user_provaider')->login($data);

                if ($result->success) {
                    if ($remember) {
                        Cookie::forever('userHASH', $result->hash);
                        Cookie::forever('userID', $result->id);
                        return Redirect::to($redirect);                       
                    } else {
                        Cookie::queue('userHASH', $result->hash, 10, '/');
                        Cookie::queue('userID', $result->id, 10, '/');
                        return Redirect::to($redirect); 
                    }
                } else {
                    $error = array(
                        'error' => 'Some problem!'
                    );
                    return Redirect::to('api-login')
                                    ->withErrors($error);
                }
            } catch (\Exception $e) {
                $error = array(
                    "error" => $e->getMessage()
                );
                return Redirect::to('api-login')
                                ->withErrors($error);
            }
        }
    }

    

}

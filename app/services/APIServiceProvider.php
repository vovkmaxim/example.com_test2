<?php

namespace Services;

use Illuminate\Support\ServiceProvider;

class APIServiceProvider extends ServiceProvider {

    public function register() {
        $app = $this->app;
        $this->app->bind('api_provaider', function () use ($app) {
            return new APIServiceProvider($app);
        });
    }

    /**
     * This method returns the $hash and $id value  of the Cookie
     * 
     * @return int
     */
    protected function getCookieHash() {

        $hash = \Cookie::get('userHASH');
        $id = \Cookie::get('userID');
        if (empty($hash)) {
            $hash = 0;
        }
        if (empty($id)) {
            $id = 0;
        }
        $userdata = array(
            'hash' => $hash,
            'id' => $id
        );

        return $userdata;
    }

    /**
     * 
     * This method to access the api for return specific information
     * 
     * @param string $url resource circulation
     * @param string $method set the method of transmission POST or GET
     * @param array $data an array of parameters to pass to API 
     * @return array result array from request to API   
     * 
     *      
     */
    protected function _makeAPIRequest($url, $method, $data = NULL) {

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($method == "POST") {
            $data_string = json_encode($data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
            );
        }
        $curl_exec = curl_exec($ch);
        if ($curl_exec === false) {
            $result = array(
                'success' => false,
                'message' => curl_error($ch)
            );
        } else {
            $json_decode = json_decode($curl_exec);
            switch (json_last_error()) {
                case JSON_ERROR_NONE:
                    $result = array(
                        'success' => true,
                        'data' => $json_decode
                    );
                    break;
                case JSON_ERROR_DEPTH:
                    $result = array(
                        'success' => false,
                        'message' => 'Достигнута максимальная глубина стека'
                    );
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    $result = array(
                        'success' => false,
                        'message' => 'Некорректные разряды или не совпадение режимов'
                    );
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    $result = array(
                        'success' => false,
                        'message' => 'Некорректный управляющий символ'
                    );
                    break;
                case JSON_ERROR_SYNTAX:
                    $result = array(
                        'success' => false,
                        'message' => 'Синтаксическая ошибка, не корректный JSON'
                    );
                    break;
                case JSON_ERROR_UTF8:
                    $result = array(
                        'success' => false,
                        'message' => 'Некорректные символы UTF-8, возможно неверная кодировка'
                    );
                    break;
                default:
                    $result = array(
                        'success' => false,
                        'message' => 'Неизвестная ошибка'
                    );
                    break;
            }
        }
        curl_close($ch);
        return $result;
    }

}

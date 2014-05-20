<?php

namespace Services;

class NewsServiceProvider extends APIServiceProvider {

    public function register() {
        $app = $this->app;
        $this->app->bind('news_provaider', function () use ($app) {
            return new NewsServiceProvider($app);
        });
    }

    /**
     * appeal to the api to get all the news
     * 
     * @return type
     * @throws \Exception
     */
    public function allnews() {

        $data = $this->_makeAPIRequest(\Config::get('curl.allnews'), "GET");
        if ($data['success']) {
            return $data['data'];
        } else {
            throw new \Exception($data['message']);
        }
    }

    /**
     * appeal to the api to get one news
     * 
     * @param int $news_id
     * @return int
     * @throws \Exception
     */
    public function onenews($news_id) {
        $url = \Config::get('curl.onenews') . $news_id;
        $data = $this->_makeAPIRequest($url, "GET");
        if ($data['success']) {
            return $data['data'];
        } else {
            throw new \Exception($data['message']);
        }
    }

    /**
     * appeal to the api to change news
     * 
     * @param array $data
     * @param int $news_id
     * @return array
     * @throws \Exception
     */
    public function changenews($data, $news_id) {
        $url = \Config::get('curl.change') . $news_id;
        $result = $this->_makeAPIRequest($url, "POST", $data);
        if ($result['success']) {
            return $result['data'];
        } else {
            throw new \Exception($result['message']);
        }
    }

    /**
     * appeal to the api to remove news
     * 
     * @param int $news_id
     * @return array
     * @throws \Exception
     */
    public function delete($news_id) {
        $url = \Config::get('curl.delete') . $news_id;
        $data = $this->_makeAPIRequest($url, "DELETE");
        if ($data['success']) {
            return $data['data'];
        } else {
            throw new \Exception($data['message']);
        }
    }

    /**
     * appeal to the api to create a new news
     * 
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function createnews($data) {
        $result = $this->_makeAPIRequest(\Config::get('curl.create'), "POST", $data);
        if ($result['success']) {
            return $result['data'];
        } else {
            throw new \Exception($result['message']);
        }
    }

    /**
     * appeal to the api to search for news
     * by coincidence text title and description
     * 
     * @param String $text
     * @return array
     * @throws \Exception
     */
    public function searchtextnews($text) {
        $data = $this->_makeAPIRequest(\Config::get('curl.search') . $text, "GET");
        if ($data['success']) {
            return $data['data'];
        } else {
            throw new \Exception($data['message']);
        }
    }

    /**
     * appeal to the api for news and reviews coincidentally tagged
     * 
     * @param String $tag
     * @return array
     * @throws \Exception
     */
    public function searchtagnews($tag) {
        $data = $this->_makeAPIRequest(\Config::get('curl.tagsearch') . $tag, "GET");
        if ($data['success']) {
            return $data['data'];
        } else {
            throw new \Exception($data['message']);
        }
    }

}

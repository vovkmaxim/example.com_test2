<?php

class NewsController extends AdminController {

    
    /**
     * Method is used to display all the news
     * 
     * @return \Illuminate\View\View 
     * returns a list of news or reference error api
     */
    public function showAllNews() {

        try {
            
//            if (App::make('user_provaider')->islogged()) {
                $news = array(
                    'news' => App::make('news_provaider')->allnews()
                );
                return View::make('APIallNews', $news);
//            }
                
        } catch (\Exception $e) {
            $news = array(
                "error" => $e->getMessage()
            );
            return View::make('getErrorApi', $news);
        }
    }

    /**
     * This method show displey one news
     * 
     * @param Integer $id  it ID displays news
     * @return \Illuminate\View\View 
     */
    public function displayOneNews($news_id) {

        try {
            //if (App::make('user_provaider')->islogged()) {

                $data = App::make('news_provaider')->onenews($news_id);

                foreach ($data as $value) {
                    $news = array(
                        "id" => $value->id,
                        "title" => $value->title,
                        "description" => $value->description,
                        "author" => $value->author,
                    );
                }
                return View::make('getOneAPINews', $news);
            //}
        } catch (\Exception $e) {
            $news = array(
                "error" => $e->getMessage()
            );
            return View::make('getErrorApi', $news);
        }
    }

    /**
     * This method allows you to view news for changes
     * 
     * @param Object $news
     * @return \Illuminate\View\View
     */
    public function getChangeNewsForm($news_id) {

        try {
            if (App::make('user_provaider')->islogged()) {
                $data = App::make('news_provaider')->onenews($news_id);
                foreach ($data as $value) {
                    $news = array(
                        "id" => $value->id,
                        "title" => $value->title,
                        "description" => $value->description,
                        "author" => $value->author,
                    );
                }
                return View::make('APIchangeNews', $news);
            }
        } catch (\Exception $e) {
            $news = array(
                "error" => $e->getMessage()
            );
            return View::make('APIchangeNews', $news);
        }
    }

    /**
     * This method saves the news on its id and returns the result display (error or success)
     * 
     * @param Integer $id is id the news you want to save changes
     * @return \Illuminate\View\View 
     */
    public function savingChangesNews($id) {
        //return $id->id;
        $title = Input::get('title');
        $author = Input::get('author');
        $description = Input::get('description');

        $validator = Validator::make(
                        array(
                    'title' => $title,
                    'author' => $author,
                    'description' => $description
                        ), array(
                    'title' => 'required',
                    'author' => 'required',
                    'description' => 'required'
                        )
        );
        if ($validator->fails()) {
            $url = 'change-news-api/' . $id;
            return Redirect::to($url)->withErrors($validator);
        } else {

            try {
                if (App::make('user_provaider')->islogged()) {
                    $data = array(
                        "title" => $title,
                        "author" => $author,
                        "description" => $description
                    );
                    $result = App::make('news_provaider')->changenews($data, $id);
                    foreach ($result as $value) {
                        $success = $value->success;
                        $message = $value->message;
                    }
                    $date = array(
                        "error" => $message
                    );
                    $url = 'api-change-news/' . $id;
                    return Redirect::to($url)->withErrors($date);
                }
            } catch (\Exception $e) {
                $date = array(
                    "error" => $e->getMessage()
                );
                $url = 'api-change-news/' . $id;
                return Redirect::to($url)->withErrors($date);
            }
        }
    }

    /**
     * This method is intended to remove the news.
     * Input parameter has ID, news and method returns the
     * result of successful or not successful removal news
     * 
     * @param Integer $id ID removable news
     * @return \Illuminate\View\View  returns the result of the removal news
     */
    public function removalNews($news_id) {

        try {
            if (App::make('user_provaider')->islogged()) {
                $result = App::make('news_provaider')->delete($news_id);
                foreach ($result as $value) {
                    $news = array(
                        "success" => $value->success,
                        "message" => $value->message,
                    );
                }
                return View::make('getResultDelete', $news);
            }
        } catch (\Exception $e) {
            $news = array(
                "success" => false,
                "message" => $e->getMessage(),
            );
            return View::make('getResultDelete', $news);
        }
    }

    /**
     * Method show create news form
     * 
     * 
     * @return \Illuminate\View\View
     */
    public function createNewsForm() {
        return View::make('APIcreateNewsForm');
    }

    /**
     * method of adding news api if successful news is added, otherwise it returns the error display
     * 
     * @return \Illuminate\View\View 
     */
    public function addingCreatedNews() {
        $title = Input::get('title');
        $author = Input::get('author');
        $description = Input::get('description');

        $validator = Validator::make(
                        array(
                    'title' => $title,
                    'author' => $author,
                    'description' => $description
                        ), array(
                    'title' => 'required',
                    'author' => 'required',
                    'description' => 'required'
                        )
        );
        if ($validator->fails()) {
            return Redirect::to('api-create-news')->withErrors($validator);
        } else {
            try {
                if (App::make('user_provaider')->islogged()) {

                    $data = array(
                        "title" => $title,
                        "author" => $author,
                        "description" => $description
                    );

                    $result = App::make('news_provaider')->createnews($data);
                    foreach ($result as $value) {
                        $success = $value->success;
                        $message = $value->message;
                    }

                    $data = array(
                        'error' => $message
                    );
                    return Redirect::to('api-create-news')->withErrors($data);
                }
            } catch (\Exception $e) {
                $data = array(
                    "error" => $e->getMessage()
                );
                return Redirect::to('api-create-news')->withErrors($data);
            }
        }
    }

    /**
     * method is intended for display on a form 
     * to search for news on the text in the 
     * title and description
     * 
     * @return \Illuminate\View\View 
     */
    public function formSearchNews() {
        return View::make('APIsearchNews');
    }

    /**
     * method is intended for display on a form 
     * to search for news and reviews on the tag  
     * 
     * 
     * @return \Illuminate\View\View 
     */
    public function formTagSearchNews() {
        return View::make('APItagSearchNews');
    }

    /**
     * This method displays the search result in the
     *  title and text descriptions of news
     * 
     * @return \Illuminate\View\View
     */
    public function showSerchNews() {

        $text_search = Input::get('text_search');
        $validator = Validator::make(
                        array(
                    'text_search' => $text_search
                        ), array(
                    'text_search' => 'required'
                        )
        );

        if ($validator->fails()) {
            return Redirect::to('api-search-news')->withErrors($validator);
        } else {

            try {
                if (App::make('user_provaider')->islogged()) {

                    $result = App::make('news_provaider')->searchtextnews($text_search);
                    foreach ($result as $data_value) {
                        if ($data_value->success) {
                            $news = array(
                                "success" => true,
                                "news" => $data_value->data
                            );
                            return View::make('getShowSearchAPINews', $news);
                        } else {
                            $news = array(
                                "success" => false,
                                "message" => $data_value->message
                            );
                            return View::make('getShowSearchAPINews', $news);
                        }
                    }
                }
            } catch (\Exception $e) {
                $date = array(
                    "error" => $e->getMessage()
                );
                return View::make('getErrorApi', $date);
            }
        }
    }

    /**
     * This method displays the search results news and reviews by tag
     * 
     * 
     * @return \Illuminate\View\View
     */
    public function showTagSerchNews() {
        $tag = Input::get('tag');
        $validator = Validator::make(
                        array(
                    'tag' => $tag
                        ), array(
                    'tag' => 'required'
                        )
        );

        if ($validator->fails()) {
            return Redirect::to('api-tag-search-news')->withErrors($validator);
        } else {

            try {
                if (App::make('user_provaider')->islogged()) {

                    $result = App::make('news_provaider')->searchtagnews($tag);
                    $dates = array();
                    foreach ($result as $data1) {
                        $success = $data1->success;
                        if ($success && !empty($success)) {
                            $news;
                            $review;
                            if (isset($data1->news)) {
                                $news = $data1->news;
                            }
                            if (isset($data1->review)) {
                                $review = $data1->review;
                            }
                            if (!empty($news) && !empty($review)) {
                                $dates = array(
                                    "success" => true,
                                    "success_news" => true,
                                    "success_review" => true,
                                    "news" => $news,
                                    "review" => $review
                                );
                            }
                            if (empty($news) && !empty($review)) {
                                $dates = array(
                                    "success" => true,
                                    "success_news" => false,
                                    "success_review" => true,
                                    "review" => $review
                                );
                            }
                            if (!empty($news) && empty($review)) {
                                $dates = array(
                                    "success" => true,
                                    "success_news" => true,
                                    "success_review" => false,
                                    "news" => $news
                                );
                            }
                            return View::make('getShowSearchAPINewsAndReview', $dates);
                        } else {
                            $dates = array(
                                "error" => "You request no return result"
                            );
                            return Redirect::to('api-tag-search-news')->withErrors($dates);
                        }
                    }
                }
            } catch (\Exception $e) {
                $date = array(
                    "error" => $e->getMessage()
                );
                return Redirect::to('api-tag-search-news')->withErrors($date);
            }
        }
    }

}

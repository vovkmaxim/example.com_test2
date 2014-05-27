<?php

class MailController extends BaseController {

    public static function sendMailForm() {
        return View::make('sender');
    }

    public static function sendMail() {

        $file = Input::file('file');
        $subject = Input::get('subject');
        $email = Input::get('email');
        $message = Input::get('message');

        $validator = Validator::make(
                        array(
                    'subject' => $subject,
                    'email' => $email,
                    'message' => $message,
                        ), array(
                    'subject' => 'required',
                    'email' => 'required|email',
                    'message' => 'required',
                        )
        );
        if ($validator->fails()) {
            return Redirect::to("send-mail")->withErrors($validator);
        } else {

            $tmpl = array(
                'subject' => $subject,
                'email' => $email,
                'text' => $message,
            );

            $data = array(
                'subject1' => $subject,
            );

            Mail::send('emails.emails', $tmpl, function($message) use ($data, $file) {
                $message->from('mvovk90@gmail.com', 'Site TEST1.COM');
                $message->to('mvovk90@mail.ru', 'MAXIM')->subject($data['subject1']);
                $message->attach($file->getRealPath(), array('as' => $file->getClientOriginalName(), 'mime' => $file->getMimeType()));
            });

            $data = array(
                'error' => 'Your message sends success',
            );

            return Redirect::to("send-mail")->withErrors($data);
        }
    }

}

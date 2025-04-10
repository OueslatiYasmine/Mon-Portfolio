<?php

class PHP_Email_Form {
    public $ajax = false;
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    private $messages = array();

    public function add_message($value, $label, $length = 0) {
        $this->messages[] = array(
            'value' => strip_tags($value),
            'label' => $label,
            'length' => $length
        );
    }

    public function send() {
        $headers = 'From: ' . $this->from_name . ' <' . $this->from_email . '>' . "\r\n";
        $headers .= 'Reply-To: ' . $this->from_email . "\r\n";
        $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";

        $message = "";
        foreach($this->messages as $msg) {
            $message .= $msg['label'] . ": " . $msg['value'] . "\n";
        }

        if(mail($this->to, $this->subject, $message, $headers)) {
            return 'OK';
        } else {
            return 'Something went wrong. Please try again later.';
        }
    }
} 
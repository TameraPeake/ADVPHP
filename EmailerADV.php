<?php

class Emailer {

  private $message = "";
  private $senderEmail ="pet2433@tamerapeake.com";
  private $recipientEmail ="peaket91@gmail.com";
  private $subject ="";

   public function __construct() { }

      public function set_message($inVal) {
        $this->message = $inVal;
      }

      public function set_senderEmail($inVal) {
        $this->senderEmail = $inVal;
      }

      public function set_recipientEmail($inVal) {
        $this->recipientEmail = $inVal;
      }

      public function set_subject($inVal) {
        $this->subject = $inVal;
      }

      public function get_message() {
        return $this->message;
      }

      public function get_senderEmail() {
        return $this->senderEmail;
      }

      public function get_recipientEmail() {
        return $this->message;
      }

      public function get_subject() {
        return $this->subject;
      }

    public function sendEmail() {

      $to = $this->get_senderEmail();
      $subject =$this->get_subject();
      $message =$this->get_message();
      $headers="From: <pet2433@tamerapeake.com>";


      return mail($to,$subject,$message,$headers); 
    }
}




?>

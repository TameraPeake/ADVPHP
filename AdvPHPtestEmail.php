<?php

  $inFirstName="";
  $inLastName="";
  $inDOB="";
  $inContactEmail="";
  $inMess="";

  $validForm= true;

/*Error messages*/

  $errFirstName = "";
  $errLastName = "";
  $errDOB= "";
  $errContactEmail="";
  $errMess="";

/*Email variables*/
  $finalFirstName="";
  $finalLastName="";
  $finalDOB="";
  $finalEmail="";
  $finalMess="";

  if (isset($_POST['contactSubmit'])){
    $inFirstName=$_POST['firstName'];
    $inLastName=$_POST['lastName'];
    $inDOB=$_POST['DOB'];
    $inContactEmail=$_POST['contactEmail'];
    $inMess=$_POST['message'];

    function validateFirstName($inFirstName){
      global $validForm, $errFirstName, $finalFirstName;
      $errFirstName="";
      $finalFirstName="";
      if($inFirstName==""){
        $validForm= false;
        $errFirstName = "Please enter your first name";
      }
      /*
      else if($inFirstName !== htmlspecialchars($inFirstName) {
        $validForm= false;
        $errFirstName="Please only use letters. numbers or special characters aren't allowed (unless you're Elon Musk's son)";
      }*/
      else {
        $finalFirstName= $inFirstName;
        echo $finalFirstName. " ";
      }
    }

    function validateLastName($inLastName){
      global $validForm, $errLastName, $finalLastName;
      $errLastName="";
      $finalLastName="";

      if(empty($inLastName)){
        $validForm= false;
        $errLastName = "Please enter your last name";
      }
      /*
      elseif($inLastName !== htmlspecialchars($inLastName) {
        $validForm=false;
        $errLastName="Please only use letters; numbers or special characters aren't allowed (unless you're Elon Musk's son)"
      }*/
      else {
        $finalLastName=$inLastName;
        echo $finalLastName."<br>";
      }
    }

    function validateDOB($inDOB){
      global $validForm, $errDOB, $finalDOB;
      $errDOB = "";
      $finalDOB="";

      if(empty($inDOB)){
        $validForm=false;
        $errDOB = "Please enter your date of birth in a MMDDYYYY format";
      }
      else {
        if (filter_var($inDOB, FILTER_VALIDATE_INT))  {
          $finalDOB = $inDOB;
          echo $finalDOB."<br>";
        }
        else {
          $validForm=false;
          $errDOB="Please enter your date of birth in a MMDDYYYY format. Do not add any special characters or letters <br>
            Also! If your birthday month starts with a 0, then just leave it out, writing it as MDDYYY";
        }
      }
    }

    function validateEmail($inContactEmail){
      global $validForm, $errContactEmail, $finalEmail;
      $errContactEmail="";
      $finalEmail = "";

      if(empty($inContactEmail)){
        $validForm=false;
        $errContactEmail="Please enter a contact email";
      }
      else {
        $email = filter_var($inContactEmail, FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $finalEmail = $email;
          echo $finalEmail."<br>";
        }
        else {
          $validForm=false;
          $errContactEmail="Please enter a contact email follwing the email@email.com format";
        }
      }
    }

    function validateMessage($inMess){
      global $validForm, $errMess, $finalMess;
      $errMess="";
      $finalMess="";

      if(empty($inMess)){
        $validForm=false;
        $errMess="Please include a message";
      }
      else {
        $finalMess= $inMess;
        echo $finalMess."<br>";
      }
    }

    validateFirstName($inFirstName);
    validateLastName($inLastName);
    validateEmail($inContactEmail);
    validateDOB($inDOB);
    validateMessage($inMess);

  /*Email section*/

    if($validForm==true){
      $emailTest = new Emailer();
      $emailTest->set_senderEmail("pet2433@tamerapeake.com");
      $emailTest->set_message($finalMess);
      $emailTest->set_recipientEmail($finalEmail);
      $emailTest->set_subject("here's your name: ".$finalFirstName." ".$finalLastName." and Date of birth: ".$finalDOB);

    /*Emailer Class*/

    /*  class Emailer {
   private $message = $finalMess;
        private $senderEmail ="pet2433@tamerapeake.com";
        private $recipientEmail =$finalEmail;
        private $subject ="here's your name: ".$finalFirstName." ".$finalLastName." and Date of birth: ".$finalDOB;*/

         function __construct() { }

            function set_message($inVal) {

             $this->message = $inVal;
           }

           function set_senderEmail($inVal) {
             $this->senderEmail = $inVal;
           }

           function set_recipientEmail($inVal) {
             $this->recipientEmail = $inVal;
           }

            function set_subject($inVal) {
             $this->subject = $inVal;
           }

            function get_message() {
             return $this->message;
           }

           function get_senderEmail() {
             return $this->senderEmail;
           }

            function get_recipientEmail() {
             return $this->message;
           }

           function get_subject() {
             return $this->subject;
           }

          function sendEmail() {

           $to = $this->get_senderEmail();
           $subject =$this->get_subject();
           $message =$this->get_message();
           $headers="From: <pet2433@tamerapeake.com>";


           return mail($to,$subject,$message,$headers);
      /*   }*/
      }
    }
    else {
      echo "form is invalid. Something isn't working";
    }
  }
  else {
  }
?>
<!doctype HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Advanced PHP:Test Email</title>
</head>
<body>
  <section id="contactUsForm">
    <form id="contactForm" name="contactForm" method="post" action="AdvPHPtestEmail.php" >
      <p>Please enter your first name:
        <input type="text" name="firstName" id="firstName" value="<?php echo("$inFirstName"); ?>"/><span class="error"><?php echo("$errFirstName");?></span>
      </p>
      <p>Please enter your last name:
        <input type="text" name="lastName" id="lastName" value="<?php echo("$inLastName"); ?>"/><span class="error"><?php echo("$errLastName");?></span>
      </p>
      <p>Please enter your DOB:
          <input type="text" name="DOB" id="DOB" value="<?php echo("$inDOB"); ?>"/><span class="error"><?php echo("$errDOB");?></span>
      </p>
      <p>Please enter your email:
          <input type="email" name="contactEmail" id="contactEmail" value="<?php echo("$inContactEmail"); ?>"/><span class="error"><?php echo("$errContactEmail");?></span>
      </p>
      <p>Please enter message:
        <input type="text" name="message" id="message" value="<?php echo("$inMess"); ?>"/><span class="error"><?php echo("$errMess");?></span>
      </p>
      <p>
      <input type="submit" name="contactSubmit" id="contactSubmit" value="Submit"/>
      </p>
    </form>
  </section>
</body>
</html>

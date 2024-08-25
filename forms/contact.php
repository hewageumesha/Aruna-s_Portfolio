<?php
  // Enable error reporting for debugging
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  /**
   * Requires the "PHP Email Form" library
   * The "PHP Email Form" library is available only in the pro version of the template
   * The library should be uploaded to: vendor/php-email-form/php-email-form.php
   * For more info and help: https://bootstrapmade.com/php-email-form/
   */

  // Replace with your real receiving email address
  $receiving_email_address = 'ehos.sampath@gmail.com';

  // Include the PHP Email Form library
  if(file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
  } else {
    die('Unable to load the "PHP Email Form" Library!');
  }

  // Create a new PHP_Email_Form instance
  $contact = new PHP_Email_Form;
  $contact->ajax = true;

  // Set email parameters
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment and configure SMTP settings if required
  /*
  $contact->smtp = array(
    'host' => 'smtp.example.com',
    'username' => 'your_username',
    'password' => 'your_password',
    'port' => '587'
  );
  */

  // Add message details
  $contact->add_message($_POST['name'], 'From');
  $contact->add_message($_POST['email'], 'Email');
  $contact->add_message($_POST['message'], 'Message', 10);

  // Send the email and output result
  if ($contact->send()) {
    echo 'Your message has been sent. Thank you!';
  } else {
    echo 'There was an error sending your message. Please try again later.';
  }
?>

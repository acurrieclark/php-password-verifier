<?php

namespace acurrieclark\PhpPasswordVerifier;
use acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException;

/**
* Verifier Class
*/

class Verifier
{

  private $checkMinLength = false,
          $checkMaxLength = false,
          $checkLetters = false,
          $checkCapitals = false,
          $checkNumbers = false,
          $checkSpecialChrs = false,
          $checkBlacklist = false;

  private static $specialChrs = ['{','}','(',')','[',']','#',',',':',';','^','.','?','!','|','&','_','`','~','@','$','%','/',"\\",'=','+','-','*','"',"'"];

  private $errors = [];

  public function getErrors() {
    return $this->errors;
  }

  public function checkPassword($password) {

    $this->errors = [];

    if ($this->checkMinLength && strlen($password) < $this->checkMinLength) {
      $this->errors['minLength'] = "Password must be at least $this->checkMinLength characters long";
    }

    if ($this->checkMaxLength && strlen($password) > $this->checkMaxLength) {
      $this->errors['maxLength'] = "Password must be at no more than $this->checkMaxLength characters long";
    }

    if ($this->checkLetters && !preg_match('/[a-zA-Z]/', $password)) {
      $this->errors['letters'] = "Password must contain at least one letter";
    }

    if ($this->checkCapitals && !preg_match('/[A-Z]/', $password)) {
      $this->errors['capitals'] = "Password must contain at least one capital letter";
    }

    if ($this->checkNumbers && !preg_match('/[0-9]/', $password)) {
      $this->errors['numbers'] = "Password must contain at least one number";
    }

    if ($this->checkSpecialChrs && !preg_match('/[\\'.join('\\',self::$specialChrs).']/', $password)) {
      $this->errors['specialChrs'] = "Password must contain at least of the characters ".join(self::$specialChrs);
    }

    if ($this->checkBlacklist) {
      $filename = dirname(dirname(__FILE__)).'/assets/top_1000_passwords.txt';
      $words = file($filename, FILE_IGNORE_NEW_LINES);
      if (in_array($password, $words)) {
        $this->errors['blacklist'] = "Your password is too common. Please choose a more unique phrase.";
      }
    }

    return empty($this->errors);
  }

  public static function getSpecialChrs() {
    return self::$specialChrs;
  }

  public function setMinLength($length) {
    if ($length && ((int)$length !== $length || $length < 0)) {
      throw new SetConstraintException("Minimum length must be a positive integer, 0 or false", 1);
    }
    else {
      $this->checkMinLength = $length;
    }
    return $this;
  }

  public function setMaxLength($length) {
    if ((int)$length !== $length || $length < 1) {
      throw new SetConstraintException("Maximum length must be a positive integer, 0 or false", 2);
    }
    else if ($length && $length < $this->checkMinLength) {
      throw new SetConstraintException("Maximum length longer that the minimum length ($this->checkMinLength) ", 3);
    }
    else {
      $this->checkMaxLength = $length;
    }
    return $this;
  }

  public function setCheckContainsLetters($value = true) {
    if ($value !== false && $value !== true) {
      throw new SetConstraintException("setCheckContainsLetters value must be of type boolean", 4);
    }
    else {
      $this->checkLetters = $value;
    }
    return $this;
  }

  public function setCheckContainsCapitals($value = true) {
    if ($value !== false && $value !== true) {
      throw new SetConstraintException("setCheckContainsCapitals value must be of type boolean", 8);
    }
    else {
      $this->checkCapitals = $value;
    }
    return $this;
  }

  public function setCheckContainsNumbers($value = true) {
    if ($value !== false && $value !== true) {
      throw new SetConstraintException("setCheckContainsNumbers value must be of type boolean", 5);
    }
    else {
      $this->checkNumbers = $value;
    }
    return $this;
  }

  public function setCheckContainsSpecialChrs($value = true) {
    if ($value !== false && $value !== true) {
      throw new SetConstraintException("setCheckContainsSpecialChrs value must be of type boolean", 6);
    }
    else {
      $this->checkSpecialChrs = $value;
    }
    return $this;
  }

  public function setCheckBlacklist($value = true) {
    if ($value !== false && $value !== true) {
      throw new SetConstraintException("setCheckBlacklist value must be of type boolean", 7);
    }
    else {
      $this->checkBlacklist = $value;
    }
    return $this;
  }

}


?>

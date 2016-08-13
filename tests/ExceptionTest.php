<?php

use acurrieclark\PhpPasswordVerifier\Verifier;

class ExceptionTest extends PHPUnit_Framework_TestCase {

  /**
  * @expectedException acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException
  * @expectedExceptionCode 1
  */
  public function testNonIntegerMinLength() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMinLength('stringNotInteger');
  }

  /**
  * @expectedException acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException
  * @expectedExceptionCode 1
  */
  public function testNegativeMinLength() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMinLength(-1);
  }

  /**
  * @expectedException acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException
  * @expectedExceptionCode 2
  */
  public function testNonIntegerMaxLength() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMaxLength('stringNotInteger');
  }

  /**
  * @expectedException acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException
  * @expectedExceptionCode 3
  */
  public function testMaxLengthGreaterThanMinLength() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMinLength(8);
    $passwordVerifier->setMaxLength(7);
  }

  /**
  * @expectedException acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException
  * @expectedExceptionCode 4
  */

  public function testCheckContainsLettersInputIsBoolean() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsLetters('hello');
  }

  /**
  * @expectedException acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException
  * @expectedExceptionCode 8
  */

  public function testCheckContainsCapitalsInputIsBoolean() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsCapitals('hello');
  }

  /**
  * @expectedException acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException
  * @expectedExceptionCode 5
  */

  public function testCheckContainsNumbersInputIsBoolean() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsNumbers('hello');
  }


  /**
  * @expectedException acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException
  * @expectedExceptionCode 6
  */

  public function testCheckContainsSpecialChrsInputIsBoolean() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsSpecialChrs('hello');
  }

  /**
  * @expectedException acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException
  * @expectedExceptionCode 7
  */

  public function testCheckBlacklistInputIsBoolean() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckBlacklist('hello');
  }
}

?>

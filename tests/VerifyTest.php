<?php

use acurrieclark\PhpPasswordVerifier\Verifier;

class VerifyTest extends PHPUnit_Framework_TestCase {

  public function testStandardPass() {
    $passwordVerifier = new Verifier();
    $this->assertEquals($passwordVerifier->checkPassword('1245'), true);
    $this->assertEquals(empty($passwordVerifier->getErrors()), true);
  }

  public function testMinLengthFail() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMinLength(6);
    $this->assertEquals($passwordVerifier->checkPassword('12345'), false);
    $this->assertEquals(isset($passwordVerifier->getErrors()['minLength']), true);
  }

  public function testMinLengthPass() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMinLength(6);
    $this->assertEquals($passwordVerifier->checkPassword('1234567'), true);
    $this->assertEquals(empty($passwordVerifier->getErrors()), true);
  }

  public function testChangeMinLength() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMinLength(8);
    $this->assertEquals($passwordVerifier->checkPassword('1234567'), false);
    $this->assertEquals(isset($passwordVerifier->getErrors()['minLength']), true);
  }

  public function testCancelMinLength() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMinLength(false);
    $this->assertEquals($passwordVerifier->checkPassword('1'), true);
    $this->assertEquals(empty($passwordVerifier->getErrors()), true);
  }

  public function testMaxLengthFail() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMaxLength(8);
    $this->assertEquals($passwordVerifier->checkPassword('123456789'), false);
    $this->assertEquals(isset($passwordVerifier->getErrors()['maxLength']), true);
  }

  public function testMaxLengthPass() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMaxLength(8);
    $this->assertEquals($passwordVerifier->checkPassword('12345678'), true);
    $this->assertEquals(empty($passwordVerifier->getErrors()), true);
  }

  public function testContainsLetterFail() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsLetters(true);
    $this->assertEquals($passwordVerifier->checkPassword('1234'), false);
    $this->assertEquals(isset($passwordVerifier->getErrors()['letters']), true);
  }

  public function testContainsLetterPass() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsLetters(true);
    $this->assertEquals($passwordVerifier->checkPassword('1234asdf'), true);
    $this->assertEquals(empty($passwordVerifier->getErrors()), true);
  }

  public function testContainsCapitalsFail() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsCapitals(true);
    $this->assertEquals($passwordVerifier->checkPassword('asdf'), false);
    $this->assertEquals(isset($passwordVerifier->getErrors()['capitals']), true);
  }

  public function testContainsCapitalsPass() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsCapitals(true);
    $this->assertEquals($passwordVerifier->checkPassword('Asdf'), true);
    $this->assertEquals(empty($passwordVerifier->getErrors()), true);
  }

  public function testContainsNumberFail() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsNumbers(true);
    $this->assertEquals($passwordVerifier->checkPassword('asdf'), false);
    $this->assertEquals(isset($passwordVerifier->getErrors()['numbers']), true);
  }

  public function testContainsNumberPass() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsNumbers(true);
    $this->assertEquals($passwordVerifier->checkPassword('1234asdf'), true);
    $this->assertEquals(empty($passwordVerifier->getErrors()), true);
  }

  public function testContainsSpecialChrsFail() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsSpecialChrs(true);
    $this->assertEquals($passwordVerifier->checkPassword('asdf'), false);
    $this->assertEquals(isset($passwordVerifier->getErrors()['specialChrs']), true);
  }

  public function testContainsSpecialChrsPass() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsSpecialChrs(true);
    $this->assertEquals($passwordVerifier->checkPassword("{"), true);
    $this->assertEquals($passwordVerifier->checkPassword("}"), true);
    $this->assertEquals($passwordVerifier->checkPassword("("), true);
    $this->assertEquals($passwordVerifier->checkPassword(")"), true);
    $this->assertEquals($passwordVerifier->checkPassword("["), true);
    $this->assertEquals($passwordVerifier->checkPassword("]"), true);
    $this->assertEquals($passwordVerifier->checkPassword("#"), true);
    $this->assertEquals($passwordVerifier->checkPassword(","), true);
    $this->assertEquals($passwordVerifier->checkPassword(":"), true);
    $this->assertEquals($passwordVerifier->checkPassword(";"), true);
    $this->assertEquals($passwordVerifier->checkPassword("^"), true);
    $this->assertEquals($passwordVerifier->checkPassword("."), true);
    $this->assertEquals($passwordVerifier->checkPassword("?"), true);
    $this->assertEquals($passwordVerifier->checkPassword("!"), true);
    $this->assertEquals($passwordVerifier->checkPassword("|"), true);
    $this->assertEquals($passwordVerifier->checkPassword("&"), true);
    $this->assertEquals($passwordVerifier->checkPassword("_"), true);
    $this->assertEquals($passwordVerifier->checkPassword("`"), true);
    $this->assertEquals($passwordVerifier->checkPassword("~"), true);
    $this->assertEquals($passwordVerifier->checkPassword("@"), true);
    $this->assertEquals($passwordVerifier->checkPassword("$"), true);
    $this->assertEquals($passwordVerifier->checkPassword("%"), true);
    $this->assertEquals($passwordVerifier->checkPassword("/"), true);
    $this->assertEquals($passwordVerifier->checkPassword("\\"), true);
    $this->assertEquals($passwordVerifier->checkPassword("="), true);
    $this->assertEquals($passwordVerifier->checkPassword("+"), true);
    $this->assertEquals($passwordVerifier->checkPassword("-"), true);
    $this->assertEquals($passwordVerifier->checkPassword("*"), true);
    $this->assertEquals($passwordVerifier->checkPassword('"'), true);
    $this->assertEquals($passwordVerifier->checkPassword("'"), true);
    $this->assertEquals(empty($passwordVerifier->getErrors()), true);
  }

  public function testBlacklistFail() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckBlacklist(true);
    $this->assertEquals($passwordVerifier->checkPassword('asdf'), false);
    $this->assertEquals(isset($passwordVerifier->getErrors()['blacklist']), true);
  }

  public function testBlacklistPass() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckBlacklist(true);
    $this->assertEquals($passwordVerifier->checkPassword('heebegeebeesyoulittlebeauty'), true);
    $this->assertEquals(empty($passwordVerifier->getErrors()), true);
  }

  public function testChainedConstraints() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckBlacklist(true)
                     ->setMinLength(6)
                     ->setMaxLength(12);
    $this->assertEquals($passwordVerifier->checkPassword('1234567890asdfg'), false);
  }

}

?>

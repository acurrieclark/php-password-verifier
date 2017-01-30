<?php

use acurrieclark\PhpPasswordVerifier\Verifier;

class VerifyTest extends PHPUnit_Framework_TestCase {

  public function testStandardPass() {
    $passwordVerifier = new Verifier();
    $this->assertTrue($passwordVerifier->checkPassword('1245'));
    $this->assertEmpty($passwordVerifier->getErrors());
  }

  public function testMinLengthFail() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMinLength(6);
    $this->assertFalse($passwordVerifier->checkPassword('12345'));
    $this->assertNotEmpty($passwordVerifier->getErrors()['minLength']);
  }

  public function testMinLengthPass() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMinLength(6);
    $this->assertTrue($passwordVerifier->checkPassword('1234567'));
    $this->assertEmpty($passwordVerifier->getErrors());
  }

  public function testChangeMinLength() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMinLength(8);
    $this->assertFalse($passwordVerifier->checkPassword('1234567'));
    $this->assertNotEmpty($passwordVerifier->getErrors()['minLength']);
  }

  public function testCancelMinLength() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMinLength(false);
    $this->assertTrue($passwordVerifier->checkPassword('1'));
    $this->assertEmpty($passwordVerifier->getErrors());
  }

  public function testMaxLengthFail() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMaxLength(8);
    $this->assertFalse($passwordVerifier->checkPassword('123456789'));
    $this->assertNotEmpty($passwordVerifier->getErrors()['maxLength']);
  }

  public function testMaxLengthPass() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setMaxLength(8);
    $this->assertTrue($passwordVerifier->checkPassword('12345678'));
    $this->assertEmpty($passwordVerifier->getErrors());
  }

  public function testContainsLetterFail() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsLetters(true);
    $this->assertFalse($passwordVerifier->checkPassword('1234'));
    $this->assertNotEmpty($passwordVerifier->getErrors()['letters']);
  }

  public function testContainsLetterPass() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsLetters(true);
    $this->assertTrue($passwordVerifier->checkPassword('1234asdf'));
    $this->assertEmpty($passwordVerifier->getErrors());
  }

  public function testContainsCapitalsFail() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsCapitals(true);
    $this->assertFalse($passwordVerifier->checkPassword('asdf'));
    $this->assertNotEmpty($passwordVerifier->getErrors()['capitals']);
  }

  public function testContainsCapitalsPass() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsCapitals(true);
    $this->assertTrue($passwordVerifier->checkPassword('Asdf'));
    $this->assertEmpty($passwordVerifier->getErrors());
  }

  public function testContainsNumberFail() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsNumbers(true);
    $this->assertFalse($passwordVerifier->checkPassword('asdf'));
    $this->assertNotEmpty($passwordVerifier->getErrors()['numbers']);
  }

  public function testContainsNumberPass() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsNumbers(true);
    $this->assertTrue($passwordVerifier->checkPassword('1234asdf'));
    $this->assertEmpty($passwordVerifier->getErrors());
  }

  public function testContainsSpecialChrsFail() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsSpecialChrs(true);
    $this->assertFalse($passwordVerifier->checkPassword('asdf'));
    $this->assertNotEmpty($passwordVerifier->getErrors()['specialChrs']);
  }

  public function testContainsSpecialChrsPass() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckContainsSpecialChrs(true);
    $this->assertTrue($passwordVerifier->checkPassword("{"));
    $this->assertTrue($passwordVerifier->checkPassword("}"));
    $this->assertTrue($passwordVerifier->checkPassword("("));
    $this->assertTrue($passwordVerifier->checkPassword(")"));
    $this->assertTrue($passwordVerifier->checkPassword("["));
    $this->assertTrue($passwordVerifier->checkPassword("]"));
    $this->assertTrue($passwordVerifier->checkPassword("#"));
    $this->assertTrue($passwordVerifier->checkPassword(","));
    $this->assertTrue($passwordVerifier->checkPassword(":"));
    $this->assertTrue($passwordVerifier->checkPassword(";"));
    $this->assertTrue($passwordVerifier->checkPassword("^"));
    $this->assertTrue($passwordVerifier->checkPassword("."));
    $this->assertTrue($passwordVerifier->checkPassword("?"));
    $this->assertTrue($passwordVerifier->checkPassword("!"));
    $this->assertTrue($passwordVerifier->checkPassword("|"));
    $this->assertTrue($passwordVerifier->checkPassword("&"));
    $this->assertTrue($passwordVerifier->checkPassword("_"));
    $this->assertTrue($passwordVerifier->checkPassword("`"));
    $this->assertTrue($passwordVerifier->checkPassword("~"));
    $this->assertTrue($passwordVerifier->checkPassword("@"));
    $this->assertTrue($passwordVerifier->checkPassword("$"));
    $this->assertTrue($passwordVerifier->checkPassword("%"));
    $this->assertTrue($passwordVerifier->checkPassword("/"));
    $this->assertTrue($passwordVerifier->checkPassword("\\"));
    $this->assertTrue($passwordVerifier->checkPassword("="));
    $this->assertTrue($passwordVerifier->checkPassword("+"));
    $this->assertTrue($passwordVerifier->checkPassword("-"));
    $this->assertTrue($passwordVerifier->checkPassword("*"));
    $this->assertTrue($passwordVerifier->checkPassword('"'));
    $this->assertTrue($passwordVerifier->checkPassword("'"));
    $this->assertEmpty($passwordVerifier->getErrors());
  }

  public function testBlacklistFail() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckBlacklist(true);
    $this->assertFalse($passwordVerifier->checkPassword('asdf'));
    $this->assertNotEmpty($passwordVerifier->getErrors()['blacklist']);
  }

  public function testBlacklistPass() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckBlacklist(true);
    $this->assertTrue($passwordVerifier->checkPassword('heebegeebeesyoulittlebeauty'));
    $this->assertEmpty($passwordVerifier->getErrors());
  }

  public function testChainedConstraints() {
    $passwordVerifier = new Verifier();
    $passwordVerifier->setCheckBlacklist(true)
                     ->setMinLength(6)
                     ->setMaxLength(12);
    $this->assertFalse($passwordVerifier->checkPassword('1234567890asdfg'));
  }

}

?>

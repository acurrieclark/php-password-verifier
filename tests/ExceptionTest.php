<?php

use acurrieclark\PhpPasswordVerifier\Verifier;

class ExceptionTest extends PHPUnit\Framework\TestCase
{
    public function testNonIntegerMinLength()
    {
        $this->expectException(\acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException::class);
        $this->expectExceptionCode(1);
        $passwordVerifier = new Verifier();
        $passwordVerifier->setMinLength('stringNotInteger');
    }

    public function testNegativeMinLength()
    {
        $this->expectException(\acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException::class);
        $this->expectExceptionCode(1);
        $passwordVerifier = new Verifier();
        $passwordVerifier->setMinLength(-1);
    }

    public function testNonIntegerMaxLength()
    {
        $this->expectException(\acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException::class);
        $this->expectExceptionCode(2);
        $passwordVerifier = new Verifier();
        $passwordVerifier->setMaxLength('stringNotInteger');
    }

    public function testMaxLengthGreaterThanMinLength()
    {
        $this->expectException(\acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException::class);
        $this->expectExceptionCode(3);
        $passwordVerifier = new Verifier();
        $passwordVerifier->setMinLength(8);
        $passwordVerifier->setMaxLength(7);
    }

    public function testCheckContainsLettersInputIsBoolean()
    {
        $this->expectException(\acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException::class);
        $this->expectExceptionCode(4);
        $passwordVerifier = new Verifier();
        $passwordVerifier->setCheckContainsLetters('hello');
    }

    public function testCheckContainsNumbersInputIsBoolean()
    {
        $this->expectException(\acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException::class);
        $this->expectExceptionCode(5);
        $passwordVerifier = new Verifier();
        $passwordVerifier->setCheckContainsNumbers('hello');
    }

    public function testCheckContainsSpecialChrsInputIsBoolean()
    {
        $this->expectException(\acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException::class);
        $this->expectExceptionCode(6);
        $passwordVerifier = new Verifier();
        $passwordVerifier->setCheckContainsSpecialChrs('hello');
    }

    public function testCheckBlacklistInputIsBoolean()
    {
        $this->expectException(\acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException::class);
        $this->expectExceptionCode(7);
        $passwordVerifier = new Verifier();
        $passwordVerifier->setCheckBlacklist('hello');
    }

    public function testCheckContainsCapitalsInputIsBoolean()
    {
        $this->expectException(\acurrieclark\PhpPasswordVerifier\Exception\SetConstraintException::class);
        $this->expectExceptionCode(8);
        $passwordVerifier = new Verifier();
        $passwordVerifier->setCheckContainsCapitals('hello');
    }
}

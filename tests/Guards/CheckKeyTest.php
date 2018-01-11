<?php namespace jmashore\Signature\Tests\Guards;

/* CheckKeyTest */
use jmashore\Signature\Guards\CheckKey;

/* This is my change */

class CheckKeyTest extends \PHPUnit_Framework_TestCase
{
    /** @var CheckVersionNumber */
    private $guard;

    public function setUp()
    {
        $this->guard = new CheckKey;
    }

    /** @test */
    public function should_throw_exception_on_missing_key()
    {
        $this->setExpectedException('jmashore\Signature\Exceptions\SignatureKeyException');

        $this->guard->check([], ['auth_key' => 'abc123'], 'auth_');
    }

    /** @test */
    public function should_throw_exception_on_invalid_key()
    {
        $this->setExpectedException('jmashore\Signature\Exceptions\SignatureKeyException');

        $this->guard->check(['auth_key' => 'edf456'], ['auth_key' => 'abc123'], 'auth_');
    }

    /** @test */
    public function should_return_true_with_valid_key()
    {
        $this->assertTrue($this->guard->check(
            ['auth_key' => 'abc123'], ['auth_key' => 'abc123'], 'auth_'
        ));
    }
}

<?php namespace jmashore\Signature\Tests;

use jmashore\Signature\Token;

class TokenTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_create_token()
    {
        $token = new Token('key', 'secret');

        $this->assertInstanceOf('jmashore\Signature\Token', $token);
        $this->assertEquals('key', $token->key());
        $this->assertEquals('secret', $token->secret());
    }
}

<?php namespace jmashore\Signature\Guards;

use jmashore\Signature\Signature;

interface Guard
{

    /**
     * Check to ensure the auth parameters
     * satisfy the rule of the guard
     *
     * @param array  $auth
     * @param array  $signature
     * @param string $prefix
     * @return bool
     */
    public function check(array $auth, array $signature, $prefix);
}

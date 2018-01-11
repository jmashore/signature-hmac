<?php namespace jmashore\Signature\Guards;

use jmashore\Signature\Exceptions\SignatureTimestampException;

class CheckTimestamp implements Guard
{
    /**
     * @var int
     */
    private $grace;

    /**
     * Create a new CheckTimestamp Guard
     *
     * @param int $grace
     * @return void
     */
    public function __construct($grace = 600)
    {
        $this->grace = $grace;
    }

    /**
     * Check to ensure the auth parameters
     * satisfy the rule of the guard
     *
     * @param array  $auth
     * @param array  $signature
     * @param string $prefix
     * @throws SignatureTimestampException
     * @return bool
     */
    public function check(array $auth, array $signature, $prefix)
    {
        if (! isset($auth[$prefix . 'timestamp'])) {
            throw new SignatureTimestampException('The timestamp has not been set');
        }

        if (abs($auth[$prefix . 'timestamp'] - time()) >= $this->grace) {
            throw new SignatureTimestampException('The timestamp is invalid');
        }

        return true;
    }
}

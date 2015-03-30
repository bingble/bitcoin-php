<?php


namespace BitWasp\Bitcoin\Signature;

use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Serializer\Signature\CompactSignatureSerializer;

class CompactSignature
{
    /**
     * @var int|string
     */
    protected $r;

    /**
     * @var int|string
     */
    protected $s;

    /**
     * @var int|string
     */
    protected $recid;

    /**
     * @var bool
     */
    protected $compressed;

    /**
     * @param $r
     * @param $s
     * @param $recid
     */
    public function __construct($r, $s, $recid, $compressed)
    {
        $this->r = $r;
        $this->s = $s;
        $this->recid = $recid;
        $this->compressed = $compressed;
    }

    /**
     * @return int|string
     */
    public function getR()
    {
        return $this->r;
    }

    /**
     * @return int|string
     */
    public function getS()
    {
        return $this->s;
    }

    /**
     * @return int|string
     */
    public function getRecoveryId()
    {
        return $this->recid;
    }

    /**
     * @return bool
     */
    public function isCompressed()
    {
        return $this->compressed === true;
    }

    /**
     * @return int|string
     */
    public function getFlags()
    {
        return $this->getRecoveryId() + 27 + ($this->isCompressed() ? 4 : 0);
    }

    /**
     * @return \BitWasp\Bitcoin\Buffer
     */
    public function getBuffer()
    {
        $serializer = new CompactSignatureSerializer(Bitcoin::getMath());
        return $serializer->serialize($this);
    }
}
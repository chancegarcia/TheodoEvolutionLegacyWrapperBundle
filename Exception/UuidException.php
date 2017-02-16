<?php

namespace Theodo\Evolution\Bundle\LegacyWrapperBundle\Exception;

/**
 * Class UuidException
 * @package Theodo\Evolution\Bundle\LegacyWrapperBundle\Exception
 * @author      Chance Garcia <chance@garcia.codes>
 */
class UuidException extends \Exception
{
    protected $uuid;
    
    public function __construct($message = "", $code = 0, $previous = null)
    {
        /**
         * use UUID values for exception code constants instead of integers to avoid overlaps
         */
        $this->uuid = $code;
        // http://stackoverflow.com/questions/4837278/filter-out-numbers-in-a-string-in-php
        $filteredCode = str_replace(['+', '-'], '', filter_var($code, FILTER_SANITIZE_NUMBER_INT));
        parent::__construct($message, $filteredCode, $previous);
    }
    
    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }
    
    /**
     * @param mixed $uuid
     * @return UuidException
     */
    public function setUuid($uuid = null)
    {
        $this->uuid = $uuid;
        return $this;
    }
}
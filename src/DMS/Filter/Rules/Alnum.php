<?php

namespace DMS\Filter\Rules;

/**
 * Alnum Rule (Alphanumeric)
 *
 * @package DMS
 * @subpackage Filter
 *
 * @Annotation
 */
class Alnum extends RegExp
{

    /**
     * Allow Whitespace or not
     *
     * @var bool
     */
    public $allowWhitespace = true;

    /**
     * {@inheritDoc}
     */
    public function applyFilter($value)
    {
        //Check for Whitespace support
        $whitespaceChar = ($this->allowWhitespace)? " ":"";

        $this->unicodePattern = '/[^\p{L}\p{N}' . $whitespaceChar . ']/u';
        $this->pattern        = '/[^a-zA-Z0-9' . $whitespaceChar . ']/';

        return parent::applyFilter($value);
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultOption()
    {
        return 'allowWhitespace';
    }

}
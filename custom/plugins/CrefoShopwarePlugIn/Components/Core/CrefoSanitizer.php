<?php
/**
 * Copyright (c) 2016 Verband der Vereine Creditreform.
 * Hellersbergstrasse 12, 41460 Neuss, Germany.
 *
 * This file is part of the CrefoShopwarePlugIn.
 * For licensing information, refer to the “license” file.
 *
 * Diese Datei ist Teil des CrefoShopwarePlugIn.
 * Informationen zur Lizenzierung sind in der Datei “license” verfügbar.
 */

namespace CrefoShopwarePlugIn\Components\Core;

/**
 * Class CrefoSanitizer
 * @package CrefoShopwarePlugIn\Components\Core
 */
class CrefoSanitizer
{

    /**
     * sanitizer rules
     * @var array
     */
    private $sanitize_rules = [];

    /**
     * source
     * @var array
     */
    private $source = [];

    /**
     * the sanitized values
     * @var array
     */
    public $sanitized = [];

    /**
     * CrefoSanitizer constructor.
     */
    public function __construct()
    {
        mb_internal_encoding("UTF-8");
    }

    /**
     * @param array $source
     */
    public function addSource($source)
    {
        $this->source = $source;
    }

    /**
     * @method run
     */
    public function run()
    {
        foreach (new \ArrayIterator($this->sanitize_rules) as $var => $opt) {
            if (array_key_exists('trim', $opt) && $opt['trim'] == true && !is_null($this->source[$var])) {
                $this->source[$var] = trim($this->source[$var]);
            }
            $this->sanitizeLength($var, $opt['length']);
            switch ($opt['type']) {
                case 'email':
                    $this->sanitizeEmail($var);
                    break;
                case 'numeric':
                    $this->sanitizeNumeric($var);
                    break;
                case 'string':
                    $this->sanitizeString($var);
                    break;
                case 'string_numeric':
                    $this->sanitizeStringNumeric($var);
                    break;
                case 'numeric_float':
                    $this->sanitizeNumericFloat($var);
                    break;
            }
        }
    }

    /**
     * @return array
     */
    public function getSanitizedArray()
    {
        return $this->sanitized;
    }

    /**
     * @param $varName
     * @param $type
     * @param int $length
     * @param bool $trim
     * @return $this
     */
    public function addRule($varName, $type, $length = 0, $trim = false)
    {
        $this->sanitize_rules[$varName] = ['type' => $type, 'length' => $length, 'trim' => $trim];
        return $this;
    }

    /**
     * @param array $rules_array
     */
    public function addRules(array $rules_array)
    {
        $this->sanitize_rules = array_merge($this->sanitize_rules, $rules_array);
    }

    /**
     * @param $var
     */
    private function sanitizeEmail($var)
    {
        if (is_null($this->source[$var])) {
            $this->sanitized[$var] = null;
            return;
        }
        $email = preg_replace('((?:\n|\r|\t|%0A|%0D|%08|%09)+)i', '', $this->source[$var]);
        $this->sanitized[$var] = (string)filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    /**
     * @param $var
     */
    private function sanitizeNumeric($var)
    {
        if (is_null($this->source[$var])) {
            $this->sanitized[$var] = null;
            return;
        }
        $this->sanitized[$var] = (int)filter_var($this->source[$var], FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * @param $var
     */
    private function sanitizeString($var)
    {
        if (is_null($this->source[$var])) {
            $this->sanitized[$var] = null;
            return;
        }
        $this->sanitized[$var] = (string)filter_var($this->source[$var], FILTER_SANITIZE_STRING);
    }

    /**
     * @param $var
     */
    private function sanitizeStringNumeric($var)
    {
        if (is_null($this->source[$var])) {
            $this->sanitized[$var] = null;
            return;
        }
        $this->sanitized[$var] = (string)preg_replace('/[^\d]+/i', "",
            filter_var($this->source[$var], FILTER_SANITIZE_STRING));
    }

    /**
     * @param $var
     */
    private function sanitizeNumericFloat($var)
    {
        if (is_null($this->source[$var])) {
            $this->sanitized[$var] = null;
            return;
        }
        $this->sanitized[$var] = (float)filter_var($this->source[$var], FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
    }

    /**
     * @param $var
     * @param $length
     */
    private function sanitizeLength($var, $length)
    {
        if (is_null($var) || mb_strlen($this->source[$var]) == 0 || $length == 0) {
            return; //do nothing
        }
        if (mb_strlen($this->source[$var]) > $length) {
            $this->source[$var] = mb_substr($this->source[$var], 0, $length - mb_strlen($this->source[$var]));
        }
    }

}

<?php

namespace App\Util;
class StringUtil
{
    /**
     * Check String is empty
     *
     * @param string someText
     * @return boolean
     */
    public static function isEmptyString($someText)
    {
        if ($someText = null || $someText = "" || empty($someText) || strlen($someText) == 0)
            return true;
        else
            return false;
    }

    /**
     * Check String is not empty
     *
     * @param string someText
     * @return boolean
     */
    public static function isNotEmpty($someText)
    {
        return !StringUtil::isEmptyString($someText);
    }
}

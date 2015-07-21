<?php

class String
{

    public function __construct()
    {
        parent::__construct();
    }

    private function KeySubString($string, $start, $end)
    {
        $startTag = strpos($string, $start, 0) + strlen($start);
        $endTag = strpos($string, $end, $startTag);
        $substr = substr($string, $startTag, ( $endTag - $startTag ));

        return $substr;
    }

    private function removeHtmlEntity($string)
    {
        return preg_replace("/&#?[a-z0-9]+;/i","", $string);
    }
    
    /**
     * [findNumericFromString description]
     * @param  String $key keyword to get a position of start.
     * @param  String $str content to find value.
     * @param  boolean $reverse check for reverse.
     * @return String
     */
    private function findNumericFromString($key, $str, $reverse = false)
    {
        $string_temp_arr = array();
        $string_return_arr = array();
        $key = strtolower($key);
        $str = strtolower($str);
        $strpos = strpos($str, $key);
        $strlen = strlen($str) - $strpos;

        if ($reverse) {
            $count = 0;
            $curStrPos = ( $strpos - 1 );

            while ($count < $strlen) {
                $findChar = substr($str, $curStrPos, 1);
                if (is_numeric($findChar) || $findChar == ' ') {
                    $string_temp_arr[] = $findChar;
                } else {
                    break;
                }
                $count++;
                $curStrPos--;
            }

            $charCount = count($string_temp_arr) - 1;

            for ($i = $charCount; $i > 0; $i--) {
                if ($string_temp_arr[$i] != ' ') {
                    $string_return_arr[] = $string_temp_arr[$i];
                }
            }

            $value = implode('', $string_return_arr);

        } else {
            $count = 0;
            $curStrPos = ( $strpos + strlen($key) );

            while ($count < $strlen) {
                $findChar = substr($str, $curStrPos, 1);
                if (is_numeric($findChar) || $findChar == ' ') {
                    $string_return_arr[] = $findChar;
                } else {
                    break;
                }
                $count++;
                $curStrPos++;
            }

            $value = implode('', $string_return_arr);

        }

        return $value;
    }

}

?>

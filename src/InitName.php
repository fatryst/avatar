<?php
/**
 * description:
 * date: 2017-07-15 13:47
 * author: fa.zeng
 * version: 1.0
 */

namespace Aliwuyun\Avatar;

class InitName
{
    public $asianFont;
    public $enableAsianChar;

    /**
     * InitName constructor.
     */
    function __construct()
    {
        $this->asianFont = dirname(__FILE__) . '/fonts/SourceHanSansCN-Normal.ttf';
        $this->enableAsianChar = is_file($this->asianFont);
    }

    /**
     * @param $names
     *
     * @return array|null|string
     */
    public function getName($names)
    {
        $charName = null;
        if (is_array($names) && count($names) > 1) {
            foreach ($names as $name) {
                if (mb_strlen($name) > 2) {
                    $name = mb_substr($name, -2);
                }
                $theName = $this->getFirstChar(strtoupper(mb_substr($name, 0, 1, "UTF-8")));
                $charName[] = $theName;
            }
        } else {
            $charName = '';
            $names = is_array($names) ? $names[0] : $names;
            if (mb_strlen($names) >= 2) {
                $names = mb_substr($names, -2);
                for ($i = 0; $i < 2; $i++) {
                    $charName .= $this->getFirstChar(strtoupper(mb_substr($names, $i, 1, "UTF-8")));
                }
            } else {
                $charName = $this->getFirstChar(strtoupper(mb_substr($names, 0, 1, "UTF-8")));
            }

        }
        return $charName;
    }

    /**
     * @param $char
     *
     * @return string
     */
    private function getFirstChar($char)
    {
        $CNChar = ord($char);
        if (!$this->enableAsianChar && preg_match("/^[\x7f-\xff]/", $char) && !($CNChar >= ord("A") && $CNChar <= ord("z"))) {
            $CNByte = iconv("UTF-8", "gb2312", $char);
            $Code = ord($CNByte{0}) * 256 + ord($CNByte{1}) - 65536;
            if ($Code >= -20319 and $Code <= -20284) return "A";
            if ($Code >= -20283 and $Code <= -19776) return "B";
            if ($Code >= -19775 and $Code <= -19219) return "C";
            if ($Code >= -19218 and $Code <= -18711) return "D";
            if ($Code >= -18710 and $Code <= -18527) return "E";
            if ($Code >= -18526 and $Code <= -18240) return "F";
            if ($Code >= -18239 and $Code <= -17923) return "G";
            if ($Code >= -17922 and $Code <= -17418) return "H";
            if ($Code >= -17417 and $Code <= -16475) return "J";
            if ($Code >= -16474 and $Code <= -16213) return "K";
            if ($Code >= -16212 and $Code <= -15641) return "L";
            if ($Code >= -15640 and $Code <= -15166) return "M";
            if ($Code >= -15165 and $Code <= -14923) return "N";
            if ($Code >= -14922 and $Code <= -14915) return "O";
            if ($Code >= -14914 and $Code <= -14631) return "P";
            if ($Code >= -14630 and $Code <= -14150) return "Q";
            if ($Code >= -14149 and $Code <= -14091) return "R";
            if ($Code >= -14090 and $Code <= -13319) return "S";
            if ($Code >= -13318 and $Code <= -12839) return "T";
            if ($Code >= -12838 and $Code <= -12557) return "W";
            if ($Code >= -12556 and $Code <= -11848) return "X";
            if ($Code >= -11847 and $Code <= -11056) return "Y";
            if ($Code >= -11055 and $Code <= -10247) return "Z";
        }
        return $char;
    }
}
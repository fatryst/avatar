<?php
/**
 * description:
 * date: 2017-07-15 14:02
 * author: fa.zeng
 * version: 1.0
 */

namespace Aliwuyun\Avatar;

/**
 * Class InitMap
 * @package App\Helps\aliwuyun\avatars\src
 * @author  fa.zeng
 */
class InitMap
{

    private $name;
    private $avatarSize;
    private $padding;
    private $avatar;
    private $fontFile;
    private $isNotLetter;
    private $letterFont;
    private $asianFont;
    private $enableAsianChar;

    /**
     * InitMap constructor.
     *
     * @param $name
     * @param int $avatarSize
     */
    function __construct($name, $avatarSize = 256)
    {
        $this->avatarSize = $avatarSize;
        $this->padding = 30 * ($this->avatarSize / 256);
        $this->letterFont = dirname(__FILE__) . '/fonts/SourceCodePro-Light.ttf';
        $this->asianFont = dirname(__FILE__) . '/fonts/SourceHanSansCN-Normal.ttf';
        $this->enableAsianChar = is_file($this->asianFont);
        $this->name = $name;
        if (in_array($this->name, str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 1))) {
            $this->isNotLetter = false;
            $this->fontFile = $this->letterFont;
        } else {
            $this->isNotLetter = true;
            $this->fontFile = $this->asianFont;
        }
    }


    /**
     * @return resource
     */
    public function Initialize()
    {
        $width = $this->avatarSize;
        $height = $this->avatarSize;
        $padding = $this->padding;
        $this->avatar = imagecreatetruecolor($width, $height);
        imageSaveAlpha($this->avatar, true);
        $BackgroundAlpha = imagecolorallocatealpha($this->avatar, 255, 255, 255, 127);
        imagefill($this->avatar, 0, 0, $BackgroundAlpha);
        if (function_exists('imageantialias')) {
            imageantialias($this->avatar, true);
        }
        $someColor = array(array(255, 235, 238), array(255, 205, 210), array(239, 154, 154), array(229, 115, 115), array(239, 83, 80), array(244, 67, 54), array(229, 57, 53), array(211, 47, 47), array(198, 40, 40), array(183, 28, 28), array(255, 138, 128), array(255, 82, 82), array(255, 23, 68), array(213, 0, 0), array(252, 228, 236), array(248, 187, 208), array(244, 143, 177), array(240, 98, 146), array(236, 64, 122), array(233, 30, 99), array(216, 27, 96), array(194, 24, 91), array(173, 20, 87), array(136, 14, 79), array(255, 128, 171), array(255, 64, 129), array(245, 0, 87), array(197, 17, 98), array(243, 229, 245), array(225, 190, 231), array(206, 147, 216), array(186, 104, 200), array(171, 71, 188), array(156, 39, 176), array(142, 36, 170), array(123, 31, 162), array(106, 27, 154), array(74, 20, 140), array(234, 128, 252), array(224, 64, 251), array(213, 0, 249), array(170, 0, 255), array(237, 231, 246), array(209, 196, 233), array(179, 157, 219), array(149, 117, 205), array(126, 87, 194), array(103, 58, 183), array(94, 53, 177), array(81, 45, 168), array(69, 39, 160), array(49, 27, 146), array(179, 136, 255), array(124, 77, 255), array(101, 31, 255), array(98, 0, 234), array(232, 234, 246), array(197, 202, 233), array(159, 168, 218), array(121, 134, 203), array(92, 107, 192), array(63, 81, 181), array(57, 73, 171), array(48, 63, 159), array(40, 53, 147), array(26, 35, 126), array(140, 158, 255), array(83, 109, 254), array(61, 90, 254), array(48, 79, 254), array(227, 242, 253), array(187, 222, 251), array(144, 202, 249), array(100, 181, 246), array(66, 165, 245), array(33, 150, 243), array(30, 136, 229), array(25, 118, 210), array(21, 101, 192), array(13, 71, 161), array(130, 177, 255), array(68, 138, 255), array(41, 121, 255), array(41, 98, 255), array(225, 245, 254), array(179, 229, 252), array(129, 212, 250), array(79, 195, 247), array(41, 182, 252), array(3, 169, 244), array(3, 155, 229), array(2, 136, 209), array(2, 119, 189), array(1, 87, 155), array(128, 216, 255), array(64, 196, 255), array(0, 176, 255), array(0, 145, 234), array(224, 247, 250), array(178, 235, 242), array(128, 222, 234), array(77, 208, 225), array(38, 198, 218), array(0, 188, 212), array(0, 172, 193), array(0, 151, 167), array(0, 131, 143), array(0, 96, 100), array(132, 255, 255), array(24, 255, 255), array(0, 229, 255), array(0, 184, 212), array(224, 242, 241), array(178, 223, 219), array(128, 203, 196), array(77, 182, 172), array(38, 166, 154), array(0, 150, 136), array(0, 137, 123), array(0, 121, 107), array(0, 105, 92), array(0, 77, 64), array(167, 255, 235), array(100, 255, 218), array(29, 233, 182), array(0, 191, 165), array(232, 245, 233), array(200, 230, 201), array(165, 214, 167), array(129, 199, 132), array(102, 187, 106), array(76, 175, 80), array(67, 160, 71), array(56, 142, 60), array(46, 125, 50), array(27, 94, 32), array(185, 246, 202), array(105, 240, 174), array(0, 230, 118), array(0, 200, 83), array(241, 248, 233), array(220, 237, 200), array(197, 225, 165), array(174, 213, 129), array(156, 204, 101), array(139, 195, 74), array(124, 179, 66), array(104, 159, 56), array(85, 139, 47), array(51, 105, 30), array(204, 255, 144), array(178, 255, 89), array(118, 255, 3), array(100, 221, 23), array(249, 251, 231), array(240, 244, 195), array(230, 238, 156), array(220, 231, 117), array(212, 225, 87), array(205, 220, 57), array(192, 202, 51), array(164, 180, 43), array(158, 157, 36), array(130, 119, 23), array(244, 255, 129), array(238, 255, 65), array(198, 255, 0), array(174, 234, 0), array(255, 253, 231), array(255, 249, 196), array(255, 245, 144), array(255, 241, 118), array(255, 238, 88), array(255, 235, 59), array(253, 216, 53), array(251, 192, 45), array(249, 168, 37), array(245, 127, 23), array(255, 255, 130), array(255, 255, 0), array(255, 234, 0), array(255, 214, 0), array(255, 248, 225), array(255, 236, 179), array(255, 224, 130), array(255, 213, 79), array(255, 202, 40), array(255, 193, 7), array(255, 179, 0), array(255, 160, 0), array(255, 143, 0), array(255, 111, 0), array(255, 229, 127), array(255, 215, 64), array(255, 196, 0), array(255, 171, 0), array(255, 243, 224), array(255, 224, 178), array(255, 204, 128), array(255, 183, 77), array(255, 167, 38), array(255, 152, 0), array(251, 140, 0), array(245, 124, 0), array(239, 108, 0), array(230, 81, 0), array(255, 209, 128), array(255, 171, 64), array(255, 145, 0), array(255, 109, 0), array(251, 233, 167), array(255, 204, 188), array(255, 171, 145), array(255, 138, 101), array(255, 112, 67), array(255, 87, 34), array(244, 81, 30), array(230, 74, 25), array(216, 67, 21), array(191, 54, 12), array(255, 158, 128), array(255, 110, 64), array(255, 61, 0), array(221, 38, 0), array(239, 235, 233), array(215, 204, 200), array(188, 170, 164), array(161, 136, 127), array(141, 110, 99), array(121, 85, 72), array(109, 76, 65), array(93, 64, 55), array(78, 52, 46), array(62, 39, 35), array(250, 250, 250), array(245, 245, 245), array(238, 238, 238), array(224, 224, 224), array(189, 189, 189), array(158, 158, 158), array(117, 117, 117), array(97, 97, 97), array(66, 66, 66), array(33, 33, 33), array(0, 0, 0), array(255, 255, 255), array(236, 239, 241), array(207, 216, 220), array(176, 187, 197), array(144, 164, 174), array(120, 144, 156), array(96, 125, 139), array(84, 110, 122), array(69, 90, 100), array(55, 71, 79), array(38, 50, 56));
        $backgroundColorIndex = mt_rand(0, count($someColor) - 1);
        $backgroundColor = imagecolorallocate($this->avatar, $someColor[$backgroundColorIndex][0], $someColor[$backgroundColorIndex][1], $someColor[$backgroundColorIndex][2]);
        imagefilledrectangle($this->avatar, 0, 0, $width, $height, $backgroundColor);
        $FontColor = imagecolorallocate($this->avatar, 255, 255, 255);
        if ($this->isNotLetter) {
            $fontSize = ($width - $padding * 3.5) / mb_strlen($this->name);
        } else {
            $fontSize = ($width - $padding * 2) / mb_strlen($this->name);
        }
        $fontBox = imagettfbbox($fontSize, 0, $this->fontFile, $this->name);
        $fontWidth = $fontBox[0] + $fontBox[2];
        $fontHeight = $fontBox[1] - $fontBox[7];
        $X = ($width) / 2 - $fontWidth / 2;
        $Y = ($height - $padding) / 2 + $fontHeight / 2;

        imagettftext($this->avatar, $fontSize, 0, $X, $Y, $FontColor, $this->fontFile, $this->name);
        return $this->avatar;
    }
}
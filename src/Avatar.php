<?php
/**
 * description:
 * date: 2017-07-15 15:06
 * author: fa.zeng
 * version: 1.0
 */

namespace Aliwuyun\Avatar;

class Avatar
{
    private $names;

    private $avatar;

    private $avatarSize;

    /**
     * Avatar constructor.
     *
     * @param int $avatarSize
     */
    function __construct($avatarSize = 256)
    {
        $this->avatarSize = $avatarSize;
    }

    /**
     * @param $names
     *
     * @return array|resource
     */
    public function create($names)
    {
        $this->names = (new InitName())->getName($names);
        if (is_array($this->names)) {
            foreach ($this->names as $name) {
                $this->avatar[] = (new InitMap($name, $this->avatarSize))->Initialize();
            }
        } else {
            $this->avatar = (new InitMap($this->names, $this->avatarSize))->Initialize();
        }
        if (is_array($this->avatar) && count($this->avatar) > 1) {
            $this->puzzle();
        }
        return $this->avatar;
    }

    /**
     * @param $path
     *
     * @return bool
     */
    public function save($path)
    {
        return imagepng($this->avatar, $path);
    }


    private function puzzle()
    {
        $background = imagecreatetruecolor($this->avatarSize, $this->avatarSize);
        imageSaveAlpha($background, true);
        $BackgroundAlpha = imagecolorallocatealpha($background, 255, 255, 255, 127);
        imagefill($background, 0, 0, $BackgroundAlpha);
        if (function_exists('imageantialias')) {
            imageantialias($background, true);
        }

        $count = count((array)$this->avatar);
        if ($count > 4) {
            array_slice((array)$this->avatar, 0, 4);
        }
        $wrapFlag = array();
        $x = 0;
        $y = 0;
        $width = 0;
        $height = 0;
        $padding = 4;
        switch ($count) {
            case 2:
                $x = 0;
                $y = intval($this->avatarSize / 4);
                $width = intval($this->avatarSize / 2);
                $height = intval($this->avatarSize / 2);
                break;
            case 3:
                $x = $this->avatarSize / 4;
                $y = 0;
                $width = intval($this->avatarSize / 2);
                $height = intval($this->avatarSize / 2);
                $wrapFlag = array(2);
                break;
            case 4:
                $x = 0;
                $y = 0;
                $width = intval($this->avatarSize / 2);
                $height = intval($this->avatarSize / 2);
                $wrapFlag = array(3);
                break;
        }
        foreach ($this->avatar as $k => $avatar) {
            if (in_array($k + 1, $wrapFlag)) {
                $x = 0;
                $y = $y + $height + $padding;
            }
            imagecopyresized($background, $avatar, $x, $y, 0, 0, $width, $height, imagesx($avatar), imagesy($avatar));
            $x = $x + $width + $padding;
        }
        $this->avatar = $background;
    }

    /**
     * @param $targetSize
     *
     * @return bool|resource
     */
    public function resize($targetSize)
    {
        if (isset($this->avatar)) {
            if ($this->avatarSize > $targetSize) {
                $Percent = $targetSize / $this->avatarSize;
                $targetWidth = round($this->avatarSize * $Percent);
                $targetHeight = round($this->avatarSize * $Percent);
                $targetImageData = imagecreatetruecolor($targetWidth, $targetHeight);
                imageSaveAlpha($targetImageData, true);
                $BackgroundAlpha = imagecolorallocatealpha($targetImageData, 255, 255, 255, 127);
                imagefill($targetImageData, 0, 0, $BackgroundAlpha);
                imagecopyresampled($targetImageData, $this->avatar, 0, 0, 0, 0, $targetWidth, $targetHeight, $this->avatarSize, $this->avatarSize);
                $this->avatar = $targetImageData;
                return $targetImageData;
            } else {
                return $this->avatar;
            }
        } else {
            return false;
        }
    }

    /**
     * @param array $img_list
     * @param int $size
     * @return mixed
     */
    public function createGroupAvatar($img_list = [], $size = 0)
    {
        if (empty($img_list)) {
            return false;
        }
        if (count($img_list) < 2) {
            return $img_list[0];
        }
        if ($size) {
            $this->avatarSize = $size;
        }
        $background = imagecreatetruecolor($this->avatarSize, $this->avatarSize);
        imageSaveAlpha($background, true);
        $BackgroundAlpha = imagecolorallocatealpha($background, 255, 255, 255, 127);
        imagefill($background, 0, 0, $BackgroundAlpha);
        if (function_exists('imageantialias')) {
            imageantialias($background, true);
        }

        $count = count($img_list);
        if ($count > 4) {
            array_slice($img_list, 0, 4);
        }
        $wrapFlag = array();
        $x = 0;
        $y = 0;
        $width = 0;
        $height = 0;
        $padding = 4;
        switch ($count) {
            case 2:
                $x = 0;
                $y = intval($this->avatarSize / 4);
                $width = intval($this->avatarSize / 2);
                $height = intval($this->avatarSize / 2);
                break;
            case 3:
                $x = $this->avatarSize / 4;
                $y = 0;
                $width = intval($this->avatarSize / 2);
                $height = intval($this->avatarSize / 2);
                $wrapFlag = array(2);
                break;
            case 4:
                $x = 0;
                $y = 0;
                $width = intval($this->avatarSize / 2);
                $height = intval($this->avatarSize / 2);
                $wrapFlag = array(3);
                break;
        }

        foreach ($img_list as $k => $pic_path) {
            $kk = $k + 1;
            if (in_array($kk, $wrapFlag)) {
                $x = 0;
                $y = $y + $height + $padding;
            }
            $pathInfo = pathinfo($pic_path);
            switch (strtolower($pathInfo['extension'])) {
                case 'jpg':
                case 'jpeg':
                    $imagecreatefromjpeg = 'imagecreatefromjpeg';
                    break;
                case 'png':
                    $imagecreatefromjpeg = 'imagecreatefrompng';
                    break;
                case 'gif':
                default:
                    $imagecreatefromjpeg = 'imagecreatefromstring';
                    $pic_path = file_get_contents($pic_path);
                    break;
            }
            $resource = $imagecreatefromjpeg($pic_path);

            imagecopyresized($background, $resource, $x, $y, 0, 0, $width, $height, imagesx($resource), imagesy($resource)); // 最后两个参数为原始图片宽度和高度，倒数两个参数为copy时的图片宽度和高度
            $x = $x + $width + $padding;
        }
        $this->avatar = $background;
    }
}
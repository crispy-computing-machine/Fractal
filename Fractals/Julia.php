<?php

namespace Fractals;

class Julia extends Fractal {

    private $zoom;

    /**
     * @var int|mixed
     */
    private mixed $moveX;

    /**
     * @var int|mixed
     */
    private mixed $moveY;

    /**
     * @var float|mixed
     */
    private mixed $cr;

    /**
     * @var float|mixed
     */
    private mixed $ci;

    function __construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax, $cr = -0.7, $ci = 0.27015, $zoom = 1, $moveX = 0, $moveY = 0) {
        parent::__construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax);
        $this->cr = $cr;
        $this->ci = $ci;
        $this->zoom = $zoom;
        $this->moveX = $moveX;
        $this->moveY = $moveY;
        $this->width = $width;
        $this->generateImage();
    }

    public function generateImage() {

        $this->image = imagecreatetruecolor($this->width, $this->height);
        imagefill($this->image, 0, 0, imagecolorallocate($this->image, 255, 255, 255));
        for ($x = 0; $x < $this->width; $x++) {
            for ($y = 0; $y < $this->height; $y++) {
                $zx = 1.5 * ($x - $this->width / 2) / ($this->width * $this->zoom / 2) + $this->moveX;
                $zy = ($y - $this->height / 2) / ($this->height * $this->zoom / 2) + $this->moveY;
                $i = $this->max_iterations;
                while ($zx * $zx + $zy * $zy < 4 && $i > 0) {
                    $temp = $zx * $zx - $zy * $zy + $this->cr;
                    $zy = 2.0 * $zx * $zy + $this->ci;
                    $zx = $temp;
                    $i--;
                }

                $color = imagecolorallocate($this->image, $i % 256, ($i * 9) % 256, ($i * 7) % 256);
                imagesetpixel($this->image, $x, $y, $color);
            }
        }

    }

    public function createImage($filename)
    {
        imagepng($this->image, $filename);
        imagedestroy($this->image);
    }
}

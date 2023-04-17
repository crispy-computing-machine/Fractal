<?php
abstract class Fractal {
    protected $width;
    protected $height;
    protected $max_iterations;
    protected $xmin;
    protected $xmax;
    protected $ymin;
    protected $ymax;

    function __construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax) {
        $this->width = $width;
        $this->height = $height;
        $this->max_iterations = $max_iterations;
        $this->xmin = $xmin;
        $this->xmax = $xmax;
        $this->ymin = $ymin;
        $this->ymax = $ymax;
    }

    abstract protected function calculatePixel($x, $y);

    function createImage($filename) {
        $image = imagecreatetruecolor($this->width, $this->height);

        for ($x = 0; $x < $this->width; $x++) {
            for ($y = 0; $y < $this->height; $y++) {
                $color = $this->calculatePixel($x, $y);
                imagesetpixel($image, $x, $y, imagecolorallocate($image, $color, $color, $color));
            }
        }

        imagepng($image, $filename);
    }
}




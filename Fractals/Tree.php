<?php

namespace Fractals;

class Tree extends Fractal {
    private $angle;
    private $angleFactor;
    private $lengthFactor;

    function __construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax, $angle, $lengthFactor = 0.7, $angleFactor = 0.6) {
        parent::__construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax);

        $this->angle = $angle;
        $this->lengthFactor = $lengthFactor;
        $this->angleFactor = $angleFactor;

        // Init
        $this->image = imagecreatetruecolor($this->width, $this->height);
        imagefill($this->image, 0, 0, imagecolorallocate($this->image, 255, 255, 255));
        $this->drawBranch($this->image, imagecolorallocate($this->image, 0, 0, 0), $this->width / 2, $this->height - 100, -$this->angle, $this->height / 4, $this->max_iterations);
    }

    private function drawBranch($image, $color, float $x1, float $y1, float $angle, float $length, int $iterations): void {
        if ($iterations <= 0) {
            return;
        }

        $x2 = $x1 + cos($angle) * $length;
        $y2 = $y1 + sin($angle) * $length;

        imageline($image, round($x1), round($y1), round($x2), round($y2), $color);

        $this->drawBranch($image, $color, $x2, $y2, $angle - $this->angle * $this->angleFactor, $length * $this->lengthFactor, $iterations - 1);
        $this->drawBranch($image, $color, $x2, $y2, $angle + $this->angle * $this->angleFactor, $length * $this->lengthFactor, $iterations - 1);
    }

    /**
     * @param $filename
     * @return void
     */
    function createImage($filename) {
        imagepng($this->image, $filename);
        imagedestroy($this->image);
    }
}

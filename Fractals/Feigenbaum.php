<?php

namespace Fractals;
class Feigenbaum extends Fractal {

    function __construct($width, $height, $max_iterations, $xmin = 2.4, $xmax = 4.0, $ymin = 0, $ymax = 1) {
        parent::__construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax);
        $this->generate();
    }

    public function generate(): void {
        $this->image = imagecreatetruecolor($this->width, $this->height);
        $black = imagecolorallocate($this->image, 0, 0, 0);
        $white = imagecolorallocate($this->image, 255, 255, 255);
        imagefill($this->image, 0, 0, $white);

        for ($i = 0; $i < $this->width; $i++) {
            $r = $this->xmin + $i * ($this->xmax - $this->xmin) / $this->width;
            $x = 0.5;

            for ($j = 0; $j < $this->max_iterations; $j++) {
                $x = $r * $x * (1 - $x);

                if ($j > $this->max_iterations / 2) {
                    $y = (int)(($x - $this->ymin) / ($this->ymax - $this->ymin) * $this->height);

                    if ($y >= 0 && $y < $this->height) {
                        $color = imagecolorallocate($this->image, $i % 256, ($i * 9) % 256, ($i * 7) % 256);
                        imagesetpixel($this->image, $i, $this->height - $y, $color);
                    }
                }
            }
        }
    }

    public function createImage($filename)
    {
        imagepng($this->image, $filename);
        imagedestroy($this->image);
    }
}
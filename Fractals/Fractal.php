<?php
namespace Fractals;
class Fractal {
    protected $width;
    protected $height;
    protected $max_iterations;
    protected $xmin;
    protected $xmax;
    protected $ymin;
    protected $ymax;
    protected $image;

    function __construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax) {
        $this->width = $width;
        $this->height = $height;
        $this->max_iterations = $max_iterations;
        $this->xmin = $xmin;
        $this->xmax = $xmax;
        $this->ymin = $ymin;
        $this->ymax = $ymax;
    }

    function createImage($filename) {
        $this->image = imagecreatetruecolor($this->width, $this->height);
        imagefill($this->image, 0, 0, imagecolorallocate($this->image, 255, 255, 255));
        for ($x = 0; $x < $this->width; $x++) {
            for ($y = 0; $y < $this->height; $y++) {
                $color = $this->calculatePixel($x, $y);
                if(is_array($color)){
                    [$r, $g, $b] = $color;
                    imagesetpixel($this->image, $x, $y, imagecolorallocate($this->image, $r, $g, $b)); // random alpha?
                } else {
                    imagesetpixel($this->image, $x, $y, imagecolorallocate($this->image, $color, $color, $color));
                }
            }
        }

        imagepng($this->image, $filename);
    }

    function displayProgressBar(int $current, int $total): void {
        $width = 50; // The width of the progress bar
        $percent = (int)(($current / $total) * 100);
        $progress = (int)(($current / $total) * $width);

        // Build the progress bar string
        $progressBar = '[';
        for ($i = 0; $i < $width; $i++) {
            if ($i < $progress) {
                $progressBar .= '=';
            } elseif ($i === $progress) {
                $progressBar .= '>';
            } else {
                $progressBar .= ' ';
            }
        }
        $progressBar .= ']';

        // Print the progress bar with the percentage
        printf("\r%s %d %%", $progressBar, $percent);

        // If the task is complete, print a newline
        if ($current === $total) {
            echo PHP_EOL;
        }
    }
}




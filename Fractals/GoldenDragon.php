<?php

namespace Fractals;

class GoldenDragon extends Fractal {
    function __construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax) {
        parent::__construct($width, $height, $max_iterations, $xmin, $xmax, $ymin, $ymax);

        $this->image = imagecreatetruecolor($this->width, $this->height);
        imagefill($this->image, 0, 0, imagecolorallocate($this->image, 255, 255, 255));
        $this->generateFractal();
    }

    private function generateFractal(): void {

        $line = imagecolorallocate($this->image, 0, 0, 0);

        /**
        *     Right-Angled Dragon (90 degrees)
        *     Angle1: 90 degrees (pi / 2 radians)
        *     Angle2: -90 degrees (-pi / 2 radians)

        *     Sierpinski Arrowhead Curve (60 degrees)
        *     Angle1: 60 degrees (pi / 3 radians)
        *     Angle2: -60 degrees (-pi / 3 radians)

        *     Twin Dragon (90 degrees)
        *     Angle1: 45 degrees (pi / 4 radians)
        *     Angle2: -45 degrees (-pi / 4 radians)

        *     Levy C curve (45 degrees)
        *     Angle1: 45 degrees (pi / 4 radians)
        *     Angle2: -45 degrees (-pi / 4 radians)
        *
        *     To use any of these angles, simply modify the $angle1 and $angle2 variables in the generateFractal() method. However, keep in mind that you might also need to modify the axiom and rules to produce the desired fractal pattern for some of these angles. Here's the modified generateFractal() method with angle variables:
        */
        $angle1 = deg2rad(90);
        $angle2 = deg2rad(-90);
        $axiom = ['F', 'X'];
        $rules = [
            'X' => ['X', '+', 'Y', 'F'],
            'Y' => ['F', 'X', '-', 'Y'],
        ];

        $sequence = $axiom;

        // Generate the L-system sequence
        for ($i = 0; $i < $this->max_iterations; $i++) {
            $newSequence = [];
            foreach ($sequence as $char) {
                if (isset($rules[$char])) {
                    $newSequence = array_merge($newSequence, $rules[$char]);
                } else {
                    $newSequence[] = $char;
                }
            }
            $sequence = $newSequence;
            #$this->displayProgressBar($i, $this->max_iterations);
        }

        // Draw the L-system sequence
        $x = $this->width / 2;
        $y = $this->height / 2;
        $direction = 0;
        $stack = [];
        $total = count($sequence);
        $i = 0;
        foreach ($sequence as $char) {
            switch ($char) {
                case 'F':
                    $x2 = $x + cos($direction) * 2;
                    $y2 = $y + sin($direction) * 2;
                    imageline($this->image, round($x), round($y), round($x2), round($y2), $line);
                    $x = $x2;
                    $y = $y2;
                    break;
                case '+':
                    $direction += $angle1;
                    break;
                case '-':
                    $direction += $angle2;
                    break;
                case '[':
                    array_push($stack, [$x, $y, $direction]);
                    break;
                case ']':
                    [$x, $y, $direction] = array_pop($stack);
                    break;
            }
            #$this->displayProgressBar($i, $total);
            $i++;
        }
    }

    /**
     * @param $filename
     * @return void
     */
    function createImage($filename) {
        imagepng($this->image, $filename);
        imagedestroy($this->image);
    }

    protected function calculatePixel($x, $y)
    {
        // Uses imageline so we can't use getpixel
    }
}

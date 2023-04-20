<?php

namespace Fractals;

class Mandelbrot extends Fractal {
    protected function calculatePixel($x, $y) {
        $real = $this->xmin + ($x / $this->width) * ($this->xmax - $this->xmin);
        $imag = $this->ymin + ($y / $this->height) * ($this->ymax - $this->ymin);

        $zr = $zi = $zr2 = $zi2 = 0;
        $i = 0;

        while ($i < $this->max_iterations && ($zr2 + $zi2) < 4) {
            $zi = 2 * $zr * $zi + $imag;
            $zr = $zr2 - $zi2 + $real;
            $zr2 = $zr * $zr;
            $zi2 = $zi * $zi;
            $i++;
        }

        return $i == $this->max_iterations ? 0 : 255 - (int)(log($i) * 10);
    }
}
<?php declare(strict_types=1);

namespace WyriHaximus\CssCompress\Compressor;

use WyriHaximus\Compress\CompressorInterface;
use YUI\Compressor as YUICompressor;

final class YUICSSCompressor implements CompressorInterface
{
    /** @var YUICompressor */
    private $yui;

    public function __construct()
    {
        $this->yui = new YUICompressor();
        $this->yui->setType(YUICompressor::TYPE_CSS);
    }

    public function compress(string $string): string
    {
        try {
            return $this->yui->compress($string);
        } catch (\Throwable $exception) {
            return $string;
        }
    }
}

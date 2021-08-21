<?php

namespace Predmond\HtmlToAmp\Converter\Extensions;

use League\Event\EventInterface;
use League\Event\EmitterInterface;
use Predmond\HtmlToAmp\ElementInterface;
use Predmond\HtmlToAmp\Converter\ConverterInterface;

/**
 * Class CloudinaryImageConverter
 *
 * An HTML Image to <amp-img /> Converter using Cloudinary
 *
 * @package Predmond\HtmlToAmp\Converter\Extensions
 * @see http://cloudinary.com/
 */
class CloudinaryImageConverter implements ConverterInterface
{
    /**
     * @param ElementInterface $element
     *
     * @return string
     */
    public function handleTagImg(EventInterface $event, ElementInterface $element)
    {

        // Should mutate all images and stop propagation
        if (function_exists('cloudinary_url')) {
            $src = $element->getAttribute('src');
            $width = $element->getAttribute('width');
            $height = $element->getAttribute('height');
            $sizes = $this->generateSizes();
            $srcset = $this->generateSrcset($src);

            $urlConfig = [
                'width' => 400,
                'height' => 225,
                'crop' => 'limit',
                'sign_url' => true,
                'type' => 'fetch',
                'effect' => 'sharpen',
            ];

            if ($width < 100 || $height < 100) {
                $width = $urlConfig['width'];
                $height = $urlConfig['height'];
            } else {
                $urlConfig['width'] = $width;
                $urlConfig['height'] = $height;
            }

            // Create the responsive <amp-img /> tag
            $ampImg = $element->createWritableElement('amp-img');
            $ampImg->setAttribute(
                'src',
                cloudinary_url($src, $urlConfig)
            );
            $ampImg->setAttribute('width', $width);
            $ampImg->setAttribute('height', $height);
            $ampImg->setAttribute('sizes', $sizes);
            $ampImg->setAttribute('srcset', $srcset);
            $ampImg->setAttribute('layout', 'responsive');
            $ampImg->setAttribute('alt', $element->getAttribute('alt'));
            $ampImg->setAttribute('attribution', $element->getAttribute('attribution'));
            $ampImg->setAttribute('class', 'amp-img');
            $element->replaceWith($ampImg);

            $event->stopPropagation();
        }
    }

    public function getSubscribedEvents()
    {
        return [
            'img' => ['handleTagImg', EmitterInterface::P_HIGH]
        ];
    }

    /**
     * Generate the <amp-img srcset=""> Attribute
     *
     * @param string $src the original source image
     * @return string
     */
    private function generateSrcset($src)
    {
        return implode(', ', [
            cloudinary_url($src, [
                'width' => 700,
                'crop' => 'limit',
                'sign_url' => true,
                'type' => 'fetch',
                'effect' => 'sharpen'
            ]) . ' 700w',
            cloudinary_url($src, [
                'width' => 465,
                'crop' => 'limit',
                'sign_url' => true,
                'type' => 'fetch',
                'effect' => 'sharpen'
            ]) . ' 465w',
        ]);
    }

    /**
     * Get <amp-img sizes=""> attribute value
     *
     * @return string
     */
    private function generateSizes()
    {
        return implode(', ', [
            '(min-width: 600px) 600px',
            '100vw'
        ]);
    }
}

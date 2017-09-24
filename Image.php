<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yiichina\mdeditor;

use Yii;
use yii\imagine\BaseImage;
use Imagine\Image\Box;
use Imagine\Image\Color;
use Imagine\Image\ImageInterface;
use Imagine\Image\ManipulatorInterface;

/**
 * Image implements most commonly used image manipulation functions using the [Imagine library](http://imagine.readthedocs.org/).
 *
 * Example of use:
 *
 * ~~~php
 * // generate a thumbnail image
 * Image::thumbnail('@webroot/img/test-image.jpg', 120, 120)
 *     ->save(Yii::getAlias('@runtime/thumb-test-image.jpg'), ['quality' => 50]);
 * ~~~
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Image extends BaseImage
{
	/**
     * Creates a thumbnail image. The function differs from `\Imagine\Image\ImageInterface::thumbnail()` function that
     * it keeps the aspect ratio of the image.
     * @param string $filename the image file path or path alias.
     * @param integer $width the width in pixels to create the thumbnail
     * @param integer $height the height in pixels to create the thumbnail
     * @param string $mode
     * @return ImageInterface
     */
    public static function thumbnail($filename, $width, $height, $mode = ManipulatorInterface::THUMBNAIL_OUTBOUND)
    {
        $box = new Box($width, $height);
        $img = static::getImagine()->open(Yii::getAlias($filename));

        if (($img->getSize()->getWidth() <= $box->getWidth() && $img->getSize()->getHeight() <= $box->getHeight()) || (!$box->getWidth() && !$box->getHeight())) {
            return $img->copy();
        }

        $img = $img->thumbnail($box, $mode);

        return $img;
    }
}

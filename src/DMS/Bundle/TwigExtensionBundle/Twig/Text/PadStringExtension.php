<?php
namespace DMS\Bundle\TwigExtensionBundle\Twig\Text;

/**
 * Adds support for Padding a String in Twig
 */
class PadStringExtension extends \Twig_Extension
{
    /**
     * Name of Extension
     *
     * @return string
     */
    public function getName()
    {
        return 'PadStringExtension';
    }

    /**
     * Available filters
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            'padString' => new \Twig_Filter_Method($this, 'padStringFilter'),
        );
    }

    /**
     * Pads string on right or left with given padCharacter until string
     * reaches maxLength
     *
     * @param string  $value
     * @param string  $padCharacter
     * @param int     $maxLength
     * @param bool    $padLeft
     * @return string
     * @throws \InvalidArgumentException
     */
    public function padStringFilter($value, $padCharacter, $maxLength, $padLeft = true)
    {
        if ( ! is_int($maxLength) ) {
            throw new \InvalidArgumentException('Pad String Filter expects its second argument to be an integer');
        }

        if (function_exists('mb_strlen')) {
            $padLength = $maxLength - mb_strlen($value);
        } else {
            $padLength = $maxLength - strlen($value);
        }

        if ($padLength <= 0) {
            return $value;
        }

        $padString = str_repeat($padCharacter, $padLength);

        if ($padLeft) {
            return $padString . $value;
        }

        return $value . $padString;
    }
}

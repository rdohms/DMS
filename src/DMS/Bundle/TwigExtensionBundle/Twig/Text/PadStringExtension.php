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
     * @param string  $padType
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function padStringFilter($value, $padCharacter, $maxLength, $padType = 'STR_PAD_RIGHT')
    {
        if ( ! is_int($maxLength)) {
            throw new \InvalidArgumentException('Pad String Filter expects its second argument to be an integer');
        }
        $diff = strlen($value) - mb_strlen($value);
        $padType = constant($padType);

        return str_pad($value, $maxLength + $diff, $padCharacter, $padType);
    }
}

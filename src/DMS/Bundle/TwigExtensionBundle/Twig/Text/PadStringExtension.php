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
        if ($this->isNullOrEmptyString($padCharacter)) {
            throw new \InvalidArgumentException('Pad String Filter cannot accept a null value or empty string as its first argument');
        }
        if ( ! is_int($maxLength)) {
            throw new \InvalidArgumentException('Pad String Filter expects its second argument to be an integer');
        }
        $diff = (function_exists('mb_strlen'))? strlen($value) - mb_strlen($value) : 0;
        $padType = constant($padType);

        return str_pad($value, $maxLength + $diff, $padCharacter, $padType);
    }

    /**
     * Make sure a padCharacter is provided
     *
     * @param $padCharacter
     * @return bool
     */
    protected function isNullOrEmptyString($padCharacter)
    {
        return (!isset($padCharacter) || trim($padCharacter)==='' || is_null($padCharacter));
    }
}

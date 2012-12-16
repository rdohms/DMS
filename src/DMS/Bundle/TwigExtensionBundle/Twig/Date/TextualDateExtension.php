<?php
namespace DMS\Bundle\TwigExtensionBundle\Twig\Date;

/**
 * Adds support for Textual Dates in Twig
 */
class TextualDateExtension extends \Twig_Extension {

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Translation\Translator
     */
    protected $translator;

    /**
     * @param \Symfony\Bundle\FrameworkBundle\Translation\Translator $translator
     */
    public function __construct($translator)
    {
        $this->translator = $translator;
    }

    /**
     * Name of Extension
     *
     * @return string
     */
    public function getName()
    {
        return 'TextualDateExtension';
    }

    /**
     * Available filters
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            'textualDate'    => new \Twig_Filter_Method($this, 'textualDateFilter')
        );
    }

    /**
     * Converts dates into relative textual dates
     *
     * Ex: x days ago, yesterday, tomorrow, in x days
     *
     * @param \DateTime $date
     *
     * @throws \InvalidArgumentException
     * @return string
     */
    public function textualDateFilter($date)
    {
        if ( ! $date instanceof \DateTime) {
            throw new \InvalidArgumentException('Textual Date Filter expects input to be a instance of DateTime');
        }

        $now  = new \DateTime('now');
        $diff = $now->diff($date);

        $diffUnit          = $this->getHighestDiffUnitAndValue($diff);
        $temporalModifier  = ($diff->invert)? 'ago':'next';
        $translationString = $temporalModifier. '.' .$diffUnit['unit'];

        // Override yesterday and tomorrow
        if ($diffUnit['unit'] == 'd' && $diffUnit['value'] == 1) {
            $translationString = ($diff->invert)? 'date.yesterday':'date.tomorrow';
        }

        // Override "just.now"
        if ($diffUnit['unit'] == 'now') {
            $translationString = 'date.just_now';
        }

        return $this->translator->transChoice($translationString, $diffUnit['value'], array('%value%' => $diffUnit['value']), 'date');
    }

    /**
     * Returns the highest unit and its value in a diff.
     *
     * @param \DateInterval $diff
     * @return array
     */
    protected function getHighestDiffUnitAndValue($diff)
    {
        // Manually define props due to Reflection Bug #53439 (PHP)
        $properties = array('y', 'm', 'd', 'h', 'i', 's');

        foreach($properties as $prop) {
            if ($diff->$prop > 0) {
                return array('unit' => $prop, 'value' => $diff->$prop);
            }
        }

        return array('unit' => 'now', 'value' => 0);
    }
}

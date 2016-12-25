<?php
namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('minimize', array($this, 'minimizeFilter')),
        );
    }

    public function minimizeFilter($string)
    {

        return strtolower($string);
    }

    public function getName()
    {
        return 'app_extension';
    }
}
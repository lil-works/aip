<?php
namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('minimize', array($this, 'minimizeFilter')),
            new \Twig_SimpleFilter('formatBytes', array($this, 'formatBytesFilter')),
        );
    }

    public function minimizeFilter($string)
    {

        return strtolower($string);
    }

    function formatBytesFilter($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }


    public function getName()
    {
        return 'app_extension';
    }
}
<?php
// src/AppBundle/Menu/MenuBuilder.php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MenuBuilder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private $factory;
    protected $em;
    protected $router;


    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory,\Doctrine\ORM\EntityManager $em,  ContainerInterface $container  )
    {
        $this->factory = $factory;
        $this->em = $em;
        $this->container = $container;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('main', array('childrenAttributes' => array('class' => 'nav nav-pills pull-right')));

        $menu->addChild('Home', array('route' => 'site_homepage'));
        $menu->addChild('GeoIp', array('route' => 'site_geoip'));
        $menu->addChild('Whois', array('route' => 'site_whois'));
        $menu->addChild('Ping', array('route' => 'site_ping'));
        $menu->addChild('PDF compressor', array('route' => 'site_pdf_compressor'));

        $menu->setExtra('translation_domain', 'AppBundle');

        return $menu;
    }
    public function createLangMenu(array $options)
    {

        $request = $this->container->get('request_stack');
        $params = $request->getCurrentRequest()->get('_route_params');
        $route = $request->getCurrentRequest()->get('_route');

        $menu = $this->factory->createItem('Available language', array('childrenAttributes' => array('class' => 'nav nav-pills pull-right')));

        $paramsEn = $paramsFr = $paramsEs = $params;
        $paramsEn["_locale"] = "en";
        $menu->addChild("English", array(
            'route' => $route,
            'routeParameters' => $paramsEn,
            'extra'=>array('icon'=>"en")

        ));

        $paramsFr["_locale"] = "fr";
        $menu->addChild("French", array(
            'route' =>$route,
            'routeParameters' => $paramsFr,
            'extra'=>array('icon'=>"fr")
        ));

        $paramsEs["_locale"] = "es";
        $menu->addChild("Spanish", array(
            'route' => $route,
            'routeParameters' => $paramsEs,
            'extra'=>array('icon'=>"es")

        ));
        $menu->setExtra('translation_domain', 'AppBundle');
        return $menu;
    }


}
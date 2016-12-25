<?php
namespace AppBundle\Services;



use Symfony\Component\Form\Extension\Templating\TemplatingExtension;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ClientInfo implements ContainerAwareInterface
{
    use ContainerAwareTrait;


    protected $templating;


    public function __construct( $templating ,  ContainerInterface $container  )
    {
        $this->templating = $templating;
        $this->container = $container;
    }
    function getBrowser(){
        $user_agent = getenv("HTTP_USER_AGENT");

        if ((strpos($user_agent, "Nav") !== FALSE) || (strpos($user_agent, "Gold") !== FALSE) ||
            (strpos($user_agent, "X11") !== FALSE) || (strpos($user_agent, "Mozilla") !== FALSE) ||
            (strpos($user_agent, "Netscape") !== FALSE)
            AND (!strpos($user_agent, "MSIE") !== FALSE)
            AND (!strpos($user_agent, "Konqueror") !== FALSE)
            AND (!strpos($user_agent, "Firefox") !== FALSE)
            AND (!strpos($user_agent, "Safari") !== FALSE))
            $browser = "Netscape";
        elseif (strpos($user_agent, "Opera") !== FALSE)
            $browser = "Opera";
        elseif (strpos($user_agent, "MSIE") !== FALSE)
            $browser = "MSIE";
        elseif (strpos($user_agent, "Lynx") !== FALSE)
            $browser = "Lynx";
        elseif (strpos($user_agent, "WebTV") !== FALSE)
            $browser = "WebTV";
        elseif (strpos($user_agent, "Konqueror") !== FALSE)
            $browser = "Konqueror";
        elseif (strpos($user_agent, "Safari") !== FALSE)
            $browser = "Safari";
        elseif (strpos($user_agent, "Firefox") !== FALSE)
            $browser = "Firefox";
        elseif ((stripos($user_agent, "bot") !== FALSE) || (strpos($user_agent, "Google") !== FALSE) ||
            (strpos($user_agent, "Slurp") !== FALSE) || (strpos($user_agent, "Scooter") !== FALSE) ||
            (stripos($user_agent, "Spider") !== FALSE) || (stripos($user_agent, "Infoseek") !== FALSE))
            $browser = "Bot";
        else
            $browser = "Autre";

        return $browser;
    }

    private function getBrowserIco($bn){
        switch ($bn){
            case 'Netscape':
                return 'NS.png';
                break;
            case 'Opera':
                return 'OP.png';
                break;
            case 'MSIE':
                return 'IE.png';
                break;
            case 'Lynx':
                return 'LX.png';
                break;
            case 'WebTV':
                return 'XX.png';
                break;
            case 'Konqueror':
                return 'KO.png';
                break;
            case 'Safari':
                return 'SF.png';
                break;
            case 'Firefox':
                return 'FF.png';
                break;
            case 'Bot':
                return 'BX.png';
                break;
            case 'Autre':
                return 'XX.png';
                break;
        }
    }

    private function getOsIco($bn){
        switch ($bn){
            case 'Windows':
                return 'WXP.png';
                break;
            case 'Mac':
                return 'MAC.png';
                break;
            case 'Linux':
                return 'LIN.png';
                break;
            case 'Lynx':
                return 'LX.png';
                break;
            case 'FreeBSD':
                return 'BSD.png';
                break;
            case 'SunOS':
                return 'SOS.png';
                break;
            case 'IRIX':
                return 'IRI.png';
                break;
            case 'BeOS':
                return 'NBS.png';
                break;
            case 'OS/2':
                return 'OS2.png';
                break;
            case 'AIX':
                return 'AIX.png';
                break;
            case 'Autre':
                return 'XX.png';
                break;
        }
    }

    /*
     * Get OS
     */
    private function getOs(){
        $user_agent = getenv("HTTP_USER_AGENT");
        if (strpos($user_agent, "Win") !== FALSE)
            $os = "Windows";
        elseif ((strpos($user_agent, "Mac") !== FALSE) || (strpos($user_agent, "PPC") !== FALSE))
            $os = "Mac";
        elseif (strpos($user_agent, "Linux") !== FALSE)
            $os = "Linux";
        elseif (strpos($user_agent, "FreeBSD") !== FALSE)
            $os = "FreeBSD";
        elseif (strpos($user_agent, "SunOS") !== FALSE)
            $os = "SunOS";
        elseif (strpos($user_agent, "IRIX") !== FALSE)
            $os = "IRIX";
        elseif (strpos($user_agent, "BeOS") !== FALSE)
            $os = "BeOS";
        elseif (strpos($user_agent, "OS/2") !== FALSE)
            $os = "OS/2";
        elseif (strpos($user_agent, "AIX") !== FALSE)
            $os = "AIX";
        else
            $os = false;
        return $os;
    }

    /*
     * Test sur une ip
     */
    private function checkIp($ip){
        if (ereg("^(((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]{1}[0-9]|[1-9]).)".
            "{1}((25[0-5]|2[0-4][0-9]|[1]{1}[0-9]{2}|[1-9]{1}[0-9]|[0-9]).)".
            "{2}((25[0-5]|2[0-4][0-9]|[1]{1}[0-9]{2}|[1-9]{1}[0-9]|[0-9]){1}))$",$ip)){
            return true;
        }
    }


    public function createView(){

        return  $this->templating->render('Services/client-info.html.twig', array(
            "ip"=>$_SERVER['REMOTE_ADDR'],
            "os"=>$this->getOs(),
            "osIco"=>$this->getOsIco($this->getOs()),
            "browser"=>$this->getBrowser(),
            "browserIco"=>$this->getBrowserIco($this->getBrowser())

        ));
    }
}
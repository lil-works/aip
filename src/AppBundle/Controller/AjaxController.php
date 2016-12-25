<?php

namespace AppBundle\Controller;

use AppBundle\Form\PingType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;

class AjaxController extends Controller
{

    public function readTextfileAction(Request $request,$filename)
    {
        $response = new Response();
        $sessionId = $request->getSession()->getId();


        $process = new Process("cat ".$sessionId."_".$filename.".txt");
        $process->run();

        $response->setContent(json_encode($process->getOutput()));



        return $response;
    }

}

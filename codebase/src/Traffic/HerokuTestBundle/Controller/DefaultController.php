<?php

namespace Traffic\HerokuTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Imagine;
use Imagine\Image\Point;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $web_root = $this->get('kernel')->getRootDir().'/../web';
        $face = $web_root.'/images/face.png';
        $tache = $web_root.'/images/tache.png';
        $imagine = $this->get('liip_imagine');
        $imagine_face  = $imagine->read(fopen($face, 'r'));
        $imagine_tache = $imagine->read(fopen($tache, 'r'));
        

        $point = new Point(35, 110);
        $imagine_face->paste($imagine_tache, $point);
        
        $merged = $web_root.'/images/merged.png';
        $imagine_face->save($merged);
        return array();
    }
}

<?php

namespace FTV\FrontBundle\Controller;

use FTV\APIBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ArticlesController extends Controller
{
    /**
     * @Route("/")
     */
    public function listArticlesAction()
    {
        return $this->render('FTVFrontBundle:Articles:list.html.twig');
    }

    /**
     * @Route("/article/{slug}")
     */
    public function viewArticleAction($slug)
    {
        // @todo : call api get_article_by_slug

        return $this->render('FTVFrontBundle:Articles:view.html.twig', [
            //'article' => $article
        ]);
    }

    /**
     * @Route("/creer")
     */
    public function createArticleAction()
    {
        return $this->render('FTVFrontBundle:Articles:create.html.twig');
    }
}

<?php

namespace FTV\APIBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FTV\APIBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use FTV\APIBundle\Entity\Article;

/**
 * Class ArticlesController
 */
class ArticlesController extends FOSRestController
{
    /**
     * Retrieve all articles.
     *
     * @return array
     *
     * @Rest\View()
     */
    public function getArticlesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('FTVAPIBundle:Article')->findAll();

        return array('articles' => $articles);
    }

    /**
     * Retrieve an article by its slug.
     *
     * @param Article $article
     * @return array
     *
     * @Route(
     *     "/articles/{slug}.{_format}",
     *     name="get_article_by_slug",
     *     defaults={"_format" = "json"},
     *     requirements={
     *       "_format": "json|xml"
     *     }
     * )
     * @Method("GET")
     *
     * @Rest\View()
     *
     * @ParamConverter("article", class="FTVAPIBundle:Article", options={"mapping": {"slug": "slug"}})
     */
    public function _getArticleBySlugAction(Article $article)
    {
        return array('article' => $article);
    }

    /**
     * Delete an article.
     *
     * @param Article $article
     *
     * @Rest\View(statusCode=204)
     *
     * @ParamConverter("article", class="FTVAPIBundle:Article")
     */
    public function deleteArticleAction(Article $article)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($article);
        $em->flush();
    }

    /**
     * Create an article.
     *
     * @param Request $request
     * @return View
     *
     * @Rest\View()
     */
    public function postArticlesAction(Request $request)
    {
        $article = new Article();

        return $this->processForm($request, $article);
    }

    /**
     * Process form : validate and hydrate the Article Object.
     *
     * @param Request $request
     * @param Article $article
     *
     * @return View
     */
    private function processForm(Request $request, Article $article)
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->submit($request->request->all(), $request->getMethod());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $routeOptions = array(
                'slug'    => $article->getSlug(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('get_article_by_slug', $routeOptions, Codes::HTTP_CREATED);
        }

        return View::create($form, Codes::HTTP_BAD_REQUEST);
    }
}
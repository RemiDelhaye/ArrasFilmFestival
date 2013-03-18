<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appprodUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appprodUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        // back_office_homepage
        if (rtrim($pathinfo, '/') === '/panel') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'back_office_homepage');
            }

            return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\DefaultController::indexAction',  '_route' => 'back_office_homepage',);
        }

        if (0 === strpos($pathinfo, '/panel/article')) {
            // article
            if (rtrim($pathinfo, '/') === '/panel/article') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'article');
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\ArticleController::indexAction',  '_route' => 'article',);
            }

            // article_show
            if (preg_match('#^/panel/article/(?P<id>[^/]+)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\ArticleController::showAction',)), array('_route' => 'article_show'));
            }

            // article_new
            if ($pathinfo === '/panel/article/new') {
                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\ArticleController::newAction',  '_route' => 'article_new',);
            }

            // article_create
            if ($pathinfo === '/panel/article/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_article_create;
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\ArticleController::createAction',  '_route' => 'article_create',);
            }
            not_article_create:

            // article_edit
            if (preg_match('#^/panel/article/(?P<id>[^/]+)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\ArticleController::editAction',)), array('_route' => 'article_edit'));
            }

            // article_update
            if (preg_match('#^/panel/article/(?P<id>[^/]+)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_article_update;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\ArticleController::updateAction',)), array('_route' => 'article_update'));
            }
            not_article_update:

            // article_delete
            if (preg_match('#^/panel/article/(?P<id>[^/]+)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_article_delete;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\ArticleController::deleteAction',)), array('_route' => 'article_delete'));
            }
            not_article_delete:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}

<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appdevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appdevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
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

        // _wdt
        if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::toolbarAction',)), array('_route' => '_wdt'));
        }

        if (0 === strpos($pathinfo, '/_profiler')) {
            // _profiler_search
            if ($pathinfo === '/_profiler/search') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchAction',  '_route' => '_profiler_search',);
            }

            // _profiler_purge
            if ($pathinfo === '/_profiler/purge') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::purgeAction',  '_route' => '_profiler_purge',);
            }

            // _profiler_info
            if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::infoAction',)), array('_route' => '_profiler_info'));
            }

            // _profiler_import
            if ($pathinfo === '/_profiler/import') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::importAction',  '_route' => '_profiler_import',);
            }

            // _profiler_export
            if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?P<token>[^/\\.]+)\\.txt$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::exportAction',)), array('_route' => '_profiler_export'));
            }

            // _profiler_phpinfo
            if ($pathinfo === '/_profiler/phpinfo') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::phpinfoAction',  '_route' => '_profiler_phpinfo',);
            }

            // _profiler_search_results
            if (preg_match('#^/_profiler/(?P<token>[^/]+)/search/results$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchResultsAction',)), array('_route' => '_profiler_search_results'));
            }

            // _profiler
            if (preg_match('#^/_profiler/(?P<token>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::panelAction',)), array('_route' => '_profiler'));
            }

            // _profiler_redirect
            if (rtrim($pathinfo, '/') === '/_profiler') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_profiler_redirect');
                }

                return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => '_profiler_search_results',  'token' => 'empty',  'ip' => '',  'url' => '',  'method' => '',  'limit' => '10',  '_route' => '_profiler_redirect',);
            }

        }

        if (0 === strpos($pathinfo, '/_configurator')) {
            // _configurator_home
            if (rtrim($pathinfo, '/') === '/_configurator') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_configurator_home');
                }

                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
            }

            // _configurator_step
            if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',)), array('_route' => '_configurator_step'));
            }

            // _configurator_final
            if ($pathinfo === '/_configurator/final') {
                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
            }

        }

        // front_office_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'front_office_homepage');
            }

            return array (  '_controller' => 'ArrasFilmFestival\\FrontOfficeBundle\\Controller\\PageController::homeAction',  '_route' => 'front_office_homepage',);
        }

        // back_office_home
        if (rtrim($pathinfo, '/') === '/panel') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'back_office_home');
            }

            return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PageController::homeAction',  '_route' => 'back_office_home',);
        }

        if (0 === strpos($pathinfo, '/panel/photo')) {
            // photo
            if (rtrim($pathinfo, '/') === '/panel/photo') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'photo');
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PhotoController::indexAction',  '_route' => 'photo',);
            }

            // photo_show
            if (preg_match('#^/panel/photo/(?P<id>[^/]+)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PhotoController::showAction',)), array('_route' => 'photo_show'));
            }

            // photo_new
            if ($pathinfo === '/panel/photo/new') {
                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PhotoController::newAction',  '_route' => 'photo_new',);
            }

            // photo_create
            if ($pathinfo === '/panel/photo/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_photo_create;
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PhotoController::createAction',  '_route' => 'photo_create',);
            }
            not_photo_create:

            // photo_edit
            if (preg_match('#^/panel/photo/(?P<id>[^/]+)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PhotoController::editAction',)), array('_route' => 'photo_edit'));
            }

            // photo_update
            if (preg_match('#^/panel/photo/(?P<id>[^/]+)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_photo_update;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PhotoController::updateAction',)), array('_route' => 'photo_update'));
            }
            not_photo_update:

            // photo_delete
            if (preg_match('#^/panel/photo/(?P<id>[^/]+)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_photo_delete;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PhotoController::deleteAction',)), array('_route' => 'photo_delete'));
            }
            not_photo_delete:

        }

        if (0 === strpos($pathinfo, '/panel/video')) {
            // video
            if (rtrim($pathinfo, '/') === '/panel/video') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'video');
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\VideoController::indexAction',  '_route' => 'video',);
            }

            // video_show
            if (preg_match('#^/panel/video/(?P<id>[^/]+)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\VideoController::showAction',)), array('_route' => 'video_show'));
            }

            // video_new
            if ($pathinfo === '/panel/video/new') {
                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\VideoController::newAction',  '_route' => 'video_new',);
            }

            // video_create
            if ($pathinfo === '/panel/video/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_video_create;
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\VideoController::createAction',  '_route' => 'video_create',);
            }
            not_video_create:

            // video_edit
            if (preg_match('#^/panel/video/(?P<id>[^/]+)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\VideoController::editAction',)), array('_route' => 'video_edit'));
            }

            // video_update
            if (preg_match('#^/panel/video/(?P<id>[^/]+)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_video_update;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\VideoController::updateAction',)), array('_route' => 'video_update'));
            }
            not_video_update:

            // video_delete
            if (preg_match('#^/panel/video/(?P<id>[^/]+)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_video_delete;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\VideoController::deleteAction',)), array('_route' => 'video_delete'));
            }
            not_video_delete:

        }

        if (0 === strpos($pathinfo, '/panel/podcast')) {
            // podcast
            if (rtrim($pathinfo, '/') === '/panel/podcast') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'podcast');
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PodcastController::indexAction',  '_route' => 'podcast',);
            }

            // podcast_show
            if (preg_match('#^/panel/podcast/(?P<id>[^/]+)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PodcastController::showAction',)), array('_route' => 'podcast_show'));
            }

            // podcast_new
            if ($pathinfo === '/panel/podcast/new') {
                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PodcastController::newAction',  '_route' => 'podcast_new',);
            }

            // podcast_create
            if ($pathinfo === '/panel/podcast/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_podcast_create;
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PodcastController::createAction',  '_route' => 'podcast_create',);
            }
            not_podcast_create:

            // podcast_edit
            if (preg_match('#^/panel/podcast/(?P<id>[^/]+)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PodcastController::editAction',)), array('_route' => 'podcast_edit'));
            }

            // podcast_update
            if (preg_match('#^/panel/podcast/(?P<id>[^/]+)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_podcast_update;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PodcastController::updateAction',)), array('_route' => 'podcast_update'));
            }
            not_podcast_update:

            // podcast_delete
            if (preg_match('#^/panel/podcast/(?P<id>[^/]+)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_podcast_delete;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PodcastController::deleteAction',)), array('_route' => 'podcast_delete'));
            }
            not_podcast_delete:

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

        if (0 === strpos($pathinfo, '/panel/user')) {
            // user
            if (rtrim($pathinfo, '/') === '/panel/user') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'user');
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\UserController::indexAction',  '_route' => 'user',);
            }

            // user_show
            if (preg_match('#^/panel/user/(?P<id>[^/]+)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\UserController::showAction',)), array('_route' => 'user_show'));
            }

            // user_new
            if ($pathinfo === '/panel/user/new') {
                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\UserController::newAction',  '_route' => 'user_new',);
            }

            // user_create
            if ($pathinfo === '/panel/user/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_user_create;
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\UserController::createAction',  '_route' => 'user_create',);
            }
            not_user_create:

            // user_edit
            if (preg_match('#^/panel/user/(?P<id>[^/]+)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\UserController::editAction',)), array('_route' => 'user_edit'));
            }

            // user_update
            if (preg_match('#^/panel/user/(?P<id>[^/]+)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_user_update;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\UserController::updateAction',)), array('_route' => 'user_update'));
            }
            not_user_update:

            // user_delete
            if (preg_match('#^/panel/user/(?P<id>[^/]+)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_user_delete;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\UserController::deleteAction',)), array('_route' => 'user_delete'));
            }
            not_user_delete:

        }

        if (0 === strpos($pathinfo, '/panel/team')) {
            // team
            if (rtrim($pathinfo, '/') === '/panel/team') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'team');
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\TeamController::indexAction',  '_route' => 'team',);
            }

            // team_show
            if (preg_match('#^/panel/team/(?P<id>[^/]+)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\TeamController::showAction',)), array('_route' => 'team_show'));
            }

            // team_new
            if ($pathinfo === '/panel/team/new') {
                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\TeamController::newAction',  '_route' => 'team_new',);
            }

            // team_create
            if ($pathinfo === '/panel/team/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_team_create;
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\TeamController::createAction',  '_route' => 'team_create',);
            }
            not_team_create:

            // team_edit
            if (preg_match('#^/panel/team/(?P<id>[^/]+)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\TeamController::editAction',)), array('_route' => 'team_edit'));
            }

            // team_update
            if (preg_match('#^/panel/team/(?P<id>[^/]+)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_team_update;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\TeamController::updateAction',)), array('_route' => 'team_update'));
            }
            not_team_update:

            // team_delete
            if (preg_match('#^/panel/team/(?P<id>[^/]+)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_team_delete;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\TeamController::deleteAction',)), array('_route' => 'team_delete'));
            }
            not_team_delete:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}

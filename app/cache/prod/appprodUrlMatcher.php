<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
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

        if (0 === strpos($pathinfo, '/')) {
            // front_office_homepage
            if (rtrim($pathinfo, '/') === '') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'front_office_homepage');
                }

                return array (  '_controller' => 'ArrasFilmFestival\\FrontOfficeBundle\\Controller\\PageController::homeAction',  '_route' => 'front_office_homepage',);
            }

            // front_office_articlepage
            if ($pathinfo === '/article') {
                return array (  '_controller' => 'ArrasFilmFestival\\FrontOfficeBundle\\Controller\\PageController::articleAction',  '_route' => 'front_office_articlepage',);
            }

            // front_office_showarticlepage
            if (0 === strpos($pathinfo, '/article') && preg_match('#^/article/(?P<slug>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\FrontOfficeBundle\\Controller\\PageController::showAction',)), array('_route' => 'front_office_showarticlepage'));
            }

            // front_office_photopage
            if ($pathinfo === '/photo') {
                return array (  '_controller' => 'ArrasFilmFestival\\FrontOfficeBundle\\Controller\\PageController::photoAction',  '_route' => 'front_office_photopage',);
            }

            // front_office_videopage
            if ($pathinfo === '/video') {
                return array (  '_controller' => 'ArrasFilmFestival\\FrontOfficeBundle\\Controller\\PageController::videoAction',  '_route' => 'front_office_videopage',);
            }

            // front_office_podcastpage
            if ($pathinfo === '/podcast') {
                return array (  '_controller' => 'ArrasFilmFestival\\FrontOfficeBundle\\Controller\\PageController::podcastAction',  '_route' => 'front_office_podcastpage',);
            }

            // front_office_programmepage
            if ($pathinfo === '/programme') {
                return array (  '_controller' => 'ArrasFilmFestival\\FrontOfficeBundle\\Controller\\PageController::programmeAction',  '_route' => 'front_office_programmepage',);
            }

        }

        if (0 === strpos($pathinfo, '/admin')) {
            // back_office_home
            if (rtrim($pathinfo, '/') === '/admin') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'back_office_home');
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PageController::homeAction',  '_route' => 'back_office_home',);
            }

            // back_office_information
            if ($pathinfo === '/admin/info') {
                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PageController::informationAction',  '_route' => 'back_office_information',);
            }

            // back_office_gestion_validation
            if ($pathinfo === '/admin/gestion/validation') {
                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\GestionController::validateindexAction',  '_route' => 'back_office_gestion_validation',);
            }

            // back_office_gestion_validation_confirm
            if (0 === strpos($pathinfo, '/admin/gestion/validate') && preg_match('#^/admin/gestion/validate/(?P<kind>[^/]+)/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\GestionController::validateAction',)), array('_route' => 'back_office_gestion_validation_confirm'));
            }

            // back_office_gestion_content
            if ($pathinfo === '/admin/gestion/contenus') {
                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\GestionController::contenusindexAction',  '_route' => 'back_office_gestion_content',);
            }

            // back_office_gestion_user
            if ($pathinfo === '/admin/gestion/users') {
                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\GestionController::usersindexAction',  '_route' => 'back_office_gestion_user',);
            }

            // back_office_gestion_user_delete
            if (0 === strpos($pathinfo, '/admin/delete') && preg_match('#^/admin/delete/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_back_office_gestion_user_delete;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\GestionController::userdeleteAction',)), array('_route' => 'back_office_gestion_user_delete'));
            }
            not_back_office_gestion_user_delete:

        }

        if (0 === strpos($pathinfo, '/admin/photo')) {
            // photo
            if (rtrim($pathinfo, '/') === '/admin/photo') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'photo');
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PhotoController::indexAction',  '_route' => 'photo',);
            }

            // photo_new
            if ($pathinfo === '/admin/photo/new') {
                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PhotoController::newAction',  '_route' => 'photo_new',);
            }

            // photo_create
            if ($pathinfo === '/admin/photo/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_photo_create;
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PhotoController::createAction',  '_route' => 'photo_create',);
            }
            not_photo_create:

            // photo_edit
            if (0 === strpos($pathinfo, '/admin/photo/edit') && preg_match('#^/admin/photo/edit/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PhotoController::editAction',)), array('_route' => 'photo_edit'));
            }

            // photo_update
            if (0 === strpos($pathinfo, '/admin/photo/update') && preg_match('#^/admin/photo/update/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_photo_update;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PhotoController::updateAction',)), array('_route' => 'photo_update'));
            }
            not_photo_update:

            // photo_delete
            if (0 === strpos($pathinfo, '/admin/photo/delete') && preg_match('#^/admin/photo/delete/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_photo_delete;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PhotoController::deleteAction',)), array('_route' => 'photo_delete'));
            }
            not_photo_delete:

        }

        if (0 === strpos($pathinfo, '/admin/video')) {
            // video
            if (rtrim($pathinfo, '/') === '/admin/video') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'video');
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\VideoController::indexAction',  '_route' => 'video',);
            }

            // video_new
            if ($pathinfo === '/admin/video/new') {
                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\VideoController::newAction',  '_route' => 'video_new',);
            }

            // video_create
            if ($pathinfo === '/admin/video/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_video_create;
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\VideoController::createAction',  '_route' => 'video_create',);
            }
            not_video_create:

            // video_edit
            if (0 === strpos($pathinfo, '/admin/video/edit') && preg_match('#^/admin/video/edit/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\VideoController::editAction',)), array('_route' => 'video_edit'));
            }

            // video_update
            if (0 === strpos($pathinfo, '/admin/video/update') && preg_match('#^/admin/video/update/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_video_update;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\VideoController::updateAction',)), array('_route' => 'video_update'));
            }
            not_video_update:

            // video_delete
            if (0 === strpos($pathinfo, '/admin/video/delete') && preg_match('#^/admin/video/delete/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_video_delete;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\VideoController::deleteAction',)), array('_route' => 'video_delete'));
            }
            not_video_delete:

        }

        if (0 === strpos($pathinfo, '/admin/podcast')) {
            // podcast
            if (rtrim($pathinfo, '/') === '/admin/podcast') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'podcast');
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PodcastController::indexAction',  '_route' => 'podcast',);
            }

            // podcast_new
            if ($pathinfo === '/admin/podcast/new') {
                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PodcastController::newAction',  '_route' => 'podcast_new',);
            }

            // podcast_create
            if ($pathinfo === '/admin/podcast/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_podcast_create;
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PodcastController::createAction',  '_route' => 'podcast_create',);
            }
            not_podcast_create:

            // podcast_edit
            if (0 === strpos($pathinfo, '/admin/podcast/edit') && preg_match('#^/admin/podcast/edit/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PodcastController::editAction',)), array('_route' => 'podcast_edit'));
            }

            // podcast_update
            if (0 === strpos($pathinfo, '/admin/podcast/update') && preg_match('#^/admin/podcast/update/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_podcast_update;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PodcastController::updateAction',)), array('_route' => 'podcast_update'));
            }
            not_podcast_update:

            // podcast_delete
            if (0 === strpos($pathinfo, '/admin/podcast/delete') && preg_match('#^/admin/podcast/delete/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_podcast_delete;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\PodcastController::deleteAction',)), array('_route' => 'podcast_delete'));
            }
            not_podcast_delete:

        }

        if (0 === strpos($pathinfo, '/admin/article')) {
            // article
            if (rtrim($pathinfo, '/') === '/admin/article') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'article');
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\ArticleController::indexAction',  '_route' => 'article',);
            }

            // article_show
            if (0 === strpos($pathinfo, '/admin/article/show') && preg_match('#^/admin/article/show/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\ArticleController::showAction',)), array('_route' => 'article_show'));
            }

            // article_new
            if ($pathinfo === '/admin/article/new') {
                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\ArticleController::newAction',  '_route' => 'article_new',);
            }

            // article_create
            if ($pathinfo === '/admin/article/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_article_create;
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\ArticleController::createAction',  '_route' => 'article_create',);
            }
            not_article_create:

            // article_edit
            if (0 === strpos($pathinfo, '/admin/article/edit') && preg_match('#^/admin/article/edit/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\ArticleController::editAction',)), array('_route' => 'article_edit'));
            }

            // article_update
            if (0 === strpos($pathinfo, '/admin/article/update') && preg_match('#^/admin/article/update/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_article_update;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\ArticleController::updateAction',)), array('_route' => 'article_update'));
            }
            not_article_update:

            // article_delete
            if (0 === strpos($pathinfo, '/admin/article/delete') && preg_match('#^/admin/article/delete/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_article_delete;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\ArticleController::deleteAction',)), array('_route' => 'article_delete'));
            }
            not_article_delete:

        }

        if (0 === strpos($pathinfo, '/admin/event')) {
            // event
            if (rtrim($pathinfo, '/') === '/admin/event') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'event');
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\EventController::indexAction',  '_route' => 'event',);
            }

            // event_new
            if ($pathinfo === '/admin/event/new') {
                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\EventController::newAction',  '_route' => 'event_new',);
            }

            // event_create
            if ($pathinfo === '/admin/event/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_event_create;
                }

                return array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\EventController::createAction',  '_route' => 'event_create',);
            }
            not_event_create:

            // event_edit
            if (0 === strpos($pathinfo, '/admin/event/edit') && preg_match('#^/admin/event/edit/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\EventController::editAction',)), array('_route' => 'event_edit'));
            }

            // event_update
            if (0 === strpos($pathinfo, '/admin/event/update') && preg_match('#^/admin/event/update/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_event_update;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\EventController::updateAction',)), array('_route' => 'event_update'));
            }
            not_event_update:

            // event_delete
            if (0 === strpos($pathinfo, '/admin/event/delete') && preg_match('#^/admin/event/delete/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_event_delete;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ArrasFilmFestival\\BackOfficeBundle\\Controller\\EventController::deleteAction',)), array('_route' => 'event_delete'));
            }
            not_event_delete:

        }

        if (0 === strpos($pathinfo, '/')) {
            // fos_user_security_login
            if ($pathinfo === '/login') {
                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'fos_user_security_login',);
            }

            // fos_user_security_check
            if ($pathinfo === '/login_check') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fos_user_security_check;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_route' => 'fos_user_security_check',);
            }
            not_fos_user_security_check:

            // fos_user_security_logout
            if ($pathinfo === '/logout') {
                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_route' => 'fos_user_security_logout',);
            }

        }

        if (0 === strpos($pathinfo, '/register')) {
            // fos_user_registration_register
            if (rtrim($pathinfo, '/') === '/register') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_registration_register');
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::registerAction',  '_route' => 'fos_user_registration_register',);
            }

            // fos_user_registration_check_email
            if ($pathinfo === '/register/check-email') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_registration_check_email;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
            }
            not_fos_user_registration_check_email:

            // fos_user_registration_confirm
            if (0 === strpos($pathinfo, '/register/confirm') && preg_match('#^/register/confirm/(?P<token>[^/]+)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_registration_confirm;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmAction',)), array('_route' => 'fos_user_registration_confirm'));
            }
            not_fos_user_registration_confirm:

            // fos_user_registration_confirmed
            if ($pathinfo === '/register/confirmed') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_registration_confirmed;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
            }
            not_fos_user_registration_confirmed:

        }

        if (0 === strpos($pathinfo, '/')) {
            // ef_connect
            if ($pathinfo === '/efconnect') {
                return array (  '_controller' => 'FM\\ElfinderBundle\\Controller\\ElfinderController::loadAction',  '_route' => 'ef_connect',);
            }

            // elfinder
            if ($pathinfo === '/elfinder') {
                return array (  '_controller' => 'FM\\ElfinderBundle\\Controller\\ElfinderController::showAction',  '_route' => 'elfinder',);
            }

        }

        if (0 === strpos($pathinfo, '/')) {
            // _imagine_back_thumb
            if (0 === strpos($pathinfo, '/media/cache/back_thumb') && preg_match('#^/media/cache/back_thumb/(?P<path>.+)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not__imagine_back_thumb;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'liip_imagine.controller:filterAction',  'filter' => 'back_thumb',)), array('_route' => '_imagine_back_thumb'));
            }
            not__imagine_back_thumb:

            // _imagine_front_thumb
            if (0 === strpos($pathinfo, '/media/cache/front_thumb') && preg_match('#^/media/cache/front_thumb/(?P<path>.+)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not__imagine_front_thumb;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'liip_imagine.controller:filterAction',  'filter' => 'front_thumb',)), array('_route' => '_imagine_front_thumb'));
            }
            not__imagine_front_thumb:

            // _imagine_front_widen
            if (0 === strpos($pathinfo, '/media/cache/front_widen') && preg_match('#^/media/cache/front_widen/(?P<path>.+)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not__imagine_front_widen;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'liip_imagine.controller:filterAction',  'filter' => 'front_widen',)), array('_route' => '_imagine_front_widen'));
            }
            not__imagine_front_widen:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}

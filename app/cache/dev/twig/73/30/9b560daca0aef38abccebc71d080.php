<?php

/* ::template_back.html.twig */
class __TwigTemplate_73309b560daca0aef38abccebc71d080 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<!--[if lt IE 7]>      <html class=\"no-js lt-ie9 lt-ie8 lt-ie7\"> <![endif]-->
<!--[if IE 7]>         <html class=\"no-js lt-ie9 lt-ie8\"> <![endif]-->
<!--[if IE 8]>         <html class=\"no-js lt-ie9\"> <![endif]-->
<!--[if gt IE 8]><!--> <html class=\"no-js\"> <!--<![endif]-->
    <head>
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
        <title>";
        // line 9
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <meta name=\"description\" content=\"\">
        <meta name=\"viewport\" content=\"width=device-width\">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel=\"stylesheet\" href=\"css/normalize.css\">
        <link rel=\"stylesheet\" href=\"css/main.css\">
        ";
        // line 17
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 23
        echo "        <script src=\"js/vendor/modernizr-2.6.2.min.js\"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class=\"chromeframe\">You are using an <strong>outdated</strong> browser. Please <a href=\"http://browsehappy.com/\">upgrade your browser</a> or <a href=\"http://www.google.com/chromeframe/?redirect=true\">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div class=\"navbar navbar-inverse navbar-fixed-top\">
            <div class=\"navbar-inner\">
                <div class=\"container\">
                    <button type=\"button\" class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\">
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                    </button>
                    <a class=\"brand\" href=\"";
        // line 39
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("back_office_home"), "html", null, true);
        echo "\">Administration</a>
                    <div class=\"nav-collapse collapse\">
                        <ul class=\"nav\">
                            <li class=\"dropdown\">
                                <a href=\"";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo"), "html", null, true);
        echo "\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Articles <b class=\"caret\"></b></a>
                                <ul class=\"dropdown-menu\">
                                    <li><a href=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo"), "html", null, true);
        echo "\">Liste</a></li>
                                    <li><a href=\"";
        // line 46
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo_new"), "html", null, true);
        echo "\">Ajouter</a></li>
                                </ul>
                            </li>
                            <li class=\"dropdown\">
                                <a href=\"";
        // line 50
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo"), "html", null, true);
        echo "\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Photo <b class=\"caret\"></b></a>
                                <ul class=\"dropdown-menu\">
                                    <li><a href=\"";
        // line 52
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo"), "html", null, true);
        echo "\">Liste</a></li>
                                    <li><a href=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo_new"), "html", null, true);
        echo "\">Ajouter</a></li>
                                </ul>
                            </li>
                            <li class=\"dropdown\">
                                <a href=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo"), "html", null, true);
        echo "\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Vidéos <b class=\"caret\"></b></a>
                                <ul class=\"dropdown-menu\">
                                    <li><a href=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo"), "html", null, true);
        echo "\">Liste</a></li>
                                    <li><a href=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo_new"), "html", null, true);
        echo "\">Ajouter</a></li>
                                </ul>
                            </li>
                            <li class=\"dropdown\">
                                <a href=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("podcast"), "html", null, true);
        echo "\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Podcasts <b class=\"caret\"></b></a>
                                <ul class=\"dropdown-menu\">
                                    <li><a href=\"";
        // line 66
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("podcast"), "html", null, true);
        echo "\">Liste</a></li>
                                    <li><a href=\"";
        // line 67
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("podcast_new"), "html", null, true);
        echo "\">Ajouter</a></li>
                                </ul>
                            </li>
                            <li><a href=\"";
        // line 70
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("front_office_homepage"), "html", null, true);
        echo "\">Site</a></li>
                        </ul>
                        <p class=\"navbar-text pull-right\">
                            @ PôleCom
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class=\"container\">

        ";
        // line 82
        $this->displayBlock('body', $context, $blocks);
        // line 83
        echo "
        <hr>

        <div>
            <p>&copy; PôleCom - EPSI Arras - 2013</p>
        </div>
        
        ";
        // line 90
        $this->displayBlock('javascripts', $context, $blocks);
        // line 94
        echo "        <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js\"></script>
        <script>window.jQuery || document.write('<script src=\"js/vendor/jquery-1.8.3.min.js\"><\\/script>')</script>
        <script src=\"js/plugins.js\"></script>
        <script src=\"js/main.js\"></script>
    </body>
</html>
";
    }

    // line 9
    public function block_title($context, array $blocks = array())
    {
        echo "Welcome!";
    }

    // line 17
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 18
        echo "        <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/bootstrap/css/normalize.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
\t\t<link href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/bootstrap/css/bootstrap.min.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
        <link href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/bootstrap/css/main.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
        <link href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/ressources/css/backoffice.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
        ";
    }

    // line 82
    public function block_body($context, array $blocks = array())
    {
    }

    // line 90
    public function block_javascripts($context, array $blocks = array())
    {
        // line 91
        echo "            <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/ressources/js/jQuery.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
            <script src=\"";
        // line 92
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/bootstrap/js/bootstrap.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        ";
    }

    public function getTemplateName()
    {
        return "::template_back.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  213 => 92,  208 => 91,  205 => 90,  200 => 82,  194 => 21,  190 => 20,  186 => 19,  181 => 18,  178 => 17,  172 => 9,  162 => 94,  160 => 90,  151 => 83,  149 => 82,  134 => 70,  128 => 67,  124 => 66,  119 => 64,  112 => 60,  108 => 59,  103 => 57,  96 => 53,  92 => 52,  87 => 50,  80 => 46,  76 => 45,  71 => 43,  64 => 39,  46 => 23,  44 => 17,  33 => 9,  23 => 1,  100 => 37,  89 => 32,  85 => 31,  81 => 30,  74 => 29,  70 => 28,  65 => 25,  63 => 24,  58 => 19,  56 => 18,  54 => 17,  50 => 15,  41 => 9,  36 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}

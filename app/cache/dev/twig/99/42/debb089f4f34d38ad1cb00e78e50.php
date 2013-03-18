<?php

/* ::template_back.html.twig */
class __TwigTemplate_9942debb089f4f34d38ad1cb00e78e50 extends Twig_Template
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
        // line 22
        echo "        <script src=\"js/vendor/modernizr-2.6.2.min.js\"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class=\"chromeframe\">You are using an <strong>outdated</strong> browser. Please <a href=\"http://browsehappy.com/\">upgrade your browser</a> or <a href=\"http://www.google.com/chromeframe/?redirect=true\">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <header>
        </header>
        <div id=\"container\">

        ";
        // line 34
        $this->displayBlock('body', $context, $blocks);
        // line 35
        echo "
        </div>
        
        ";
        // line 38
        $this->displayBlock('javascripts', $context, $blocks);
        // line 39
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
        ";
    }

    // line 34
    public function block_body($context, array $blocks = array())
    {
    }

    // line 38
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "::template_back.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  108 => 38,  103 => 34,  97 => 20,  93 => 19,  88 => 18,  85 => 17,  79 => 9,  69 => 39,  67 => 38,  62 => 35,  60 => 34,  46 => 22,  44 => 17,  33 => 9,  23 => 1,  77 => 25,  68 => 19,  63 => 17,  58 => 15,  52 => 12,  47 => 10,  42 => 8,  35 => 6,  31 => 4,  28 => 3,);
    }
}

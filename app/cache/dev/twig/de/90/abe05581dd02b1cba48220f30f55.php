<?php

/* BackOfficeBundle:Photo:new.html.twig */
class __TwigTemplate_de90abe05581dd02b1cba48220f30f55 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::template_back.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::template_back.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "
<div class=\"row\">
\t<div class=\"span8 offset2\">
\t\t<form class=\"form-horizontal\" action=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo_create"), "html", null, true);
        echo "\" method=\"post\" ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo ">
\t\t    <fieldset>
\t\t    \t<legend>Ajouter des photos</legend>

\t\t    \t";
        // line 11
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "

\t\t    \t<div class=\"control-group\">
\t\t\t    \t";
        // line 14
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "image"), 'label', array("label_attr" => array("class" => "control-label")) + (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
        echo "
\t\t\t    \t<div class=\"controls\">
\t\t\t\t    \t";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "image"), 'widget', array("attr" => array("class" => "span4")));
        echo "
\t\t\t\t    </div>
\t\t\t\t    ";
        // line 18
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "image"), 'errors');
        echo "
\t\t\t\t</div>

\t\t    \t<div class=\"control-group\">
\t\t\t    \t";
        // line 22
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "title"), 'label', array("label_attr" => array("class" => "control-label")) + (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
        echo "
\t\t\t    \t<div class=\"controls\">
\t\t\t\t    \t";
        // line 24
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "title"), 'widget', array("attr" => array("placeholder" => "Titre de la photo", "class" => "span4")));
        echo "
\t\t\t\t    </div>
\t\t\t\t    ";
        // line 26
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "title"), 'errors');
        echo "
\t\t\t\t</div>

\t\t    \t<div class=\"control-group\">
\t\t\t    \t";
        // line 30
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "content"), 'label', array("label_attr" => array("class" => "control-label")) + (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
        echo "
\t\t\t    \t<div class=\"controls\">
\t\t\t\t    \t";
        // line 32
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "content"), 'widget', array("attr" => array("placeholder" => "Description de la photo", "class" => "span4")));
        echo "
\t\t\t\t    </div>
\t\t\t\t    ";
        // line 34
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "content"), 'errors');
        echo "
\t\t\t\t</div>

\t\t\t\t\t";
        // line 37
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "_token"), 'widget');
        echo "

\t\t\t\t<div class=\"form-actions\">
\t\t\t\t  \t<input type=\"submit\" class=\"btn btn-primary\" />
\t\t\t    \t<input type=\"reset\" class=\"btn\" />
\t\t\t\t</div>
\t\t\t</fieldset>
\t\t</form>
\t</div>
</div>

";
    }

    public function getTemplateName()
    {
        return "BackOfficeBundle:Photo:new.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 32,  56 => 16,  62 => 22,  209 => 91,  204 => 90,  190 => 20,  160 => 89,  134 => 69,  124 => 50,  112 => 59,  87 => 49,  65 => 22,  53 => 16,  82 => 32,  40 => 12,  23 => 1,  479 => 162,  473 => 161,  468 => 158,  460 => 155,  456 => 153,  452 => 151,  443 => 149,  439 => 148,  436 => 147,  434 => 146,  429 => 144,  426 => 143,  422 => 142,  412 => 134,  408 => 132,  406 => 131,  401 => 130,  397 => 129,  392 => 126,  386 => 122,  383 => 121,  380 => 120,  378 => 119,  373 => 116,  367 => 112,  364 => 111,  361 => 110,  359 => 109,  354 => 106,  340 => 105,  336 => 103,  321 => 101,  313 => 99,  311 => 98,  308 => 97,  304 => 95,  297 => 91,  293 => 90,  284 => 89,  282 => 88,  277 => 86,  267 => 85,  263 => 84,  257 => 81,  251 => 80,  246 => 78,  240 => 77,  234 => 74,  228 => 73,  223 => 71,  219 => 70,  213 => 69,  207 => 68,  198 => 67,  181 => 18,  176 => 65,  170 => 61,  168 => 60,  146 => 58,  142 => 56,  128 => 66,  125 => 44,  107 => 36,  38 => 15,  144 => 53,  141 => 51,  135 => 47,  126 => 45,  109 => 41,  103 => 56,  67 => 15,  61 => 18,  47 => 18,  105 => 24,  93 => 28,  76 => 25,  72 => 14,  68 => 22,  27 => 7,  91 => 31,  84 => 27,  94 => 39,  88 => 6,  79 => 17,  59 => 22,  21 => 2,  44 => 17,  31 => 4,  28 => 3,  225 => 96,  216 => 90,  212 => 88,  205 => 84,  201 => 89,  196 => 81,  194 => 79,  191 => 78,  189 => 77,  186 => 19,  180 => 72,  172 => 9,  159 => 61,  154 => 59,  147 => 55,  132 => 48,  127 => 46,  121 => 45,  118 => 44,  114 => 42,  104 => 36,  100 => 37,  78 => 26,  75 => 23,  71 => 42,  58 => 21,  34 => 11,  26 => 6,  24 => 3,  25 => 3,  19 => 1,  70 => 26,  63 => 24,  46 => 22,  22 => 2,  163 => 59,  155 => 58,  152 => 49,  149 => 81,  145 => 46,  139 => 55,  131 => 51,  123 => 41,  120 => 40,  115 => 39,  106 => 36,  101 => 37,  96 => 52,  83 => 18,  80 => 26,  74 => 36,  66 => 31,  55 => 19,  52 => 18,  50 => 10,  43 => 7,  41 => 15,  37 => 8,  35 => 5,  32 => 4,  29 => 4,  184 => 70,  178 => 17,  171 => 62,  165 => 58,  162 => 93,  157 => 60,  153 => 54,  151 => 82,  143 => 54,  138 => 51,  136 => 50,  133 => 43,  130 => 47,  122 => 43,  119 => 47,  116 => 35,  111 => 37,  108 => 42,  102 => 30,  98 => 31,  95 => 34,  92 => 51,  89 => 37,  85 => 30,  81 => 40,  73 => 24,  64 => 38,  60 => 23,  57 => 11,  54 => 20,  51 => 14,  48 => 19,  45 => 11,  42 => 8,  39 => 9,  36 => 7,  33 => 9,  30 => 7,);
    }
}

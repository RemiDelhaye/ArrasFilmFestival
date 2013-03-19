<?php

/* BackOfficeBundle:Photo:index.html.twig */
class __TwigTemplate_376e1dd07cf4e04ddb2aca3b715214be extends Twig_Template
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
";
        // line 5
        $context["compte"] = 1;
        // line 6
        echo "
<h1>Photos</h1>

<a href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo_new"), "html", null, true);
        echo "\" class=\"btn btn-block\">
    <i class=\"icon-plus\"></i> Ajouter une photo
</a>

<section class=\"thumbnails section-photo\">

    ";
        // line 15
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["entities"]) ? $context["entities"] : $this->getContext($context, "entities")));
        foreach ($context['_seq'] as $context["_key"] => $context["entity"]) {
            // line 17
            if (((isset($context["compte"]) ? $context["compte"] : $this->getContext($context, "compte")) == 4)) {
                // line 18
                $context["compte"] = 1;
                // line 19
                echo "
</section>
<section class=\"thumbnails section-photo\">";
            }
            // line 24
            $context["compte"] = ((isset($context["compte"]) ? $context["compte"] : $this->getContext($context, "compte")) + 1);
            // line 25
            echo "
    <article class=\"span4\">
        <div class=\"thumbnail article-image\">
            <h4>";
            // line 28
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "title"), "html", null, true);
            echo "</h4>
            <img src=\"";
            // line 29
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("uploads/photos/"), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "path"), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "title"), "html", null, true);
            echo "\" />
            <p>";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "content"), "html", null, true);
            echo "</p>
            <p><small><em>";
            // line 31
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "created"), "d/m/Y à H:i:s"), "html", null, true);
            echo "</em></small></p>  
            <a href=\"";
            // line 32
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo_edit", array("id" => $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "id"))), "html", null, true);
            echo "\" class=\"btn btn-block\" ><i class=\"icon-edit\"></i> Modifier</a>
        </div>  
    </article>

    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entity'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 37
        echo "
</section>

";
    }

    public function getTemplateName()
    {
        return "BackOfficeBundle:Photo:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 37,  89 => 32,  85 => 31,  81 => 30,  74 => 29,  70 => 28,  65 => 25,  63 => 24,  58 => 19,  56 => 18,  54 => 17,  50 => 15,  41 => 9,  36 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}

<?php

/* BackOfficeBundle:Photo:index.html.twig */
class __TwigTemplate_0978471e278cfd62d920af1ed022e266 extends Twig_Template
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
<h1>Photos</h1>

<table class=\"table table-striped table-bordered\">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Crée le</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    ";
        // line 18
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "entities"));
        foreach ($context['_seq'] as $context["_key"] => $context["entity"]) {
            // line 19
            echo "        <tr>
            <td>";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "entity"), "title"), "html", null, true);
            echo "</td>
            <td>";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "entity"), "content"), "html", null, true);
            echo "</td>
            <td>";
            // line 22
            if ($this->getAttribute($this->getContext($context, "entity"), "created")) {
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "entity"), "created"), "d/m/Y à H:i:s"), "html", null, true);
            }
            echo "</td>
            <td><img src=\"";
            // line 23
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("uploads/photos/"), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "entity"), "path"), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "entity"), "title"), "html", null, true);
            echo "\" width=\"300px\"/></td>
            <td>
                <a href=\"";
            // line 25
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo_show", array("id" => $this->getAttribute($this->getContext($context, "entity"), "id"))), "html", null, true);
            echo "\" class=\"btn\" ><i class=\"icon-search\"></i></a>  
                <a href=\"";
            // line 26
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo_edit", array("id" => $this->getAttribute($this->getContext($context, "entity"), "id"))), "html", null, true);
            echo "\" class=\"btn\" ><i class=\"icon-edit\"></i></a>  
                <a href=\"#myModal";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "entity"), "title"), "html", null, true);
            echo "\" role=\"button\" class=\"btn\" data-toggle=\"modal\"><i class=\"icon-trash\"></i></a>
            </td>
        </tr>

        <div id=\"myModal";
            // line 31
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "entity"), "title"), "html", null, true);
            echo "\" class=\"modal hide fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
          <div class=\"modal-header\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
            <h3 id=\"myModalLabel\">Supprimer une photo</h3>
          </div>
          <div class=\"modal-body\">
            <p>Voulez-vous vraiment supprimer la photo \"";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "entity"), "title"), "html", null, true);
            echo "\" ?</p>
            <p><i class=\"icon-warning-sign\"></i> <em>Attention ! Cette action est irréversible !</em></p>
          </div>
          <div class=\"modal-footer\">
            <button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">Annuler</button>
            <a href=\"";
            // line 42
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo_edit", array("id" => $this->getAttribute($this->getContext($context, "entity"), "id"))), "html", null, true);
            echo "\" class=\"btn btn-danger\">Supprimer cette photo <i class=\"icon-remove icon-white\"></i></a>
          </div>
        </div>

    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entity'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 47
        echo "    </tbody>
</table>

<a href=\"";
        // line 50
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("photo_new"), "html", null, true);
        echo "\" class=\"btn\">
    <i class=\"icon-plus\"></i> Ajouter une photo
</a>

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
        return array (  124 => 50,  119 => 47,  108 => 42,  100 => 37,  91 => 31,  84 => 27,  80 => 26,  76 => 25,  68 => 23,  62 => 22,  58 => 21,  54 => 20,  51 => 19,  47 => 18,  31 => 4,  28 => 3,);
    }
}

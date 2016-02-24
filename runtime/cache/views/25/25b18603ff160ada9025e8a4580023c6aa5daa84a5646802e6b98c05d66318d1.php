<?php

/* Web/Views/Error/404.html.twig */
class __TwigTemplate_587ceb830b14a24c3dc3017bb47ac842b86d0a27063100e26e1dd1eb04c711c3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("Web/Views/layout.html.twig", "Web/Views/Error/404.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "Web/Views/layout.html.twig";
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
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>

        <div class=\"container\">
            <div class=\"content\">
                <div class=\"title\">Page Not Found！</div>
            </div>
        </div>

";
    }

    public function getTemplateName()
    {
        return "Web/Views/Error/404.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,  11 => 1,);
    }
}
/* {% extends 'Web/Views/layout.html.twig' %}*/
/* */
/* {% block body %}*/
/* */
/*         <style>*/
/*             html, body {*/
/*                 height: 100%;*/
/*             }*/
/* */
/*             body {*/
/*                 margin: 0;*/
/*                 padding: 0;*/
/*                 width: 100%;*/
/*                 display: table;*/
/*                 font-weight: 100;*/
/*                 font-family: 'Lato';*/
/*             }*/
/* */
/*             .container {*/
/*                 text-align: center;*/
/*                 display: table-cell;*/
/*                 vertical-align: middle;*/
/*             }*/
/* */
/*             .content {*/
/*                 text-align: center;*/
/*                 display: inline-block;*/
/*             }*/
/* */
/*             .title {*/
/*                 font-size: 96px;*/
/*             }*/
/*         </style>*/
/* */
/*         <div class="container">*/
/*             <div class="content">*/
/*                 <div class="title">Page Not Found！</div>*/
/*             </div>*/
/*         </div>*/
/* */
/* {% endblock %}*/

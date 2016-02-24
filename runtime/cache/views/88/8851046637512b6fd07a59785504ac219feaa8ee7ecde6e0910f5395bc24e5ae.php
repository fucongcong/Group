<?php

/* Web/Views/layout.html.twig */
class __TwigTemplate_0e928c20aa0211a621dc4e727a3b245d7778226aeff6ef7639c20ce68615b55e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'keywords' => array($this, 'block_keywords'),
            'description' => array($this, 'block_description'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'head_scripts' => array($this, 'block_head_scripts'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<!--[if lt IE 7]>      <html class=\"lt-ie9 lt-ie8 lt-ie7\"> <![endif]-->
<!--[if IE 7]>         <html class=\"lt-ie9 lt-ie8\"> <![endif]-->
<!--[if IE 8]>         <html class=\"lt-ie9\"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class=\"\"> <!--<![endif]-->
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <title>";
        // line 11
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
  <meta name=\"keywords\" content=\"";
        // line 12
        $this->displayBlock('keywords', $context, $blocks);
        echo "\" />
  <meta name=\"description\" content=\"";
        // line 13
        $this->displayBlock('description', $context, $blocks);
        echo "\" />
 ";
        // line 15
        echo "
  ";
        // line 16
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 21
        echo "
  ";
        // line 22
        $this->displayBlock('head_scripts', $context, $blocks);
        // line 23
        echo "
</head>
<body>
<!-- ";
        // line 26
        echo " -->

  ";
        // line 28
        $this->displayBlock('body', $context, $blocks);
        // line 32
        echo "
";
        // line 34
        echo "
";
        // line 48
        echo "
";
        // line 50
        echo "  ";
        // line 51
        echo "</body>
</html>";
    }

    // line 11
    public function block_title($context, array $blocks = array())
    {
    }

    // line 12
    public function block_keywords($context, array $blocks = array())
    {
    }

    // line 13
    public function block_description($context, array $blocks = array())
    {
    }

    // line 16
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 17
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('group_twig')->getPublic("asset/css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <link href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('group_twig')->getPublic("asset/css/web.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">

  ";
    }

    // line 22
    public function block_head_scripts($context, array $blocks = array())
    {
    }

    // line 28
    public function block_body($context, array $blocks = array())
    {
        // line 29
        echo "  <!--head-->

  ";
    }

    public function getTemplateName()
    {
        return "Web/Views/layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  124 => 29,  121 => 28,  116 => 22,  109 => 18,  104 => 17,  101 => 16,  96 => 13,  91 => 12,  86 => 11,  81 => 51,  79 => 50,  76 => 48,  73 => 34,  70 => 32,  68 => 28,  64 => 26,  59 => 23,  57 => 22,  54 => 21,  52 => 16,  49 => 15,  45 => 13,  41 => 12,  37 => 11,  25 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <!--[if lt IE 7]>      <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->*/
/* <!--[if IE 7]>         <html class="lt-ie9 lt-ie8"> <![endif]-->*/
/* <!--[if IE 8]>         <html class="lt-ie9"> <![endif]-->*/
/* <!--[if gt IE 8]><!-->*/
/* <html class=""> <!--<![endif]-->*/
/* <head>*/
/*   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">*/
/*   <meta http-equiv="X-UA-Compatible" content="IE=edge">*/
/*   <meta name="viewport" content="width=device-width, initial-scale=1.0">*/
/*   <title>{% block title %}{% endblock %}</title>*/
/*   <meta name="keywords" content="{% block keywords %}{% endblock %}" />*/
/*   <meta name="description" content="{% block description %}{% endblock %}" />*/
/*  {#  <meta content="{{ csrf_token('site') }}" name="csrf-token" /> #}*/
/* */
/*   {% block stylesheets %}*/
/*     <link href="{{ asset("asset/css/bootstrap.min.css") }}" rel="stylesheet">*/
/*     <link href="{{ asset("asset/css/web.css") }}" rel="stylesheet">*/
/* */
/*   {% endblock %}*/
/* */
/*   {% block head_scripts %}{% endblock %}*/
/* */
/* </head>*/
/* <body>*/
/* <!-- {#   {% include 'web/views/public/head.html.twig' %} #} -->*/
/* */
/*   {% block body %}*/
/*   <!--head-->*/
/* */
/*   {% endblock %}*/
/* */
/* {#   {% include 'web/views/public/bottom.html.twig' %} #}*/
/* */
/* {# cmd  seajs: #}*/
/* {#*/
/*     <script>*/
/*      var app = {};*/
/*       app.jspath="/asset/lib/sea-modules";*/
/*     </script>*/
/*     <script src="{{ asset("asset/lib/sea-modules/seajs/seajs/2.2.1/sea.js") }}"></script>*/
/*     <script src="{{ asset("asset/lib/seajs-config.js") }}"></script>*/
/*     <script>*/
/*     seajs.use("/asset/js/index")*/
/*     </script>*/
/* */
/*   #}*/
/* */
/* {# amd  requirejs: #}*/
/*   {# <script data-main="/asset/js/index" src="/asset/js/require.js"></script>#}*/
/* </body>*/
/* </html>*/

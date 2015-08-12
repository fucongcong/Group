<?php

/* Web/Views/layout.html.twig */
class __TwigTemplate_9ebaf0aa3b96b03f25ef1916d558d20a8ed5f53afb9b45c2eb5b0ebc5020fb4b extends Twig_Template
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
        // line 41
        echo "
";
        // line 43
        echo "  
";
        // line 45
        echo "    <script>
     var app = {};
      app.jspath=\"/asset/lib/sea-modules\";
    </script>
    <script src=\"";
        // line 49
        echo twig_escape_filter($this->env, $this->env->getExtension('group_twig')->getPublic("asset/lib/sea-modules/seajs/seajs/2.2.1/sea.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 50
        echo twig_escape_filter($this->env, $this->env->getExtension('group_twig')->getPublic("asset/lib/seajs-config.js"), "html", null, true);
        echo "\"></script>
    <script>
    seajs.use(\"/asset/js/index\")
    </script>
  
";
        // line 56
        echo "  ";
        // line 57
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
        
       <div class=\"homepage-feature homepage-feature-slides \">
          <a href=\"http://www.qiqiuyu.com/\"><img src=\"http://www.qiqiuyu.com/files/default/2014/10-23/205006edc818248854.png?4.1.0\"></a>
          <a href=\"http://open.edusoho.com\"><img src=\"http://www.qiqiuyu.com/files/default/2014/10-24/155234264731150631.jpg?4.2.0\"></a>
          <a href=\"http://www.qiqiuyu.com/group/5/thread/11\"><img src=\"http://www.qiqiuyu.com/files/default/2014/10-21/113957d6a3b8136524.png?4.1.0\"></a>
          <div class=\"cycle-pager\"></div>
            <div class=\"slide-nav cycle-prev\"><span class=\"iconfont icon-zuojiantou\"></span></div>
            <div class=\"slide-nav cycle-next\"><span class=\"iconfont icon-jiantou\"></span>
          </div>
       </div>
  ";
    }

    public function getTemplateName()
    {
        return "Web/Views/layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  139 => 29,  136 => 28,  131 => 22,  124 => 18,  119 => 17,  116 => 16,  111 => 13,  106 => 12,  101 => 11,  96 => 57,  94 => 56,  86 => 50,  82 => 49,  76 => 45,  73 => 43,  70 => 41,  68 => 28,  64 => 26,  59 => 23,  57 => 22,  54 => 21,  52 => 16,  49 => 15,  45 => 13,  41 => 12,  37 => 11,  25 => 1,);
    }
}

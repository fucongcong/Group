<?php

/* Web/Views/Group/index.html.twig */
class __TwigTemplate_57c82960fe03404c24ad84618e44cad87be019e0caf10c4f44455370ca8e170c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("Web/Views/layout.html.twig", "Web/Views/Group/index.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
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

    // line 2
    public function block_title($context, array $blocks = array())
    {
        // line 3
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["group"]) ? $context["group"] : null), "title", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["group"]) ? $context["group"] : null), "title", array()), "")) : ("")), "html", null, true);
        echo "
";
    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        // line 6
        echo "
<!-- <div id=\"carousel-example-generic\" class=\"carousel slide\" data-ride=\"carousel\">

  <ol class=\"carousel-indicators\">
    <li data-target=\"#carousel-example-generic\" data-slide-to=\"0\" class=\"active\"></li>
    <li data-target=\"#carousel-example-generic\" data-slide-to=\"1\"></li>
    <li data-target=\"#carousel-example-generic\" data-slide-to=\"2\"></li>
  </ol>


  <div class=\"carousel-inner\" role=\"listbox\">
    <div class=\"item active\">
      <img src=\"/asset/img/slide-1.jpg\" alt=\"...\">
    </div>
    <div class=\"item \">
      <img src=\"/asset/img/slide-2.jpg\" alt=\"...\">
    </div>
    <div class=\"item \">
      <img src=\"/asset/img/slide-3.jpg\" alt=\"...\">
    </div>

  </div>

  <a class=\"left carousel-control\" href=\"#carousel-example-generic\" role=\"button\" data-slide=\"prev\">
    <span class=\"glyphicon glyphicon-chevron-left\"></span>
    <span class=\"sr-only\">Previous</span>
  </a>
  <a class=\"right carousel-control\" href=\"#carousel-example-generic\" role=\"button\" data-slide=\"next\">
    <span class=\"glyphicon glyphicon-chevron-right\"></span>
    <span class=\"sr-only\">Next</span>
  </a>
</div> -->
<form method=\"post\" action=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('group_twig')->getUrl("create_group", array("id" => 1)), "html", null, true);
        echo "\">
  
  <input type=\"hidden\" name=\"csrf_token\" value=\"";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('group_twig')->getCsrfToken(), "html", null, true);
        echo "\">

  <button type=\"submit\">提交</button>
</form>
<div class=\"container\" style=\"margin-top:20px;\">
  <div class=\"row\" >
      <div class=\"col-md-12 clearfix\">
        <a href=\"/\" type=\"button\" class=\"btn btn-primary pull-right\">返回首页</a>
      </div>

      <div class=\"col-md-12\">
        <div class=\"panel panel-default\">
          <div class=\"panel-body\">
            当前路由: ";
        // line 53
        echo twig_escape_filter($this->env, (isset($context["uri"]) ? $context["uri"] : null), "html", null, true);
        echo "
          </div>
          <div class=\"panel-footer\">\$this -> route() -> getUri()</div>
        </div>
      </div>

      <div class=\"col-md-12\">
        <div class=\"panel panel-default\">
          <div class=\"panel-body\">
            获取所有参数: ";
        // line 62
        echo twig_escape_filter($this->env, $this->env->getExtension('group_twig')->dump((isset($context["parameters"]) ? $context["parameters"] : null)), "html", null, true);
        echo "
          </div>
          <div class=\"panel-footer\">\$this -> route() -> getParameters()</div>
        </div>
      </div>

      <div class=\"col-md-12\">
        <div class=\"panel panel-default\">
          <div class=\"panel-body\">
            获取所有参数的名称: ";
        // line 71
        echo twig_escape_filter($this->env, $this->env->getExtension('group_twig')->dump((isset($context["parametersName"]) ? $context["parametersName"] : null)), "html", null, true);
        echo "
          </div>
          <div class=\"panel-footer\">\$this -> route() -> getParametersName()</div>
        </div>
      </div>

      <div class=\"col-md-12\">
        <div class=\"panel panel-default\">
          <div class=\"panel-body\">
            当前action名称: ";
        // line 80
        echo twig_escape_filter($this->env, (isset($context["action"]) ? $context["action"] : null), "html", null, true);
        echo "
          </div>
          <div class=\"panel-footer\">\$this -> route() -> getAction()</div>
        </div>
      </div>

       <div class=\"col-md-12\">
        <div class=\"panel panel-default\">
          <div class=\"panel-body\">
            系统允许的请求方法类型: ";
        // line 89
        echo twig_escape_filter($this->env, $this->env->getExtension('group_twig')->dump((isset($context["methods"]) ? $context["methods"] : null)), "html", null, true);
        echo "
          </div>
          <div class=\"panel-footer\">\$this -> route() -> getMethods()</div>
        </div>
      </div>

      <div class=\"col-md-12\">
        <div class=\"panel panel-default\">
          <div class=\"panel-body\">
            当前请求方法: ";
        // line 98
        echo twig_escape_filter($this->env, $this->env->getExtension('group_twig')->dump((isset($context["currentMethod"]) ? $context["currentMethod"] : null)), "html", null, true);
        echo "
          </div>
          <div class=\"panel-footer\">\$this -> route() -> getCurrentMethod()</div>
        </div>
      </div>

       <div class=\"col-md-12\">
        <div class=\"panel panel-default\">
          <div class=\"panel-body\">
            当前时区: ";
        // line 107
        echo twig_escape_filter($this->env, (isset($context["timezone"]) ? $context["timezone"] : null), "html", null, true);
        echo "
          </div>
          <div class=\"panel-footer\">\$this -> getContainer() -> getTimezone()</div>
        </div>
      </div>
  </div>

</div>

";
    }

    public function getTemplateName()
    {
        return "Web/Views/Group/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  168 => 107,  156 => 98,  144 => 89,  132 => 80,  120 => 71,  108 => 62,  96 => 53,  80 => 40,  75 => 38,  41 => 6,  38 => 5,  32 => 3,  29 => 2,  11 => 1,);
    }
}
/* {% extends 'Web/Views/layout.html.twig' %}*/
/* {% block title%}*/
/* {{group.title|default("")}}*/
/* {% endblock %}*/
/* {% block body %}*/
/* */
/* <!-- <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">*/
/* */
/*   <ol class="carousel-indicators">*/
/*     <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>*/
/*     <li data-target="#carousel-example-generic" data-slide-to="1"></li>*/
/*     <li data-target="#carousel-example-generic" data-slide-to="2"></li>*/
/*   </ol>*/
/* */
/* */
/*   <div class="carousel-inner" role="listbox">*/
/*     <div class="item active">*/
/*       <img src="/asset/img/slide-1.jpg" alt="...">*/
/*     </div>*/
/*     <div class="item ">*/
/*       <img src="/asset/img/slide-2.jpg" alt="...">*/
/*     </div>*/
/*     <div class="item ">*/
/*       <img src="/asset/img/slide-3.jpg" alt="...">*/
/*     </div>*/
/* */
/*   </div>*/
/* */
/*   <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">*/
/*     <span class="glyphicon glyphicon-chevron-left"></span>*/
/*     <span class="sr-only">Previous</span>*/
/*   </a>*/
/*   <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">*/
/*     <span class="glyphicon glyphicon-chevron-right"></span>*/
/*     <span class="sr-only">Next</span>*/
/*   </a>*/
/* </div> -->*/
/* <form method="post" action="{{url('create_group', {'id':1})}}">*/
/*   */
/*   <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">*/
/* */
/*   <button type="submit">提交</button>*/
/* </form>*/
/* <div class="container" style="margin-top:20px;">*/
/*   <div class="row" >*/
/*       <div class="col-md-12 clearfix">*/
/*         <a href="/" type="button" class="btn btn-primary pull-right">返回首页</a>*/
/*       </div>*/
/* */
/*       <div class="col-md-12">*/
/*         <div class="panel panel-default">*/
/*           <div class="panel-body">*/
/*             当前路由: {{uri}}*/
/*           </div>*/
/*           <div class="panel-footer">$this -> route() -> getUri()</div>*/
/*         </div>*/
/*       </div>*/
/* */
/*       <div class="col-md-12">*/
/*         <div class="panel panel-default">*/
/*           <div class="panel-body">*/
/*             获取所有参数: {{dump(parameters)}}*/
/*           </div>*/
/*           <div class="panel-footer">$this -> route() -> getParameters()</div>*/
/*         </div>*/
/*       </div>*/
/* */
/*       <div class="col-md-12">*/
/*         <div class="panel panel-default">*/
/*           <div class="panel-body">*/
/*             获取所有参数的名称: {{dump(parametersName)}}*/
/*           </div>*/
/*           <div class="panel-footer">$this -> route() -> getParametersName()</div>*/
/*         </div>*/
/*       </div>*/
/* */
/*       <div class="col-md-12">*/
/*         <div class="panel panel-default">*/
/*           <div class="panel-body">*/
/*             当前action名称: {{action}}*/
/*           </div>*/
/*           <div class="panel-footer">$this -> route() -> getAction()</div>*/
/*         </div>*/
/*       </div>*/
/* */
/*        <div class="col-md-12">*/
/*         <div class="panel panel-default">*/
/*           <div class="panel-body">*/
/*             系统允许的请求方法类型: {{dump(methods)}}*/
/*           </div>*/
/*           <div class="panel-footer">$this -> route() -> getMethods()</div>*/
/*         </div>*/
/*       </div>*/
/* */
/*       <div class="col-md-12">*/
/*         <div class="panel panel-default">*/
/*           <div class="panel-body">*/
/*             当前请求方法: {{dump(currentMethod)}}*/
/*           </div>*/
/*           <div class="panel-footer">$this -> route() -> getCurrentMethod()</div>*/
/*         </div>*/
/*       </div>*/
/* */
/*        <div class="col-md-12">*/
/*         <div class="panel panel-default">*/
/*           <div class="panel-body">*/
/*             当前时区: {{timezone}}*/
/*           </div>*/
/*           <div class="panel-footer">$this -> getContainer() -> getTimezone()</div>*/
/*         </div>*/
/*       </div>*/
/*   </div>*/
/* */
/* </div>*/
/* */
/* {% endblock %}*/

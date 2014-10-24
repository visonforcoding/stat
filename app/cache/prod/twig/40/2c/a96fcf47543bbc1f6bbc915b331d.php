<?php

/* ::layout.html.twig */
class __TwigTemplate_402ca96fcf47543bbc1f6bbc915b331d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::base.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "  <div id=\"wrapper\" class=\"screen_wide\">
      <div id=\"header\">
          <div class=\"wrap\">
              <a href=\"index.html\" class=\"logo\"></a>
              <div class=\"buttons\">
                  <div class=\"item\">                        
                      <div class=\"btn-group\">                        
                          <a href=\"#\" class=\"btn btn-primary btn-small dropdown-toggle\" data-toggle=\"dropdown\">
                              <span class=\"i-forward\"></span>
                          </a>
                          <ul class=\"dropdown-menu\">
                              <li><a href=\"#\"><span class=\"i-profile\"></span> Profile</a></li>
                              <li><a href=\"#\"><span class=\"i-forward\"></span> Logout</a></li>
                          </ul> 
                      </div>
                  </div>                
              </div>
          </div>
      </div>
      <div id=\"layout\">
        
            <div id=\"sidebar\">

                <div class=\"user\">
                    <div class=\"pic\">
                        <img src=\"img/examples/users/dmitry_m.jpg\"/>
                    </div>
                    <div class=\"info\">
                        <div class=\"name\">
                            <a href=\"#\">";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user"), "username"), "html", null, true);
        echo "</a>
                        </div>
                    </div>
                </div>

                <ul class=\"navigation\">
                    <li class=\"active\">
                        <a href=\"index.html\">Dashboard</a>
                    </li>              
                    <li>
                        <a href=\"#\">Element 2</a>
                    </li>                                   
                </ul>

            </div>

            <div id=\"content\">                        
                <div class=\"wrap\">
                    <div class=\"head\">
                        <div class=\"info\">
                            <h1>Dashboard</h1>
                            <ul class=\"breadcrumb\">
                                <li class=\"active\">Dashboard</li>
                            </ul>
                        </div>
                        
                        <div class=\"search\">
                            <form action=\"\" method=\"post\">
                                <input type=\"text\" placeholder=\"search...\"/>                                
                                <button type=\"submit\"><span class=\"i-calendar\"></span></button>
                                <button type=\"submit\"><span class=\"i-magnifier\"></span></button>
                            </form>
                        </div>                        
                    </div>                                                                    
                    
                    <div class=\"content\">
                        <div class=\"row-fluid\">
                            <div class=\"span6\">    
                             1                                 
                            </div>
                            <div class=\"span6\">
                                2                            
                            </div>                            
                        </div>
                        ";
        // line 77
        $this->displayBlock('fos_user_content', $context, $blocks);
        // line 78
        echo "                        
                    </div>
                        
                </div>
            </div>
      </div>
  </div>
\t
";
    }

    // line 77
    public function block_fos_user_content($context, array $blocks = array())
    {
        echo " ";
    }

    public function getTemplateName()
    {
        return "::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  124 => 77,  112 => 78,  110 => 77,  63 => 33,  32 => 4,  29 => 3,  31 => 3,  28 => 2,);
    }
}

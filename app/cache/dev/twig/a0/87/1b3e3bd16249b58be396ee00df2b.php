<?php

/* YameiRecEyeBundle::showRequest.html.twig */
class __TwigTemplate_a0871b3e3bd16249b58be396ee00df2b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'fos_user_content' => array($this, 'block_fos_user_content'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 3
        echo "<style type=\"text/css\">
    #table_box{
        margin-top: 20px;
    }
</style>
 ";
    }

    // line 9
    public function block_fos_user_content($context, array $blocks = array())
    {
        echo " 
<div id=\"table_box\">
     <table id=\"list\"></table> 
    <div id=\"pager\"></div> 
</div>

";
    }

    // line 16
    public function block_javascripts($context, array $blocks = array())
    {
        // line 17
        echo "<script type=\"text/javascript\">
    \$(function(){
        \$(\"#list\").jqGrid({
        url: \"";
        // line 20
        echo $this->env->getExtension('routing')->getPath("yamei_rec_eye_getRequestList");
        echo "\",
        datatype: \"json\",
        mtype: \"POST\",
        colNames: [\"用户\", \"协议\", \"主机\", \"路径\",\"参数\",\"请求方式\",\"请求时间\", \"源IP\", \"源端口\",\"目的IP\",\"目的端口\"],
        colModel: [
            { name: \"username\", width: 55 , align: \"center\"},
            { name: \"protocol\", width: 90, align: \"center\" },
            { name: \"hostname\", width:210, align: \"left\" },
            { name: \"path\", width:210, align: \"left\" },
            { name: \"params\", width:210, align: \"center\" },
            { name: \"method\", width:90, align: \"center\" },
            { name: \"req_time\", width:150, align: \"center\" ,sortable:true},
            { name: \"from_ip4\", width:150, align: \"center\" },
            { name: \"from_port\", width: 100, align: \"center\", sortable: false },
            { name: \"to_ip4\", width: 150, align: \"center\", sortable: false },
            { name: \"to_port\", width: 100, align: \"center\", sortable: false }
        ],
        pager: \"#pager\",
        rownumbers:true,
        rowNum: 10,
        rowList: [10, 20, 30],
        sortname: \"id\",
        sortorder: \"desc\",
        viewrecords: true,
        gridview: true,
        autoencode: true,
        caption: \"request data\",
        height:\"auto\",
        autowidth:true,
        jsonReader: {
                        root: \"rows\",
                        page: \"page\",
                        total: \"total\",
                        records: \"records\",
                        repeatitems: false,
                        id: \"0\"
                    }
    }); 
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "YameiRecEyeBundle::showRequest.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 20,  57 => 17,  54 => 16,  42 => 9,  33 => 3,  30 => 2,);
    }
}

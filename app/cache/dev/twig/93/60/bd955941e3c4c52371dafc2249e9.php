<?php

/* YameiRecEyeBundle::manageUser.html.twig */
class __TwigTemplate_9360bd955941e3c4c52371dafc2249e9 extends Twig_Template
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
    #cpwd form{
        margin-left: 120px;
    }
</style>
 ";
    }

    // line 12
    public function block_fos_user_content($context, array $blocks = array())
    {
        // line 13
        echo "<div id=\"table_box\">
    <table id=\"list\"></table> 
    <div id=\"pager\"></div> 
</div>
<div id=\"cpwd\" title=\"密码修改\">
    <form>
        <fieldset>
            <label for=\"pwd1\">密码</label>
            <input type=\"password\" name=\"pwd1\" id=\"pwd1\" required=\"required\" class=\"text ui-widget-content ui-corner-all\" />
            <label for=\"pwd2\">确认密码</label>
            <input type=\"password\" name=\"pwd2\" id=\"pwd2\" value=\"\" required=\"required\" class=\"text ui-widget-content ui-corner-all\" />
        </fieldset>
    </form>
</div>
";
    }

    // line 28
    public function block_javascripts($context, array $blocks = array())
    {
        // line 29
        echo "<script type=\"text/javascript\">
    \$(function() {
    \$(\"#list\").jqGrid({
    url: \"";
        // line 32
        echo $this->env->getExtension('routing')->getPath("yamei_rec_eye_getUserList");
        echo "\",
            datatype: \"json\",
            mtype: \"POST\",
            colNames: [\"id\", \"用户\", \"密码\", \"email\", \"启用\", \"上次登录时间\"";
        // line 35
        echo ", \"公司\", \"全称\",
                    \"编号\", \"创建时间\", \"更新时间\"],
            colModel: [
            { name: \"id\", width: 55, align: \"center\", hidden:true, hidedlg:true},
            { name: \"username\", width: 55, editable:true, align: \"center\"},
            { name: \"password\", editable:true, hidden:true, editrules:{edithidden: true}, edittype:'password'},
            { name:\"email\", width:210, editable:true, align: \"center\" },
            { name: \"enabled\", editable:true, hidden:false, editrules:{edithidden:true},
       ";
        // line 50
        echo "            edittype:'checkbox', editoptions:{value:'1:0'}},
            { name: \"last_login\", width:210, align: \"center\"},
                ";
        // line 53
        echo "            { name: \"company\", width:90, editable:true, align: \"center\" },
            { name: \"fullname\", width:210, editable:true, align: \"left\" },
            { name: \"code\", width:100, align: \"center\", sortable:true},
            { name: \"crt_time\", width:150, align: \"center\" },
            { name: \"upd_time\", width: 150, align: \"center\", sortable: false }
            ],
            pager: \"#pager\",
            rownumbers:true,
            rowNum: 10,
            rowList: [10, 20, 30],
            multiselect:true, //启用多选，最左侧会出现复选框
            sortname: \"id\",
            sortorder: \"asc\",
            viewrecords: true,
            gridview: true,
            autoencode: true,
            caption: \"request data\",
            height:\"auto\",
            autowidth:true,
            jsonReader:
            {
            root: \"rows\",
            page: \"page\",
            total: \"total\",
            records: \"records\",
            repeatitems: false,
            id:'id'
            }
    });
            \$(\"#list\").navGrid('#pager', {edit: true, add: true, del: true, search: true},
    {
    //edit   
    jqModal: true,
            reloadAfterSubmit: true,
            closeOnEscape: true,
            savekey: [true, 13],
            closeAfterEdit: true,
            url: '";
        // line 90
        echo $this->env->getExtension('routing')->getPath("yamei_rec_eye_editUser");
        echo "',
            beforeShowForm: function(form) {
            \$('#tr_password', form).hide();
            },
            afterSubmit: function(response) {
            var responseText = \$.parseJSON(response.responseText);
                    var success = responseText.success;
                    var message = responseText.message;
                    return [success, message];
            }
    },
    {//add
    left: 500,
            top: 200,
            modal: true,
            reloadAfterSubmit: true,
            closeOnEscape: true,
            savekey: [true, 13],
            closeAfterAdd: true,
            url: \"";
        // line 109
        echo $this->env->getExtension('routing')->getPath("yamei_rec_eye_addUser");
        echo "\",
            beforeShowForm: function(form) {
            \$('#tr_password', form).show();
            },
            afterSubmit: function(response) {
            var responseText = \$.parseJSON(response.responseText);
                    var success = responseText.success;
                    var message = responseText.message;
                    return [success, message];
            }
    },
    {//del
    url: \"";
        // line 121
        echo $this->env->getExtension('routing')->getPath("yamei_rec_eye_delUser");
        echo "\",
            afterSubmit: function(response) {
            var responseText = \$.parseJSON(response.responseText);
                    var success = responseText.success;
                    var message = responseText.message;
                    return [success, message];
            }
    },
    {
    //search 
    width:600,
    sopt:['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc'] 


    }
    ).navButtonAdd('#pager', {caption: \"修改密码\", buttonicon: \"ui-icon-newwin\",
            onClickButton: function() {
            var ck = ckSelCount();
                    if (!ck) {
            //修改密码模态框
            \$('#cpwd').dialog('open');
            } else {
            return false;
            }
            },
            position: \"last\", title: \"修改密码\", cursor: \"pointer\"});
            \$('#cpwd').dialog({
    autoOpen:false,
            width:500,
            modal:true,
            height:250,
            buttons:{
            \"确认修改\":function() {
            var id = \$('#list').jqGrid('getGridParam', 'selrow');
                    var pwd2 = \$('#pwd2').val();
                    \$.ajax({
                    url: \"";
        // line 157
        echo $this->env->getExtension('routing')->getPath("yamei_rec_eye_chPwd");
        echo "\",
                            type: \"POST\",
                            data: {'id': id, 'pwd': pwd2},
                            success: function(msg) {
                            alert(msg);
                                    \$('#cpwd').dialog('close');
                                    \$('#list').trigger('reloadGrid'); //刷新jgrid
                            }
                    });
            },
                    Cancel:function() {
                    \$(this).dialog('close');
                    }
            }
    });
    });
            function ckSelCount() {
            var count = \$('.cbox:checked').length;
                    var error = false;
                    if (count > 1) {
            alert('只能选取一个进行修改密码');
                    error = true;
            }
            var id = \$('#list').jqGrid('getGridParam', 'selrow');
                    if (id === null) {
            alert('您未选择任何记录');
                    error = true;
            }
            return error;
            }
";
        // line 201
        echo "</script>
";
    }

    public function getTemplateName()
    {
        return "YameiRecEyeBundle::manageUser.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  242 => 201,  209 => 157,  170 => 121,  155 => 109,  133 => 90,  94 => 53,  90 => 50,  80 => 35,  74 => 32,  69 => 29,  66 => 28,  48 => 13,  45 => 12,  33 => 3,  30 => 2,);
    }
}

define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'cms/parame/index',
                    add_url: 'cms/parame/add',
                    edit_url: 'cms/parame/edit',
                    del_url: 'cms/parame/del',
                    multi_url: 'cms/parame/multi',
                    table: 'cms_parame',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'weigh',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', sortable: true, title: __('Id')},
                        {field: 'type', title: __('Type'), formatter: Table.api.formatter.search, searchList: Config.typeList},
                        {field: 'name', title: '产品ID', formatter: Table.api.formatter.search},
                        {field: 'title', title: __('Title')},
                        // {field: 'image', title: __('Image'), events: Table.api.events.image, formatter: Table.api.formatter.image},
                        // {field: 'url', title: __('Url'), formatter: Table.api.formatter.url},
                        {field: 'createtime', title: __('Createtime'), sortable: true, operate: 'RANGE', addclass: 'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'updatetime', title: __('Updatetime'), sortable: true, visible: false, operate: 'RANGE', addclass: 'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'status', title: __('Status'), formatter: Table.api.formatter.status},
                        {field: 'weigh', title: __('Weigh'), visible: false},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
            
            var url = '';

            $(".btn-adds").off("click").on("click", function () {
                var url = 'cms/parame/add?name=' + $(".commonsearch-table input[name=name]").val();
                //当为新选项卡中打开时
                    //Fast.api.addtabs(url, __('Add'));
                    Fast.api.open(url, __('Add'), $(this).data() || {});
                return false;
            });
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});
/*选项卡切换*/
$('.radio-btn').click(function(){
    var v = $(this).val();
    if(v == 1)
    {
        $('#content-box').show();
        $('#atlas-box').hide();
        $('#video-box').hide();
        $('#file-box').hide();
    }else if(v == 2)
    {
        $('#content-box').hide();
        $('#atlas-box').show();
        $('#video-box').hide();
        $('#file-box').hide();
    }else if(v == 3)
    {
        $('#content-box').hide();
        $('#atlas-box').hide();
        $('#video-box').show();
        $('#file-box').hide();
    }else if(v == 4)
    {
        $('#content-box').hide();
        $('#atlas-box').hide();
        $('#video-box').hide();
        $('#file-box').show();
    }
})
//使用方法: class="editor" , lang="javascript",没有.editor不会解析
$(".editor").each(function(index){
    var id = "editor_"+index;
    $(this).attr("id",id);
    var editor = ace.edit(id);
   editor.setTheme("ace/theme/visual_studio");
   editor.getSession().setMode("ace/mode/" + $(this).attr("lang"));
   editor.resize();
})



var spu={rules:null};SPU_ADMIN=function($){function t(t){"percentage"==t?$("tr.auto_hide").fadeIn("fast"):$("tr.auto_hide").fadeOut("fast")}function r(t,r){return t.val()?parseInt(t.val()):void 0!==r?r+"px":0}function e(t,r){return t.val().length>0?t.wpColorPicker("color"):void 0!==r?r:""}function n(){var t=$("#content_ifr").contents().find("html");t.trigger("spu_tinymce_init"),t.css({background:"#9C9B9B;"}),("undefined"==typeof spup_js||""==$("#spu_optin").val())&&(t.find(".spu-fields-container").remove(),t.find("#tinymce").css({padding:"25px","background-color":e($("#spu-background-color")),"border-color":e($("#spu-border-color")),"border-width":r($("#spu-border-width")),"border-style":"solid",width:$("#spu-width").val(),color:e($("#spu-color")),height:"auto","min-width":"200px","max-width":"100%",margin:"8px auto 0;"}))}return $(document).ready(function(){spu.rules.init();var r=$("#spu-options input.spu-color-field");r.length&&r.wpColorPicker({change:n,clear:n}),$("#spu-options :input").not(".spu-color-field").change(n),t($("#spu_trigger").val()),$("#spu_trigger").change(function(){t($(this).val())})}),spu.rules={$el:null,init:function(){var t=this;t.$el=$("#spu-rules"),t.$el.on("click",".rules-add-rule",function(){return t.add_rule($(this).closest("tr")),!1}),t.$el.on("click",".rules-remove-rule",function(){return t.remove_rule($(this).closest("tr")),!1}),t.$el.on("click",".rules-add-group",function(){return t.add_group(),!1}),t.$el.on("change",".param select",function(){var t=$(this).closest("tr"),r=t.attr("data-id"),e=t.closest(".rules-group"),n=e.attr("data-id"),i={action:"spu/field_group/render_rules",nonce:spu_js.nonce,rule_id:r,group_id:n,value:"",param:$(this).val()},a=$('<div class="spu-loading"><img src="'+spu_js.admin_url+'/images/wpspin_light.gif"/> </div>');t.find("td.value").html(a),$.ajax({url:ajaxurl,data:i,type:"post",dataType:"html",success:function(t){a.replaceWith(t)}})})},add_rule:function(t){var r=t.clone(),e=r.attr("data-id"),n="rule_"+(parseInt(e.replace("rule_",""),10)+1);return r.find("[name]").each(function(){$(this).attr("name",$(this).attr("name").replace(e,n)),$(this).attr("id",$(this).attr("id").replace(e,n))}),r.attr("data-id",n),t.after(r),!1},remove_rule:function(t){var r=t.siblings("tr").length;0==r?this.remove_group(t.closest(".rules-group")):t.remove()},add_group:function(){var t=this.$el.find(".rules-group:last"),r=t.clone(),e=r.attr("data-id"),n="group_"+(parseInt(e.replace("group_",""),10)+1);r.find("[name]").each(function(){$(this).attr("name",$(this).attr("name").replace(e,n)),$(this).attr("id",$(this).attr("id").replace(e,n))}),r.attr("data-id",n),r.find("h4").text(spu_js.l10n.or),r.find("tr:not(:first)").remove(),t.after(r)},remove_group:function(t){t.remove()}},{onTinyMceInit:function(){n()}}}(jQuery);
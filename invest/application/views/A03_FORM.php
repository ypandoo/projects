<script>
function dialogAjaxDone(json){
	DWZ.ajaxDone(json);
	if (json.statusCode == DWZ.statusCode.ok){
		if (json.navTabId){
			alertMsg.correct('操作成功！');
			$.pdialog.closeCurrent();
		}
	}
}
function gConfirmMsg(){
	var name = $("form[name=group_form]").find('input[name=name]').val();
	if(name == ''){
		alertMsg.info("请输入群组名称");
		return false;
	}else{
		$.post("<?php echo base_url();?>A03/form_submit", {action:'quicksave',postdata:$('form[name=group_form]').serialize()}, dialogAjaxDone, "json");
	}
}

</script>
<div class="pageContent">
	<form method="post" name="group_form">
		<div class="pageFormContent" layoutH="140">
				<label>群组名称：</label>
					<input type="text" name="name" value=""><span class="info"><font color="red">*</font></span>
			</div>
		</div>
		<div class="formBar">
			<ul>
				<!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
				<li><div class="buttonActive"><div class="buttonContent"><button type="button" onclick="gConfirmMsg();">保存</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>

		<input type="hidden" name="course_id" value="<?php echo $course_id;?>" />
	</form>
</div>

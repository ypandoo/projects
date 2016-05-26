<div style="overflow-x:hidden">
	<table class="list" width="100%" rel="jbsxBox">
		<thead>
			<tr>
				<th width="80"><input type="checkbox" group="students[]" class="checkboxCtrl">全选</th>
				<th>人员代码</th>
				<th>姓名</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($students as $k=>$v):?>
			<?php if($v['usercode'] && $v['username']):?>
			<tr target="sid_obj" rel="1">
				<td><input type="checkbox" name="students[]" class="students" value="<?php echo $v['usercode'];?>||<?php echo $v['username'];?>||<?php echo ($v['f2'] ? $v['f2']:'') . ($v['f3'] ? '|'.$v['f3']:'') . ($v['f4'] ? '|'.$v['f4']:'') . ($v['f5'] ? '|'.$v['f5']:'') . ($v['f6'] ? '|'.$v['f6']:'') . ($v['f7'] ? '|'.$v['f7']:'') . ($v['f8'] ? '|'.$v['f8']:'') . ($v['f9'] ? '|'.$v['f9']:'') . ($v['f10'] ? '|'.$v['f10']:'');?>"/></td>
				<td><?php echo $v['usercode'];?></td>
				<td><?php echo $v['username'];?></td>
			</tr>
			<?php endif;?>
			<?php endforeach;?>
		</tbody>
	</table>
</div>
<script>
$("#add_students_button").click(function(){
	var s = [];
	$(".students").each(function(){
		if($(this).attr("checked") == "checked"){
			s.push($(this).val());
		}
	});

	if(s.length == 0){
		alertMsg.error('请选择人员');
		return false;
	}
	$.ajax({
		url:"A02/add_students",
		data:{students:s.join(",")},
		type:'post',
		dataType:'json',
		success:function(res){
			$("#students_list_div").loadUrl("A02/students_grid");
		}
	});
});
</script>
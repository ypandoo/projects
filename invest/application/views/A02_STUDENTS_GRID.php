<div style="overflow-x:hidden">
	<table class="list" width="100%">
		<thead>
			<tr>
				<th width="80"><input type="checkbox" group="remove_students[]" class="checkboxCtrl">全选</th>
				<th>人员代码</th>
				<th>姓名</th>
				<!--<th>所属部门</th>-->
			</tr>
		</thead>
		<tbody>
			<?php foreach($students as $k=>$v):?>
			<tr target="sid_obj" rel="1">
				<td><input type="checkbox" name="remove_students[]" class="remove_students" value="<?php echo $v['usercode'];?>"/></td>
				<td><?php echo $v['usercode'];?></td>
				<td><?php echo $v['username'];?></td>
				<!--<td><?php echo $v['deptment'];?></td>-->
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</div>

<script>
$("#remove_students_button").click(function(){
	var rs = [];
	$(".remove_students").each(function(){
		if($(this).attr("checked") == "checked"){
			rs.push($(this).val());
		}
	});

	if(rs.length == 0){
		alertMsg.error('请选择人员');
		return false;
	}
	$.ajax({
		url:"A02/remove_students",
		data:{students:rs.join(",")},
		type:'post',
		dataType:'json',
		success:function(res){
			$("#students_list_div").loadUrl("A02/students_grid");
		}
	});
});
</script>

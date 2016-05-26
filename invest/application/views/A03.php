<script>
function navTabAjaxDone(json){
	DWZ.ajaxDone(json);
	if (json.statusCode == DWZ.statusCode.ok){
		if (json.navTabId){
			navTab.reload(json.forwardUrl, {}, json.navTabId);
		}
	}
}
</script>
<form id="pagerForm" method="post" action="<?php echo base_url();?>A03">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="<?php echo $datalist['numPerPage'];?>" />
	<input type="hidden" name="orderField" value="<?php echo $datalist['orderField'];?>" />
</form>
<div class="pageContent">
	<div class="pageHeader">
		<form rel="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo base_url();?>A03" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
					关键字段：
					<select name="field" style="width:126px;height:23px;">
						<?php foreach($fields as $k=>$v):?>
						<option value="<?php echo $k;?>" <?php echo $k==$field ? "selected":"";?>><?php echo $v;?></option>
						<?php endforeach;?>
					</select>
					<input type="text" name="keywords" value="<?php echo $keywords?>" style="width:126px;height:18px;"/>
					</td>
				</tr>
			</table>
			<div class="subBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div></li>
				</ul>
			</div>
		</div>
		</form>
	</div>
	<?php if($this->admin_type > 0):?> 
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="<?php echo base_url();?>A03/form_edit" target="navTab" rel="main" title="新增群组"><span>新增群组</span></a></li>
			<li><a class="edit" href="<?php echo base_url();?>A03/form_edit?group_id={group_id}" target="navTab" rel="main" title="编辑群组"><span>编辑群组</span></a></li>
			<li><a class="delete" href="<?php echo base_url();?>A03/form_submit?action=remove&group_id={group_id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<!--
			<li class="line"></li>
			<li><a class="icon" href="<?php echo base_url();?>A03/form_submit?action=finish&course_id={course_id}" target="ajaxTodo" title="确定要设置完成吗?"><span>设置完成</span></a></li>
			-->
		</ul>
	</div>
	<?php endif;?>
	<table class="table" width="100%" layoutH="141">
		<thead>
			<tr>
				<th>序号</th>
				<th>群组名称</th>
				<th>人数</th>
				<th>创建人</th>
				<th>创建时间</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1;foreach($datalist['list'] as $v):?>
			<tr target="group_id" rel="<?php echo $v['id']?>">
				<td><?php echo $i?></td>
				<td><?php echo $v['name']?></td>
				<td><?php echo $v['total_students']?></td>
				<td><?php echo $v['create_user']?></td>
				<td><?php echo $v['create_time']?></td>
			</tr>
			<?php $i++;endforeach;?>
		</tbody>
	</table>
	<?php 
	echo MY_Controller::loadPageNavigation($datalist);
	?>

</div>
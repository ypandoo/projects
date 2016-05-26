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
<form id="pagerForm" method="post" action="<?php echo base_url();?>A02">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="<?php echo $datalist['numPerPage'];?>" />
	<input type="hidden" name="orderField" value="<?php echo $datalist['orderField'];?>" />
</form>
<div class="pageContent">
	<div class="pageHeader">
		<form rel="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo base_url();?>A02" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
					<!--
					课程状态
					<select name="status">
						<option value="">不限</option>
						<?php 
						$CS = MY_Controller::loadItems('COURSE_STATUS');
						foreach($CS as $k=>$v):?>
							<option value="<?php echo $k;?>" <?php echo $status != '' && $k == $status ? "selected":""?>><?php echo $v;?></option>
						<?php endforeach;?>
					</select>
					</td>
					-->
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
			<li><a class="add" href="<?php echo base_url();?>A02/form" target="navTab" rel="main" title="新增课程"><span>新增课程</span></a></li>
			<li><a class="edit" href="<?php echo base_url();?>A02/form?course_id={course_id}" target="navTab" rel="main" title="编辑课程"><span>编辑课程</span></a></li>
			<li><a class="delete" href="<?php echo base_url();?>A02/form_submit?action=remove&course_id={course_id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<!--
			<li class="line"></li>
			<li><a class="icon" href="<?php echo base_url();?>A02/form_submit?action=finish&course_id={course_id}" target="ajaxTodo" title="确定要设置完成吗?"><span>设置完成</span></a></li>
			-->
		</ul>
	</div>
	<?php endif;?>
	<table class="table" width="100%" layoutH="<?php echo $this->admin_type > 0 ? '141' : '114';?>">
		<thead>
			<tr>
				<th>序号</th>
				<th>课程名称</th>
				<th>讲师姓名</th>
				<th>培训时间</th>
				<!--<th>参与人数</th>
				<th>当前状态</th>
				-->
				<th>创建人</th>
				<th>创建时间</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1;foreach($datalist['list'] as $v):?>
			<tr target="course_id" rel="<?php echo $v['id']?>">
				<td><?php echo $i?></td>
  				<td><?php echo $v['title']?></td>
				<td><?php echo $v['teacher']?></td>
				<td><?php echo $v['datetime']?></td>
				<!--
				<td><?php echo $v['total_students']?></td>
				<td><?php echo MY_Controller::loadItems('COURSE_STATUS',$v['status']);?></td>
				-->
				<td><?php echo $v['realname']?></td>
				<td><?php echo $v['timestamp']?></td>
			</tr>
			<?php $i++;endforeach;?>
		</tbody>
	</table>
	<?php 
	echo MY_Controller::loadPageNavigation($datalist);
	?>

</div>
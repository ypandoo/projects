package com.gxcz.xuhui.investment.controller;

import java.math.BigDecimal;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.UUID;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.propertyeditors.CustomDateEditor;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.WebDataBinder;
import org.springframework.web.bind.annotation.InitBinder;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

import com.gxcz.xuhui.investment.model.FollowSchemeInfo;
import com.gxcz.xuhui.investment.model.dto.FollowSchemeInfoDTO;
import com.gxcz.xuhui.investment.model.dto.ResultDTO;
import com.gxcz.xuhui.investment.service.impl.IFollowSchemeService;

@Controller
@RequestMapping("/FollowSchemeController")
public class FollowSchemeController {
	IFollowSchemeService followSchemeService=null;

	public IFollowSchemeService getFollowSchemeService() {
		return followSchemeService;
	}
	@Autowired
	public void setFollowSchemeService(IFollowSchemeService followSchemeService) {
		this.followSchemeService = followSchemeService;
	}
	 /* 
	  * 表单提交日期绑定 
	  */  
	 @InitBinder  
	 public void initBinder(WebDataBinder binder) {  
	     SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");  
	     dateFormat.setLenient(false);  
	     binder.registerCustomEditor(Date.class, new CustomDateEditor(dateFormat, true));  
	 }  
	 
	@RequestMapping("/saveOrUpdate")
	public String saveOrUpdate(@ModelAttribute("follschemeDto") FollowSchemeInfoDTO follschemeDto){
		ResultDTO resultDto=new ResultDTO();
		FollowSchemeInfo record=null;
		BigDecimal multiplicand = new BigDecimal("10000");
		try{
			follschemeDto.setFollowAmount(follschemeDto.getFollowAmount().multiply(multiplicand));
			follschemeDto.setGroupForceAmount(follschemeDto.getGroupForceAmount().multiply(multiplicand));
			follschemeDto.setCompForceAmount(follschemeDto.getCompForceAmount().multiply(multiplicand));
			follschemeDto.setCompChoiceAmount(follschemeDto.getCompChoiceAmount().multiply(multiplicand));
			follschemeDto.setMinamount(follschemeDto.getMinamount().multiply(multiplicand));
			follschemeDto.setMaxamount(follschemeDto.getMaxamount().multiply(multiplicand));
			record=follschemeDto.toModelVO(follschemeDto);
			int resultint=0;
			if(!"null".equals(record.getSchemeId())&&!"".equals(record.getSchemeId()) && record.getSchemeId()!=null){
				resultint=followSchemeService.updateByPrimaryKey(record);
			}else{
				record.setSchemeId(UUID.randomUUID().toString());
				resultint=followSchemeService.insert(record);
			}
			resultDto.setBaseModel(record);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return "redirect:/back/projectManage.jsp?projectId="+record.getProjectId()+"&schemeid="+record.getSchemeId();
	}
	@RequestMapping("/getSchemeByProjectId")
	@ResponseBody
	public ResultDTO getProjectById(@RequestParam("projectId") String projectId){
		ResultDTO resultDto=new ResultDTO();
		try{
			FollowSchemeInfo followSchemeInfo =followSchemeService.selectByProjectId(projectId);
			if(followSchemeInfo==null){
				followSchemeInfo=new FollowSchemeInfo();
			}
			resultDto.setSuccess(true);
			resultDto.setBaseModel(followSchemeInfo);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}

	@RequestMapping("/deleteSchemeLink")
	@ResponseBody
	public ResultDTO deleteSchemeLink(@RequestParam("schemeId") String schemeId, @RequestParam("schemeLink") String schemeLink){
		ResultDTO resultDto=new ResultDTO();
		try{
			FollowSchemeInfo record = new FollowSchemeInfo();
			record.setSchemeId(schemeId);
			record.setFollowChemeLink(schemeLink);
			followSchemeService.updateByPrimaryKeySelective(record);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
}

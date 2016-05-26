package com.gxcz.xuhui.investment.controller;

import java.math.BigDecimal;
import java.util.Date;
import java.util.List;
import java.util.UUID;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;
import org.json.*;

import com.gxcz.common.util.BaseUtil;
import com.gxcz.xuhui.investment.model.CompleteSubscribeRecord;
import com.gxcz.xuhui.investment.model.ForceFollowInfo;
import com.gxcz.xuhui.investment.model.dto.CompleteSubscribeRecordDTO;
import com.gxcz.xuhui.investment.model.dto.ForceModelDTO;
import com.gxcz.xuhui.investment.model.dto.QueryParamDTO;
import com.gxcz.xuhui.investment.model.dto.ResultDTO;
import com.gxcz.xuhui.investment.service.ICompleteSubscribeRecordService;
import com.gxcz.xuhui.investment.service.impl.IForceFollowService;

@Controller
@RequestMapping("/ForceFollowController")
public class ForceFollowController {
	IForceFollowService forceFollowService=null;
	ICompleteSubscribeRecordService completeSubscribeRecordService=null;

	public IForceFollowService getForceFollowService() {
		return forceFollowService;
	}
	@Autowired
	public void setForceFollowService(IForceFollowService forceFollowService) {
		this.forceFollowService = forceFollowService;
	}	
	
	public ICompleteSubscribeRecordService getCompleteSubscribeRecordService() {
		return completeSubscribeRecordService;
	}
	@Autowired
	public void setCompleteSubscribeRecordService(ICompleteSubscribeRecordService completeSubscribeRecordService) {
		this.completeSubscribeRecordService = completeSubscribeRecordService;
	}
	
	@RequestMapping("/saveOrUpdate")
	public String saveOrUpdate(@ModelAttribute("form") ForceModelDTO forceModel){
		ResultDTO resultDto=new ResultDTO();
		String projectid="";
		try{
			projectid=forceModel.getProjectid();
			int result=forceFollowService.saveOrUpdate(forceModel);
			resultDto.setBaseModel(null);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return "redirect:/back/projectManage.jsp?projectId="+projectid;
	}
	
	@RequestMapping("/insert")
	@ResponseBody
	public ResultDTO insert(@RequestParam("projectId") String projectId, @RequestParam("objStr") String objStr){
		ResultDTO resultDto=new ResultDTO();
		
		try {
			ForceFollowInfo record = null;
			JSONArray jsonArr = new JSONArray(objStr);
			JSONObject json = null;
			for(int i=0; i<jsonArr.length(); i++){
				record = new ForceFollowInfo();
//				json = new JSONObject(jsonArr.get(i));
				json = jsonArr.getJSONObject(i);
				
				record.setForceFollowId(UUID.randomUUID().toString());
				record.setName(json.getString("name"));
				record.setCompany(json.getString("company"));
				record.setDepartment(json.getString("department"));
				record.setDownlimit(new BigDecimal(json.getString("downLimit")));
				record.setToplimit(new BigDecimal(json.getString("topLimit")));
				record.setDuty(json.getString("duty"));
				record.setProjectId(projectId);
				record.setRemark(json.getString("remark"));
				record.setForceType(json.getString("forceType"));
				record.setCreatetime(new Date());
				forceFollowService.insert(record);
			}
			resultDto.setSuccess(true);
		} catch (Exception ex) {
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}	

	@RequestMapping("/update")
	@ResponseBody
	public ResultDTO update(@RequestParam("forceFollowId") String forceFollowId, @RequestParam("objStr") String objStr){
		ResultDTO resultDto=new ResultDTO();
		try {
			ForceFollowInfo record = null;
			JSONArray jsonArr = new JSONArray(objStr);
			JSONObject json = null;
			for(int i=0; i<jsonArr.length(); i++){
//				json = new JSONObject(jsonArr.get(i));
				json = jsonArr.getJSONObject(i);
				record = new ForceFollowInfo();
				record.setForceFollowId(forceFollowId);
				record.setDownlimit(new BigDecimal(json.getString("downLimit")));
				record.setToplimit(new BigDecimal(json.getString("topLimit")));
				forceFollowService.updateByPrimaryKeySelective(record);
			}
			resultDto.setSuccess(true);
		} catch (Exception ex) {
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}

	@RequestMapping("/delete")
	@ResponseBody
	public ResultDTO delete(@RequestParam("forceFollowId") String forceFollowId){
		ResultDTO resultDto=new ResultDTO();
		try{
			forceFollowService.deleteByPrimaryKey(forceFollowId);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	
	@RequestMapping("/getForceByProjectId")
	@ResponseBody
	public ResultDTO getProjectById(@RequestParam("projectId") String projectId,@RequestParam("forceType") String forceType){
		ResultDTO resultDto=new ResultDTO();
		try{
			ForceFollowInfo info = new ForceFollowInfo();
			info.setProjectId(projectId);
			info.setForceType(forceType);
			List<ForceFollowInfo> list=forceFollowService.selectByProjectId(info);
			resultDto.setSuccess(true);
			resultDto.setDataDto(list);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	
	@RequestMapping("/keyForceList")
	@ResponseBody
	public ResultDTO keyForceList(@RequestParam("projectId") String projectId){
		ResultDTO resultDto=new ResultDTO();
		
		try{
			ForceFollowInfo info = new ForceFollowInfo();
			info.setProjectId(projectId);
			info.setForceType("1");
			List<ForceFollowInfo> list=forceFollowService.selectByProjectId(info);
			
			QueryParamDTO queryDto = new QueryParamDTO();
			queryDto.setProjectId(projectId);
			queryDto.setPageSize(999);
			List<CompleteSubscribeRecordDTO> compList = completeSubscribeRecordService.queryAllUnCompleteRecord(queryDto);
			
			boolean b = true;
			ForceFollowInfo tempInfo = null;
			CompleteSubscribeRecord record = new CompleteSubscribeRecord();
			record.setProjectId(projectId);
			for(int i=0; i<list.size(); i++){
				b = true;
				tempInfo = list.get(i);
				for(int j=0; j<compList.size(); j++){
					if(tempInfo.getUid().equals(compList.get(j).getUid())){
						b = false;
						break;
					}
				}
				if(b){
					record.setUid(tempInfo.getUid());
					record.setContributiveAmount(tempInfo.getDownlimit());
					record.setLeverageAmount(new BigDecimal(Float.parseFloat(tempInfo.getDownlimit().toString())*4));
					record.setContributiveConfirmAmount(tempInfo.getDownlimit());
					record.setConfirmLeverageAmt(new BigDecimal(Float.parseFloat(tempInfo.getDownlimit().toString())*4));
					record.setBankNo("");
					/* 最后拼接一个下标数值，防止生成无法通过毫秒区分的code */
					record.setNumber(BaseUtil.formatDate(new Date(), "yyyyMMdd-HHmmssSSS")+i);
					completeSubscribeRecordService.insert(record);
				}
			}
			resultDto.setSuccess(true);
		}catch(Exception ex){
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		
		return resultDto;
	}
	
}

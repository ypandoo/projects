package com.gxcz.xuhui.investment.controller;

import java.io.IOException;
import java.text.ParseException;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import javax.servlet.ServletContext;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.multipart.commons.CommonsMultipartFile;
import org.springframework.web.multipart.support.DefaultMultipartHttpServletRequest;

import com.gxcz.common.util.BaseUtil;
import com.gxcz.common.util.ExcelUtil;
import com.gxcz.xuhui.investment.model.ForceFollowInfo;
import com.gxcz.xuhui.investment.model.PayInDetail;
import com.gxcz.xuhui.investment.model.dto.PayInDetailDTO;
import com.gxcz.xuhui.investment.model.dto.ResultDTO;
import com.gxcz.xuhui.investment.service.ICompleteSubscribeRecordService;
import com.gxcz.xuhui.investment.service.impl.IForceFollowService;
import com.gxcz.xuhui.investment.service.impl.IPayInDetailService;

@Controller
@RequestMapping("/PayInDetailController")
public class PayInDetailController {
	IPayInDetailService payInDetailService = null;

	IForceFollowService forceFollowService=null;

	
	private ICompleteSubscribeRecordService completeSubscribeRecordService;

	public ICompleteSubscribeRecordService getCompleteSubscribeRecordService() {
		return completeSubscribeRecordService;
	}

	@Autowired
	public void setCompleteSubscribeRecordService(ICompleteSubscribeRecordService completeSubscribeRecordService) {
		this.completeSubscribeRecordService = completeSubscribeRecordService;
	}
	
	public IPayInDetailService getPayInDetailService() {
		return payInDetailService;
	}

	@Autowired
	public void setPayInDetailService(IPayInDetailService payInDetailService) {
		this.payInDetailService = payInDetailService;
	}	
	
	public IForceFollowService getForceFollowService() {
		return forceFollowService;
	}

	@Autowired
	public void setForceFollowService(IForceFollowService forceFollowService) {
		this.forceFollowService = forceFollowService;
	}

	@RequestMapping("/delete")
	@ResponseBody
	protected ResultDTO delete(@RequestParam("piId") String piId){
		ResultDTO resultDto=new ResultDTO();
		try{
			payInDetailService.deleteByPrimaryKey(piId);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	
	@RequestMapping(value="/selectListByDetail",method=RequestMethod.POST)
	protected @ResponseBody ResultDTO selectListByDetail(@RequestBody PayInDetailDTO payInDto,HttpServletRequest request,HttpServletResponse response){
		ResultDTO resultDto = new ResultDTO();
		try{
			List<PayInDetailDTO> dataDto = payInDetailService.selectByDetail(payInDto);
			
			ForceFollowInfo info = new ForceFollowInfo();
			info.setProjectId(payInDto.getProjectId());
			info.setForceType("");
			List<ForceFollowInfo> list=forceFollowService.selectByProjectId(info);
			for(int i=0; i<list.size(); i++){
				for(int j=0; j<dataDto.size(); j++){
					if(dataDto.get(j).getUserId().equals(list.get(i).getUid())){
						dataDto.get(j).setSubType(list.get(i).getCompany());
					}
				}
			}
			
			resultDto.setDataDto(dataDto);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}	

	/**
	 * 批量导入缴款数据
	 * @param session
	 * @param projectId
	 * @return
	 */
	@RequestMapping("/callPayInImport")
	public @ResponseBody String callPayInImport(HttpSession session,DefaultMultipartHttpServletRequest request){
		ResultDTO resultDto=new ResultDTO();
		CommonsMultipartFile file = (CommonsMultipartFile)  request.getFile("piFileUp");
		if(file!= null){
			try {
				String fileName = file.getOriginalFilename();
				// 导入对象
				List<PayInDetail> allList = ExcelUtil.readPayInDetailExcel(file,fileName,completeSubscribeRecordService);
				
				PayInDetailDTO payInDto = new PayInDetailDTO();
				// 已存储对象
				List<PayInDetailDTO> allPIList = payInDetailService.selectByDetail(payInDto);
				
				List<PayInDetail> insertList = new ArrayList<PayInDetail>();
				List<PayInDetail> updateList = new ArrayList<PayInDetail>();
				PayInDetail piInfo = null;
				PayInDetailDTO piDto = null;
				// 操作标识  true:update  false:insert
				boolean b = false;
				for (int i = 0; i < allList.size(); i++) {
					b = false;
					piInfo = allList.get(i);
					for (int j = 0; j < allPIList.size(); j++) {
						piDto = allPIList.get(j);
						if (piInfo.getProjectId().equals(piDto.getProjectId()) && piInfo.getUserId().equals(piDto.getUserId()) && (piInfo.getPiTimes().compareTo(piDto.getPiTimes()) == 0)) {
							// 已存储中，用户、项目、缴款批次全部匹配则更新
							b = true;
							break;
						}
					}
					if (b) {
						// 如果是修改操作，则更新number_code作为修改条件
						piInfo.setNumberCode(piDto.getNumberCode());
						updateList.add(piInfo);
					} else {
						// 新增缴款记录
						insertList.add(piInfo);
					}
				}
				if(updateList.size() > 0){
					payInDetailService.updateBatch(updateList);
				}
				if(insertList.size() > 0){
					payInDetailService.insertBatch(insertList);
				}
				//resultDto.setBaseModel(null);
				resultDto.setSuccess(true);
			} catch (IOException e) {
				e.printStackTrace();
				resultDto.setSuccess(false);
				resultDto.setError("文件不存在,请检查！");
			}catch(NumberFormatException ex){
				ex.printStackTrace();
				resultDto.setSuccess(false);
				resultDto.setError("导入的数据类数据格式有误,请检查！");
			}catch(ParseException ex){
				ex.printStackTrace();
				resultDto.setSuccess(false);
				resultDto.setError("导入的日期类数据格式有误,请检查！");
			}
		}else{
			resultDto.setSuccess(false);
			resultDto.setError("文件不存在,请检查！");
		}
		return resultDto.toString();
	}
	

	/**
	 * 缴款确认数据导出
	 * @param bonusIds
	 * @return
	 */
	@RequestMapping("/callPayInExport")
	public @ResponseBody ResultDTO callPayInExport(HttpSession session,HttpServletResponse response,@RequestParam("piIds") String piIds,@RequestParam("projectId") String projectId){
		ResultDTO result = new ResultDTO();
		List<PayInDetail> piIdList = new ArrayList<PayInDetail>();
		PayInDetail detail = new PayInDetail();
		if(piIds != null && !piIds.equals("")){
			String uidArr[] = piIds.split(",");
			for(int i=0; i<uidArr.length; i++){
				detail = new PayInDetail();
				detail.setPiId(uidArr[i]);
				detail.setProjectId(projectId);
				piIdList.add(detail);
			}
		}else{
			detail.setProjectId(projectId);
			piIdList.add(detail);
		}
		
		List<PayInDetailDTO> data =payInDetailService.getListById(piIdList);
		
		ForceFollowInfo info = new ForceFollowInfo();
		info.setProjectId(projectId);
		info.setForceType("");
		List<ForceFollowInfo> list=forceFollowService.selectByProjectId(info);
		for(int i=0; i<list.size(); i++){
			for(int j=0; j<data.size(); j++){
				if(data.get(j).getUserId().equals(list.get(i).getUid())){
					data.get(j).setSubType(list.get(i).getCompany());
				}
			}
		}
		
		ServletContext  application  = session.getServletContext();
		String serverRealPath = application.getRealPath("/") ;
		String srcFilePath = serverRealPath+"templet//PayInDetail.xlsx";
		String newFile ="d://export//"+"缴款明细-"+BaseUtil.formatDate(new Date(), "yyyyMMddHHmmss")+".xlsx";
		ExcelUtil.writePiListExcel(srcFilePath,newFile,data,response);
		result.setDataDto(data);
		result.setSuccess(true);
		return result;
	}
}

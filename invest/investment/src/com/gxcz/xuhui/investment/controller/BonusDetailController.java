package com.gxcz.xuhui.investment.controller;

import java.io.File;
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.math.BigDecimal;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.UUID;

import javax.servlet.ServletContext;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.util.FileCopyUtils;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.multipart.commons.CommonsMultipartFile;
import org.springframework.web.multipart.support.DefaultMultipartHttpServletRequest;

import com.gxcz.common.util.BaseUtil;
import com.gxcz.common.util.ExcelUtil;
import com.gxcz.xuhui.investment.model.BonusDetail;
import com.gxcz.xuhui.investment.model.ForceFollowInfo;
import com.gxcz.xuhui.investment.model.UserInfo;
import com.gxcz.xuhui.investment.model.dto.BonusDetailDTO;
import com.gxcz.xuhui.investment.model.dto.ResultDTO;
import com.gxcz.xuhui.investment.service.ICompleteSubscribeRecordService;
import com.gxcz.xuhui.investment.service.impl.IBonusDetailService;
import com.gxcz.xuhui.investment.service.impl.IForceFollowService;

@Controller
@RequestMapping("/BonusDetailController")
public class BonusDetailController {
	IForceFollowService forceFollowService=null;
	
	IBonusDetailService bonusDetailService=null;

	private ICompleteSubscribeRecordService completeSubscribeRecordService;

	public ICompleteSubscribeRecordService getCompleteSubscribeRecordService() {
		return completeSubscribeRecordService;
	}

	@Autowired
	public void setCompleteSubscribeRecordService(ICompleteSubscribeRecordService completeSubscribeRecordService) {
		this.completeSubscribeRecordService = completeSubscribeRecordService;
	}
	public IForceFollowService getForceFollowService() {
		return forceFollowService;
	}

	@Autowired
	public void setForceFollowService(IForceFollowService forceFollowService) {
		this.forceFollowService = forceFollowService;
	}

	public IBonusDetailService getBonusDetailService() {
		return bonusDetailService;
	}
	
	@Autowired
	public void setBonusDetailService(IBonusDetailService bonusDetailService) {
		this.bonusDetailService = bonusDetailService;
	}
	
	@RequestMapping("/delete")
	@ResponseBody
	protected ResultDTO delete(@RequestParam("bonusId") String bonusId){
		ResultDTO resultDto=new ResultDTO();
		try{
			int resultInt=bonusDetailService.deleteByPrimaryKey(bonusId);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	
	@RequestMapping("/update")
	@ResponseBody
	protected ResultDTO update(@RequestBody BonusDetail bonusDetail){
		ResultDTO resultDto=new ResultDTO();
		try{
			int resultInt=bonusDetailService.updateByPrimaryKey(bonusDetail);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	@RequestMapping("/insert")
	@ResponseBody
	protected ResultDTO insert(@RequestParam("projectId") String projectId,@RequestParam("userid") String userid,
			@RequestParam("subscribeType") String subscribeType,@RequestParam("subscribeAmount") String subscribeAmount,
			@RequestParam("bonusTimes") String bonusTimes,@RequestParam("bonusAmount") String bonusAmount){
		ResultDTO resultDto=new ResultDTO();
		try{
			BonusDetail bonusDetail=new BonusDetail();
			SimpleDateFormat sdf=new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
			Date nowDate= new Date();
			bonusDetail.setBonusDate(sdf.parse(sdf.format(nowDate)));
			bonusDetail.setProjectId(projectId);
			bonusDetail.setUserid(userid);
			bonusDetail.setSubscribeType(subscribeType);
			bonusDetail.setSubscribeAmount(new BigDecimal(subscribeAmount));
			bonusDetail.setBonusTimes(new BigDecimal(bonusTimes));
			bonusDetail.setBonusAmount(new BigDecimal(bonusAmount));
			bonusDetail.setBonusId(UUID.randomUUID().toString());
			bonusDetail.setNumber(BaseUtil.formatDate(new Date(), "yyyyMMdd-HHmmss"));
			int resultInt=bonusDetailService.insert(bonusDetail);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	@RequestMapping("/getBonusDetailList")
	@ResponseBody
	protected ResultDTO getBonusDetailList(HttpSession session,@RequestParam("startDate") String startDate,
			@RequestParam("endDate") String endDate,@RequestParam("projectName") String projectName,
			@RequestParam("userid") String userid,@RequestParam("startPage") int startPage,
			@RequestParam("endPage") int endPage,@RequestParam("projectId") String projectId){
		ResultDTO resultDto=new ResultDTO();
		try{
			BonusDetailDTO bonusDetailDto=new BonusDetailDTO();
			String uid = "";
			if(!userid.equals("") || userid.length() > 0){
				UserInfo userInfo = (UserInfo)session.getAttribute("userInfo");
				uid = userInfo.getUid();
			}
			bonusDetailDto.setUserid(uid);
			bonusDetailDto.setStartDate(startDate);
			bonusDetailDto.setEndDate(endDate);
			bonusDetailDto.setProjectName(projectName);
			bonusDetailDto.setStartPage(startPage);
			bonusDetailDto.setPageSize(endPage-startPage);
			bonusDetailDto.setProjectId(projectId);
			List<BonusDetailDTO> bonusDetailList= bonusDetailService.getBonusDetailList(bonusDetailDto);
			
			resultDto.setDataDto(bonusDetailList);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	

	/**
	 * 分红明细导出
	 * @param bonusIds
	 * @return
	 */
	@RequestMapping("/callBonusExport")
	public @ResponseBody ResultDTO callBonusExport(HttpSession session,HttpServletResponse response,@RequestParam("bonusIds") String bonusIds,@RequestParam("projectId") String projectId){
		ResultDTO result = new ResultDTO();
		List bonusIdList = new ArrayList();
		BonusDetail detail = new BonusDetail();
		if(bonusIds != null && !bonusIds.equals("")){
			String uidArr[] = bonusIds.split(",");
			for(int i=0; i<uidArr.length; i++){
				detail = new BonusDetail();
				detail.setBonusId(uidArr[i]);
				detail.setProjectId(projectId);
				bonusIdList.add(detail);
			}
		}else{
			detail.setProjectId(projectId);
			bonusIdList.add(detail);
		}
		
		List<BonusDetailDTO> data =bonusDetailService.getBonusDetailByList(bonusIdList);
		
		ServletContext  application  = session.getServletContext();   
		String serverRealPath = application.getRealPath("/") ;
		String srcFilePath = serverRealPath+"templet//BonusDetail.xlsx";
		String newFile ="d://export//"+"分红明细-"+BaseUtil.formatDate(new Date(), "yyyyMMddHHmmss")+".xlsx";
		ExcelUtil.writeBonusDetailExcel(srcFilePath,newFile,data,response);
		result.setDataDto(data);
		result.setSuccess(true);
		return result;
	}
	
	
	/**
	 * 导入
	 * @param session
	 * @param projectId
	 * @return
	 */
	@RequestMapping("/callBonusImport")
	public @ResponseBody String callBonusImport(HttpSession session,DefaultMultipartHttpServletRequest request){
	   CommonsMultipartFile file = (CommonsMultipartFile)  request.getFile("bonusFileUp");
	   String fileName = file.getOriginalFilename();
		 ResultDTO resultDto=new ResultDTO();
		 if(file!= null){
			List<BonusDetail> insertList = new ArrayList<BonusDetail>();
			List<BonusDetail> updateList = new ArrayList<BonusDetail>();
			 try {
				// 导入对象
				List<BonusDetail> bonusList = ExcelUtil.readBonusDetailExcel(file,fileName,completeSubscribeRecordService);
				
				BonusDetailDTO bonusDetailDTO = new BonusDetailDTO();
				bonusDetailDTO.setPageSize(999);
				// 已存储对象
				List<BonusDetailDTO> allList = bonusDetailService.getBonusDetailList(bonusDetailDTO);
				
				BonusDetail bonusInfo = new BonusDetail();
				BonusDetailDTO bonusDto = new BonusDetailDTO();
				// 操作标识  true:update  false:insert
				boolean b = false;
				for(int i=0; i<bonusList.size(); i++){
					b = false;
					bonusInfo = bonusList.get(i);
					for(int j=0; j<allList.size(); j++){
						bonusDto = allList.get(j);
						if(bonusInfo.getProjectId().equals(bonusDto.getProjectId())
							&& bonusInfo.getUserid().equals(bonusDto.getUserid())
							&& (bonusInfo.getBonusTimes().compareTo(bonusDto.getBonusTimes())==0)){
							// 已存储中，用户、项目、缴款批次全部匹配则更新
							b = true;
							break;
						}
					}
					if(b){
						// 如果是修改操作，则更新number_code作为修改条件
						bonusInfo.setNumber(bonusDto.getNumber());
						updateList.add(bonusInfo);
					}else{
						// 新增缴款记录
						insertList.add(bonusInfo);
					}
				}
				
				if(updateList.size() > 0){
					bonusDetailService.updateBatch(updateList);
				}
				if(insertList.size() > 0){
					bonusDetailService.insertBatch(insertList);
				}
				
				resultDto.setBaseModel(null);
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
	
}

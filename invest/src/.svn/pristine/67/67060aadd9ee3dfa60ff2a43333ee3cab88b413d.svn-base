package com.gxcz.xuhui.investment.controller;

import java.util.ArrayList;
import java.util.List;
import java.util.UUID;

import javax.servlet.http.HttpSession;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

import com.gxcz.xuhui.investment.model.UserInfo;
import com.gxcz.xuhui.investment.model.UserProjectRelate;
import com.gxcz.xuhui.investment.model.dto.ResultDTO;
import com.gxcz.xuhui.investment.model.dto.UserInfoDTO;
import com.gxcz.xuhui.investment.model.dto.UserProjectRelateDTO;
import com.gxcz.xuhui.investment.service.impl.IUserProjectRelateService;

@Controller
@RequestMapping("/UserProjectRelateController")
public class UserProjectRelateController {
	IUserProjectRelateService userProjectRelateService=null;

	public IUserProjectRelateService getUserProjectRelateService() {
		return userProjectRelateService;
	}
	@Autowired
	public void setUserProjectRelateService(IUserProjectRelateService userProjectRelateService) {
		this.userProjectRelateService = userProjectRelateService;
	}
	@RequestMapping("/getUserProjectList")
	@ResponseBody
	public ResultDTO getUserProjectList(HttpSession session,@RequestParam("projectName") String projectName,UserProjectRelateDTO userProjectRelateDTO,@RequestParam("startPage") int startPage,@RequestParam("endPage") int endPage){
		ResultDTO resultDto=new ResultDTO();
		try{
			UserInfo userInfo= (UserInfo) session.getAttribute("userInfo");
			userProjectRelateDTO.setUid(userInfo.getUid());
			userProjectRelateDTO.setType("2");//信息管理员
			userProjectRelateDTO.setProjectName(projectName);
			userProjectRelateDTO.setStartPage(startPage);
			userProjectRelateDTO.setPageSize(endPage-startPage);
			List<UserProjectRelateDTO> list= userProjectRelateService.getUserProjectList(userProjectRelateDTO);
			resultDto.setDataDto(list);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	@RequestMapping("/getUserManageProjectList")
	@ResponseBody
	public ResultDTO getUserManageProjectList(HttpSession session,@RequestParam("projectName") String projectName,UserProjectRelateDTO userProjectRelateDTO){
		ResultDTO resultDto=new ResultDTO();
		try{
			UserInfo userInfo= (UserInfo) session.getAttribute("userInfo");
			userProjectRelateDTO.setUid(userInfo.getUid());
			userProjectRelateDTO.setType("3");//跟投管理员
			userProjectRelateDTO.setProjectName(projectName);
			List<UserProjectRelateDTO> list= userProjectRelateService.getUserProjectList(userProjectRelateDTO);
			resultDto.setDataDto(list);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	@RequestMapping("/deleteProject")
	@ResponseBody
	public ResultDTO deleteProject(HttpSession session,@RequestParam("projectId") String projectId,UserProjectRelateDTO userProjectRelateDTO){
		ResultDTO resultDto=new ResultDTO();
		try{
//			UserInfo userInfo= (UserInfo) session.getAttribute("userInfo");
			userProjectRelateService.deleteRelateByProject(projectId);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError("项目已经关联其他，不允许删除");
		}
		return resultDto;
	}
	@RequestMapping("/saveUserProject")
	@ResponseBody
	public ResultDTO saveUserProject(HttpSession session,@RequestParam("projectName") String projectName,@RequestParam("projectArea")String projectArea ){
		ResultDTO resultDto=new ResultDTO();
		try{
			UserInfo userInfo= (UserInfo) session.getAttribute("userInfo");
			String userid=userInfo.getUid();
			UserProjectRelateDTO userProjectDto=new UserProjectRelateDTO();
			userProjectDto.setUid(userid);
			userProjectDto.setProjectArea(projectArea);
			userProjectDto.setProjectName(projectName);
			userProjectRelateService.saveUserProject(userProjectDto);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	
	@RequestMapping("/deleteRelateByUserProject")
	@ResponseBody
	public ResultDTO deleteRelateByUserProject(@RequestParam("projectId") String projectId,@RequestParam("userId") String userId){
		ResultDTO resultDto=new ResultDTO();
		try{
			UserProjectRelateDTO userProjectRelateDTO=new UserProjectRelateDTO();
			userProjectRelateDTO.setProjectId(projectId);
			String uidArr[] = userId.split(",");
			for(int i=0; i<uidArr.length; i++){
				if(!uidArr[i].equals("")){
					userProjectRelateDTO.setUid(uidArr[i]);
					userProjectRelateService.deleteRelateByUserProject(userProjectRelateDTO);
				}
			}
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	
	@RequestMapping("/addRelateByUserProject")
	@ResponseBody
	public ResultDTO addRelateByUserProject(@RequestParam("projectId") String projectId,@RequestParam("userId") String userId){
		ResultDTO resultDto=new ResultDTO();
		try{
			
//			UserProjectRelateDTO userProjectRelateDTO=new UserProjectRelateDTO();
//			userProjectRelateDTO.setProjectId(projectId);
			UserProjectRelate userProject=new UserProjectRelate();
			userProject.setProjectId(projectId);
			
			String uidArr[] = userId.split(",");
			for(int i=0; i<uidArr.length; i++){
				if(!uidArr[i].equals("")){
					userProject.setUid(uidArr[i]);
					userProject.setType("2");
					userProject.setUserprojRelateId(UUID.randomUUID().toString());
					userProjectRelateService.insert(userProject);					
				}
			}
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	

	
	@RequestMapping("/editRelateByUserProject")
	@ResponseBody
	public ResultDTO editRelateByUserProject(@RequestParam("projectId") String projectId,@RequestParam("addUserId") String addUserId,@RequestParam("delUserId") String delUserId,@RequestParam("updUserId") String updUserId){
		ResultDTO resultDto=new ResultDTO();
		List delList = new ArrayList();
		List insertList = new ArrayList();
		List updateList = new ArrayList();
		try{
			
			String delUidArr[] = delUserId.split(",");
			for(int i=0; i<delUidArr.length; i++){
				if(!delUidArr[i].equals("")){
					UserProjectRelateDTO userProject=new UserProjectRelateDTO();
					userProject.setProjectId(projectId);
					String addUserIds[] = delUidArr[i].split(":");
					userProject.setUid(addUserIds[0]);
					delList.add(userProject);
				//	userProjectRelateService.deleteRelateByUserProject(userProjectRelateDTO);
				}
			}
			
			String addUidArr[] = addUserId.split(",");
			for(int i=0; i<addUidArr.length; i++){
				if(!addUidArr[i].equals("")){
					UserProjectRelate userProject=new UserProjectRelate();
					userProject.setProjectId(projectId);
					String addUserIds[] = addUidArr[i].split(":");
					userProject.setUid(addUserIds[0]);
					userProject.setPermissionFlag(addUserIds[1]);  //关系字段 “0000”，“0001”……“1111”
					userProject.setType("2");
					userProject.setUserprojRelateId(UUID.randomUUID().toString());
					insertList.add(userProject);
				//	userProjectRelateService.insert(userProject);
				}
			}
			
			String updUidArr[] = updUserId.split(",");
			for(int i=0; i<updUidArr.length; i++){
				if(!updUidArr[i].equals("")){
					UserProjectRelate userProject=new UserProjectRelate();
					userProject.setProjectId(projectId);
					String updUserIds[] = updUidArr[i].split(":");
					userProject.setUid(updUserIds[0]);
					userProject.setPermissionFlag(updUserIds[1]);  //关系字段 “0000”，“0001”……“1111”
					updateList.add(userProject);
				}
			}
			if(delList != null && delList.size() >0){
				userProjectRelateService.deleteRelateList(delList);
			}
			if(insertList != null && insertList.size() >0){
				userProjectRelateService.insertRelateList(insertList);
			}
			if(updateList != null && updateList.size() >0){
				userProjectRelateService.updateRelateList(updateList);
			}
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	
	@RequestMapping("/getRelateByUserId")
	@ResponseBody
	public ResultDTO getRelateByUserId(HttpSession session,@RequestParam("projectId") String projectId){
		ResultDTO resultDto=new ResultDTO();
	    try{
	    	UserInfo userInfo = (UserInfo)session.getAttribute("userInfo");
	    	UserProjectRelateDTO userProjectRelateDTO = new UserProjectRelateDTO();
	    	userProjectRelateDTO.setProjectId(projectId);
	    	userProjectRelateDTO.setUid(userInfo.getUid());
	    	List<UserInfoDTO> list=userProjectRelateService.getRelateByUserId(userProjectRelateDTO);
	    	resultDto.setDataDto(list);
	    	resultDto.setSuccess(true);
	    	
	    }catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
		
	}
	
}

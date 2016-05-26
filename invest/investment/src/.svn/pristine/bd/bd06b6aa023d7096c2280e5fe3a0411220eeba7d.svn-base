package com.gxcz.xuhui.investment.controller;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.UUID;

import javax.servlet.http.HttpSession;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

import com.gxcz.xuhui.investment.model.DynamicNewsInfo;
import com.gxcz.xuhui.investment.model.UserInfo;
import com.gxcz.xuhui.investment.model.dto.DynamicNewsInfoDTO;
import com.gxcz.xuhui.investment.model.dto.ResultDTO;
import com.gxcz.xuhui.investment.service.impl.DynamicNewsService;

@Controller
@RequestMapping("/DynamicNewsController")
public class DynamicNewsController {
	private final Logger logger=Logger.getLogger(DynamicNewsController.class);
	private DynamicNewsService dynamicNewsService=null;

	public DynamicNewsService getDynamicNewsService() {
		return dynamicNewsService;
	}
	
	@Autowired
	public void setDynamicNewsService(DynamicNewsService dynamicNewsService) {
		this.dynamicNewsService = dynamicNewsService;
	}
	/**
	 * 首页显示新闻
	 * @param session
	 * @param dynamicNewsInfoDTO
	 * @return
	 */
	@RequestMapping("/getNewsListByUser")
	@ResponseBody
	public ResultDTO getNewsListByUser(HttpSession session,@RequestBody DynamicNewsInfoDTO dynamicNewsInfoDTO) {
		ResultDTO resultDTO=new ResultDTO();
		try{
			UserInfo userInfo= (UserInfo) session.getAttribute("userInfo");
			dynamicNewsInfoDTO.setUserid(userInfo.getUid());
//			dynamicNewsInfoDTO.setPageSize(6);
			List<DynamicNewsInfoDTO> dynamicList=dynamicNewsService.getNewsListByUser(dynamicNewsInfoDTO);
			resultDTO.setDataDto(dynamicList);
			resultDTO.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDTO.setSuccess(false);
			resultDTO.setError(ex.getMessage());
		}
		return resultDTO;
	}
	/***
	 * 根据时间段 模糊查询
	 * @param title
	 * @param projectId
	 * @param releaseBegin
	 * @param releaseEnd
	 * @return
	 */
	@RequestMapping("/getNewsListByProjectId")
	@ResponseBody
	public ResultDTO getNewsListByProjectId(@RequestParam("title") String title,@RequestParam("projectId") String projectId,@RequestParam("releaseBegin") String releaseBegin,@RequestParam("releaseEnd") String releaseEnd){
		ResultDTO resultDTO=new ResultDTO();
		try{
			DynamicNewsInfoDTO dynamicNewsInfoDTO=new DynamicNewsInfoDTO();
			dynamicNewsInfoDTO.setProjectId(projectId);
			dynamicNewsInfoDTO.setReleaseBegin(releaseBegin);
			dynamicNewsInfoDTO.setReleaseEnd(releaseEnd);
			dynamicNewsInfoDTO.setTitle(title);
			List<DynamicNewsInfoDTO> list= dynamicNewsService.getNewsListByProjectId(dynamicNewsInfoDTO);
			resultDTO.setDataDto(list);
			resultDTO.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDTO.setSuccess(false);
			resultDTO.setError(ex.getMessage());
		}
		return resultDTO;
	}
	@RequestMapping("/insert")
	@ResponseBody
	public ResultDTO insert(HttpSession session, @RequestParam("projectId") String projectId,@RequestParam("title") String title,@RequestParam("content") String content){
		ResultDTO resultDTO=new ResultDTO();
		try{
			SimpleDateFormat sdf=new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
			UserInfo userInfo= (UserInfo) session.getAttribute("userInfo");
			DynamicNewsInfo dynewsInfo=new DynamicNewsInfo();
			dynewsInfo.setAuthor(userInfo.getUid());
			dynewsInfo.setContent(content);
			dynewsInfo.setProjectId(projectId);
			Date nowDate= new Date();
			dynewsInfo.setReleaseDate(sdf.parse(sdf.format(nowDate)));
			dynewsInfo.setTitle(title);
			dynewsInfo.setNewsId(UUID.randomUUID().toString());
			int result=dynamicNewsService.insert(dynewsInfo);
			resultDTO.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDTO.setSuccess(false);
			resultDTO.setError(ex.getMessage());
		}
		return resultDTO;
	}
	@RequestMapping("/update")
	@ResponseBody
	public ResultDTO update(HttpSession session,@RequestParam("newsId") String newsId,@RequestParam("title") String title,@RequestParam("content") String content){
		ResultDTO resultDTO=new ResultDTO();
		try{
			UserInfo userInfo=(UserInfo) session.getAttribute("userInfo");
			DynamicNewsInfo dynewsInfo=new DynamicNewsInfo();
			dynewsInfo.setAuthor(userInfo.getUid());
			dynewsInfo.setContent(content);
			dynewsInfo.setTitle(title);
			dynewsInfo.setNewsId(newsId);
			int result=dynamicNewsService.updateByPrimaryKey(dynewsInfo);
			resultDTO.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDTO.setSuccess(false);
			resultDTO.setError(ex.getMessage());
		}
		return resultDTO;
	}
	@RequestMapping("/delete")
	@ResponseBody
	public ResultDTO delete(@RequestParam("newsId") String newsId){
		ResultDTO resultDTO=new ResultDTO();
		try{
			int result=dynamicNewsService.deleteByPrimaryKey(newsId);
			resultDTO.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDTO.setSuccess(false);
			resultDTO.setError(ex.getMessage());
		}
		return resultDTO;
	}
	/***
	 * 已认购项目的新闻
	 */
	@RequestMapping("/getComsubProjectNewsByUser")
	@ResponseBody
	public ResultDTO getComSubProjectNewsByUser(HttpSession session,@RequestParam("startPage") int startPage,@RequestParam("endPage") int endPage){
		ResultDTO resultDTO=new ResultDTO();
		try{
			UserInfo userInfo= (UserInfo) session.getAttribute("userInfo");
			DynamicNewsInfoDTO dynamicNewsInfoDTO=new DynamicNewsInfoDTO();
			dynamicNewsInfoDTO.setUserid(userInfo.getUid());
			List<DynamicNewsInfoDTO> list= dynamicNewsService.getComSubProjectNewsByUser(dynamicNewsInfoDTO);
			resultDTO.setDataDto(list);
			resultDTO.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDTO.setSuccess(false);
			resultDTO.setError(ex.getMessage());
		}
		return resultDTO;
	}
	@RequestMapping("/getNewsByNewsid")
	@ResponseBody
	public ResultDTO getNewsByNewsid(@RequestParam("newsId") String newsId){
		ResultDTO resultDTO=new ResultDTO();
		try{
			DynamicNewsInfo dynamicNewsInfo= dynamicNewsService.selectByPrimaryKey(newsId);
			resultDTO.setBaseModel(dynamicNewsInfo);
			resultDTO.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDTO.setSuccess(false);
			resultDTO.setError(ex.getMessage());
		}
		return resultDTO;
	}
	@RequestMapping("/getNewsDetail")
	@ResponseBody
	public ResultDTO getNewsDetail(@RequestParam("newsId") String newsId){
		ResultDTO resultDTO=new ResultDTO();
		try{
			DynamicNewsInfoDTO dynamicNewsInfo= dynamicNewsService.getNewsDetail(newsId);
			resultDTO.setPagerDTO(dynamicNewsInfo);
			resultDTO.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDTO.setSuccess(false);
			resultDTO.setError(ex.getMessage());
		}
		return resultDTO;
	}
	
			

}

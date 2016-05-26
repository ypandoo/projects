package com.gxcz.xuhui.investment.controller;

import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.HashMap;
import java.util.Hashtable;
import java.util.List;
import java.util.Map;
import java.util.UUID;

import sun.misc.BASE64Decoder;

import javax.naming.Context;
import javax.naming.NamingException;
import javax.naming.directory.DirContext;
import javax.naming.directory.InitialDirContext;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

import sun.misc.BASE64Decoder;

import com.gxcz.xuhui.investment.model.UserInfo;
import com.gxcz.xuhui.investment.model.dto.LoginParamDTO;
import com.gxcz.xuhui.investment.model.dto.ProjectBasicInfoDTO;
import com.gxcz.xuhui.investment.model.dto.ResultDTO;
import com.gxcz.xuhui.investment.model.dto.UserInfoDTO;
import com.gxcz.xuhui.investment.service.impl.IUserProjectRelateService;
import com.gxcz.xuhui.investment.service.impl.IUserService;

@Controller
@RequestMapping("/userController")
public class UserController{
	Logger logger=Logger.getLogger(UserController.class);
	IUserService userService=null;
	IUserProjectRelateService userProjectRelateService=null;
	@RequestMapping("/insertUser")
	public void insert( @ModelAttribute("userinfo")  UserInfo userinfo){
		// 绑定
		UserInfo user=new UserInfo();
		user.setUid(UUID.randomUUID().toString());
		user.setUname("zhangsan");
		user.setPassword("123456");
		user.setLoginId("smith_zhang");
		userService.insert(user);
	}
//	 /* 
//	  * 表单提交日期绑定 
//	  */  
//	 @InitBinder  
//	 public void initBinder(WebDataBinder binder) {  
//	     SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd ");  
//	     dateFormat.setLenient(false);  
//	     binder.registerCustomEditor(Date.class, new CustomDateEditor(dateFormat, true));  
//	 }  
//	   
//	 /* 
//	  * 提交绑定 
//	  */  
//	@InitBinder  
//	public void initDataBinder(WebDataBinder binder) {  
//	    binder.registerCustomEditor(UserInfo.class, "createTime",new DateEditor());  
//	}  
	
	@RequestMapping(value="/login",method=RequestMethod.POST)
	public @ResponseBody ResultDTO login(@RequestBody LoginParamDTO param,HttpServletRequest request,HttpServletResponse response){
		ResultDTO result = new ResultDTO();
		String loginId = param.getLoginId();
		String password = param.getPassword();
//		UserInfo userInfo = userService.getUserInfoByLoginId(loginId);
		UserInfo userInfo = userService.getUserInfoBysAMAccountName(loginId);
		boolean isPass = verifyUserInfo(userInfo, loginId, password);
		if(isPass){
//			userInfo = new UserInfo();
//			userInfo.setMobilePhone("15688888888");
//			userInfo.setCardId("100001195601010055");
//			userInfo.setTelephone("021-89898888");
//			userInfo.setUname("旭辉");
//			if(loginId.equals("admin")){
//				userInfo.setUid("1001");
//				userInfo.setLoginId("admin");
//				userInfo.setPassword("admin");
//				userInfo.setEmail("admin@cifi.com.cn");
//			}else{
//				userInfo.setUid(loginId);
//				userInfo.setLoginId(loginId);
//				userInfo.setPassword(password);
//				userInfo.setEmail(loginId+"@cifi.com.cn");
//			}
			request.getSession().setAttribute("userInfo",userInfo);
			request.getSession().setAttribute("loginId",userInfo.getUid());
			request.getSession().setAttribute("loginName",userInfo.getUname());
			request.getSession().setAttribute("accountName",loginId);
			result.setSuccess(true);
		}else{
			if(userInfo == null){
				result.setError("用户名不存在.");
			}else{
				result.setError("登录密码不正确.");
			}
		}
		return result;
	}
	
	@RequestMapping(value="/loginOut",method=RequestMethod.POST)
	public @ResponseBody ResultDTO loginOut(HttpServletRequest request,HttpServletResponse response){
		ResultDTO result = new ResultDTO();
		request.getSession().removeAttribute("userInfo");
		request.getSession().removeAttribute("loginId");
		request.getSession().removeAttribute("loginName");
		request.getSession().removeAttribute("accountName");
		result.setSuccess(true);
		return result;
	}
	
	public IUserService getUserService() {
		return userService;
	}
	public IUserProjectRelateService getUserProjectRelateService() {
		return userProjectRelateService;
	}
	@Autowired
	public void setUserService(IUserService userService) {
		this.userService = userService;
	}
	@Autowired
	public void setUserProjectRelateService(IUserProjectRelateService userProjectRelateService) {
		this.userProjectRelateService = userProjectRelateService;
	}
	
	@RequestMapping("/getUserListByName")
	@ResponseBody
	public ResultDTO getUserListByName(@RequestParam("uname") String uname,@RequestParam("projectId") String projectId,@RequestParam("startPage") int startPage,@RequestParam("pageSize") int pageSize){
		ResultDTO resultDto=new ResultDTO();
		try{
			UserInfoDTO userInfoDto=new UserInfoDTO();
			userInfoDto.setUname(uname);
			userInfoDto.setStartPage(startPage);
			userInfoDto.setPageSize(pageSize);
			userInfoDto.setProjectId(projectId);
			List<UserInfoDTO> userDtoList= userService.getUserRelateList(userInfoDto);
			resultDto.setSuccess(true);
			resultDto.setDataDto(userDtoList);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	@RequestMapping(value="/getUserListByProject",method=RequestMethod.POST)
	@ResponseBody
	public ResultDTO getUserListByProject(@RequestParam("projectId") String projectId,@RequestParam("startPage") int startPage,@RequestParam("endPage") int endPage){
		ResultDTO resultDto=new ResultDTO();
		try{
			ProjectBasicInfoDTO ProjectInfoDto=new ProjectBasicInfoDTO();
			ProjectInfoDto.setProjectId(projectId);
			ProjectInfoDto.setStartPage(startPage);
			ProjectInfoDto.setPageSize(endPage-startPage);
			List<UserInfoDTO> userInfoList= userProjectRelateService.getUserRelateByProject(ProjectInfoDto);
			resultDto.setSuccess(true);
			resultDto.setDataDto(userInfoList);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	
	private boolean verifyUserInfo(UserInfo originalUser,String loginId,String password){
//		if("admin".equals(loginId) && password.equals(originalUser.getPassword())){
//		if("admin".equals(loginId) && password.equals("admin")){
//			return true;
//		}else 
		if(adAreaCheck(originalUser,loginId,password) == true){
			return true;
		}
		if(originalUser == null){
			return false;
		}
		if (originalUser.getLoginId().equals(loginId) && originalUser.getPassword().equals(password)){
			return true;
		}
		
		return false;
	}
	
	private boolean adAreaCheck(UserInfo originalUser,String loginId,String password){
//		String host  = "192.168.8.232";  // AD服务器IP（一共2个AD域服务器，备份的效果，另一个是192.168.8.232）
//		String port  = "389"; // 端口
//		String DN_OU = "ou=旭辉集团股份有限公司,DC=cifi,DC=com,DC=cn" ;
//		String DN_CN = "CN="+loginId;
//		 
//		String url = new String("ldap://" + host + ":" + port);
//		 
//		Hashtable env = new Hashtable();
//		DirContext ctx;
//		env.put(Context.INITIAL_CONTEXT_FACTORY,"com.sun.jndi.ldap.LdapCtxFactory");
//		//env.put(Context.SECURITY_AUTHENTICATION, "none");
//		env.put(Context.SECURITY_AUTHENTICATION, "simple");
//		env.put(Context.PROVIDER_URL, url);
//		env.put(Context.SECURITY_PRINCIPAL, DN_CN+","+DN_OU); 
//		env.put(Context.SECURITY_PRINCIPAL, loginId); 
//		env.put(Context.SECURITY_CREDENTIALS, password);
//		 
//		try {
//			ctx = new InitialDirContext(env);// 初始化上下文
//			System.out.println("ad域认证成功");
//			 
//			ctx.close();
//			return true; //验证成功返回name
//		} catch (javax.naming.AuthenticationException e) {
//			System.out.println("ad域认证失败");
//			System.out.println("e.getExplanation():"+e.getExplanation());
//			System.out.println("e.getMessage():"+e.getMessage());
//			return false;
//		}catch (Exception e) {
//			System.out.println("ad域认证出错：" + e);
//			return false;
//		}
		

		String host = "192.168.8.232"; // AD服务器IP
		String port = "389"; // 端口
		// String domain = "@domain.com.cn"; //邮箱的后缀名
		//String user="@cifi.com.cn\\"+loginId;//这里有两种格式，domain\User或邮箱的后缀名,建议用domain\User这种格式
		String user=loginId+"@cifi.com.cn";
		String url = new String("ldap://" + host + ":" + port);
		// String user = userName.indexOf(domain) > 0 ? userName : userName + domain;
		Hashtable<String, String> env = new Hashtable<String, String>();
		DirContext ctx;
		env.put(Context.SECURITY_AUTHENTICATION, "simple");//一种模式，不用管，就这么写就可以了
		env.put(Context.SECURITY_PRINCIPAL, user);
		env.put(Context.SECURITY_CREDENTIALS, password);
		env.put(Context.INITIAL_CONTEXT_FACTORY,
		"com.sun.jndi.ldap.LdapCtxFactory");
		env.put(Context.PROVIDER_URL, url);
		try {
			ctx = new InitialDirContext(env);
			ctx.close();
			return true; //验证成功返回name
		} catch (NamingException err) {
			logger.error("ad域认证失败");
			logger.error("e.getExplanation():"+err.getExplanation());
			return false;//验证失败返回空
		}
	}
	
	@RequestMapping("/getUserInfoBysAMAccountName")
	public @ResponseBody ResultDTO getUserInfoBysAMAccountName(String sAMAccountName){
		ResultDTO result = new ResultDTO();
		try {
			UserInfo user = userService.getUserInfoBysAMAccountName(sAMAccountName);
			result.setSuccess(true);
			List<UserInfo> data = new ArrayList<UserInfo>(); 
			data.add(user);
			result.setDataDto(data);
		} catch (Exception e) {
			e.printStackTrace();
			result.setSuccess(false);
			result.setError(e.getMessage());
		}
		return result;
	}
	 
	/**
	 * 外部单点登录接口
	 */
	@RequestMapping("/loginForKey")
	public String loginForKey(HttpServletRequest request){
		String sAMAccountName = request.getParameter("loginId");
		try {
			BASE64Decoder decoder = new sun.misc.BASE64Decoder();
			byte[] temp = decoder.decodeBuffer(sAMAccountName);
			String loginStr = new String(temp);
			UserInfo userInfo = userService.getUserInfoBysAMAccountName(loginStr);
			if(userInfo != null && userInfo.getUid() != null){
				request.getSession().setAttribute("userInfo",userInfo);
				request.getSession().setAttribute("loginId",userInfo.getUid());
				request.getSession().setAttribute("loginName",userInfo.getUname());
//				request.getSession().setAttribute("accountName",sAMAccountName);
				request.getSession().setAttribute("accountName",userInfo.getSamaccountname());
				return "redirect:/front/index.jsp";
			}else{
				return "redirect:/front/login.jsp";
			}
		} catch (IOException e) {
			e.printStackTrace();
			return "redirect:/front/login.jsp";
		}
	}
	 
	/**
	 * app单点登录接口
	 */
	@RequestMapping("/loginForApp")
	public @ResponseBody ResultDTO loginForApp(HttpServletRequest request){
		ResultDTO result = new ResultDTO();
		String sAMAccountName = request.getParameter("loginId");
		try {
//			BASE64Decoder decoder = new sun.misc.BASE64Decoder();
//			byte[] temp = decoder.decodeBuffer(sAMAccountName);
//			String loginStr = new String(temp);
//			UserInfo userInfo = userService.getUserInfoBysAMAccountName(loginStr);
			UserInfo userInfo = userService.getUserInfoBysAMAccountName(sAMAccountName);
			if(userInfo != null && userInfo.getUid() != null){
				request.getSession().setAttribute("userInfo",userInfo);
				request.getSession().setAttribute("loginId",userInfo.getUid());
				request.getSession().setAttribute("loginName",userInfo.getUname());
				request.getSession().setAttribute("accountName",sAMAccountName);
				result.setSuccess(true);
			}else{
				result.setSuccess(false);
			}
		} catch (Exception e) {
			e.printStackTrace();
			result.setSuccess(false);
			result.setError(e.getMessage());
		}
		return result;
	}




/**
 * app单点登录接口
 */
@RequestMapping("/loginForApp2")
public @ResponseBody ResultDTO loginForApp2(HttpServletRequest request){
	ResultDTO result = new ResultDTO();
	String uName = request.getParameter("loginId");
	try {
//		BASE64Decoder decoder = new sun.misc.BASE64Decoder();
//		byte[] temp = decoder.decodeBuffer(sAMAccountName);
//		String loginStr = new String(temp);
//		UserInfo userInfo = userService.getUserInfoBysAMAccountName(loginStr);
		UserInfo userInfo = userService.getUserInfoByUname(uName);
		if(userInfo != null && userInfo.getUid() != null){
			request.getSession().setAttribute("userInfo",userInfo);
			request.getSession().setAttribute("loginId",userInfo.getUid());
			request.getSession().setAttribute("loginName",userInfo.getUname());
			request.getSession().setAttribute("accountName",userInfo.getSamaccountname());
			result.setSuccess(true);
		}else{
			result.setSuccess(false);
		}
	} catch (Exception e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
		result.setSuccess(false);
		result.setError(e.getMessage());
	}
	return result;
}
@RequestMapping({"/remissionUser/update"})
@ResponseBody
public ResultDTO updateRemissionCountByUser(@RequestBody UserInfo userInfo) { ResultDTO result = new ResultDTO();
  try {
    this.userService.updateRemissionCountByUserId(userInfo);
    result.setSuccess(true);
  } catch (Exception e) {
    e.printStackTrace();
    this.logger.error(e.getMessage());
    result.setSuccess(false);
  }
  return result; } 
@RequestMapping({"/remissionUser/updateBacth"})
@ResponseBody
public ResultDTO updateRemissionCountBatch(@RequestBody List<UserInfo> userList) {
  ResultDTO result = new ResultDTO();
  try {
    this.userService.updateRemissionCountBatch(userList);
    result.setSuccess(true);
  } catch (Exception e) {
    e.printStackTrace();
    this.logger.error(e.getMessage());
    result.setSuccess(false);
    result.setError(e.getMessage());
  }
  return result;
}
@RequestMapping({"/remissionUser/list"})
@ResponseBody
public ResultDTO fetchRemissionUserList() { ResultDTO result = new ResultDTO();
  try {
    List userList = this.userService.selectRemissionUserList();
    result.setDataDto(userList);
    result.setSuccess(true);
  } catch (Exception e) {
    e.printStackTrace();
    this.logger.error(e.getMessage());
    result.setSuccess(false);
    result.setError(e.getMessage());
  }
  return result; } 
@RequestMapping({"/remissionUser/list/limit"})
@ResponseBody
public ResultDTO fetchRemisssionUserLimit(@RequestBody String userName) {
  ResultDTO result = new ResultDTO();
  Map searchParam = new HashMap(1);
  if ((userName != null) && (!"".equals(userName.trim())))
    searchParam.put("userName", userName);
  try
  {
    List userList = this.userService.selectRemissionUserLimit(searchParam);
    result.setDataDto(userList);
    result.setSuccess(true);
  } catch (Exception e) {
    e.printStackTrace();
    this.logger.error(e.getMessage());
    result.setSuccess(false);
    result.setError(e.getMessage());
  }
  return result;
}
}
/*public class BASE64Coding {
	private static BASE64Encoder encoder = new sun.misc.BASE64Encoder();
	private static BASE64Decoder decoder = new sun.misc.BASE64Decoder(); 
	public BASE64Coding() {}    
	public static String encode (String s)           {
		return encoder.encode(s.getBytes());              
		
	}    
	publicstatic String decode (String s){   
		byte[] temp = decoder.decodeBuffer(s);    
		} catch (IOException ioe) {                   
			
		}           
	}   
	publicstaticvoid main(String[] args) {  
		String str="13516741234";           
		System.out.println("加密");          
		System.out.println(BASE64Coding.encode(str));           
		System.out.println("解密");           
		System.out.println(BASE64Coding.decode(BASE64Coding.encode(str)));       
		}   
	}  
*/
package com.gxcz.xuhui.investment.interceptors;

import java.io.PrintWriter;
import java.util.List;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.log4j.Logger;
import org.springframework.web.servlet.HandlerInterceptor;
import org.springframework.web.servlet.ModelAndView;

import com.gxcz.xuhui.investment.model.UserInfo;

/**
 * 权限拦截器
 * 
 *  
 * 
 */
public class SecurityInterceptor implements HandlerInterceptor {

	private static final Logger logger = Logger.getLogger(SecurityInterceptor.class);

	private List<String> excludeUrls;// 不需要拦截的资源

	public List<String> getExcludeUrls() {
		return excludeUrls;
	}

	public void setExcludeUrls(List<String> excludeUrls) {
		this.excludeUrls = excludeUrls;
	}

	/**
	 * 完成页面的render后调用
	 */
	@Override
	public void afterCompletion(HttpServletRequest request, HttpServletResponse response, Object object, Exception exception) throws Exception {

	}

	/**
	 * 在调用controller具体方法后拦截
	 */
	@Override
	public void postHandle(HttpServletRequest request, HttpServletResponse response, Object object, ModelAndView modelAndView) throws Exception {

	}

	/**
	 * 在调用controller具体方法前拦截
	 */
	@Override
	public boolean preHandle(HttpServletRequest request, HttpServletResponse response, Object object) throws Exception {
		String requestUri = request.getRequestURI();
		String contextPath = request.getContextPath();
		String url = requestUri.substring(contextPath.length());
		// 请求是否来自app
		String reqType = request.getParameter("reqType");
		int appIndex = -1;
		if(null != request.getHeader("referer")){
			appIndex = request.getHeader("referer").indexOf("app/");
		}
		// logger.info(url);
		// 单点登录入口加入非校验url列表
		excludeUrls.add("/userController/loginForKey.action");
		excludeUrls.add("/userController/loginForApp2.action");
		if (/*(reqType!=null&&reqType.equals("app") || appIndex!=-1) ||*/ url.indexOf("/plugins/") > -1 || url.indexOf("/images/") >-1 || excludeUrls.contains(url)) {// 如果要访问的资源是不需要验证的
			return true;
		}
		
		UserInfo sessionInfo = (UserInfo) request.getSession().getAttribute("userInfo");
		if (sessionInfo == null || sessionInfo.getUid().equalsIgnoreCase("")) {// 如果没有登录或登录超时
			 String path = request.getContextPath();
			 String basePath = request.getScheme()+"://"+request.getServerName()+":"+request.getServerPort()+path;  
			String requestType = request.getHeader("X-Requested-With");//判断是ajax请求还是普通请求  ajax是有值得
			logger.info("请求过来的方式是："+requestType);
			if("XMLHttpRequest".equalsIgnoreCase(requestType)){
				if(appIndex != -1){
					response.setHeader("sessionstatus", "timeoutForApp");  
				}else{
					response.setHeader("sessionstatus", "timeout");  
				}
				 response.sendError(518, "session timeout.");  
			}else{
				PrintWriter out = response.getWriter();
				out.write("<html><script type='text/javascript'>window.open('"+basePath+"/front/login.jsp','_top'); </script></html>");
			}
			return false;
		}

//		if (!sessionInfo.getResourceList().contains(url)) {// 如果当前用户没有访问此资源的权限
//			request.setAttribute("msg", "您没有访问此资源的权限！<br/>请联系超管赋予您<br/>[" + url + "]<br/>的资源访问权限！");
//			request.getRequestDispatcher("/error/noSecurity.jsp").forward(request, response);
//			return false;
//		}

		return true;
	}
}

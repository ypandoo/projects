package com.gxcz.xuhui_ldap.ldap.listener;

import javax.servlet.ServletContextEvent;
import javax.servlet.ServletContextListener;

import org.springframework.web.context.WebApplicationContext;
import org.springframework.web.context.support.WebApplicationContextUtils;

import com.gxcz.common.util.ApplicationContextHelper;

public class StaratLdapListener implements ServletContextListener {

	private static WebApplicationContext webApplicationContext;

	private static ApplicationContextHelper helper = new ApplicationContextHelper();;

	public void contextDestroyed(ServletContextEvent sce) {

	}

	public void contextInitialized(ServletContextEvent sce) {
		webApplicationContext = WebApplicationContextUtils.getRequiredWebApplicationContext(sce.getServletContext());
		// run定时器
		StaratLdapRunnerManager.initRunner(sce);
	}

}

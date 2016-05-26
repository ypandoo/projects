package com.gxcz.xuhui.investment.listener;

import javax.servlet.ServletContextEvent;
import javax.servlet.ServletContextListener;

public class MyStartUpListener implements ServletContextListener {

	@Override
	public void contextInitialized(ServletContextEvent sce) {
		// 在这个listener中配置log4j日志文件输出目录，此listener一定要在Log4jConfigListener之前配置，执行
		System.setProperty("lo4jDir", sce.getServletContext().getRealPath("/logs"));
	}

	@Override
	public void contextDestroyed(ServletContextEvent sce) {
		
	}

}

package com.gxcz.common.util;

import org.springframework.beans.BeansException;
import org.springframework.context.ApplicationContext;
import org.springframework.context.ApplicationContextAware;
import org.springframework.stereotype.Component;

/**
 * 	@author zhangwanli </br>
 * 获取ApplicationContext的工具类，
 * 主要用于使用new创建的对象，不归属spring容器管理时无法为该对象注入属性
 * 使用该工具类获取ApplicationContext中的bean，赋值给对应的属性
 * */
@Component(value = "applicationContextHelper")
public class ApplicationContextHelper implements ApplicationContextAware {

	private static ApplicationContext context;

	@Override
	public void setApplicationContext(ApplicationContext applicationContext) throws BeansException {
		context = applicationContext;
	}

	public static ApplicationContext getApplicationContext() {
		return context;
	}

}

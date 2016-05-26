package com.gxcz.xuhui_ldap.ldap.listener;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

import javax.servlet.ServletContextEvent;

import org.apache.log4j.Logger;

import com.gxcz.xuhui_ldap.ldap.synchronous.Ldap_Screen;

public class StaratLdapRunnerManager {
	private static final Logger logger = Logger.getLogger(StaratLdapRunnerManager.class);

	public static final void initRunner(ServletContextEvent applicationContext) {
		
		new Thread() {
			public void run() {
				logger.info("运行数据定时同步run方法");
				while (true) {
					try {
						long inteval = 1 * 60L * 60L * 1000L;// 设置运行时间/1小时
						sleep(inteval);// 睡眠
						if (betweenTime("00:30:00", "01:30:00")) {// 设置允许执行时间
							logger.info("数据同步StartTime:" + new Date());
							Ldap_Screen ls = new Ldap_Screen();
							ls.Screen();
							logger.info("数据同步EndTime:" + new Date());
						}
					} catch (Exception e) {
						logger.error("定时同步数据任务：出现异常已终止。");
						return;
					}
				}
			}
		}.start();
		
	}

	public static boolean betweenTime(String beginStr, String endStr) throws ParseException {
		DateFormat format = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
		Calendar cal = Calendar.getInstance();
		// 今天
		Date thisTime = cal.getTime();
		String thisStr = format.format(thisTime); // 当前时间
		beginStr = thisStr.substring(0, 11) + beginStr; // 开始时间
		endStr = thisStr.substring(0, 11) + endStr; //
		// 第二天
		Date beginDate = format.parse(beginStr);
		Date endDate = format.parse(endStr);
		if (thisTime.after(beginDate) && thisTime.before(endDate)) {
			return true;
		} else {
			return false;
		}
	}

	public static final void stopRunner() {

	}

}

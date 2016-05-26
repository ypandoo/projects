package com.gxcz.xuhui_ldap.ldap.synchronous;

import java.util.ArrayList;
import java.util.List;

import org.apache.log4j.Logger;

import com.gxcz.xuhui_ldap.ldap.ad.Ldap_Ad;
import com.gxcz.xuhui_ldap.ldap.jdbc.Ldap_Jdbc;
import com.gxcz.xuhui_ldap.ldap.model.UserDTO;

public class Ldap_Screen {

	private static final Logger logger = Logger.getLogger(Ldap_Screen.class);

	public void Screen() {
		logger.info("进入同步AD域用户数据方法中......");
		Ldap_Ad ldapSycTool = new Ldap_Ad();
		Ldap_Jdbc localSycTool = new Ldap_Jdbc();

		try {
			List<UserDTO> adUserList = ldapSycTool.testSearch();// 从AD域中获取的集合对象
			List<UserDTO> localUserList = localSycTool.query();// 从数据库中查询出来的数据集合
			List<UserDTO> insertlist = new ArrayList<UserDTO>();// 添加用户信息集合
			List<UserDTO> updatelist = new ArrayList<UserDTO>();// 修改用户的集合
			for (int i = 0; i < adUserList.size(); i++) {
				UserDTO adUser = new UserDTO();
				adUser = adUserList.get(i);
				boolean exist = false;
				for (int j = 0; j < localUserList.size(); j++) {
					UserDTO localUser = new UserDTO();
					localUser = localUserList.get(j);
					if (adUser.getsAMAccountName().equals(localUser.getsAMAccountName())) {
						exist = true;
						boolean depar = false;
						boolean head = false;
						boolean serv = false;
						String filiale = adUser.getDepartment();
						String Ufiliale = localUser.getDepartment() + "";
						String headquar = adUser.getHeadquarters();
						String uheadquar = localUser.getHeadquarters() + "";
						String service = adUser.getService();
						String uservice = localUser.getService() + "";
						if (filiale == null && "null".equals(Ufiliale)) {
							depar = true;
						} else if (Ufiliale.equals(filiale + "")) {
							depar = true;
						}
						if (headquar == null && "null".equals(uheadquar)) {
							head = true;
						} else if (uheadquar.equals(headquar + "")) {
							head = true;
						}
						if (service == null && "null".equals(uservice)) {
							serv = true;
						} else if (uservice.equals(service + "")) {
							serv = true;
						}
						try {
							if (localUser.getName().equals(adUser.getName()) && localUser.getWhenChanged().equals(adUser.getWhenChanged()) && localUser.getsAMAccountName().equals(adUser.getsAMAccountName()) && localUser.getUserPrincipalName().equals(adUser.getUserPrincipalName())
									&& localUser.getFiliale().equals(adUser.getFiliale()) && depar == true && head == true && serv == true && localUser.getStatus().equals(adUser.getStatus())) {
								continue;
							} else {
								updatelist.add(adUser);
							}
						} catch (Exception e) {
							e.printStackTrace();
						}
					}
				}
				if (!exist) {
					insertlist.add(adUser);
				}
			}
			logger.info("修改用户数量：" + updatelist.size() + "条；添加用户数量： " + insertlist.size() + "条.");
			localSycTool.updete(updatelist);// 执行批量修改用户数据的方法
			localSycTool.insert(insertlist);// 执行批量添加用户数据的方法
		} catch (Exception e) {
			logger.error(e.getMessage());
			e.printStackTrace();
		}

	}
}

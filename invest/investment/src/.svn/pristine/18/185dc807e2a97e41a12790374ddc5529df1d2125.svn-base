package com.gxcz.xuhui_ldap.ldap.ad;

import java.io.InputStream;
import java.util.Hashtable;
import java.util.List;
import java.util.Properties;

import javax.naming.Context;
import javax.naming.NamingException;
import javax.naming.directory.DirContext;
import javax.naming.directory.InitialDirContext;
import javax.naming.directory.SearchControls;
import javax.naming.ldap.InitialLdapContext;
import javax.naming.ldap.LdapContext;

import org.apache.log4j.Logger;

import com.gxcz.xuhui_ldap.ldap.model.UserDTO;

public class Ldap_Ad {

	private static final Logger logger = Logger.getLogger(Ldap_Ad.class);

	ClassLoader cl = this.getClass().getClassLoader();

	InputStream in = cl.getResourceAsStream("com/gxcz/xuhui_ldap/ldap/" + "size.Properties");

	/**
	 * 连接LDAP
	 */

	public LdapContext connetLDAP() throws NamingException, Exception {
		logger.info("启动连接LDAP....");
		Properties p = new Properties();
		p.load(in);
		// 连接Ldap需要的信息
		String ldapFactory = p.getProperty("ldapFactory");
		String ldapUrl = p.getProperty("ldapUrl");// url
		String ldapAccount = p.getProperty("ldapAccount"); // 用户名
		String ldapPwd = p.getProperty("ldapPwd");// 密码
		Hashtable<String, String> env = new Hashtable<String, String>();
		env.put(Context.INITIAL_CONTEXT_FACTORY, ldapFactory);
		// LDAP server
		env.put(Context.PROVIDER_URL, ldapUrl);
		env.put(Context.SECURITY_AUTHENTICATION, "simple");
		env.put(Context.SECURITY_PRINCIPAL, ldapAccount);
		env.put(Context.SECURITY_CREDENTIALS, ldapPwd);
		env.put("java.naming.referral", "follow");
		env.put("java.naming.batchsize", "10");
		LdapContext ctxTDS = new InitialLdapContext(env, null);
		return ctxTDS;
	}

	/**
	 * 同步所有用户信息
	 * 
	 * @return
	 * @throws Exception
	 */
	public List<UserDTO> testSearch() throws Exception {

		logger.info("获取AD域中所有用户信息.");
		LdapContext ctx = connetLDAP();
		// 设置过滤条件
		// String samaccountname = "Administrator";
		String filter = "(objectClass=user)";
		// (samaccountname="+samaccountname+")))";
		// 限制要查询的字段内容
		String[] attrPersonArray = { "name", "userPrincipalName", "sAMAccountName", "whenCreated", "whenChanged", "userAccountControl" };
		// { "samaccountname", "userPassword", "displayName", "cn", "sn",
		// "mail", "description" };
		SearchControls searchControls = new SearchControls();
		searchControls.setSearchScope(SearchControls.SUBTREE_SCOPE);
		// 设置将被返回的Attribute
		searchControls.setReturningAttributes(attrPersonArray);

		Page page = new Page();
		List<UserDTO> userlist = page.ldapPage(ctx, filter, searchControls);
		return userlist;
	}

	/**
	 * 用户验证
	 * 
	 * @param userName
	 * @param password
	 * @return
	 */
	public String check(String userName, String password) throws Exception {
		logger.info("进行用户验证....");
		if ((userName == null || userName.equals("")) && password == null || "".equals(password)) {
			logger.info("认证失败:帐号密码不能为空！");
			return "notnull";// 认证失败\n帐号密码不能为空！
		}
		Properties p = new Properties();
		p.load(in);
		String url = p.getProperty("ldapUrl"); // AD服务器IP

		String DN_OU = p.getProperty("ou");

		String DN_CN = "CN=" + userName;

		Hashtable<String, String> env = new Hashtable<String, String>();

		DirContext ctx;

		env.put(Context.INITIAL_CONTEXT_FACTORY, "com.sun.jndi.ldap.LdapCtxFactory");

		// env.put(Context.SECURITY_AUTHENTICATION, "none");

		env.put(Context.SECURITY_AUTHENTICATION, "simple");

		env.put(Context.PROVIDER_URL, url);

		env.put(Context.SECURITY_PRINCIPAL, DN_CN + "," + DN_OU);

		env.put(Context.SECURITY_PRINCIPAL, userName);

		env.put(Context.SECURITY_CREDENTIALS, password);

		try {

			ctx = new InitialDirContext(env);// 初始化上下文

			logger.info("认证成功");

			ctx.close();

			return userName; // 验证成功返回name

		} catch (javax.naming.AuthenticationException e) {

			logger.info("认证失败");

			logger.info("e.getExplanation():" + e.getExplanation());

			logger.info("e.getMessage():" + e.getMessage());

			return "exce";

		} catch (Exception e) {

			System.out.println("认证出错：" + e);

			return "error";

		}

	}

}

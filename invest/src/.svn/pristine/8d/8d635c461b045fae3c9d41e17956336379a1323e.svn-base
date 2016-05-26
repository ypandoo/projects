package com.gxcz.xuhui_ldap.ldap.jdbc;

import java.io.InputStream;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import java.util.Properties;
import java.util.UUID;

import org.apache.log4j.Logger;

import com.gxcz.xuhui_ldap.ldap.model.UserDTO;

public class Ldap_Jdbc {
	private static final Logger logger = Logger.getLogger(Ldap_Jdbc.class);
	ClassLoader cl = this.getClass().getClassLoader();
	InputStream in = cl.getResourceAsStream("DBConfig.properties");
	Properties p = new Properties();

	/**
	 * 修改方法
	 * 
	 * @param updatelist
	 */
	public void updete(List<UserDTO> updatelist) {
		logger.info("进入修改方法.....");
		if (updatelist.size() == 0) {
			logger.info("不执行修改方法！");
			return;
		}
		logger.info("需要修改数量:" + updatelist.size());
		Connection conn = getConnection();
		PreparedStatement pst = null;
		try {
			int count = 0;
			conn.setAutoCommit(false);
			String sql = "update USER_INFO set UNAME=?,whenChanged=?,status=?,sAMAccountName=?," + "userPrincipalName=?,department=?,service=?,filiale=?,headquarters=? where sAMAccountName=?";

			pst = conn.prepareStatement(sql, ResultSet.TYPE_SCROLL_SENSITIVE, ResultSet.CONCUR_READ_ONLY);
			for (int i = 0; i < updatelist.size(); i++) {
				UserDTO user = new UserDTO();
				user = updatelist.get(i);
				pst.setString(1, user.getName());
				pst.setString(2, user.getWhenChanged());
				pst.setString(3, user.getStatus());
				pst.setString(4, user.getsAMAccountName());
				pst.setString(5, user.getUserPrincipalName());
				pst.setString(6, user.getDepartment());
				pst.setString(7, user.getService());
				pst.setString(8, user.getFiliale());
				pst.setString(9, user.getHeadquarters());
				pst.setString(10, user.getsAMAccountName());
				pst.addBatch();
				++count;
			}
			pst.executeBatch();
			conn.commit();
			logger.info("已修改数量：" + count);
		} catch (Exception e) {
			try {
				conn.rollback();
			} catch (SQLException e1) {
				e1.printStackTrace();
			}
			e.printStackTrace();
		} finally {
			try {
				pst.close();
				conn.close();
			} catch (SQLException e) {
				e.printStackTrace();
			}
		}
	}

	/* 插入数据记录，并输出插入的数据记录数 */
	public void insert(List<UserDTO> insertlist) {
		logger.info("进入添加方法.....");
		if (insertlist.size() == 0) {
			logger.info("不执行添加方法！");
			return;
		}
		Connection conn = getConnection();
		PreparedStatement prest = null;

		try {
			conn.setAutoCommit(false);
			long start = System.currentTimeMillis();
			// String id= UUID.randomUUID().toString();
			String sql = "INSERT INTO USER_INFO(UID,UNAME, sAMAccountName,status, service, userPrincipalName," + "whenChanged,headquarters,filiale,department) VALUES (?,?,?,?,?,?,?,?,?,?)"; // 插入数据的sql语句
			prest = conn.prepareStatement(sql, ResultSet.TYPE_SCROLL_SENSITIVE, ResultSet.CONCUR_READ_ONLY);
			for (int i = 0; i < insertlist.size(); i++) {
				UserDTO user = insertlist.get(i);
				prest.setString(1, UUID.randomUUID().toString());
				prest.setString(2, user.getName());
				prest.setString(3, user.getsAMAccountName());
				prest.setString(4, user.getStatus());
				prest.setString(5, user.getService());
				prest.setString(6, user.getUserPrincipalName());
				prest.setString(7, user.getWhenChanged());
				prest.setString(8, user.getHeadquarters());
				prest.setString(9, user.getFiliale());
				prest.setString(10, user.getDepartment());
				prest.addBatch();
			}
			prest.executeBatch();
			conn.commit();
			long end = System.currentTimeMillis();
			logger.info("数据导入完毕,所用时间为: " + (end - start) + " ms");
			// conn.close();
		} catch (SQLException e) {
			try {
				conn.rollback();
			} catch (SQLException e1) {
				e1.printStackTrace();
			}
			logger.error("插入数据失败" + e.getMessage());
		} finally {
			try {
				prest.close();
				conn.close();
			} catch (SQLException e) {
				e.printStackTrace();
			}
		}
	}

	/* 查询数据库，输出符合要求的记录的情况 */
	public List<UserDTO> query() {
		logger.info("进入查询方法.....");
		List<UserDTO> list = new ArrayList<UserDTO>();
		Connection conn = getConnection();
		try {
			String sql = "select * from USER_INFO";
			PreparedStatement pst = conn.prepareStatement(sql);
			int count = 0;
			ResultSet rs = pst.executeQuery(sql);
			while (rs.next()) { // 判断是否还有下一个数据
				UserDTO user = new UserDTO();
				// 根据字段名获取相应的值

				user.setName(rs.getString("UNAME"));
				user.setsAMAccountName(rs.getString("sAMAccountName"));
				user.setStatus(rs.getString("status"));
				user.setService(rs.getString("service"));
				user.setUserPrincipalName(rs.getString("userPrincipalName"));
				user.setWhenChanged(rs.getString("whenChanged"));
				user.setHeadquarters(rs.getString("headquarters"));
				user.setFiliale(rs.getString("filiale"));
				user.setDepartment(rs.getString("department"));
				list.add(user);
				++count;

			}
			logger.info("查询的数据数量：" + count);

		} catch (SQLException e) {
			logger.info("查询数据失败");
		}
		return list;
	}

	/* 获取数据库连接的函数 */
	public Connection getConnection() {
		Connection con = null; // 创建用于连接数据库的Connection对象
		try {
			p.load(in);
			String driverClassName = p.getProperty("driverClassName");
			String jdbc_url = p.getProperty("jdbc_url");// url
			String jdbc_username = p.getProperty("jdbc_username"); // 用户名
			String jdbc_password = p.getProperty("jdbc_password");// 密码

			Class.forName(driverClassName);// 加载Mysql数据驱动

			con = DriverManager.getConnection(jdbc_url, jdbc_username, jdbc_password);// 创建数据连接

		} catch (Exception e) {
			logger.info("数据库连接失败" + e.getMessage());
		}
		return con; // 返回所建立的数据库连接
	}

}

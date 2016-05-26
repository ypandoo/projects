package com.gxcz.common.util;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class DBUtil {

	public static Connection connectOracle(){
		String oracleDriver = "oracle.jdbc.driver.OracleDriver";
		String url = "jdbc:oracle:thin:@127.0.0.1:1521/ORCL";
		String user = "system";
		String password = "zhangwanli99";
		Connection conn = null;
		try {
			Class.forName(oracleDriver);
		} catch (ClassNotFoundException e) {
			e.printStackTrace();
			System.err.print("加载oracle驱动失败！");
			System.exit(1);
		}
		try {
			conn = DriverManager.getConnection(url, user, password);
			System.out.println(conn);
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.print("连接oracle失败！");
			System.exit(1);
		}
		return conn;
	}
	
	public static Connection connectMysql(){
		String mysqlDriver = "com.mysql.jdbc.Driver";
		String url = "jdbc:mysql://127.0.0.1:3306/zwl?userUnicode=true?characterEncoding=utf8";
		String user = "root";
		String password = "zhangwanli99";
		Connection conn = null;
		try {
			Class.forName(mysqlDriver);
		} catch (ClassNotFoundException e) {
			e.printStackTrace();
			System.err.print("加载mysql驱动失败！");
			System.exit(1);
		}
		try {
			conn = DriverManager.getConnection(url, user, password);
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.print("连接mysql失败！");
			System.exit(1);
		}
		return conn;
	}
	
	public static Connection connectSqlserver(){
		String sqlserverDriver = "com.microsoft.sqlserver.jdbc.SQLServerDriver";
//		String url = "jdbc:sqlserver://127.0.0.1:1433;integratedSecurity=true;DatabaseName=master";
		String url = "jdbc:sqlserver://10.0.71.50:1433;DatabaseName=VankeMiniMDS";
		String user = "vkoper";
		String password = "vkmdm";
		Connection conn = null;
		try {
			Class.forName(sqlserverDriver);
		} catch (ClassNotFoundException e) {
			e.printStackTrace();
			System.err.print("加载sqlserver驱动失败");
			System.exit(1);
		}
		try {
			conn = DriverManager.getConnection(url, user, password);
			System.out.println(conn);
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.print("连接sqlserver失败！");
			System.exit(1);
		}
		return conn;
	}
	
	public static void close(Connection conn, Statement stmt,ResultSet rs){
		if(rs != null){
			try {
				rs.close();
			} catch (SQLException e) {
				e.printStackTrace();
			}finally{
				if(stmt != null){
					try {
						stmt.close();
					} catch (SQLException e) {
						e.printStackTrace();
					}finally{
						if(conn != null){
							try {
								conn.close();
							} catch (SQLException e) {
								e.printStackTrace();
							}
						}
					}
				}
			}
		}
	}
	
	public static void main(String[] args) {
//		connectOracle();
//		connectMysql();
		connectSqlserver();
	}
}

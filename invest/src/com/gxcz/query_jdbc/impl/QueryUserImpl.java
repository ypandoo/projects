package com.gxcz.query_jdbc.impl;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

import com.gxcz.query_jdbc.IQueryUser_Jdbc;
import com.gxcz.query_jdbc.entity.UserDTO;






public class QueryUserImpl implements IQueryUser_Jdbc {
	 // 创建静态全局变量  
   static Connection conn;  
 
   static Statement st;  
	@Override
	public List<UserDTO> QueryAll(String name) {
		List<UserDTO> list=new ArrayList<UserDTO>();
		list=this.query(name);
		return list;
	}
	 /* 查询数据库，输出符合要求的记录的情况*/  
   public static List<UserDTO> query(String name) {  
         
       conn = getConnection(); //连接到数据库  
       try {  
           String sql = "select * from USER_INFO where UNAME like '%"+name+"%'";   
           st = (Statement) conn.createStatement();   
           List<UserDTO> list=new ArrayList<UserDTO>();
           ResultSet rs = st.executeQuery(sql);    
           System.out.println("最后的查询结果为：");  
           while (rs.next()) { // 判断是否还有下一个数据  
               UserDTO user=new UserDTO();
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
           }  
           conn.close();   //关闭数据库连接  
             return list;
       } catch (SQLException e) {  
           System.out.println("查询数据失败");
           return null;
       }  
   }  
 

   /* 获取数据库连接的函数*/  
   public static Connection getConnection() {  
       Connection con = null;  //创建用于连接数据库的Connection对象  
       try {  
           Class.forName("com.mysql.jdbc.Driver");// 加载Mysql数据驱动  
             
           con = DriverManager.getConnection(  
                   "jdbc:mysql://192.168.8.63:3306/inverstment", "root", "GXCZ@xuhui88");// 创建数据连接  
             
       } catch (Exception e) {  
           System.out.println("数据库连接失败" + e.getMessage());  
       }  
       return con; //返回所建立的数据库连接  
   }  
}
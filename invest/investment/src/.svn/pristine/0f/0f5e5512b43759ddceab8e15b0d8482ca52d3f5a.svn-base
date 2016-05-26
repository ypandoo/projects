package com.gxcz.query_jdbc;

import java.util.List;

import com.gxcz.query_jdbc.entity.UserDTO;
import com.gxcz.query_jdbc.impl.QueryUserImpl;

public class Test {

	public static void main(String[] args) {
		IQueryUser_Jdbc user=new QueryUserImpl();
		List<UserDTO>	list=user.QueryAll("陈静");
		System.out.println(list.size());
		for(int i=0;i<list.size();i++){
			System.out.println(list.get(i).getName()+"\t"+list.get(i).getHeadquarters());
		}

	}

}

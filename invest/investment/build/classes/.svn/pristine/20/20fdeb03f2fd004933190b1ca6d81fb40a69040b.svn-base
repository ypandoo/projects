package com.gxcz.query_jdbc;


import java.util.List;

import javax.annotation.Resource;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.servlet.ModelAndView;

import com.gxcz.query_jdbc.entity.UserDTO;
import com.gxcz.query_jdbc.impl.QueryUserImpl;




@Controller
@RequestMapping("/theuser.do")
public class QueryUserController {

	@RequestMapping(params= "action=aa")
	public ModelAndView findByID(HttpServletRequest request,
			HttpServletResponse response)throws Exception{
		ModelAndView modelAndView=null;
		try {
			String name=request.getParameter("name");//传入的参数
			IQueryUser_Jdbc user=new QueryUserImpl();
			List<UserDTO>	list=user.QueryAll(name);
			System.out.println(list.size());
			for(int i=0;i<list.size();i++){
				System.out.println(list.get(i).getName()+"\t"+list.get(i).getHeadquarters());
			}
			modelAndView=new ModelAndView("user/test").addObject("theuser",list);
		} catch (Exception e) {
			System.out.println(e.getMessage());
			modelAndView=new ModelAndView("error");
		}
		return modelAndView;
	}
	
}

package com.gxcz.xuhui.investment.controller;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;

import com.gxcz.xuhui.investment.model.dto.ResultDTO;

@Controller(value = "com.gxcz.xuhui.investment.controller.TestController")
@RequestMapping("/test")
public class TestController {
	
	@RequestMapping(value = "/aa")
	public @ResponseBody ResultDTO test() {
		System.out.println("success");
		ResultDTO result = new ResultDTO();
		result.setSuccess(true);
		result.setErrCode("0");
		
		List<Map<String,Object>> resultData = new ArrayList<Map<String,Object>>();
		Map<String,Object> dataMap = new HashMap<String, Object>();
		dataMap.put("name", "king");
		dataMap.put("isexists", true);
		dataMap.put("createDate", new SimpleDateFormat("yyyy-MM-dd").format(new Date()));
		
		TestClass c = new TestClass();
		c.setId("1");
		c.setName("abc");
		dataMap.put("testClass", c);
		
		List<String> l = new ArrayList<String>();
	     l.add("1");
	     l.add("1");
	     l.add("1");
	     l.add("1");
	     l.add("1");
	     l.add("1");
	     l.add("1");
		dataMap.put("dataList", l);
		resultData.add(dataMap);
//		result.setData(l);
		return result;
	}
	
	class TestClass{
		private String id;
		private String name;
		public String getId() {
			return id;
		}
		public void setId(String id) {
			this.id = id;
		}
		public String getName() {
			return name;
		}
		public void setName(String name) {
			this.name = name;
		}
		
		
		
	}
}

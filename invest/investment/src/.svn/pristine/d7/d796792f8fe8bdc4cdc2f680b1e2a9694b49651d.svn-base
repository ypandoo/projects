package com.gxcz.xuhui.investment.service.impl;

import java.util.List;
import java.util.Map;

import com.gxcz.xuhui.investment.model.UserInfo;
import com.gxcz.xuhui.investment.model.dto.UserInfoDTO;

public interface IUserService {
	void insert(UserInfo userinfo);
	
	UserInfo getUserInfoByLoginId(String logId);
	
	List<UserInfoDTO> getUserList(UserInfoDTO userInfoDto);

	UserInfo getUserInfoBysAMAccountName(String sAMAccountName);
	
	List<UserInfoDTO> getUserRelateList(UserInfoDTO userInfoDto);
	
	int updateRemissionCountByUserId(UserInfo userInfo);
	
	int updateRemissionCountBatch(List<UserInfo> userList);

	List<UserInfo> selectRemissionUserList();
	
	List<UserInfo> selectRemissionUserLimit(Map<String, String> searchParam);
	
	UserInfo getUserInfoByUname(String uname);
	
}

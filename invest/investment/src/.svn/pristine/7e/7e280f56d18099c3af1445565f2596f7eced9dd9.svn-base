package com.gxcz.xuhui.investment.service.impl;

import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.gxcz.xuhui.investment.dao.UserInfoMapper;
import com.gxcz.xuhui.investment.model.UserInfo;
import com.gxcz.xuhui.investment.model.dto.UserInfoDTO;

@Service("userService")
public class UserService implements IUserService {
	private UserInfoMapper userInfoMapper=null;
	
	public void insert(UserInfo userinfo) {
		userInfoMapper.insert(userinfo);
	}
	public UserInfoMapper getUserInfoMapper() {
		return userInfoMapper;
	}
	@Autowired
	public void setUserInfoMapper(UserInfoMapper userInfoMapper) {
		this.userInfoMapper = userInfoMapper;
	}
	public UserInfo getUserInfoByLoginId(String loginId) {
		UserInfo userInfo = userInfoMapper.selectByLoginId(loginId);
		return userInfo;
	}
	@Override
	public List<UserInfoDTO> getUserList(UserInfoDTO userInfoDto) {
		return userInfoMapper.getUserList(userInfoDto);
	}
	@Override
	public UserInfo getUserInfoBysAMAccountName(String sAMAccountName) {
		return userInfoMapper.selectBySAMAccountName(sAMAccountName);
	}
	@Override
	public List<UserInfoDTO> getUserRelateList(UserInfoDTO userInfoDto) {
		
		return userInfoMapper.getUserRelateList(userInfoDto);
	}
	@Override
	public UserInfo getUserInfoByUname(String uname) {
		return userInfoMapper.selectByUname(uname);
	}
	@Override
	public int updateRemissionCountByUserId(UserInfo userInfo) {
		 return this.userInfoMapper.updateRemissionCountByUserId(userInfo);
	}
	@Override
	public int updateRemissionCountBatch(List<UserInfo> userList){
		int result = 0;
	    for (int i = 0; i < userList.size(); i++) {
	      result += this.userInfoMapper.updateRemissionCountByUserId((UserInfo)userList.get(i));
	    }
	    return result;
	}
	@Override
	public List<UserInfo> selectRemissionUserList() {
		return this.userInfoMapper.selectRemissionUserList();
	}
	@Override
	public List<UserInfo> selectRemissionUserLimit(Map<String, String> paramMap) {
		return this.userInfoMapper.selectRemissionUserLimit(paramMap);
	}
	
}

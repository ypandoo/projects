package com.gxcz.xuhui.investment.service.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.gxcz.xuhui.investment.dao.FollowSchemeInfoMapper;
import com.gxcz.xuhui.investment.model.FollowSchemeInfo;

@Service("followSchemeService")
public class FollowSchemeService implements IFollowSchemeService {
	FollowSchemeInfoMapper followSchemeInfoMapper=null;
	
	public FollowSchemeInfoMapper getFollowSchemeInfoMapper() {
		return followSchemeInfoMapper;
	}
	@Autowired
	public void setFollowSchemeInfoMapper(FollowSchemeInfoMapper followSchemeInfoMapper) {
		this.followSchemeInfoMapper = followSchemeInfoMapper;
	}
	@Override
	public int deleteByPrimaryKey(String schemeId) {
		// TODO Auto-generated method stub
		return followSchemeInfoMapper.deleteByPrimaryKey(schemeId);
	}
	@Override
	public int insert(FollowSchemeInfo record) {
		// TODO Auto-generated method stub
		return followSchemeInfoMapper.insert(record);
	}
	@Override
	public int insertSelective(FollowSchemeInfo record) {
		// TODO Auto-generated method stub
		return followSchemeInfoMapper.insertSelective(record);
	}
	@Override
	public FollowSchemeInfo selectByPrimaryKey(String schemeId) {
		// TODO Auto-generated method stub
		return followSchemeInfoMapper.selectByPrimaryKey(schemeId);
	}
	public int updateByPrimaryKeySelective(FollowSchemeInfo record) {
		// TODO Auto-generated method stub
		return followSchemeInfoMapper.updateByPrimaryKeySelective(record);
	}
	@Override
	public int updateByPrimaryKey(FollowSchemeInfo record) {
		// TODO Auto-generated method stub
		return followSchemeInfoMapper.updateByPrimaryKey(record);
	}
	@Override
	public FollowSchemeInfo selectByProjectId(String projectId) {
		// TODO Auto-generated method stub
		return followSchemeInfoMapper.selectByProjectId(projectId);
	}


}

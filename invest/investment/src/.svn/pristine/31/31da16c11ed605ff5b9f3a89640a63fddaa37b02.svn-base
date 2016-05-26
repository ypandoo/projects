package com.gxcz.xuhui.investment.service.impl;

import java.util.List;
import java.util.UUID;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.alibaba.druid.util.StringUtils;
import com.gxcz.xuhui.investment.dao.SubscribeInfoMapper;
import com.gxcz.xuhui.investment.model.ForceFollowInfo;
import com.gxcz.xuhui.investment.model.SubscribeInfo;
import com.gxcz.xuhui.investment.model.dto.SubscribeModelDTO;

@Service("subscribeService")
public class SubscribeService implements ISubscribeService {
	SubscribeInfoMapper subscribeInfoMapper=null;
	
	public SubscribeInfoMapper getSubscribeInfoMapper() {
		return subscribeInfoMapper;
	}
	@Autowired
	public void setSubscribeInfoMapper(SubscribeInfoMapper subscribeInfoMapper) {
		this.subscribeInfoMapper = subscribeInfoMapper;
	}

	@Override
	public int deleteByPrimaryKey(String subscribeId) {
		// TODO Auto-generated method stub
		return subscribeInfoMapper.deleteByPrimaryKey(subscribeId);
	}

	@Override
	public int insert(SubscribeInfo record) {
		// TODO Auto-generated method stub
		return subscribeInfoMapper.insert(record);
	}

	@Override
	public int insertSelective(SubscribeInfo record) {
		// TODO Auto-generated method stub
		return subscribeInfoMapper.insertSelective(record);
	}

	@Override
	public SubscribeInfo selectByPrimaryKey(String subscribeId) {
		// TODO Auto-generated method stub
		return subscribeInfoMapper.selectByPrimaryKey(subscribeId);
	}

	@Override
	public int updateByPrimaryKeySelective(SubscribeInfo record) {
		// TODO Auto-generated method stub
		return subscribeInfoMapper.updateByPrimaryKeySelective(record);
	}

	@Override
	public int updateByPrimaryKey(SubscribeInfo record) {
		// TODO Auto-generated method stub
		return subscribeInfoMapper.updateByPrimaryKey(record);
	}

	@Override
	public List<SubscribeInfo> selectByProjectId(String projectId) {
		return subscribeInfoMapper.selectByProjectId(projectId);
	}
	@Override
	public int saveOrUpdate(SubscribeModelDTO subscribeModel) {
		int result=1;
		String projectId=subscribeModel.getProjectId();
		List<SubscribeInfo> list= subscribeModel.getSubscribeList();
		for(int i=0;i<list.size();i++){
			SubscribeInfo subscribeInfo= list.get(i);
			subscribeInfo.setProjectId(projectId);
			if(!StringUtils.isEmpty(subscribeInfo.getSubscribeId())){
				updateByPrimaryKey(subscribeInfo);
			}else{
				subscribeInfo.setSubscribeId(UUID.randomUUID().toString());
				insert(subscribeInfo);
			}
		}
		return result;
	}

}

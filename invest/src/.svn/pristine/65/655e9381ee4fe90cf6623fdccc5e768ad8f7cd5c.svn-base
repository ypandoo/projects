package com.gxcz.xuhui.investment.service.impl;

import java.math.BigDecimal;
import java.util.Date;
import java.util.List;
import java.util.UUID;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.alibaba.druid.util.StringUtils;
import com.gxcz.xuhui.investment.dao.ForceFollowInfoMapper;
import com.gxcz.xuhui.investment.model.ForceFollowInfo;
import com.gxcz.xuhui.investment.model.dto.ForceModelDTO;

@Service("forceFollowService")
public class ForceFollowService implements IForceFollowService {
	ForceFollowInfoMapper forceFollowInfoMapper=null;
	
	public ForceFollowInfoMapper getForceFollowInfoMapper() {
		return forceFollowInfoMapper;
	}

	@Autowired
	public void setForceFollowInfoMapper(ForceFollowInfoMapper forceFollowInfoMapper) {
		this.forceFollowInfoMapper = forceFollowInfoMapper;
	}

	@Override
	public int deleteByPrimaryKey(String forceFollowId) {
		return forceFollowInfoMapper.deleteByPrimaryKey(forceFollowId);
	}

	@Override
	public int insert(ForceFollowInfo record) {
		// TODO Auto-generated method stub
		return forceFollowInfoMapper.insert(record);
	}

	@Override
	public int insertSelective(ForceFollowInfo record) {
		// TODO Auto-generated method stub
		return forceFollowInfoMapper.insertSelective(record);
	}

	@Override
	public ForceFollowInfo selectByPrimaryKey(String forceFollowId) {
		// TODO Auto-generated method stub
		return forceFollowInfoMapper.selectByPrimaryKey(forceFollowId);
	}

	@Override
	public int updateByPrimaryKeySelective(ForceFollowInfo record) {
		// TODO Auto-generated method stub
		return forceFollowInfoMapper.updateByPrimaryKey(record);
	}

	@Override
	public int updateByPrimaryKey(ForceFollowInfo record) {
		// TODO Auto-generated method stub
		return forceFollowInfoMapper.updateByPrimaryKeySelective(record);
	}

	@Override
	public List<ForceFollowInfo> selectByProjectId(ForceFollowInfo record) {
		return forceFollowInfoMapper.selectByProjectId(record);
	}
	
	public int saveOrUpdate(ForceModelDTO forceModelDTO) throws Exception{
		int result=1;
		String projectId=forceModelDTO.getProjectid();
		List<ForceFollowInfo> list= forceModelDTO.getForceFollList();
		for(int i=0;i<list.size();i++){
			ForceFollowInfo forceFollowInfo= list.get(i);
			if(forceFollowInfo.getName() == null || "".equals(forceFollowInfo.getName())){
				continue;
			}
			forceFollowInfo.setProjectId(projectId);
			
			// 转换单位为万元
//			forceFollowInfo.getToplimit().intValue();
			forceFollowInfo.setToplimit(new BigDecimal(forceFollowInfo.getToplimit().intValue()*10000));
			forceFollowInfo.setDownlimit(new BigDecimal(forceFollowInfo.getDownlimit().intValue()*10000));
			
			if(!StringUtils.isEmpty(forceFollowInfo.getForceFollowId())){
				updateByPrimaryKey(forceFollowInfo);
			}else{
				forceFollowInfo.setCreatetime(new Date());
				forceFollowInfo.setForceFollowId(UUID.randomUUID().toString());
				insert(forceFollowInfo);
			}
		}
		return result;
	}

}

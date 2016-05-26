package com.gxcz.xuhui.investment.service.impl;

import java.util.List;

import com.gxcz.xuhui.investment.model.ForceFollowInfo;
import com.gxcz.xuhui.investment.model.dto.ForceModelDTO;

public interface IForceFollowService {
	int deleteByPrimaryKey(String forceFollowId);

    int insert(ForceFollowInfo record);

    int insertSelective(ForceFollowInfo record);

    ForceFollowInfo selectByPrimaryKey(String forceFollowId);

    int updateByPrimaryKeySelective(ForceFollowInfo record);

    int updateByPrimaryKey(ForceFollowInfo record);
    
    List<ForceFollowInfo> selectByProjectId(ForceFollowInfo record);
    
    int saveOrUpdate(ForceModelDTO list) throws Exception;
}

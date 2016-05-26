package com.gxcz.xuhui.investment.service.impl;

import java.util.List;

import com.gxcz.xuhui.investment.model.SubscribeInfo;
import com.gxcz.xuhui.investment.model.dto.SubscribeModelDTO;

public interface ISubscribeService {
	int deleteByPrimaryKey(String subscribeId);

    int insert(SubscribeInfo record);

    int insertSelective(SubscribeInfo record);

    SubscribeInfo selectByPrimaryKey(String subscribeId);

    int updateByPrimaryKeySelective(SubscribeInfo record);

    int updateByPrimaryKey(SubscribeInfo record);
    
    List<SubscribeInfo> selectByProjectId(String projectId);
    
    int saveOrUpdate(SubscribeModelDTO subscribeModel);
}

package com.gxcz.xuhui.investment.dao;

import java.util.List;

import com.gxcz.xuhui.investment.model.SubscribeInfo;

public interface SubscribeInfoMapper {
    int deleteByPrimaryKey(String subscribeId);

    int insert(SubscribeInfo record);

    int insertSelective(SubscribeInfo record);

    SubscribeInfo selectByPrimaryKey(String subscribeId);

    int updateByPrimaryKeySelective(SubscribeInfo record);

    int updateByPrimaryKey(SubscribeInfo record);
    
    List<SubscribeInfo> selectByProjectId(String projectId);
    
    int deleteRelateByProject(String projectId);
}
package com.gxcz.xuhui.investment.dao;

import java.util.List;

import com.gxcz.xuhui.investment.model.ForceFollowInfo;

public interface ForceFollowInfoMapper {
    int deleteByPrimaryKey(String forceFollowId);

    int insert(ForceFollowInfo record);

    int insertSelective(ForceFollowInfo record);

    ForceFollowInfo selectByPrimaryKey(String forceFollowId);

    int updateByPrimaryKeySelective(ForceFollowInfo record);

    int updateByPrimaryKey(ForceFollowInfo record);
    
    List<ForceFollowInfo> selectByProjectId(ForceFollowInfo record);
    
    int deleteRelateByProject(String projectId);
    
}
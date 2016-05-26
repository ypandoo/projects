package com.gxcz.xuhui.investment.dao;

import com.gxcz.xuhui.investment.model.FollowSchemeInfo;

public interface FollowSchemeInfoMapper {
    int deleteByPrimaryKey(String schemeId);

    int insert(FollowSchemeInfo record);

    int insertSelective(FollowSchemeInfo record);

    FollowSchemeInfo selectByPrimaryKey(String schemeId);

    int updateByPrimaryKeySelective(FollowSchemeInfo record);

    int updateByPrimaryKey(FollowSchemeInfo record);
    
    FollowSchemeInfo selectByProjectId(String projectId);
    
    int deleteRelateByProject(String projectId);
}
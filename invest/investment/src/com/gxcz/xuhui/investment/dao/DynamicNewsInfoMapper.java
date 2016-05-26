package com.gxcz.xuhui.investment.dao;

import java.util.List;

import com.gxcz.xuhui.investment.model.DynamicNewsInfo;
import com.gxcz.xuhui.investment.model.dto.DynamicNewsInfoDTO;

public interface DynamicNewsInfoMapper {
    int deleteByPrimaryKey(String newsId);

    int insert(DynamicNewsInfo record);

    int insertSelective(DynamicNewsInfo record);

    DynamicNewsInfo selectByPrimaryKey(String newsId);

    int updateByPrimaryKeySelective(DynamicNewsInfo record);

    int updateByPrimaryKey(DynamicNewsInfo record);
    
    List<DynamicNewsInfoDTO> getNewsListByUser(DynamicNewsInfoDTO dynamicNewsInfoDTO);
    
    List<DynamicNewsInfoDTO> getNewsListByProjectId(DynamicNewsInfoDTO dynamicNewsInfoDTO);
    
    List<DynamicNewsInfoDTO> getComSubProjectNewsByUser(DynamicNewsInfoDTO dynamicNewsInfoDTO);
    
    DynamicNewsInfoDTO getNewsDetail(String newsId);
}
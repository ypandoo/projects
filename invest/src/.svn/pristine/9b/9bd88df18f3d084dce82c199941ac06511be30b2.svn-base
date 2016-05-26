package com.gxcz.xuhui.investment.service.impl;

import java.util.List;

import com.gxcz.xuhui.investment.model.BonusDetail;
import com.gxcz.xuhui.investment.model.dto.BonusDetailDTO;

public interface IBonusDetailService {
	int deleteByPrimaryKey(String bonusId);

    int insert(BonusDetail record);

    int insertSelective(BonusDetail record);

    BonusDetail selectByPrimaryKey(String bonusId);

    int updateByPrimaryKeySelective(BonusDetail record);

    int updateByPrimaryKey(BonusDetail record);
    
    List<BonusDetailDTO> getBonusDetailList(BonusDetailDTO bonusDetailDTO);
    
    int insertBatch(List<BonusDetail> list);
    
    List<BonusDetailDTO> getBonusDetailByList(List list);
    
    int updateBatch(List<BonusDetail> list);
}

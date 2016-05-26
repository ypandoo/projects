package com.gxcz.xuhui.investment.service.impl;

import java.util.List;

import com.gxcz.xuhui.investment.model.PayInDetail;
import com.gxcz.xuhui.investment.model.dto.PayInDetailDTO;

public interface IPayInDetailService {
	int deleteByPrimaryKey(String piId);

    int insert(PayInDetail record);

    int insertSelective(PayInDetail record);

    PayInDetail selectByPrimaryKey(String piId);

    int updateByPrimaryKeySelective(PayInDetail record);

    int updateByPrimaryKey(PayInDetail record);
    
    List<PayInDetailDTO> selectByDetail(PayInDetailDTO record);
    
    int insertBatch(List<PayInDetail> list);
    
    List<PayInDetailDTO> getListById(List<PayInDetail> list);
    
    int updateBatch(List<PayInDetail> list);
}

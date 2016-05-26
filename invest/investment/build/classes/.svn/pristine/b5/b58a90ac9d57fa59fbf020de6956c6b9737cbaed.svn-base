package com.gxcz.xuhui.investment.service.impl;

import java.util.List;

import com.gxcz.xuhui.investment.model.BankInfo;
import com.gxcz.xuhui.investment.model.dto.BankInfoDTO;

public interface IBankService {
	int deleteByPrimaryKey(String bankId);

    int insert(BankInfo record);

    int insertSelective(BankInfo record);

    BankInfo selectByPrimaryKey(String bankId);

    int updateByPrimaryKeySelective(BankInfo record);

    int updateByPrimaryKey(BankInfo record);
    
	List<BankInfoDTO> getBankListByUserId(String userid);
}

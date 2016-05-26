package com.gxcz.xuhui.investment.service.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.gxcz.xuhui.investment.dao.BankInfoMapper;
import com.gxcz.xuhui.investment.model.BankInfo;
import com.gxcz.xuhui.investment.model.dto.BankInfoDTO;

@Service("bankService")
public class BankService implements IBankService {
	BankInfoMapper bankInfoMapper; 
	
	public BankInfoMapper getBankInfoMapper() {
		return bankInfoMapper;
	}
	@Autowired
	public void setBankInfoMapper(BankInfoMapper bankInfoMapper) {
		this.bankInfoMapper = bankInfoMapper;
	}

	@Override
	public List<BankInfoDTO> getBankListByUserId(String userid) {
		return bankInfoMapper.getBankListByUserId(userid);
	}
	@Override
	public int deleteByPrimaryKey(String bankId) {
		return bankInfoMapper.deleteByPrimaryKey(bankId);
	}
	@Override
	public int insert(BankInfo record) {
		return bankInfoMapper.insert(record);
	}
	@Override
	public int insertSelective(BankInfo record) {
		return bankInfoMapper.insertSelective(record);
	}
	@Override
	public BankInfo selectByPrimaryKey(String bankId) {
		return bankInfoMapper.selectByPrimaryKey(bankId);
	}
	@Override
	public int updateByPrimaryKeySelective(BankInfo record) {
		return bankInfoMapper.updateByPrimaryKeySelective(record);
	}
	@Override
	public int updateByPrimaryKey(BankInfo record) {
		return bankInfoMapper.updateByPrimaryKey(record);
	}

}

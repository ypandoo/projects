package com.gxcz.xuhui.investment.service.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.gxcz.xuhui.investment.dao.PayInDetailMapper;
import com.gxcz.xuhui.investment.model.PayInDetail;
import com.gxcz.xuhui.investment.model.dto.PayInDetailDTO;

@Service("payInDetailService")
public class PayInDetailService implements IPayInDetailService {
	PayInDetailMapper payInDetailMapper = null;
	
	public PayInDetailMapper getPayInDetailMapper() {
		return payInDetailMapper;
	}

	@Autowired
	public void setPayInDetailMapper(PayInDetailMapper payInDetailMapper) {
		this.payInDetailMapper = payInDetailMapper;
	}

	@Override
	public int deleteByPrimaryKey(String piId) {
		// TODO Auto-generated method stub
		return payInDetailMapper.deleteByPrimaryKey(piId);
	}

	@Override
	public int insert(PayInDetail record) {
		// TODO Auto-generated method stub
		return payInDetailMapper.insert(record);
	}

	@Override
	public int insertSelective(PayInDetail record) {
		// TODO Auto-generated method stub
		return payInDetailMapper.insertSelective(record);
	}

	@Override
	public PayInDetail selectByPrimaryKey(String piId) {
		// TODO Auto-generated method stub
		return payInDetailMapper.selectByPrimaryKey(piId);
	}

	@Override
	public int updateByPrimaryKeySelective(PayInDetail record) {
		// TODO Auto-generated method stub
		return payInDetailMapper.updateByPrimaryKeySelective(record);
	}

	@Override
	public int updateByPrimaryKey(PayInDetail record) {
		// TODO Auto-generated method stub
		return payInDetailMapper.updateByPrimaryKey(record);
	}

	@Override
	public List<PayInDetailDTO> selectByDetail(PayInDetailDTO record) {
		// TODO Auto-generated method stub
		return payInDetailMapper.selectByDetail(record);
	}

	@Override
	public int insertBatch(List<PayInDetail> list) {
		// TODO Auto-generated method stub
		return payInDetailMapper.insertBatch(list);
	}

	@Override
	public List<PayInDetailDTO> getListById(List<PayInDetail> list) {
		// TODO Auto-generated method stub
		return payInDetailMapper.getListById(list);
	}

	@Override
	public int updateBatch(List<PayInDetail> list) {
		// TODO Auto-generated method stub
		return payInDetailMapper.updateBatch(list);
	}

}

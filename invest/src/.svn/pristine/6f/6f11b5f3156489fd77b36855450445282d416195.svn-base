package com.gxcz.xuhui.investment.service.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.gxcz.xuhui.investment.dao.BonusDetailMapper;
import com.gxcz.xuhui.investment.model.BonusDetail;
import com.gxcz.xuhui.investment.model.dto.BonusDetailDTO;

@Service("bonusDetailService")
public class BonusDetailService implements IBonusDetailService {
	BonusDetailMapper bonusDetailMapper=null;
	
	public BonusDetailMapper getBonusDetailMapper() {
		return bonusDetailMapper;
	}
	@Autowired
	public void setBonusDetailMapper(BonusDetailMapper bonusDetailMapper) {
		this.bonusDetailMapper = bonusDetailMapper;
	}

	@Override
	public int deleteByPrimaryKey(String bonusId) {
		return bonusDetailMapper.deleteByPrimaryKey(bonusId);
	}

	@Override
	public int insert(BonusDetail record) {
		return bonusDetailMapper.insert(record);
	}

	@Override
	public int insertSelective(BonusDetail record) {
		return bonusDetailMapper.insertSelective(record);
	}

	@Override
	public BonusDetail selectByPrimaryKey(String bonusId) {
		return bonusDetailMapper.selectByPrimaryKey(bonusId);
	}

	@Override
	public int updateByPrimaryKeySelective(BonusDetail record) {
		return bonusDetailMapper.updateByPrimaryKeySelective(record);
	}

	@Override
	public int updateByPrimaryKey(BonusDetail record) {
		return bonusDetailMapper.updateByPrimaryKey(record);
	}

	@Override
	public List<BonusDetailDTO> getBonusDetailList(BonusDetailDTO bonusDetailDTO) {
		return bonusDetailMapper.getBonusDetailList(bonusDetailDTO);
	}
	@Override
	public int insertBatch(List<BonusDetail> list) {
		return bonusDetailMapper.insertBatch(list);
	}
	@Override
	public List<BonusDetailDTO> getBonusDetailByList(List list) {
		// TODO Auto-generated method stub
		return bonusDetailMapper.getBonusDetailByList(list);
	}
	@Override
	public int updateBatch(List<BonusDetail> list) {
		// TODO Auto-generated method stub
		return bonusDetailMapper.updateBatch(list);
	}

}

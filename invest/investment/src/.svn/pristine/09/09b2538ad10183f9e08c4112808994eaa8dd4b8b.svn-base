package com.gxcz.xuhui.investment.service.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.gxcz.xuhui.investment.dao.DynamicNewsInfoMapper;
import com.gxcz.xuhui.investment.model.DynamicNewsInfo;
import com.gxcz.xuhui.investment.model.dto.DynamicNewsInfoDTO;

@Service("dynamicNewsService")
public class DynamicNewsService implements IDynamicNewsService {
	private DynamicNewsInfoMapper dynamicNewsInfoMapper=null;
	
	public DynamicNewsInfoMapper getDynamicNewsInfoMapper() {
		return dynamicNewsInfoMapper;
	}
	@Autowired
	public void setDynamicNewsInfoMapper(DynamicNewsInfoMapper dynamicNewsInfoMapper) {
		this.dynamicNewsInfoMapper = dynamicNewsInfoMapper;
	}

	@Override
	public List<DynamicNewsInfoDTO> getNewsListByUser(DynamicNewsInfoDTO dynamicNewsInfoDTO) {
		return dynamicNewsInfoMapper.getNewsListByUser(dynamicNewsInfoDTO);
	}

	@Override
	public int deleteByPrimaryKey(String newsId) {
		return dynamicNewsInfoMapper.deleteByPrimaryKey(newsId);
	}

	@Override
	public int insert(DynamicNewsInfo record) {
		return dynamicNewsInfoMapper.insert(record);
	}

	@Override
	public int insertSelective(DynamicNewsInfo record) {
		return dynamicNewsInfoMapper.insertSelective(record);
	}

	@Override
	public DynamicNewsInfo selectByPrimaryKey(String newsId) {
		return dynamicNewsInfoMapper.selectByPrimaryKey(newsId);
	}

	@Override
	public int updateByPrimaryKeySelective(DynamicNewsInfo record) {
		return dynamicNewsInfoMapper.updateByPrimaryKeySelective(record);
	}

	@Override
	public int updateByPrimaryKey(DynamicNewsInfo record) {
		return dynamicNewsInfoMapper.updateByPrimaryKey(record);
	}
	@Override
	public List<DynamicNewsInfoDTO> getNewsListByProjectId(DynamicNewsInfoDTO dynamicNewsInfoDTO) {
		return dynamicNewsInfoMapper.getNewsListByProjectId(dynamicNewsInfoDTO);
	}
	@Override
	public List<DynamicNewsInfoDTO> getComSubProjectNewsByUser(DynamicNewsInfoDTO dynamicNewsInfoDTO) {
		return dynamicNewsInfoMapper.getComSubProjectNewsByUser(dynamicNewsInfoDTO);
	}
	@Override
	public DynamicNewsInfoDTO getNewsDetail(String newsId) {
		return dynamicNewsInfoMapper.getNewsDetail(newsId);
	}

}

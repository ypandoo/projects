package com.gxcz.xuhui.investment.dao;

import com.gxcz.xuhui.investment.model.SubscribeRecordList;

public interface SubscribeRecordListMapper {
    int insert(SubscribeRecordList record);

    int insertSelective(SubscribeRecordList record);
}
package com.gxcz.xuhui.investment.dao;

import java.math.BigDecimal;
import java.util.List;

import org.apache.ibatis.annotations.Param;

import com.gxcz.xuhui.investment.model.CompleteSubscribeRecord;
import com.gxcz.xuhui.investment.model.SubscribeSummaryInfo;
import com.gxcz.xuhui.investment.model.dto.CompleteSubscribeRecordDTO;
import com.gxcz.xuhui.investment.model.dto.DimissionInfoDTO;
import com.gxcz.xuhui.investment.model.dto.QueryParamDTO;

public interface CompleteSubscribeRecordMapper {
    int deleteByPrimaryKey(String csrId);

    int insert(CompleteSubscribeRecord record);

    int insertSelective(CompleteSubscribeRecord record);

    CompleteSubscribeRecord selectByPrimaryKey(String csrId);

    int updateByPrimaryKeySelective(CompleteSubscribeRecord record);

    int updateByPrimaryKey(CompleteSubscribeRecord record);
    
    List<CompleteSubscribeRecordDTO> selectAllUnCompleteSubscribe(QueryParamDTO queryparam);
    
    SubscribeSummaryInfo selectSummaryInfo();
    
    SubscribeSummaryInfo selectSummaryInfoByUser(String uid);
   
    
    SubscribeSummaryInfo selectSummaryInfoByProjectId(String projectId);

	List<CompleteSubscribeRecordDTO> getSubscribeByList(List subscribeIdList);

	int updateBatch(CompleteSubscribeRecord record);

	BigDecimal queryConfirmationPayment(@Param(value = "projectId") String projectId, @Param(value = "userId") String uid);
    
    List<DimissionInfoDTO> queryDimissionList(QueryParamDTO queryparam);

	int updateDimissionByCsrid(CompleteSubscribeRecord record);

	int updateDimissionByUid(CompleteSubscribeRecord record);
    
    List<DimissionInfoDTO> queryDimissionListByExport(QueryParamDTO queryparam);
    
}
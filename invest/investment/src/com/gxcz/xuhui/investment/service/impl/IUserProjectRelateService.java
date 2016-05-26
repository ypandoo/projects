package com.gxcz.xuhui.investment.service.impl;

import java.util.List;

import com.gxcz.xuhui.investment.model.UserProjectRelate;
import com.gxcz.xuhui.investment.model.dto.ProjectBasicInfoDTO;
import com.gxcz.xuhui.investment.model.dto.UserInfoDTO;
import com.gxcz.xuhui.investment.model.dto.UserProjectRelateDTO;

public interface IUserProjectRelateService {
	int insert(UserProjectRelate record);

    int insertSelective(UserProjectRelate record);
    
    List<UserProjectRelateDTO> getUserProjectList(UserProjectRelateDTO userProjectRelateDTO);
    
    int deleteRelateByProject(String projectId);
    
    int saveUserProject(UserProjectRelateDTO record);
    
    List<UserInfoDTO> getUserByProject(String projectId);
    
    int deleteRelateByUserProject(UserProjectRelateDTO userProjectRelateDTO);

	int insertRelateList(List list);

	int deleteRelateList(List list);

	int updateRelateList(List list);
	
	List<UserInfoDTO> getUserRelateByProject(ProjectBasicInfoDTO ProjectInfoDto);
	
	List<UserInfoDTO> getRelateByUserId(UserProjectRelateDTO userProjectRelateDTO);
}

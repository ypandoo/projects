package com.gxcz.xuhui.investment.controller;

import java.util.List;
import java.util.UUID;

import javax.servlet.http.HttpSession;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

import com.gxcz.xuhui.investment.model.BankInfo;
import com.gxcz.xuhui.investment.model.UserInfo;
import com.gxcz.xuhui.investment.model.dto.BankInfoDTO;
import com.gxcz.xuhui.investment.model.dto.CompleteSubscribeRecordDTO;
import com.gxcz.xuhui.investment.model.dto.QueryParamDTO;
import com.gxcz.xuhui.investment.model.dto.ResultDTO;
import com.gxcz.xuhui.investment.service.ICompleteSubscribeRecordService;
import com.gxcz.xuhui.investment.service.impl.IBankService;
import com.gxcz.xuhui.investment.service.impl.IUserService;

@Controller
@RequestMapping("/BankController")
public class BankController {
	private IBankService bankService;
	private ICompleteSubscribeRecordService completeSubscribeRecordService;
	private IUserService userService;

	public IBankService getBankService() {
		return bankService;
	}

	@Autowired
	public void setBankService(IBankService bankService) {
		this.bankService = bankService;
	}

	public ICompleteSubscribeRecordService getCompleteSubscribeRecordService() {
		return completeSubscribeRecordService;
	}

	@Autowired
	public void setCompleteSubscribeRecordService(ICompleteSubscribeRecordService completeSubscribeRecordService) {
		this.completeSubscribeRecordService = completeSubscribeRecordService;
	}

	public IUserService getUserService() {
		return userService;
	}

	@Autowired
	public void setUserService(IUserService userService) {
		this.userService = userService;
	}

	@RequestMapping("/getBankListByUserId")
	@ResponseBody
	public ResultDTO getBankListByUserId(HttpSession session) {
		ResultDTO resultDto = new ResultDTO();
		try {
			UserInfo userInfo = userService.getUserInfoBysAMAccountName(String.valueOf(session.getAttribute("accountName")));
			session.setAttribute("userInfo",userInfo);
			String userid = userInfo.getUid();
			List<BankInfoDTO> bankInfoList = bankService.getBankListByUserId(userid);
			resultDto.setDataDto(bankInfoList);
			resultDto.setBaseModel(userInfo);
			resultDto.setSuccess(true);
		} catch (Exception ex) {
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}

	@RequestMapping("/insertBank")
	@ResponseBody
	public ResultDTO insertBank(HttpSession session, @RequestParam("bankNo") String bankNo, @RequestParam("bankName") String bankName, @RequestParam("bankAttribute") String bankAttribute) {
		ResultDTO resultDto = new ResultDTO();
		try {
			UserInfo userInfo = (UserInfo) session.getAttribute("userInfo");
			BankInfo bankInfo = new BankInfo();
			bankInfo.setUid(userInfo.getUid());
			bankInfo.setBankAttribute(bankAttribute);
			bankInfo.setBankName(bankName);
			bankInfo.setBankNo(bankNo);
			bankInfo.setBankId(UUID.randomUUID().toString());
			bankService.insert(bankInfo);
			resultDto.setSuccess(true);
		} catch (Exception ex) {
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}

	@RequestMapping("/deleteBank")
	@ResponseBody
	public ResultDTO deleteBank(HttpSession session, @RequestParam("bankId") String bankId) {
		ResultDTO resultDto = new ResultDTO();
		try {
			QueryParamDTO param = new QueryParamDTO();
			param.setBankId(bankId);
			List<CompleteSubscribeRecordDTO> data = completeSubscribeRecordService.queryAllUnCompleteRecord(param);
			if (data == null || data.size() <= 0) {
				bankService.deleteByPrimaryKey(bankId);
				resultDto.setSuccess(true);
			} else {
				resultDto.setError("当前帐号存在绑定关系，无法删除.");
				resultDto.setSuccess(false);
			}
		} catch (Exception ex) {
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}

	@RequestMapping("/updateBank")
	@ResponseBody
	public ResultDTO updateBank(HttpSession session, @RequestParam("bankId") String bankId, @RequestParam("bankNo") String bankNo, @RequestParam("bankName") String bankName, @RequestParam("bankAttribute") String bankAttribute) {
		ResultDTO resultDto = new ResultDTO();
		try {
			UserInfo userInfo = (UserInfo) session.getAttribute("userInfo");
			BankInfo bankInfo = new BankInfo();
			bankInfo.setUid(userInfo.getUid());
			bankInfo.setBankAttribute(bankAttribute);
			bankInfo.setBankName(bankName);
			bankInfo.setBankNo(bankNo);
			bankInfo.setBankId(bankId);
			bankService.updateByPrimaryKey(bankInfo);
			resultDto.setSuccess(true);
		} catch (Exception ex) {
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
}

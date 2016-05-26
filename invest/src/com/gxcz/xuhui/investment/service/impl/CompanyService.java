package com.gxcz.xuhui.investment.service.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.gxcz.xuhui.investment.dao.ICompanyDAO;
@Service
public class CompanyService implements ICompanyService {
	@Autowired
	private ICompanyDAO companyDAO;

	public ICompanyDAO getCompanyDAO() {
		return companyDAO;
	}

	public void setCompanyDAO(ICompanyDAO companyDAO) {
		this.companyDAO = companyDAO;
	}
	
	
	
	

}

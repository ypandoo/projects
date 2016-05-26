package com.gxcz.common.util;

import java.math.BigDecimal;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;

public class BaseUtil {

	/**
	 * 格式化时间 
	 * @param date
	 * @param ft
	 * @return
	 */
	public static String formatDate(Date date, String ft){
		SimpleDateFormat format = new SimpleDateFormat(ft); 
		return format.format(date);
	}
	/**
     * String 转成Date
     * @param dateStr
     * @return
     */
    public static  Date toChangeStringToDate(String dateStr) throws ParseException{
     SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd"); 
    Date d = null;
    	if(dateStr.contains("/")){
    		dateStr = dateStr.replaceAll("/", "-");
    	}
       d = format.parse(dateStr);
       
    return d;
    }
    
    public static BigDecimal getBigDecimal(String amount){
    	if(amount != null && !amount.equals("")){
    		if(amount.contains(",")){
    			amount = amount.replaceAll(",", "");
    		}
    		
    		return new BigDecimal(amount);
    	}
    	return new BigDecimal(0.00);
    }
    
   
}

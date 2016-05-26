package com.gxcz.common.util;

import java.io.IOException;
import java.io.InputStream;
import java.util.Scanner;

import org.apache.http.Header;
import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.CloseableHttpClient;
import org.apache.http.impl.client.HttpClients;
import org.apache.http.message.BasicHeader;
import org.apache.http.protocol.HTTP;
import org.apache.log4j.Logger;

import com.alibaba.fastjson.JSONObject;

public class HttpClientUtil {
	/**
	 * Logger for this class
	 */
	private static final Logger logger = Logger.getLogger(HttpClientUtil.class);

	public static JSONObject doPostRequest(String url, Header[] headers, JSONObject jsonParam) {
		CloseableHttpClient httpclient = HttpClients.createDefault();
		HttpPost post = new HttpPost(url);
		JSONObject result = null;
		try {
			StringEntity strEntity = new StringEntity(jsonParam.toJSONString(), "UTF-8");
			strEntity.setContentType(new BasicHeader(HTTP.CONTENT_TYPE, "application/x-www-form-urlencoded"));
			strEntity.setContentEncoding(new BasicHeader(HTTP.CONTENT_ENCODING, "UTF-8"));
			post.setHeaders(headers);
			post.setEntity(strEntity);
			logger.info("httpClient请求URL:" + post.getURI());
			logger.info("headers：");
			for (Header head : headers) {
				logger.info(head.getName() + "====" + head.getValue());
			}
			logger.info("body：");
			logger.info(jsonParam.toJSONString());
			HttpResponse response = httpclient.execute(post);
			HttpEntity entity = response.getEntity();
			logger.info("----------------------------------------");
			logger.info(response.getStatusLine());
			if (entity != null) {
				logger.info("Response content length: " + entity.getContentLength());
			}
			logger.info("----------------------------------------");

			InputStream inSm = null;
			inSm = entity.getContent();
			Scanner inScn = new Scanner(inSm);
			while (inScn.hasNextLine()) {
				String msg = inScn.nextLine();
				logger.info(msg);
				 result = JSONObject.parseObject(msg);
			}
			if (inScn != null) {
				inScn.close();
			}
		} catch (ClientProtocolException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} finally {
			post.abort();
			post.releaseConnection();
		}
		return result;
	}

}

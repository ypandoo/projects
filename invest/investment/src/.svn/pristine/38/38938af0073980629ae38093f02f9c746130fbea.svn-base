package com.gxcz.xuhui.investment.controller;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.util.Date;
import java.util.HashMap;
import java.util.Hashtable;
import java.util.Iterator;
import java.util.List;
import java.util.Map;
import java.util.UUID;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import org.apache.commons.fileupload.FileItem;
import org.apache.commons.fileupload.FileItemFactory;
import org.apache.commons.fileupload.FileUploadException;
import org.apache.commons.fileupload.disk.DiskFileItemFactory;
import org.apache.commons.fileupload.servlet.ServletFileUpload;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.multipart.MultipartFile;
import org.springframework.web.multipart.MultipartHttpServletRequest;

import com.gxcz.common.util.BaseUtil;
import com.gxcz.common.util.ConfigUtil;
import com.gxcz.xuhui.investment.model.FollowSchemeInfo;
import com.gxcz.xuhui.investment.model.ProjectBasicInfo;
import com.gxcz.xuhui.investment.service.impl.IFollowSchemeService;
import com.gxcz.xuhui.investment.service.impl.IProjectBasicService;

/**
 * 文件控制器
 * 
 * 
 * 
 */
@Controller
@RequestMapping("/FileUpLoadController")
public class FileUpLoadController {
	IProjectBasicService projectBasicService = null;

	public IProjectBasicService getProjectBasicService() {
		return projectBasicService;
	}

	@Autowired
	public void setProjectBasicService(IProjectBasicService projectBasicService) {
		this.projectBasicService = projectBasicService;
	}
	
	IFollowSchemeService followSchemeService=null;

	public IFollowSchemeService getFollowSchemeService() {
		return followSchemeService;
	}
	@Autowired
	public void setFollowSchemeService(IFollowSchemeService followSchemeService) {
		this.followSchemeService = followSchemeService;
	}

	//
	// /**
	// * 浏览器服务器附件
	// *
	// * @param response
	// * @param request
	// * @param session
	// * @return
	// */
	// @RequestMapping("/fileManage")
	// @ResponseBody
	// public Map<String, Object> fileManage(HttpServletResponse response,
	// HttpServletRequest request, HttpSession session) {
	// Map<String, Object> m = new HashMap<String, Object>();
	//
	// // 根目录路径，可以指定绝对路径，比如 /var/www/attached/
	// String rootPath = session.getServletContext().getRealPath("/") +
	// "attached/";
	//
	// // 根目录URL，可以指定绝对路径，比如 http://www.yoursite.com/attached/
	// String rootUrl = request.getContextPath() + "/attached/";
	//
	// // 图片扩展名
	// String[] fileTypes = new String[] { "gif", "jpg", "jpeg", "png", "bmp" };
	//
	// String dirName = request.getParameter("dir");
	// if (dirName != null) {
	// if (!Arrays.<String> asList(new String[] { "image", "flash", "media",
	// "file" }).contains(dirName)) {
	// // out.println("Invalid Directory name.");
	// // return;
	// try {
	// response.getWriter().write("无效的目录名称！");
	// } catch (IOException e) {
	// e.printStackTrace();
	// }
	// return m;
	// }
	// rootPath += dirName + "/";
	// rootUrl += dirName + "/";
	// File saveDirFile = new File(rootPath);
	// if (!saveDirFile.exists()) {
	// saveDirFile.mkdirs();
	// }
	// }
	//
	// // 根据path参数，设置各路径和URL
	// String path = request.getParameter("path") != null ?
	// request.getParameter("path") : "";
	// String currentPath = rootPath + path;
	// String currentUrl = rootUrl + path;
	// String currentDirPath = path;
	// String moveupDirPath = "";
	// if (!"".equals(path)) {
	// String str = currentDirPath.substring(0, currentDirPath.length() - 1);
	// moveupDirPath = str.lastIndexOf("/") >= 0 ? str.substring(0,
	// str.lastIndexOf("/") + 1) : "";
	// }
	//
	// // 排序形式，name or size or type
	// String order = request.getParameter("order") != null ?
	// request.getParameter("order").toLowerCase() : "name";
	//
	// // 不允许使用..移动到上一级目录
	// if (path.indexOf("..") >= 0) {
	// // out.println("Access is not allowed.");
	// // return;
	// try {
	// response.getWriter().write("不允许访问！");
	// } catch (IOException e) {
	// e.printStackTrace();
	// }
	// return m;
	// }
	// // 最后一个字符不是/
	// if (!"".equals(path) && !path.endsWith("/")) {
	// // out.println("Parameter is not valid.");
	// // return;
	// try {
	// response.getWriter().write("参数无效！");
	// } catch (IOException e) {
	// e.printStackTrace();
	// }
	// return m;
	// }
	// // 目录不存在或不是目录
	// File currentPathFile = new File(currentPath);
	// if (!currentPathFile.isDirectory()) {
	// // out.println("Directory does not exist.");
	// // return;
	// try {
	// response.getWriter().write("目录不存在！");
	// } catch (IOException e) {
	// e.printStackTrace();
	// }
	// return m;
	// }
	//
	// // 遍历目录取的文件信息
	// List<Hashtable<String, Object>> fileList = new
	// ArrayList<Hashtable<String, Object>>();
	// if (currentPathFile.listFiles() != null) {
	// for (File file : currentPathFile.listFiles()) {
	// Hashtable<String, Object> hash = new Hashtable<String, Object>();
	// String fileName = file.getName();
	// if (file.isDirectory()) {
	// hash.put("is_dir", true);
	// hash.put("has_file", (file.listFiles() != null));
	// hash.put("filesize", 0L);
	// hash.put("is_photo", false);
	// hash.put("filetype", "");
	// } else if (file.isFile()) {
	// String fileExt = fileName.substring(fileName.lastIndexOf(".") +
	// 1).toLowerCase();
	// hash.put("is_dir", false);
	// hash.put("has_file", false);
	// hash.put("filesize", file.length());
	// hash.put("is_photo", Arrays.<String>
	// asList(fileTypes).contains(fileExt));
	// hash.put("filetype", fileExt);
	// }
	// hash.put("filename", fileName);
	// hash.put("datetime", new
	// SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(file.lastModified()));
	// fileList.add(hash);
	// }
	// }
	//
	// if ("size".equals(order)) {
	// Collections.sort(fileList, new SizeComparator());
	// } else if ("type".equals(order)) {
	// Collections.sort(fileList, new TypeComparator());
	// } else {
	// Collections.sort(fileList, new NameComparator());
	// }
	// m.put("moveup_dir_path", moveupDirPath);
	// m.put("current_dir_path", currentDirPath);
	// m.put("current_url", currentUrl);
	// m.put("total_count", fileList.size());
	// m.put("file_list", fileList);
	//
	// return m;
	// }
	//
	/**
	 * 
	 * @param response
	 * @param request
	 * @param session
	 * @return
	 */
	@RequestMapping("/upload")
	// @ResponseBody
	// public Map<String, Object> upload(HttpServletResponse response,
	// MultipartHttpServletRequest request, HttpSession session) {
	public String upload(HttpServletResponse response, MultipartHttpServletRequest request, HttpSession session) {
		String projectid = request.getParameter("uploadProId");
		String path = "front/files/";
//		String filePathName = "protocal-" + BaseUtil.formatDate(new Date(), "yyyyMMdd-HHmmss") + ".doc";
		String filePathName = uploadUtil(request, session,projectid,path);

		ProjectBasicInfo info = projectBasicService.selectByPrimaryKey(projectid);
		String linkStr = info.getSchemeProtocol();
		if(linkStr != null && linkStr.length() > 0){
			filePathName = linkStr+";"+filePathName;
		}
		
		ProjectBasicInfo record = new ProjectBasicInfo();
		record.setProjectId(projectid);
		record.setSchemeProtocol(filePathName);
		projectBasicService.updateByPrimaryKeySelective(record);
		return "redirect:/back/projectManage.jsp?projectId=" + projectid;
	}
	
	@RequestMapping("/uploadScheme")
	public String uploadScheme(HttpServletResponse response, MultipartHttpServletRequest request, HttpSession session) {
		String projectid = request.getParameter("uploadProId_1");
		String schemeId = request.getParameter("uploadSchemeId");
		String path = "front/files/";
//		String filePathName = "scheme-" + BaseUtil.formatDate(new Date(), "yyyyMMdd-HHmmss") + ".doc";
		String filePathName = uploadUtil(request, session,projectid,path);
		
		FollowSchemeInfo info = followSchemeService.selectByPrimaryKey(schemeId);
		String linkStr = info.getFollowChemeLink();
		if(linkStr != null && linkStr.length() > 0){
			filePathName = linkStr+";"+filePathName;
		}
		FollowSchemeInfo followSchemeInfo = new FollowSchemeInfo();
		followSchemeInfo.setSchemeId(schemeId);
		followSchemeInfo.setFollowChemeLink(filePathName);
		followSchemeService.updateByPrimaryKeySelective(followSchemeInfo);
		return "redirect:/back/projectManage.jsp?projectId=" + projectid;
	}
	
	private String uploadUtil(MultipartHttpServletRequest request, HttpSession session,String projectid,String path){
		// Map<String, Object> m = new HashMap<String, Object>();
//				String projectid = request.getParameter("uploadProId");
//				String m = "redirect:/back/projectManage.jsp?projectId=" + projectid;
				String m = BaseUtil.formatDate(new Date(), "yyyyMMdd-HHmmss");
				// m.put("error", 1);
				// m.put("message", "上传成功！");

				// 文件保存目录路径
				String savePath = session.getServletContext().getRealPath("/") + path;

				// 文件保存目录URL
				String saveUrl = request.getContextPath() + "/"+path;

				// 定义允许上传的文件扩展名
				HashMap<String, String> extMap = new HashMap<String, String>();
				extMap.put("image", ConfigUtil.get("image"));
				extMap.put("flash", ConfigUtil.get("flash"));
				extMap.put("media", ConfigUtil.get("media"));
				extMap.put("file", ConfigUtil.get("file"));

				long maxSize = Long.parseLong(ConfigUtil.get("maxFileSize")); // 允许上传最大文件大小(字节)

				if (!ServletFileUpload.isMultipartContent(request)) {
					// m.put("error", 1);
					// m.put("message", "请选择文件！");
					return m;
				}

				// 检查目录
				File uploadDir = new File(savePath);
				if (!uploadDir.isDirectory()) {
					uploadDir.mkdirs();
				}

				// 检查目录写权限
				if (!uploadDir.canWrite()) {
					// m.put("error", 1);
					// m.put("message", "上传目录没有写权限！");
					return m;
				}

				String dirName = request.getParameter("dir");
				if (dirName == null) {
					dirName = "file";
				}
				if (!extMap.containsKey(dirName)) {
					// m.put("error", 1);
					// m.put("message", "目录名不正确！");
					return m;
				}

				// 创建文件夹
				// savePath += dirName + "/";
				// saveUrl += dirName + "/";
				// File saveDirFile = new File(savePath);
				// if (!saveDirFile.exists()) {
				// saveDirFile.mkdirs();
				// }
				// SimpleDateFormat yearDf = new SimpleDateFormat("yyyy");
				// SimpleDateFormat monthDf = new SimpleDateFormat("MM");
				// SimpleDateFormat dateDf = new SimpleDateFormat("dd");
				// Date date = new Date();
				// String ymd = yearDf.format(date) + "" + monthDf.format(date) + "" +
				// dateDf.format(date) + "/"+projectid+"/";
				// savePath += ymd;
				// saveUrl += ymd;
				// File dirFile = new File(savePath);
				// if (!dirFile.exists()) {
				// dirFile.mkdirs();
				// }

				if (ServletFileUpload.isMultipartContent(request)) {// 判断表单是否存在enctype="multipart/form-data"
					FileItemFactory factory = new DiskFileItemFactory();
					ServletFileUpload upload = new ServletFileUpload(factory);
					upload.setHeaderEncoding("UTF-8");
					for (Iterator it = request.getFileNames(); it.hasNext();) {
						String key = (String) it.next();
						MultipartFile imgFile = request.getFile(key);
						if (imgFile.getOriginalFilename().length() > 0) {
							String fileName = imgFile.getOriginalFilename();
							// 检查文件大小
							if (imgFile.getSize() > maxSize) {
								// m.put("error", 1);
								// m.put("message", "上传文件大小超过限制！(允许最大[" + maxSize +
								// "]字节，您上传了[" + imgFile.getSize() + "]字节)");
								return m;
							}
							// 检查扩展名
							String fileExt = fileName.substring(fileName.lastIndexOf(".") + 1).toLowerCase();
							if (!Arrays.<String> asList(extMap.get(dirName).split(",")).contains(fileExt)) {
								// m.put("error", 1);
								// m.put("message", "上传文件扩展名是不允许的扩展名。\n只允许" +
								// extMap.get(dirName) + "格式！");
								return m;
							}

							try {
								fileName = m+"-"+fileName;
								saveFileFromInputStream(imgFile.getInputStream(), savePath, fileName);
								return fileName;
							} catch (Exception ex) {
								ex.printStackTrace();
								// m.put("error", 1);
								// m.put("message", "上传文件失败！");
								return m;
							}

							// m.put("error", 0);
							// m.put("url", saveUrl + fileName);
						}

					}
				}
				return m;
	}

	// 保存文件
	private File saveFileFromInputStream(InputStream stream, String path, String filename) throws IOException {
		File file = new File(path + "/" + filename);
		FileOutputStream fs = new FileOutputStream(file);
		byte[] buffer = new byte[1024 * 1024];
		int bytesum = 0;
		int byteread = 0;
		while ((byteread = stream.read(buffer)) != -1) {
			bytesum += byteread;
			fs.write(buffer, 0, byteread);
			fs.flush();
		}
		fs.close();
		stream.close();
		return file;
	}

}

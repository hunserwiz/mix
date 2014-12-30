<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>

<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>
<!DOCTYPE html>
<html>
<head>
	<title>Bill Payment Monitor System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="description" content="Bill Payment Monitor System for Big C Supercenter Public Company Limited"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<meta http-equiv="cache-control" content="max-age=0"/>
	<meta http-equiv="cache-control" content="no-cache"/>
	<meta http-equiv="expires" content="0"/>
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT"/>
	<meta http-equiv="pragma" content="no-cache"/>
	
	<%@ include file="css.jsp" %>
</head>
<body class="skin-blue">
	<%@ include file="header.jsp" %>
	
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
		<%@ include file="sidebar.jsp" %>
		
		<!-- Right side column. Contains the navbar and content of the page -->
		<div class="right-side">
			<div data-ng-view data-bindonce>
			
			</div>
		</div><!-- /.right-side -->
	</div>
	<!-- ################################### [START] LIB JAVASCRIPT ################################### -->
	<%@ include file="js.jsp" %>
	<!-- ################################### [ END ] LIB JAVASCRIPT ################################### -->
</body>
</html>
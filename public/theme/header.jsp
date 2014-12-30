<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>

	<!-- ###################################  [START] LOADING INDICATOR ################################### -->
	<%-- <div id="loading" data-ng-show="httpRequestTracker.hasPendingRequests()">
		<div class="modal-backdrop fade in" style="z-index: 10001;"></div>
		<div style="position: fixed; left: 45%; top: 275px; z-index: 11000;">
			<img src="${contextPath}/img/ajax-loader.gif">
		</div>
	</div> --%>
	
	<%-- <div id="loading-upload" class="hide">
		<div class="cleardrop"></div>
		<div id="loading-mask">
		    <p class="loader" id="loading_mask_loader">
		    	<img src="${contextPath}/img/ajax-loader-tr.gif" alt="Loading...">
		    	<br>
		    	<span lang="En">Uploading </span> <span id="loading-upload-percent"></span> <span lang="En"> please wait...</span>
		    </p>
		</div>
	</div> --%>
	<!-- ###################################  [ END ] LOADING INDICATOR ################################### -->
	
<div class="header" data-ng-controller="HeaderCtrl">
	<a href="${contextPath}/index.jsp" class="logo">
		<img style="width: 25px; height: 36px; margin-top: -2px;" src="${contextPath}/img/bigc/bigc-logo.png"/>
		<span>Bill Payment</span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<div class="navbar navbar-static-top" data-role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" data-role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
		
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<!-- Message -->
				<%-- <li class="dropdown messages-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-envelope"></i>
						<span class="label label-danger">4</span>
					</a>
					<ul class="dropdown-menu">
						<li class="header">You have 2 messages</li>
						<li>
							<ul class="menu">
								<li>
									<a href="#">
										<div class="pull-left">
											<img src="${contextPath}/img/avatar/avatar_unknow.jpg" class="img-circle" alt="User Image"/>
										</div>
										<h4>
											Support Team
											<small><i class="fa fa-clock-o"></i> 5 mins</small>
										</h4>
										<p>Why not buy a new awesome theme?</p>
									</a>
								</li>
								<li>
									<a href="#">
										<div class="pull-left">
											<img src="${contextPath}/img/avatar/avatar_unknow.jpg" class="img-circle" alt="user image"/>
										</div>
										<h4>
											AdminLTE Design Team
											<small><i class="fa fa-clock-o"></i> 2 hours</small>
										</h4>
										<p>Why not buy a new awesome theme?</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="footer"><a href="#">See All Messages</a></li>
					</ul>
				</li> --%>

				<!-- Switch Language -->
				<li class="dropdown language-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img class="flag flag-${lang}"/>
					</a>
					<ul class="dropdown-menu">
						<li class="header"><a data-ng-click="myFunction.switchLang('en')"><img class="flag flag-en" title="English"/> English</a></li>
						<li><a data-ng-click="myFunction.switchLang('th')"><img class="flag flag-th" title="Thai"/> Thai</a></li>
					</ul>
				</li>
				
				<!-- User Account -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<!-- <i class="glyphicon glyphicon-user"></i> -->
						<span>Welcome </span><span data-ng-bind="LoginUser.userCode"></span><span> : </span><span data-ng-bind="LoginUser.userName"></span><span> <i class="caret"></i></span>
					</a>
					<ul class="dropdown-menu " style="margin-right:0; width:170px">
						<!-- User image 
						<li class="user-header bg-green">
							<img src="${contextPath}/img/avatar/avatar.png" class="img-circle" alt="User Image" />
							<!-- <p>
								<small>{{LoginUser.branchName}}</small>
								{{LoginUser.employeeDisplayName}}
								<small>{{LoginUser.positionName}}</small>
								<small>{{LoginUser.divisionName}}</small>
								<small>{{LoginUser.departmentName}}</small>
							</p>
						</li> -->
						<!-- My Profile --> 
						<li >
							<a href="${contextPath}/module/my-profile.jsp" class="btn btn-flat" style="text-align: left;">
								<i class="glyphicon glyphicon-user"></i>&nbsp;<span>My Profile</span>
							</a>
						</li>
						<!-- Change Password -->
						<li>
							<a class="btn btn-flat" style="text-align: left;" data-ng-click="popupChangePassword(false)">
								<i class="fa fa-key"></i>&nbsp;<span>Change Password</span>
							</a>
						</li>
						<li>
							<a href="${contextPath}/logout" class="btn btn-flat" style="text-align: left;">
								<i class="fa fa-power-off"></i>&nbsp;<span>Sign Out</span>
							</a>
						</li>
					</ul>
				</li>
				
			</ul>
		</div>
	</div>
</div>

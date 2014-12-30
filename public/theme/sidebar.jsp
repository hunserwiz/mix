<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>


		<div class="left-side sidebar-offcanvas">                
			<!-- sidebar: style can be found in sidebar.less -->
			<div class="sidebar">
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<li id="menuHome">
						<%-- <a href="${contextPath}/module/test.jsp"> --%>
						<a href="/module/test.jsp">
							<i class="fa fa-home"></i> <span>Home</span>
						</a>
		      		</li>
		      		
		      		
		      		
		      		<%-- <li>
						<a href="${contextPath}/module/biller.jsp?v=${version}#/monitor">
							<i class="fa fa-list-alt"></i> <span>Biller Monitor</span>
						</a>
		      		</li>
		      		<li>
						<a href="${contextPath}/module/master-data.jsp?v=${version}#/monitor">
							<i class="fa fa-file-text"></i> <span>Master Data Monitor</span>
						</a>
		      		</li>
		      		<li>
						<a href="${contextPath}/module/site.jsp?v=${version}#/monitor">
							<i class="fa fa-sitemap"></i> <span>Site Monitor</span>
						</a>
		      		</li>
		      		<li>
						<a href="${contextPath}/module/ho.jsp?v=${version}#/monitor">
							<i class="fa fa-globe"></i> <span>HO Monitor</span>
						</a>
		      		</li>
		      		<li>
						<a href="${contextPath}/module/interface-monitor.jsp?v=${version}">
							<i class="fa fa-exchange"></i> <span>Interface Monitor</span>
						</a>
		      		</li> --%>
		      		
		      		
		      		
		      		<shiro:hasPermission name="transactionMonitor:menu">
		      		<li id="menuTransMonitor">
						<a href="${contextPath}/module/transaction-monitor.jsp">
							<i class="fa fa-align-left"></i> <span>Transaction Monitor</span>
						</a>
		      		</li>
		      		</shiro:hasPermission>
		      		<shiro:hasPermission name="validationError:menu">
		      		<li id="menuValidationError">
						<a href="${contextPath}/module/validation-error.jsp">
							<i class="fa fa-check-square-o"></i> <span>Validation Error</span>
						</a>
		      		</li>
		      		</shiro:hasPermission>
		      		<shiro:hasPermission name="acknowledgeError:menu">
		      		<li id="menuAcknowledgeError">
						<a href="${contextPath}/module/acknowledge-error.jsp">
							<i class="fa fa-exclamation-triangle"></i> <span>Acknowledge Error</span>
						</a>
		      		</li>
		      		</shiro:hasPermission>
		      		
		      		<shiro:hasPermission name="systemSetup:menu">
					<li class="treeview" id="menuSystemSetup">
						<a href="">
							<i class="fa fa-cogs"></i> <span>System Setup</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<shiro:hasPermission name="user:menu">
							<li id="menuUser">
								<a href="${contextPath}/module/system-setup.jsp?v=${version}#/user">
									<i class="fa fa-angle-double-right"></i> <span>User Setting</span>
								</a>
							</li>
							</shiro:hasPermission>
							<shiro:hasPermission name="role:menu">
							<li id="menuRole">
								<a href="${contextPath}/module/system-setup.jsp?v=${version}#/role">
									<i class="fa fa-angle-double-right"></i> <span>Role Setting</span>
								</a>
							</li>
							</shiro:hasPermission>
							<shiro:hasPermission name="schedulerJob:menu">
							<li id="menuScheduler">
								<a href="${contextPath}/module/system-setup.jsp?v=${version}#/scheduler">
									<i class="fa fa-angle-double-right"></i> <span>Scheduler Job</span>
								</a>
							</li>
							</shiro:hasPermission>
							<shiro:hasPermission name="jobLog:menu">
							<li id="menuJobLog">
								<a href="${contextPath}/module/system-setup.jsp?v=${version}#/job-log">
									<i class="fa fa-angle-double-right"></i> <span>Job Log</span>
								</a>
							</li>
							</shiro:hasPermission>
							<shiro:hasPermission name="lov:menu">
							<li id="menuListOfValue">
								<a href="${contextPath}/module/system-setup.jsp?v=${version}#/list-of-value">
									<i class="fa fa-angle-double-right"></i> <span>List Of Value</span>
								</a>
							</li>
							</shiro:hasPermission>
							<shiro:hasPermission name="errorMessage:menu">
							<li id="menuErrorMessage">
								<a href="${contextPath}/module/system-setup.jsp?v=${version}#/error-message">
									<i class="fa fa-angle-double-right"></i> <span>Error Message</span>
								</a>
							</li>
							</shiro:hasPermission>
							<shiro:hasPermission name="transMonitorSetting:menu">
							<li id="menuTransMonitorSetting">
								<a href="${contextPath}/module/system-setup.jsp?v=${version}#/trans-monitor-setting">
									<i class="fa fa-angle-double-right"></i> <span>Transaction Monitor Setting</span>
								</a>
							</li>
							</shiro:hasPermission>
						</ul>
					</li>
					</shiro:hasPermission>
					
				</ul>
			</div>
			<!-- /.sidebar -->
		</div>
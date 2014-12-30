<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<!-- jquery -->
	<script src="lib/jquery/jquery-1.11.0.min.js"></script>
	<script src="/lib/jquery/jquery-ui-1.10.4.custom.min.js"></script>
	
	<script src="lib/jquery-gritter/jquery.gritter.min.js"></script>
	
	<script src="lib/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
	<script src="lib/jQuery-File-Upload/js/jquery.fileupload.js"></script>
	
	<!-- utility -->
	<script src="lib/icheck/icheck.min.js"></script>
	<script src="lib/select2/select2.min.js"></script>
	<script src="lib/dynatree/jquery.dynatree.js"></script>
	<script src="lib/moment/moment.min.js"></script>
	<script src="lib/ckeditor/ckeditor.js"></script>
	
	<!-- admin-lte -->
	<script src="lib/admin-lte/admin-lte.js"></script>
	
	<!-- bootstrap -->
	<script src="lib/bootstrap/js/bootstrap.js"></script>
	<script src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
	
	<!-- underscore -->
	<script src="lib/underscore/underscore-min.js"></script>
	<script src="lib/underscore/underscore-mixin.js"></script>
	
	<!-- angular -->
	<script src="lib/angular/angular.js}"></script>
	<script src="lib/angular/angular-route.js"></script>
	<script src="lib/angular/angular-animate.js"></script>
	<script src="lib/angular/angular-cookies.js"></script>
	
	<script src="lib/angular-translate/angular-translate.js"></script>
	<script src="lib/angular-translate/angular-translate-storage-cookie.js"></script>
	<script src="lib/angular-translate/angular-translate-storage-local.js"></script>
	
	<script src="lib/angular-ui/ui-select2/select2.js"></script>
	<script src="lib/angular-ui/ui-bootstrap/ui-bootstrap-0.10.0.js"></script>
	<script src="lib/angular-ui/ui-sortable/sortable.js"></script>
	<!--[if (!IE)|(gte IE 9) ]>
		<script src="${contextPath}/lib/angular-ui/ui-utils/ui-utils.js?v=${version}"></script>
	<!--<![endif]-->
	<!--[if lte IE 8]>
		<script src="${contextPath}/lib/angular-ui/ui-utils/ui-utils-ieshiv.js?v=${version}"></script>
	<![endif]-->
	<script src="lib/angular-bindonce/bindonce.min.js"></script>
	<script src="lib/angular-loading-bar/loading-bar.js"></script>
	
	<!-- js -->
	<script src="js/common/security/interceptor.js"></script>
	
	<script src="js/directives.js"></script>
	<script src="js/filters.js"></script>
	<script src="js/services.js"></script>
	
	<script src="js/app.js"></script>
	<script src="js/myFunction.js"></script>
	
	<!-- app -->
	<link rel="stylesheet" href="css/app.css"/>
	<link rel="stylesheet" href="css/app-ie.css"/>
	
	<!-- ################################### [ END ] LIB JAVASCRIPT ################################### -->

<div class="content-header">
--------------------------------------------------------------
<div>
		<label>Input:</label>
		<input type="text" ng-model="inputname" placeholder="input data">
		<br/>
		<h1>Your input is {{inputname}} </h1>
	</div>
	

	<div ng-app="todoApp">
  
  <div ng-controller="TodoController">
    <span>{{remaining()}} of {{todos.length}} remaining</span>
    [ <a href="" ng-click="archive()">remove</a> ]
    <ul class="unstyled">
      <li ng-repeat="todo in todos">
        <input type="checkbox" ng-model="todo.done">
        <span class="done-{{todo.done}}">{{todo.text}}</span>
      </li>
    </ul>
    <form ng-submit="addTodo()">
      <input type="text" ng-model="todoText"  size="30"
             placeholder="add new todo here">
      <input class="btn-primary" type="submit" value="add">
    </form>
  </div>
</div>

----------------------------------
	<i class="ic-title ic-molecule-2x"></i>
	<h1>
		Site Monitor
	</h1>
	<div class="monitor-summary-container">
		<div class="monitor-summary">
			<span class="title">ALL</span>
			<span class="ic-bullet-green"></span>
			<span>606</span>
			<span class="ic-bullet-red"></span>
			<span>17</span>
		</div>
		<div class="monitor-summary">
			<span class="title">Hyper</span>
			<span class="ic-bullet-green"></span>
			<span>114</span>
			<span class="ic-bullet-red"></span>
			<span>9</span>
		</div>
		<div class="monitor-summary">
			<span class="title">BMK</span>
			<span class="ic-bullet-green"></span>
			<span>31</span>
			<span class="ic-bullet-red"></span>
			<span>2</span>
		</div>
		<div class="monitor-summary">
			<span class="title">Pure</span>
			<span class="ic-bullet-green"></span>
			<span>148</span>
			<span class="ic-bullet-red"></span>
			<span>0</span>
		</div>
		<div class="monitor-summary">
			<span class="title">MBC</span>
			<span class="ic-bullet-green"></span>
			<span>310</span>
			<span class="ic-bullet-red"></span>
			<span>6</span>
		</div>
		<div class="monitor-summary">
			<span class="title">Jumbo</span>
			<span class="ic-bullet-green"></span>
			<span>1</span>
			<span class="ic-bullet-red"></span>
			<span>0</span>
		</div>
	</div>
</div>



<div class="content">
	<button type="button" class="close" data-ng-click="cancel()">&times;</button>
	<!-- ###############    Criteria    ############### -->
	<div class="row form-group">
		<div class="col-sm-4">
			<label class="col-sm-5">Site Group</label>
			<div class="col-sm-7">
				<select data-ng-model="criteria.group">
					<option value="">All</option>
					<option value="Hyper">Hyper</option>
					<option value="BMK">BMK</option>
					<option value="Pure">Pure</option>
					<option value="MBC">MBC</option>
					<option value="Jumbo">Jumbo</option>
				</select>
			</div>
		</div>
		<div class="col-sm-4">
			<label class="col-sm-5">Server Status</label>
			<div class="col-sm-7">
				<select data-ng-model="criteria.serverStatus">
					<option value="">All</option>
					<option value="N">Normal</option>
					<option value="X">Abnormal</option>
				</select>
			</div>
		</div>
		<div class="col-sm-4">
			<label class="col-sm-5">Database Status</label>
			<div class="col-sm-7">
				<select data-ng-model="criteria.databaseStatus">
					<option value="">All</option>
					<option value="N">Normal</option>
					<option value="X">Abnormal</option>
				</select>
			</div>
		</div>
	</div><!-- end row 1 -->
	
	<div class="row form-sep"></div>
	
	
	<!-- ###############    Monitor    ############### -->
	<div class="row no-margin">
		<div class="monitor-container" data-ng-repeat="monitor in monitorList">
			<div class="monitor-header {{monitor.serverStatus}} {{monitor.databaseStatus}}">
				<span>{{monitor.name}}</span>
				<span class="ic-database"></span>
				<span class="ic-server"></span>
			</div>
			<div class="monitor-body">
				<span>{{monitor.time}}</span>
			</div>
		</div>
	</div>
	
	<br>


</div>




<!-- #######  DEBUG  ####### -->
<!-- <pre>
  Debug
=========
criteria
{{ criteria | json }}

</pre> -->

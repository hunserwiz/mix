@extends('layouts.main')

@section('content')
	<form name="form-sep">
		<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4">วันที่ออกใบสินค้า  :</label>
						<div class="span8">					
							<select  ng-model="criteria.siteGroupId" ng-options="obj.siteGroupId as obj.siteGroupCode+':'+ obj.siteGroupName for obj in siteGroupList">
								 <option value="" lang="En">-- Please Select --</option>			
								  <option></option>
								  <option></option>
								  <option></option>
							</select>
						</div>
					</div>
			</div>
			<!-- ################################################################################ -->
			<div class="row-fluid" >
					<div class="span6">
						<label class="span4">ประเภทสินค้า  :</label>
						<div class="span8">					
							<select  ng-model="criteria.siteGroupId" ng-options="obj.siteGroupId as obj.siteGroupCode+':'+ obj.siteGroupName for obj in siteGroupList">
								 <option value="" lang="En">-- Please Select --</option>			
								  <option></option>
								  <option></option>
								  <option></option>
							</select>
						</div>
					</div>
					<div class="span6">
						<label class="span4">ชื่อสินค้า :</label>
						<div class="span8">
							<select >
									 <option value="" lang="En">-- Please Select --</option>			
									  <option>1</option>
									  <option>2</option>
									  <option>3</option>
								</select>
						</div>
					</div>

			</div>
    <!-- ################################################################################ -->

			<div class="row-fluid" >
		
				<div class="span6">
					<label class="span4">ราคาต่อหน่วย :</label>
					<div class="span8">
						<input type="text" name="price"  data-ng-model="price" required>
					</div>
				</div>
              <div class="span6">
				<label class="span4"> จำนวนสินค้า :</label>
				<div class="span8">
						<input class="span3" type="text" name="unit"  data-ng-model="unit" required>
				</div>
			</div>

			</div>
       <!-- ################################################################################ -->
		<div class="row-fluid" >
			<div class="span6">
				<label class="span4">ชื่อ-นามสกุลตัวแทนจำหน่าย   :</label>
				<div class="span8">					
					<select >
						 <option value="" lang="En">-- Please Select --</option>			
						  <option></option>
						  <option></option>
						  <option></option>
					</select>
				</div>
			</div>
			<div class="span6">
				<label class="span4">เขตการขาย :</label>
					<div class="span8">					
						<select >
							<option value="" lang="En">-- Please Select --</option>			
								<option>1</option>
								<option>2</option>
								<option>3</option>
						</select>				
					</div>
			</div>
			
		</div>

		<!-- ################################################################################ -->
		<div class="row-fluid" >
			<div class="span6">
				<label class="span4"> เจ้าหน้าที่ออกใบเสร็จ :</label>
				<div class="span8">
						<input class="" type="text" name="unit"  data-ng-model="unit" required>
				</div>
			</div>
    
			<div class="span6">
				<label class="span4">เลขที่ใบเสร็จ :</label>
				<div class="span8">
				<input type="text" name="cratdedate"  data-ng-model="userCode" required>					

				</div>
			</div>
		<div>


		 <div class="text-right" style="padding-right:19%">
		       <a class="btn btn-success" href="ListOrder.html">&nbsp;<span lang="En" >Save</span></a>	
				<!-- <button class="btn btn-success" data-loading-text="Loading..." data-ng-click="save()">Save<i class="fa fa-save"></i><span></span></button>-->
				<button class="btn  btn-danger" data-ng-click="cancle()">cancle<i class="fa fa-save"></i><span></span></button>
		</div>
     </form> 

@stop
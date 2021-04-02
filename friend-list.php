

		<div class="tab">
		  <button class="tablinks" onclick="openCity(event, 'friend-list')" id="p1-tab1" ><i class="fa fa-comment"></i></button>
		  <button class="tablinks" onclick="openCity(event, 'active-fl')"><i class="fa fa-user-plus"> 
		  	<sup>0</sup> </i></button>
		  <button class="tablinks" onclick="openCity(event, 'settings')"><i class="fa fa-sun-o"></i></button>
		</div>

		<div id="friend-list" class="tabcontent">
		 
		  <div class="row">
			  <div class="left">
			  	 <h3>friend-list</h3>
			    <ul id="myMenu">

			    	<span id="friend">
			    		<?php
							require_once 'user-list.php';
						?>			    		
			    	</span>
			      
			    </ul>
			  </div>
			</div>

		</div>

		<div id="active-fl" class="tabcontent">
		  <div class="row">
			  <div class="left">
			    <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
			    <h4>Active Now </h4>
			    <ul id="myMenu">

			    	<span id="user">
			    		<?php
							require_once 'user-list2.php';
						?>			    		
			    	</span>
			      
			    </ul>
			  </div>
			</div>
		</div>

		<div id="settings" class="tabcontent widget-main">
			<fieldset class="form-field" >
				<?php require_once 'user-info.php'; ?>
		</fieldset>
			
		</div>


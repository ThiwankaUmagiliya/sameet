<div class="container">
		
			<div class="tab-pane active p-3" id="l1" role="tabpanel">
				<h3 style='color:#ffff00;'>Upcoming Meetings</h3>
					<ul class="list-group">
					
						<li class="list-group-item"> 
							<h5 class="list-group-item-heading">01. Annual general meeting</h5>
							<p class="list-group-item-text pl-5">21/11/2021 at 2.00 pm on Main Auditorium<br>
							<button id="submit" name="submit" type="button" class="btn btn-outline-info btn-sm" onclick='location.href="?submit=m1"'>Add to Calendar</button>
							</p>
						</li>

						<li class="list-group-item"> 
							<h5 class="list-group-item-heading">02. Welfare meeting</h5>
							<p class="list-group-item-text pl-5">30/11/2021 at 2.00 pm on Main Auditorium<br>
							<button id="submit" name="submit" type="button" class="btn btn-outline-info btn-sm" onclick='location.href="?submit=m2"'>Add to Calendar</button>
							</p>
						</li>

						<li class="list-group-item"> 
							<h5 class="list-group-item-heading">03. Progress meeting</h5>
							<p class="list-group-item-text pl-5">21/12/2021 at 2.00 pm on Main Auditorium<br>
							<button id="submit" name="submit" type="button" class="btn btn-outline-info btn-sm" onclick='location.href="?submit=m3"'>Add to Calendar</button>
							</p>
						</li>						              
                 
					</ul> 
			</div>
			
</div>

<?php
if($_GET){
    include 'schedules.php';
    if(isset($_GET['submit'])){
        
       $request = $_GET['submit'];
        switch ($request) {
            case 'm1':
                m1();
                break;
            case 'm2':
                m2();
                break;
            case 'm3':
                m3();
                break;
            default:
                echo "Error!";
        } 
    }  
}
?>
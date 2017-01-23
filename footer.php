<div class="row2">
		<div class="col-md-12 footerback">
		<nav class="navbar navbar-default" role="navigation">
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav footermenu">
						
						<li class="active">
							<a href="index.php" class="footermenulia">Home</a>
						</li>
						<li class="active">
							<a href="#" class="footermenulia">About us</a>
						</li>
						<li class="active">
							<a href="#" class="footermenulia">Privacy Policy</a>
						</li>
						<li class="active">
							<a href="#" class="footermenulia1">Terms and Conditions</a>
						</li>
					</ul>
					<ul class="nav navbar-nav footersocial">
					<?php 
						$query_social = "SELECT  `fb`, `twitter`, `google`, `youtube` FROM `sitesettings`";
						$query_social_result = $con->query($query_social);
						if($query_social_result->num_rows > 0)
						{
							$row_social = $query_social_result->fetch_assoc();
							$fb = $row_social['fb'];
							$twitter = $row_social['twitter'];
							$google = $row_social['google'];
							$youtube = $row_social['youtube'];
						}
					?>
						<li><a href="<?php echo $twitter;?>"><i class="fa fa-twitter"></i></a></li>
						<li><a href="<?php echo $fb;?>"><i class="fa fa-facebook"></i></a></li>
						<li><a href="<?php echo $google;?>"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="<?php echo $youtube;?>"><i class="fa fa-youtube-play"></i></a></li>
					</ul>				
				</div>
				
			</nav>
		</div>
		<div class="col-md-12">
		<p class="footer-bottom">Copy Rights&copy;2016 paarampariyam, lnc.</p>
		</div>
	</div>
	<script>
$('.addwishlist').click(function() {
	$val = $(this).attr("value");
   $.ajax({
      url: 'savewishlist.php',
      data: {
         pid: $val,
		 userid:'<?php echo $_SESSION["uid"];?>'
      },
	  type: 'POST',
      error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
      },
      success: function(data) {
        console.log(data);
		$("#addwishlist"+$val+"").attr("disabled","disabled");
		 }
      
   });
});

</script>


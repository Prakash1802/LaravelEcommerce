
@extends('admin.admin_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="container-full">
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Change Admin Password</h4>
			
			</div>
			
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form  method="POST" action="{{route('admin.update.password')}}">
						@csrf
					  	<div class="row">
							<div class="col-12">
								
								<div class="row">
									<div class="col-md-6">
										
										<div class="form-group">
											<h5>Current Password<span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="password" name="oldpassword" id="current_password" class="form-control">
											</div>
										</div>
									
										<div class="form-group">
											<h5>New Password<span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="password" name="password" id="password" class="form-control">
											</div>
										</div>

										<div class="form-group">
											<h5>Confirm Password<span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="text" name="password_confirmation" id="password_confirmation" class="form-control">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="text-xs-right">
							<button type="submit" class="btn btn-rounded btn-info">Change Password</button>
						</div>

					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

	</section>
	
</div>

<script type="text/javascript">
	
	$(document).ready(function(){

		$(document).on('change','#profile_image',function(e){

			let reader = new FileReader();
			reader.onload = function(e){

				$('#preview_image').attr('src', e.target.result);

			}
			reader.readAsDataURL(e.target.files['0']);

		});

	});
</script>
@endsection
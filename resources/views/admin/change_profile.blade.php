
@extends('admin.admin_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="container-full">
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Edit Admin Profile</h4>
			
			</div>
			
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form  method="POST" action="{{route('admin.profile.store')}}" enctype="multipart/form-data">
						@csrf
					  	<div class="row">
							<div class="col-12">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<h5>Name<span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="text" name="name" class="form-control" value="{{$data->name}}" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
											</div>
											
										</div>
									
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<h5>Email<span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="text" name="email" class="form-control" value="{{$data->email}}" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
											</div>
											
										</div>
									</div>
								</div>	

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<h5>Profile Image<span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="file" name="profile_photo_path" class="form-control" id="profile_image">
											</div>
											
										</div>
									
									</div>

									<div class="col-md-6">
										<img src="{{(!empty($data->profile_photo_path)) ? url('uploads/admin_images/'.$data->profile_photo_path):url('uploads/no_image.png')}}" style="width: 100px; height:100px" id="preview_image">
									</div>
								</div>
							</div>
						</div>
						<div class="text-xs-right">
							<button type="submit" class="btn btn-rounded btn-info">Submit</button>
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
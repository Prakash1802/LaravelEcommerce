
@extends('admin.admin_master')
@section('content')

<div class="container-full">

	<section class="content">
		<div class="row">
			<div class="box box-widget widget-user">	
				
				<h3 class="widget-user-username">Name: {{$data->name}}</h3>
<a href="{{route('admin.profile.edit')}}" style="float:right;" class="btn btn-rounded  btn-success mb-5">Edit Profile</a>
				<h6 class="widget-user-desc">Email: {{$data->email}}</h6>
			
				<div class="widget-user-image">
<img class="rounded-circle" src="{{ (!empty($data->profile_photo_path)) ? url('uploads/admin_images/'.$data->profile_photo_path) : url('uploads/no_image.png') }}" alt="User Avatar">
				</div>

				<div class="box-footer">
				  <div class="row">
					<div class="col-sm-4">
					  <div class="description-block">
						<h5 class="description-header">12K</h5>
						<span class="description-text">FOLLOWERS</span>
					  </div>
					
					</div>
					
					<div class="col-sm-4 br-1 bl-1">
					  <div class="description-block">
						<h5 class="description-header">550</h5>
						<span class="description-text">FOLLOWERS</span>
					  </div>
					
					</div>
					<div class="col-sm-4">
					  <div class="description-block">
						<h5 class="description-header">158</h5>
						<span class="description-text">TWEETS</span>
					  </div>
					</div>
				  </div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
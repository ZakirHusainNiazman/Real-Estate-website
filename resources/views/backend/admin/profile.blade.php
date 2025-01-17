    @extends('backend.admin.layout')

    @section('admin')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>




        <div class="page-content">

            <div class="row profile-body">
                <!-- left wrapper start -->
                <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
                    <div class="card rounded">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div>
                                    <img class="wd-100 rounded-circle"
                                        src="{{ !empty($profileData->photo) ? url('upload/admin_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                        alt="profile">
                                    <span class="h4 ms-3">{{ $profileData->name }}</span>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                                <p class="text-muted">{{ $profileData->name }}</p>
                            </div>
                            <div class="mt-3">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                                <p class="text-muted">{{ $profileData->email }}</p>
                            </div>
                            <div class="mt-3">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                                <p class="text-muted">{{ $profileData->address }}</p>
                            </div>
                            <div class="mt-3">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                                <p class="text-muted">{{ $profileData->phone }}</p>
                            </div>
                            <div class="mt-3 d-flex social-links">
                                <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                    <i data-feather="github"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                    <i data-feather="twitter"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                    <i data-feather="instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- left wrapper end -->
                <!-- middle wrapper start -->
                <div class="col-md-8 col-xl-8 middle-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">

                                    <h6 class="card-title">Update Admin Profile</h6>

                                    <form class="forms-sample" method="post" action="{{route('admin.profile.store')}}" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleInputUsername1" class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control"
                                                id="username" autocomplete="off"
                                                name="username"
                                                value={{ $profileData->username }}>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value={{ $profileData->name }}>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="email" class="form-control" name="email"
                                                value={{ $profileData->email }} id="email" placeholder="Email">
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ $profileData->phone }}" id="email">
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ $profileData->address }}" id="address">
                                        </div>
                                        <div class="mb-3">
                                            <label for="photo" class="form-label">Photo</label>
                                            <input type="file" class="form-control" name="photo" id="photo">
                                        </div>
                                        <div class="mb-3">
                                            <label for="photo" class="form-label"></label>
                                            <img class="wd-100 rounded-circle" id="showImage"
                                                src="{{ !empty($profileData->photo) ? url('upload/admin_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                                alt="profile">
                                        </div>

                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                                        <button class="btn btn-secondary">Cancel</button>
                                    </form>

                                </div>
                            </div> </div>
                            <div class="col-md-12">

                            </div>
                        </div>
                    </div>
                    <!-- middle wrapper end -->
                </div>

            </div>

            <script type="text/javascript">
                $(document).ready(function(){
                    $('#photo').change(function (e){
                        var reader = new FileReader();
                        reader.onload = function(e){
                            $('#showImage').attr('src',e.target.result);
                        }
                        reader.readAsDataURL(e.target.files['0']);
                    });
                });
            </script>
        @endsection

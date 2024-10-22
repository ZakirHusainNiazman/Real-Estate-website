    @extends('backend.admin.layout')

    @section('admin')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> 

        <div class="page-content">

            <div class="row profile-body">
                <!-- middle wrapper start -->
                <div class="col-md-8 col-xl-8 middle-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Update Amenities</h6>

                                    <form class="forms-sample" id="myForm" method="post" action="{{ route('update.amenities',$amenity->id)}}">
                                        @csrf
                                        <div class="mb-3 form-group">
                                            <label for="amenity_name" class="form-label">Amenity Name</label>
                                            <input type="text " name="amenity_name" value="{{$amenity->name}}" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                                        <button class="btn btn-secondary">Cancel</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>
                <!-- middle wrapper end -->
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#myForm').validate({
                    rules: {
                        amenity_name: {
                            required: true,
                        },

                    },
                    messages: {
                        amenity_name: {
                            required: 'Please Enter Amenities Name',
                        },


                    },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    },
                });
            });
        </script>
    @endsection

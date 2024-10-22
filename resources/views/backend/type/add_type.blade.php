    @extends('backend.admin.layout')

    @section('admin')

        <div class="page-content">

            <div class="row profile-body">
                <!-- middle wrapper start -->
                <div class="col-md-8 col-xl-8 middle-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">

                                    <h6 class="card-title">Add Property Type</h6>

                                    <form class="forms-sample" method="post" action="{{ route('store.type')}}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="type_name" class="form-label">Type Name</label>
                                            <input type="text " name="type_name" class="form-control @error('type_name') is-invalid @enderror">
                                            @error('type_name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="type_icon" class="form-label">Type Icon</label>
                                            <input type="text" name="type_icon" class="form-control @error('type_icon') is-invalid @enderror">
                                            @error('type_icon')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
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
    @endsection

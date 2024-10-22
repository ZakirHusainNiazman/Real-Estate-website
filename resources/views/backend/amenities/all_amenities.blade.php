@extends('backend.admin.layout')

@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.amenities') }}" class=" btn btn-inverse-info">Add Amenity</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Amenities</h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Amenity Name</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($amenities as $key => $amenity)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $amenity->name }}</td>
                                            <td>
                                                <a href="{{ route('edit.amenities', $amenity->id) }}"
                                                    class=" btn btn-inverse-warning">Edit</a>
                                                <a href="{{ route('delete.amenities', $amenity->id) }}"
                                                    class="btn btn-inverse-danger" id="delete">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

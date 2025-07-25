@extends('admin.layout.layout')
@section('content')
    @include('admin.layout.navbar')
    @include('admin.layout.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Features</h1>
                <div class="ml-auto">
                    <a href="{{ route('admin_feature_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>New
                        Features</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Icon Preview</th>
                                                <th>Icon</th>
                                                <th>Heading</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($feature as $features)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="{{ $features->icon }} fz_30 "></td>
                                                    <td>
                                                        {{ $features->icon }}
                                                    </td>
                                                    <td>{{ $features->heading }}</td>
                                                    <td class="pt_10 pb_10">
                                                        <a href="{{ route('admin_feature_edit', $features->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ route('admin_feature_delete', $features->id) }}"
                                                            class="btn btn-danger"
                                                            onClick="return confirm('Are you sure?');"><i
                                                                class="fas fa-trash"></i></a>
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
        </section>
    </div>
@endsection

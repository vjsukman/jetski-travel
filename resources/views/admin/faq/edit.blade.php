@extends('admin.layout.layout')
@section('content')
    @include('admin.layout.navbar')
    @include('admin.layout.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit FAQ</h1>
                <div class="ml-auto">
                    <a href="{{ route('admin_faq_index') }}" class="btn btn-primary"><i></i>Back</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_faq_edit_submit', $faqs->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Question *</label>
                                        <input type="text" class="form-control" name="question"
                                            value="{{ $faqs->question }} ">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Answer *</label>
                                        <textarea name="answer" class="form-control h-100" cols="30" rows="10">{{ $faqs->answer }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

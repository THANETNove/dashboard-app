@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">ประกาศ</div>
                        <form method="POST" action="{{ route('announces-store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('ประกาศ') }}</label>

                                <div class="col-md-8">
                                    <textarea name="declare" class="form-control" rows="4" placeholder="รายละเอียดการประกาศ" required></textarea>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        บันทึก
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

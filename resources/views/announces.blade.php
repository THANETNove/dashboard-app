@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card-title">ประกาศ</div>

                            <a href="{{ url('create-announces') }}" class="btn btn-primary ms-auto">เพิ่มรายชื่อ</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ประกาศ</th>
                                        <th scope="col">วันที่ประกาศ</th>
                                        <th scope="col" class="col-2">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody id="userTable">
                                    @php $i = 1; @endphp
                                    @foreach ($data as $da)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $da->declare }}</td>
                                            <td>{{ $da->created_at->diffForHumans() }}</td>

                                            <td>
                                                <a href="javascript:void(0);" class="icon-action delete-declare"
                                                    data-email="{{ $da->declare }}" data-user-id="{{ $da->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
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

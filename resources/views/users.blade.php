@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">รายชื่อทั้งหมด</div>
                        <!-- ช่องค้นหาข้อมูล -->
                        <div class="mb-3 mt-3">
                            <input type="text" id="searchInput" placeholder="Search ..." class="form-control" />

                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col" class="col-2">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody id="userTable">
                                    @php $i = 1; @endphp
                                    @foreach ($data as $user)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>

                                            <td>
                                                <a href="{{ url('user-edit', $user->id) }}"
                                                    class="icon-action edit"><i class="far fa-edit"></i></a>
                                                <a href="javascript:void(0);" class="icon-action delete"
                                                    data-email="{{ $user->email }}" data-user-id="{{ $user->id }}">
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let typingTimer;
            let doneTypingInterval = 500; // หน่วงเวลา 0.5 วินาที

            function filterTable() {
                let searchText = document.getElementById("searchInput").value.toLowerCase().trim();

                document.querySelectorAll("#userTable tr").forEach(function(row) {
                    let rowText = row.textContent.toLowerCase(); // อ่านข้อมูลทั้งแถว

                    let matchesSearch = searchText === "" || rowText.includes(searchText);

                    // แสดงแถวที่ตรงกับเงื่อนไขการค้นหา
                    row.style.display = matchesSearch ? "" : "none";
                });
            }

            document.getElementById("searchInput").addEventListener("keydown", function(event) {
                if (event.key === "Backspace" && this.value.length === 1) {
                    setTimeout(filterTable, 50);
                }
            });

            // เมื่อพิมพ์ในช่องค้นหา รอ 0.5 วินาที ก่อนกรอง
            document.getElementById("searchInput").addEventListener("input", function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(filterTable, doneTypingInterval);
            });

            // รีเซ็ตเวลา ถ้ายังพิมพ์อยู่
            document.getElementById("searchInput").addEventListener("keydown", function() {
                clearTimeout(typingTimer);
            });

            // แสดงข้อมูลทั้งหมดเมื่อโหลดหน้า
            filterTable();
        });
    </script>
@endsection

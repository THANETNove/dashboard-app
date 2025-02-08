<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')



</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen  bg-center bg-gray-100 dark:bg-dots-lighter selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    @include('layouts.navbar')
                @else
                    <div class="main-header-welcome-2">
                        <a href="{{ route('login') }}" class="font-semibold-login">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-semibold-register">Register</a>
                        @endif
                    </div>


                @endauth
            </div>
        @endif
        <div class="box-login-content-2">
            <div class="container">
                <div class="row">
                    <!-- ประกาศข่าวสาร -->
                    <div class="col-lg-8 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-danger">📌 ประกาศสำคัญ</h5>
                                <p>กรุณาปฏิบัติตามกฎการใช้งาน และโพสต์เนื้อหาที่เหมาะสม</p>
                            </div>
                        </div>

                        <!-- ค้นหากระทู้ -->
                        <div class="mb-3">
                            <input type="text" id="searchInput" class="form-control" placeholder="🔍 ค้นหากระทู้...">
                        </div>

                        <!-- รายการกระทู้ -->
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-md-12">
                                    <h3 class="mb-4">📜 สมุดข้อความ</h3>
                                    <!-- รายการข้อความ -->
                                    <div id="messageList">
                                        @foreach ($messages as $message)
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h5 class="card-title"> {{ $message->title }}</h5>

                                                    <p>
                                                        {{ $message->content }}</p>
                                                    <p class="text-muted">โดย {{ $message->user->name }} •
                                                        {{ $message->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ส่วนเพิ่มกระทู้ -->
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">📝 ตั้งกระทู้ใหม่</h5>
                                <form action="{{ route('forum-store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" name="title" class="form-control"
                                            placeholder="หัวข้อกระทู้" required>
                                    </div>
                                    <div class="mb-3">
                                        <textarea name="content" class="form-control" rows="4" placeholder="รายละเอียด" required></textarea>
                                    </div>
                                    @auth
                                        <button type="submit" class="btn btn-success w-100">โพสต์กระทู้</button>
                                    @else
                                        <a href="{{ url('login') }}" class="btn btn-success w-100">Login</a>


                                    @endauth

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script ค้นหากระทู้ -->
        <script>
            document.getElementById("searchInput").addEventListener("input", function() {
                let searchText = this.value.toLowerCase().trim();

                document.querySelectorAll("#messageList .card").forEach(function(card) {
                    let title = card.querySelector(".card-title").textContent.toLowerCase();
                    card.style.display = title.includes(searchText) ? "" : "none";
                });
            });
        </script>



    </div>

    @include('layouts.script')
</body>

</html>

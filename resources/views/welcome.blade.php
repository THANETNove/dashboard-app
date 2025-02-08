<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')
</head>

<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-gray-100 dark:bg-dots-lighter">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    @include('layouts.navbar')
                @else
                    <div class="main-header-welcome-2 d-flex justify-content-end">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-success">Register</a>
                        @endif
                    </div>
                @endauth
            </div>
        @endif

        <div class="box-login-content-2">
            <div class="container">
                <div class="row">
                    <!-- 📌 ประกาศข่าวสาร -->
                    <div class="col-lg-12 col-md-12">
                        <div class="alert alert-danger shadow-sm">
                            <h5 class="fw-bold">📢 ประกาศสำคัญ</h5>
                            @foreach ($announce as $ann)
                                <p class="mb-1"><i class="fas fa-bullhorn"></i> {{ $ann->declare }}</p>
                            @endforeach
                        </div>

                        <!-- 🔍 ค้นหากระทู้ -->
                        <div class="input-group mb-4">
                            <input type="text" id="searchInput" class="form-control" placeholder="🔍 ค้นหากระทู้...">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>



                        <!-- 📜 รายการกระทู้ -->
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-md-12">
                                    <h3 class="mb-4 text-primary"><i class="fas fa-comments"></i> สมุดข้อความ</h3>
                                    <div id="messageList">
                                        @foreach ($messages as $message)
                                            <div class="card mb-3 shadow-sm border-left border-primary">
                                                <div class="card-body">
                                                    <h5 class="card-title text-primary">
                                                        <i class="fas fa-comment-alt"></i> {{ $message->title }}
                                                    </h5>
                                                    <p class="text-muted">
                                                        <small>โดย {{ $message->user->name }} •
                                                            {{ $message->created_at->diffForHumans() }}</small>
                                                    </p>
                                                    <p class="mb-2">{{ $message->content }}</p>
                                                </div>
                                            </div>

                                            <!-- แสดงการตอบกลับ -->
                                            <div class="replies ps-4">
                                                <h6>🗨️ ความคิดเห็น</h6>
                                                @foreach ($message->replies as $reply)
                                                    <div class="card mt-2 p-2 shadow-sm">
                                                        <p><strong>{{ $reply->user->name }}</strong>:
                                                            {{ $reply->content }}</p>
                                                        <small
                                                            class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- ฟอร์มตอบกลับ -->
                                            <div style="margin-bottom: 42px">
                                                @auth
                                                    <form
                                                        action="{{ route('forum-reply', ['message_id' => $message->id]) }}"
                                                        method="POST" class="mt-3 ps-4">
                                                        @csrf
                                                        <div class="mb-2">
                                                            <textarea name="content" class="form-control" rows="2" placeholder="เขียนความคิดเห็น..." required></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary btn-sm">💬
                                                            ตอบกลับ</button>
                                                    </form>
                                                @else
                                                    <p><a href="{{ url('login') }}">เข้าสู่ระบบ</a> เพื่อแสดงความคิดเห็น
                                                    </p>
                                                @endauth
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- ฟอร์มสร้างกระทู้ใหม่ -->
                                <div class="col-lg-4 col-md-12" style="margin-top: 64px">
                                    <div class="card shadow-lg">
                                        <div class="card-body">
                                            <h5 class="card-title text-success"><i class="fas fa-plus-circle"></i>
                                                ตั้งกระทู้ใหม่</h5>
                                            <form action="{{ route('forum-store') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <input type="text" name="title"
                                                        class="form-control border-success"
                                                        placeholder="💬 หัวข้อกระทู้" required>
                                                </div>
                                                <div class="mb-3">
                                                    <textarea name="content" class="form-control border-success" rows="4" placeholder="📝 รายละเอียด" required></textarea>
                                                </div>
                                                @auth
                                                    <button type="submit" class="btn btn-success w-100">
                                                        <i class="fas fa-paper-plane"></i> โพสต์กระทู้
                                                    </button>
                                                @else
                                                    <a href="{{ url('login') }}" class="btn btn-outline-danger w-100">
                                                        <i class="fas fa-sign-in-alt"></i> กรุณาเข้าสู่ระบบ
                                                    </a>
                                                @endauth
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>

        <!-- 🔍 ค้นหากระทู้ -->
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

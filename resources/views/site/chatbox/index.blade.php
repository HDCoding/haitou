@extends('layouts.dashboard')

@section('title', 'Chat')

@section('css')
    <style>
        #footer {
            display: none;
        }
    </style>
@endsection

@section('content')

    <div class="left-part bg-white fixed-left-part">
        <!-- Mobile toggle button -->
        <a class="ti-menu ti-close btn btn-success show-left-part d-block d-md-none" href="javascript:void(0)"></a>
        <!-- Mobile toggle button -->
        <div class="p-15">
            <h4>Chat</h4>
        </div>
        <div class="scrollable position-relative" style="height:100%;">
            <div class="p-15">
                <h5 class="card-title">Pesquisar Contato</h5>
                <form>
                    <label for="contact" style="display: none"></label>
                    <input class="form-control" id="contact" type="text" placeholder="Pesquisar Contato">
                </form>
            </div>
            <hr>
            <ul class="mailbox list-style-none">
                <li>
                    <div class="message-center chat-scroll">
                        <a href="javascript:void(0)" class="message-item" id='chat_user_1' data-user-id='1'>
                            <span class="user-img">
                                <img src="{{ asset('images/favicons/android-icon-48x48.png') }}" alt="user" class="img-rounded">
                                <span class="profile-status online pull-right"></span>
                            </span>
                            <div class="mail-contnet">
                                <h5 class="message-title">Chat Geral</h5>
                                <span class="mail-desc">Just see the my admin!</span>
                            </div>
                        </a>
{{--                        <!-- Message -->--}}
{{--                        <a href="javascript:void(0)" class="message-item" id='chat_user_2' data-user-id='2'>--}}
{{--                            <span class="user-img"> <img src="../../assets/images/users/2.jpg" alt="user" class="img-rounded"> <span class="profile-status busy pull-right"></span> </span>--}}
{{--                            <div class="mail-contnet">--}}
{{--                                <h5 class="message-title">Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>--}}
{{--                        </a>--}}
{{--                        <!-- Message -->--}}
{{--                        <a href="javascript:void(0)" class="message-item" id='chat_user_3' data-user-id='3'>--}}
{{--                            <span class="user-img"> <img src="../../assets/images/users/3.jpg" alt="user" class="img-rounded"> <span class="profile-status away pull-right"></span> </span>--}}
{{--                            <div class="mail-contnet">--}}
{{--                                <h5 class="message-title">Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>--}}
{{--                        </a>--}}
{{--                        <!-- Message -->--}}
{{--                        <a href="javascript:void(0)" class="message-item" id='chat_user_4' data-user-id='4'>--}}
{{--                            <span class="user-img"> <img src="../../assets/images/users/4.jpg" alt="user" class="img-rounded"> <span class="profile-status offline pull-right"></span> </span>--}}
{{--                            <div class="mail-contnet">--}}
{{--                                <h5 class="message-title">Nirav Joshi</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>--}}
{{--                        </a>--}}
{{--                        <!-- Message -->--}}
{{--                        <!-- Message -->--}}
{{--                        <a href="javascript:void(0)" class="message-item" id='chat_user_5' data-user-id='5'>--}}
{{--                            <span class="user-img"> <img src="../../assets/images/users/5.jpg" alt="user" class="img-rounded"> <span class="profile-status offline pull-right"></span> </span>--}}
{{--                            <div class="mail-contnet">--}}
{{--                                <h5 class="message-title">Sunil Joshi</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>--}}
{{--                        </a>--}}
{{--                        <!-- Message -->--}}
{{--                        <!-- Message -->--}}
{{--                        <a href="javascript:void(0)" class="message-item" id='chat_user_6' data-user-id='6'>--}}
{{--                            <span class="user-img"> <img src="../../assets/images/users/6.jpg" alt="user" class="img-rounded"> <span class="profile-status offline pull-right"></span> </span>--}}
{{--                            <div class="mail-contnet">--}}
{{--                                <h5 class="message-title">Akshay Kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>--}}
{{--                        </a>--}}
{{--                        <!-- Message -->--}}
{{--                        <!-- Message -->--}}
{{--                        <a href="javascript:void(0)" class="message-item" id='chat_user_7' data-user-id='7'>--}}
{{--                            <span class="user-img"> <img src="../../assets/images/users/7.jpg" alt="user" class="img-rounded"> <span class="profile-status offline pull-right"></span> </span>--}}
{{--                            <div class="mail-contnet">--}}
{{--                                <h5 class="message-title">Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>--}}
{{--                        </a>--}}
{{--                        <!-- Message -->--}}
{{--                        <!-- Message -->--}}
{{--                        <a href="javascript:void(0)" class="message-item" id='chat_user_8' data-user-id='8'>--}}
{{--                            <span class="user-img"> <img src="../../assets/images/users/8.jpg" alt="user" class="img-rounded"> <span class="profile-status offline pull-right"></span> </span>--}}
{{--                            <div class="mail-contnet">--}}
{{--                                <h5 class="message-title">Varun Dhavan</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>--}}
{{--                        </a>--}}
{{--                        <!-- Message -->--}}
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Left Part  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Part  Mail Compose -->
    <!-- ============================================================== -->
    <div class="right-part">
        <div class="p-20">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Chat Geral</h4>
                    <div class="chat-box scrollable" style="height:calc(100vh - 300px);">
                        <!--chat Row -->
                        <ul class="chat-list chatbox">
                            <!--chat Row -->
{{--                            @foreach($chatboxes as $chatbox)--}}
                            <li class="chat-item">
                                <div class="chat-content">
{{--                                    <h6 class="font-medium">{{ $chatbox->username }}</h6>--}}
                                    <div class="box bg-light-info">
{{--                                        {{ $chatbox->message }}--}}
                                    </div>
                                </div>
                            </li>
{{--                            @endforeach--}}
                            <!--chat Row -->
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    {!! Form::open(['url' => 'chatbox', 'class' => 'chatbox-form']) !!}
                    <div class="row">
                        <div class="col-11">
                            <div class="input-field m-t-0 m-b-0">
                                <label for="message" style="display: none"></label>
                                <textarea id="message" name="message" placeholder="Digite e enter" class="form-control border-0" minlength="1" maxlength="5000" required></textarea>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn-circle btn-lg btn-cyan float-right text-white"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->

@endsection

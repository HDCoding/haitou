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
{{--            <div class="p-15">--}}
{{--                <h5 class="card-title">Pesquisar Contato</h5>--}}
{{--                <form>--}}
{{--                    <label for="contact" style="display: none"></label>--}}
{{--                    <input class="form-control" id="contact" type="text" placeholder="Pesquisar Contato">--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <hr>--}}
            <ul class="mailbox list-style-none">
                <li>
                    <div class="message-center chat-scroll">
                        <a href="javascript:void(0)" class="message-item" id='chat_user_1' data-user-id='1'>
                            <span class="user-img">
                                <img src="{{ secure_asset('images/favicons/android-icon-48x48.png') }}" alt="user" class="img-rounded">
                                <span class="profile-status online pull-right"></span>
                            </span>
                            <div class="mail-contnet">
                                <h5 class="message-title">Chat</h5>
                                <span class="mail-desc">Conversa com todo mundo!</span>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- End Left Part  -->

    <!-- Right Part Mail Compose -->
    <div class="right-part">
        <div class="p-20">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Chat</h4>
                    <div class="chat-box scrollable" id="chatlist" style="height:calc(100vh - 300px);">
                        <!--chat Row -->
                        <ul class="chat-list chatbox">
                            <!--chat Row -->
                            @foreach($messages as $message)
                            <li class="chat-item">
                                <div class="chat-img">
                                    <img src="{{ $message->user->avatar() }}" alt="{{ $message->username }}">
                                </div>
                                <div class="chat-content">
                                    <h6 class="font-medium">
                                        {{ link_to_route('user.profile',  $message->username, [strtolower($message->username)], ['target' => '_blank']) }}
                                         -
                                        <span style="color:{{ $message->user->group->color }}">{{ $message->user->groupName() }}</span>
                                    </h6>
                                    <div class="box {{ in_array(auth()->user()->id, explode(',', $message->mentions)) ? 'mentioned' : 'bg-light-info' }}">
                                        {{ $message->message }}
                                    </div>
                                </div>
                                <div class="chat-time">{{ $message->created_at->diffForHumans() }}</div>
                            </li>
                            @endforeach
                        <!--chat Row -->
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="row">
                        <div class="col-11">
                            <div class="input-field m-t-0 m-b-0">
                                <label for="message" style="display: none"></label>
                                <textarea id="message" name="message" placeholder="Mensagem" class="form-control border-0" minlength="1" maxlength="500" required></textarea>
                                <p id="chat-error" class="hidden text-danger"></p>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" id="submit" class="btn-circle btn-lg btn-cyan float-right text-white">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page wrapper  -->

@endsection

@section('scripts')
    <script src="{{ secure_asset('js/pages/chatbox.js') }}"></script>
@endsection

<!-- Column -->
<div class="col-lg-4 col-xlg-3 col-md-5">
    <div class="card">
        <div class="card-body">
            <center class="m-t-30">
                <div class="el-card-avatar el-overlay-1">
                    <img src="{{ auth()->user()->avatar() }}" class="img-thumbnail" width="300" alt="avatar" onclick="chooseAvatar()"/>
                    {!! Form::open(['route' => 'post.avatar', 'files' => true, 'class' => 'form-horizontal', 'id' => 'form-avatar']) !!}
                    <input type="file" id="avatarInput" name="avatar" class="form-control" accept="image/*" style="display: none"/>
                    {!! Form::close() !!}
                </div>
                <h4 class="card-title m-t-10">{{ auth()->user()->username }}</h4>
                <h6 class="card-subtitle">{{ auth()->user()->groupName() }}</h6>
                <div class="row text-center justify-content-md-center"></div>
            </center>
        </div>
        <div>
            <hr>
        </div>
        <div class="card-body">
            <small class="text-muted">Email </small>
            <h6>email@mail.com</h6>
            <br/>
            <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
            <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
            <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
        </div>
    </div>
</div>
<!-- Column -->

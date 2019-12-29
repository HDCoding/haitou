<!-- Column -->
<div class="col-lg-4 col-xlg-3 col-md-5">
    <div class="card">
        <div class="card-body">
            <center class="m-t-30">
                <img src="{{ auth()->user()->avatar() }}" class="rounded-circle" width="150" alt="avatar"/>
                <h4 class="card-title m-t-10">{{ auth()->user()->username }}</h4>
                <h6 class="card-subtitle">{{ auth()->user()->groupName() }}</h6>
                <div class="row text-center justify-content-md-center">
                    <div class="col-4">
                        <a href="javascript:void(0)" class="link">
                            <i class="icon-people"></i>
                            <font class="font-medium">254</font>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="javascript:void(0)" class="link">
                            <i class="icon-picture"></i>
                            <font class="font-medium">54</font>
                        </a>
                    </div>
                </div>
            </center>
        </div>
        <div>
            <hr>
        </div>
        <div class="card-body"><small class="text-muted">Email address </small>
            <h6>hannagover@gmail.com</h6> <small class="text-muted p-t-30 db">Phone</small>
            <h6>+91 654 784 547</h6> <small class="text-muted p-t-30 db">Address</small>
            <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6>
            <small class="text-muted p-t-30 db">Social Profile</small>
            <br/>
            <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
            <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
            <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
        </div>
    </div>
</div>
<!-- Column -->

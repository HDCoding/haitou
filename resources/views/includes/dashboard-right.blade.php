<!-- ============================================================== -->
<!-- customizer Panel -->
<!-- ============================================================== -->
<aside class="customizer">
    <a href="javascript:void(0)" class="service-panel-toggle"><i class="fa fa-spin fa-cog"></i></a>
    <div class="customizer-body">
        <ul class="nav customizer-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="mdi mdi-wrench font-20"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="mdi mdi-star-circle font-20"></i></a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <!-- Tab 1 -->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="p-15 border-bottom">
                    <!-- Sidebar -->
                    <h5 class="font-medium m-b-10 m-t-10">Configurações de Layout</h5>
                    <div class="custom-control custom-checkbox m-t-10">
                        <input type="checkbox" class="custom-control-input" name="theme-view" id="theme-view">
                        <label class="custom-control-label" for="theme-view">Tema escuro</label>
                    </div>
                    <div class="custom-control custom-checkbox m-t-10">
                        <input type="checkbox" class="custom-control-input sidebartoggler" name="collapssidebar" id="collapssidebar">
                        <label class="custom-control-label" for="collapssidebar">Recolher barra lateral</label>
                    </div>
                    <div class="custom-control custom-checkbox m-t-10">
                        <input type="checkbox" class="custom-control-input" name="sidebar-position" id="sidebar-position">
                        <label class="custom-control-label" for="sidebar-position">Barra lateral fixa</label>
                    </div>
                    <div class="custom-control custom-checkbox m-t-10">
                        <input type="checkbox" class="custom-control-input" name="header-position" id="header-position">
                        <label class="custom-control-label" for="header-position">Cabeçalho fixo</label>
                    </div>
                    <div class="custom-control custom-checkbox m-t-10">
                        <input type="checkbox" class="custom-control-input" name="boxed-layout" id="boxed-layout">
                        <label class="custom-control-label" for="boxed-layout">Layout em caixa</label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <!-- Logo BG -->
                    <h5 class="font-medium m-b-10 m-t-10">Cor do Logotipo</h5>
                    <ul class="theme-color">
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin1"></a></li>
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin2"></a></li>
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin3"></a></li>
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin4"></a></li>
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin5"></a></li>
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin6"></a></li>
                    </ul>
                    <!-- Logo BG -->
                </div>
                <div class="p-15 border-bottom">
                    <!-- Navbar BG -->
                    <h5 class="font-medium m-b-10 m-t-10">Cor do Cabeçalho</h5>
                    <ul class="theme-color">
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin1"></a></li>
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin2"></a></li>
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin3"></a></li>
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin4"></a></li>
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin5"></a></li>
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin6"></a></li>
                    </ul>
                    <!-- Navbar BG -->
                </div>
                <div class="p-15 border-bottom">
                    <!-- Logo BG -->
                    <h5 class="font-medium m-b-10 m-t-10">Cor da Barra Lateral</h5>
                    <ul class="theme-color">
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin1"></a></li>
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin2"></a></li>
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin3"></a></li>
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin4"></a></li>
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin5"></a></li>
                        <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin6"></a></li>
                    </ul>
                    <!-- Logo BG -->
                </div>
            </div>
            <!-- End Tab 1 -->
            <!-- Tab 2 -->
            <div class="tab-pane fade p-15" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <h6 class="m-t-20 m-b-20">Status</h6>
                <div class="steamline">
                    <div class="sl-item">
                        <div class="sl-left">
                            <img src="{{ auth()->user()->levelImage() }}" class="d-block ui-w-40" alt="Level">
                        </div>
                        <div class="sl-right">
                            <div class="font-medium">{{ auth()->user()->level() }}</div>
                            <div class="desc">Level </div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left">
                            <img src="{{ asset('images/status/heart.png') }}" class="rounded-circle" alt="Points">
                        </div>
                        <div class="sl-right">
                            <div class="font-medium">{{ auth()->user()->points() }}</div>
                            <div class="desc">Pontos </div>
                        </div>
                    </div>
                    @if(auth()->user()->is_warned)
                    <div class="sl-item">
                        <div class="sl-left">
                            <img src="{{ asset('images/status/warned.png') }}" class="rounded-circle" alt="Warned">
                        </div>
                        <div class="sl-right">
                            <div class="font-medium">Advertência</div>
                            <div class="desc">Regularize antes de uma uma suspensão ou banimento.</div>
                        </div>
                    </div>
                    @endif
                    <div class="sl-item">
                        <div class="sl-left">
                            <img src="{{ asset('images/status/ratio.png') }}" class="rounded-circle" alt="Ratio">
                        </div>
                        <div class="sl-right">
                            <div class="font-medium">{{ auth()->user()->ratio() }}</div>
                            <div class="desc">Ratio</div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left">
                            <img src="{{ asset('images/status/downloaded.png') }}" class="rounded-circle" alt="Downloaded">
                        </div>
                        <div class="sl-right">
                            <div class="font-medium">{{ auth()->user()->downloaded() }}</div>
                            <div class="desc">Download </div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left">
                            <img src="{{ asset('images/status/uploaded.png') }}" class="rounded-circle" alt="Uploaded">
                        </div>
                        <div class="sl-right">
                            <div class="font-medium">{{ auth()->user()->uploaded() }}</div>
                            <div class="desc">Upload</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Tab 2 -->
        </div>
    </div>
</aside>

@extends('layouts.dashboard')

@section('title', 'Doação')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Doação</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center m-b-30 text-danger">Sua doação ajuda a manter o seu site no ar.</h5>
                        <div class="card-group">
                            <div class="card m-t-30 border-top border-left">
                                <div class="p-15 text-center">
                                    <h4 class="card-title m-t-10">Bronze</h4>
                                    <h2 class="display-5 position-relative m-t-20 m-b-10">
                                        <span class="price-sign">R$</span>5
                                    </h2>
                                    <p>Por Mês</p>
                                </div>
                                <div class="border-top">
                                    <ul class="list-style-none text-center">
                                        <li class="border-bottom p-20">
                                            <i class="ti-user m-r-5"></i>10 GB
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-mobile m-r-5"></i>14 Dias VIP
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-server m-r-5"></i>00 Pontos
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-reload m-r-5"></i>00 Convites
                                        </li>
                                        <li class="border-bottom p-20">
                                            <button class="btn btn-success btn-rounded waves-effect waves-light">Escolher</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card border-top m-t-30">
                                <div class="p-15 text-center">
                                    <h4 class="card-title m-t-10 text-center">Prata</h4>
                                    <h2 class="display-5 position-relative m-t-20 m-b-10">
                                        <span class="price-sign">R$</span>10
                                    </h2>
                                    <p>Por Mês</p>
                                </div>
                                <div class="border-top">
                                    <ul class="list-style-none text-center">
                                        <li class="border-bottom p-20">
                                            <i class="ti-user m-r-5"></i>20 GB
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-mobile m-r-5"></i>28 Dias VIP
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-server m-r-5"></i>00 Pontos
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-reload m-r-5"></i>00 Convites
                                        </li>
                                        <li class="border-bottom p-20">
                                            <button class="btn btn-success btn-rounded waves-effect waves-light">Escolher</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card bg-light border-top border-left">
                                <h5 class="price-label text-white text-center bg-info">Popular</h5>
                                <div class="p-15 text-center">
                                    <h4 class="card-title m-t-40 text-center">Ouro</h4>
                                    <h2 class="display-5 position-relative m-t-20 m-b-10">
                                        <span class="price-sign">R$</span>15
                                    </h2>
                                    <p>Por Mês</p>
                                </div>
                                <div class="border-top">
                                    <ul class="list-style-none text-center">
                                        <li class="border-bottom p-20">
                                            <i class="ti-user m-r-5"></i>30 GB
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-mobile m-r-5"></i>56 Dias VIP
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-server m-r-5"></i>00 Pontos
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-reload m-r-5"></i>00 Convites
                                        </li>
                                        <li class="border-bottom p-20">
                                            <button class="btn btn-lg btn-info btn-rounded waves-effect waves-light">Escolher</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card border-top m-t-30">
                                <div class="p-15 text-center">
                                    <h4 class="card-title m-t-10 text-center">Esmeralda</h4>
                                    <h2 class="display-5 position-relative m-t-20 m-b-10">
                                        <span class="price-sign">R$</span>20
                                    </h2>
                                    <p>Por Mês</p>
                                </div>
                                <div class="border-top">
                                    <ul class="list-style-none text-center">
                                        <li class="border-bottom p-20">
                                            <i class="ti-user m-r-5"></i>40 GB
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-mobile m-r-5"></i>84 Dias VIP
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-server m-r-5"></i>00 Pontos
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-reload m-r-5"></i>00 Convites
                                        </li>
                                        <li class="border-bottom p-20">
                                            <button class="btn btn-success btn-rounded waves-effect waves-light">Escolher</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Row2 -->
                        <div class="card-group">
                            <div class="card m-t-30 border-top border-left">
                                <div class="p-15 text-center">
                                    <h4 class="card-title m-t-10">Diamante</h4>
                                    <h2 class="display-5 position-relative m-t-20 m-b-10">
                                        <span class="price-sign">R$</span>30
                                    </h2>
                                    <p>Por Mês</p>
                                </div>
                                <div class="border-top">
                                    <ul class="list-style-none text-center">
                                        <li class="border-bottom p-20">
                                            <i class="ti-user m-r-5"></i>50 GB
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-mobile m-r-5"></i>112 Dias VIP
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-server m-r-5"></i>00 Pontos
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-reload m-r-5"></i>00 Convites
                                        </li>
                                        <li class="border-bottom p-20">
                                            <button class="btn btn-success btn-rounded waves-effect waves-light">Escolher</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card border-top m-t-30">
                                <div class="p-15 text-center">
                                    <h4 class="card-title m-t-10 text-center">Elite</h4>
                                    <h2 class="display-5 position-relative m-t-20 m-b-10">
                                        <span class="price-sign">R$</span>10
                                    </h2>
                                    <p>Por Mês</p>
                                </div>
                                <div class="border-top">
                                    <ul class="list-style-none text-center">
                                        <li class="border-bottom p-20">
                                            <i class="ti-user m-r-5"></i>65 GB
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-mobile m-r-5"></i>140 Dias VIP
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-server m-r-5"></i>00 Pontos
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-reload m-r-5"></i>00 Convites
                                        </li>
                                        <li class="border-bottom p-20">
                                            <button class="btn btn-success btn-rounded waves-effect waves-light">Escolher</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card border-top m-t-30">
                                <div class="p-15 text-center">
                                    <h4 class="card-title m-t-10 text-center">Mestre</h4>
                                    <h2 class="display-5 position-relative m-t-20 m-b-10">
                                        <span class="price-sign">R$</span>50
                                    </h2>
                                    <p>Por Mês</p>
                                </div>
                                <div class="border-top">
                                    <ul class="list-style-none text-center">
                                        <li class="border-bottom p-20">
                                            <i class="ti-user m-r-5"></i>80 GB
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-mobile m-r-5"></i>168 Dias VIP
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-server m-r-5"></i>00 Pontos
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-reload m-r-5"></i>00 Convites
                                        </li>
                                        <li class="border-bottom p-20">
                                            <button class="btn btn-success btn-rounded waves-effect waves-light">Escolher</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card border-top m-t-30">
                                <div class="p-15 text-center">
                                    <h4 class="card-title m-t-10 text-center">Mito</h4>
                                    <h2 class="display-5 position-relative m-t-20 m-b-10">
                                        <span class="price-sign">R$</span>100
                                    </h2>
                                    <p>Por Mês</p>
                                </div>
                                <div class="border-top">
                                    <ul class="list-style-none text-center">
                                        <li class="border-bottom p-20">
                                            <i class="ti-user m-r-5"></i>100 GB
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-mobile m-r-5"></i>200 Dias VIP
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-server m-r-5"></i>00 Pontos
                                        </li>
                                        <li class="border-bottom p-20">
                                            <i class="ti-reload m-r-5"></i>00 Convites
                                        </li>
                                        <li class="border-bottom p-20">
                                            <button class="btn btn-success btn-rounded waves-effect waves-light">Escolher</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="border-dark m-b-30">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center m-b-30 font-weight-light my-5">Dúvidas.</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-2">Dapibus ac facilisis in?</h5>
                                <p class="ui-company-text text-muted mb-4">Lorem ipsum dolor sit amet, ius virtute suscipit te. Ius prima euismod consequat eu.</p>
                                <h5 class="mb-2">Cras justo odio?</h5>
                                <p class="ui-company-text text-muted mb-4">Etiam vivendo eu sea, purto ponderum mediocritatem at pro.</p>
                                <h5 class="mb-2">Porta ac consectetur ac?</h5>
                                <p class="ui-company-text text-muted mb-4">Iuvaret deleniti vulputate nec ne, id vix lucilius legendos deseruisse.</p>
                                <h5 class="mb-2">Ne ornatus albucius ius?</h5>
                                <p class="ui-company-text text-muted mb-4">Lorem ipsum dolor sit amet, mea in pertinax hendrerit gloriatur.</p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-2">Ne ornatus albucius ius?</h5>
                                <p class="ui-company-text text-muted mb-4">Lorem ipsum dolor sit amet, mea in pertinax hendrerit gloriatur.</p>
                                <h5 class="mb-2">Quo insolens intellegam dissentiet at?</h5>
                                <p class="ui-company-text text-muted mb-4">Ex fugit legimus fuisset per. Ex quidam option diceret ius.</p>
                                <h5 class="mb-2">Ad his assum delenit blandit?</h5>
                                <p class="ui-company-text text-muted mb-4">Ne ornatus albucius ius, nostrum dignissim repudiandae an usu.</p>
                                <h5 class="mb-2">Dapibus ac facilisis in?</h5>
                                <p class="ui-company-text text-muted mb-4">Lorem ipsum dolor sit amet, ius virtute suscipit te. Ius prima euismod consequat eu.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

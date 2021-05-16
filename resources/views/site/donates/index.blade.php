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
                                        <span class="price-sign">R$</span>40
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
                        <h3 class="card-title text-center m-b-30 font-weight-light my-5">Obrigado por considerar fazer uma doação.</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="ui-company-text mb-4">
                                    Nós criamos o site e organizamos o conteúdo com o intuito de ter o melhor conjunto de informações
                                     com qualidade e organização de forma de fácil entendimento.
                                </p>
                                <p class="ui-company-text mb-4">
                                    O Site não possui fins lucrativos. Temos um site limpo, livre de propagandas pornográficas ou links
                                     para malwares e vírus. Somos entusiastas com a intenção de aprender mais e transmitir o conhecimento
                                      adquirido para todos, prezando sempre pela qualidade do conteúdo que apresentamos.
                                </p>
                                <p class="ui-company-text mb-4">
                                    O site mantém-se no ar através de doações. Com as doações podemos continuar sempre investindo em melhorias
                                     não só para a infraestrutura do site mas também para a criação de conteúdo.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

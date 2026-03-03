@extends('layouts.master')

@section('estilos')
<style>
    /* ===== PORTADA 4: EDITORIAL BOLD ===== */
    .hero-editorial {
        background: #fff;
        padding: 50px 0 0;
        border-bottom: 5px solid #cb0223;
    }
    .hero-editorial .big-title {
        font-size: 80px;
        font-weight: 900;
        color: #1a1a1a;
        line-height: 0.95;
        letter-spacing: -4px;
        margin-bottom: 0;
    }
    .hero-editorial .big-title .c13 {
        color: #cb0223;
        font-size: 0.5em;
        vertical-align: super;
        letter-spacing: 0;
    }
    .hero-editorial .big-title .thin {
        font-weight: 200;
        color: #999;
    }
    .hero-tagline {
        font-size: 15px;
        color: #888;
        margin-top: 12px;
        padding-bottom: 30px;
        border-bottom: 1px solid #eee;
        margin-bottom: 30px;
        letter-spacing: 3px;
        text-transform: uppercase;
        font-weight: 600;
    }
    .hero-ed-desc {
        font-size: 18px;
        color: #555;
        line-height: 1.7;
        max-width: 500px;
        margin-bottom: 30px;
    }
    .hero-ed-btns {
        display: flex;
        gap: 10px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }
    .btn-ed-red {
        padding: 14px 32px;
        background: #cb0223;
        color: #fff;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        border-radius: 0;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .btn-ed-red:hover { background: #a80020; color: #fff; text-decoration: none; }
    .btn-ed-ghost {
        padding: 14px 32px;
        background: transparent;
        border: 2px solid #1a1a1a;
        color: #1a1a1a;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        border-radius: 0;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .btn-ed-ghost:hover { background: #1a1a1a; color: #fff; text-decoration: none; }

    /* Image side */
    .hero-ed-img {
        width: 100%;
        height: 100%;
        min-height: 380px;
        object-fit: cover;
    }

    /* Marquee */
    .marquee-bar {
        background: #cb0223;
        padding: 12px 0;
        overflow: hidden;
        white-space: nowrap;
    }
    .marquee-content {
        display: inline-block;
        animation: marquee 25s linear infinite;
        font-size: 13px;
        font-weight: 700;
        color: rgba(255,255,255,0.85);
        letter-spacing: 2px;
        text-transform: uppercase;
    }
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* Grid section */
    .grid-section {
        padding: 60px 0;
        background: #fafafa;
    }
    .grid-section h2 {
        font-size: 36px;
        font-weight: 900;
        color: #1a1a1a;
        margin-bottom: 30px;
        letter-spacing: -1px;
    }
    .grid-card {
        display: block;
        background: #fff;
        border: none;
        border-bottom: 3px solid transparent;
        padding: 30px;
        margin-bottom: 20px;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }
    .grid-card:hover {
        border-bottom-color: #cb0223;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transform: translateY(-4px);
        text-decoration: none;
    }
    .grid-card .gc-label {
        font-size: 10px;
        font-weight: 800;
        color: #cb0223;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 8px;
    }
    .grid-card h4 {
        font-size: 18px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 6px;
    }
    .grid-card p {
        font-size: 13px;
        color: #888;
        line-height: 1.55;
        margin: 0;
    }

    /* Numbers strip */
    .numbers-strip {
        background: #1a1a1a;
        padding: 35px 0;
    }
    .ns-item { text-align: center; }
    .ns-item .ns-num {
        font-size: 40px;
        font-weight: 900;
        color: #fff;
    }
    .ns-item .ns-num span { color: #cb0223; }
    .ns-item .ns-lbl {
        font-size: 11px;
        color: rgba(255,255,255,0.4);
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .hero-editorial .big-title { font-size: 44px; letter-spacing: -2px; }
        .hero-ed-img { min-height: 200px; }
    }
</style>
@endsection

@section('mainContainer')
    <!-- HERO -->
    <section class="hero-editorial">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6" style="padding: 40px 60px;">
                    <h1 class="big-title">
                        NAPR<span class="thin">O</span>C<span class="c13">13</span>
                    </h1>
                    <p class="hero-tagline">Natural Products · ¹³C NMR · Database</p>
                    <p class="hero-ed-desc">
                        {!! trans('applicationResource.sesion.subtituloc') !!}
                    </p>
                    <div class="hero-ed-btns">
                        <a href="{{ url('search/byShiftNoPosition') }}" class="btn-ed-red">
                            Iniciar búsqueda
                        </a>
                        <a href="{{ url('search/byName') }}" class="btn-ed-ghost">
                            Por nombre
                        </a>
                    </div>
                </div>
                <div class="col-md-6 hidden-xs" style="padding:0;">
                    <img src="{!! asset('images/plumeria.jpg') !!}" class="hero-ed-img" alt="NAPROC">
                </div>
            </div>
        </div>
    </section>

    <!-- MARQUEE -->
    <div class="marquee-bar">
        <div class="marquee-content">
            &nbsp;&nbsp;&nbsp;★ UNIVERSIDAD DE SALAMANCA &nbsp;&nbsp;·&nbsp;&nbsp; DPTO. CIENCIAS FARMACÉUTICAS &nbsp;&nbsp;·&nbsp;&nbsp; DR. JOSÉ LUIS LÓPEZ PÉREZ &nbsp;&nbsp;·&nbsp;&nbsp; +8000 COMPUESTOS &nbsp;&nbsp;·&nbsp;&nbsp; RMN ¹³C &nbsp;&nbsp;·&nbsp;&nbsp; PRODUCTOS NATURALES &nbsp;&nbsp;·&nbsp;&nbsp;
            ★ UNIVERSIDAD DE SALAMANCA &nbsp;&nbsp;·&nbsp;&nbsp; DPTO. CIENCIAS FARMACÉUTICAS &nbsp;&nbsp;·&nbsp;&nbsp; DR. JOSÉ LUIS LÓPEZ PÉREZ &nbsp;&nbsp;·&nbsp;&nbsp; +8000 COMPUESTOS &nbsp;&nbsp;·&nbsp;&nbsp; RMN ¹³C &nbsp;&nbsp;·&nbsp;&nbsp; PRODUCTOS NATURALES &nbsp;&nbsp;·&nbsp;&nbsp;
        </div>
    </div>

    <!-- NUMBERS -->
    <section class="numbers-strip">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 ns-item">
                    <div class="ns-num">8<span>,</span>000<span>+</span></div>
                    <div class="ns-lbl">Compuestos</div>
                </div>
                <div class="col-sm-3 ns-item">
                    <div class="ns-num">200<span>K</span></div>
                    <div class="ns-lbl">Desplazamientos</div>
                </div>
                <div class="col-sm-3 ns-item">
                    <div class="ns-num">6</div>
                    <div class="ns-lbl">Tolerancias</div>
                </div>
                <div class="col-sm-3 ns-item">
                    <div class="ns-num">25<span>+</span></div>
                    <div class="ns-lbl">Años</div>
                </div>
            </div>
        </div>
    </section>

    <!-- SEARCH GRID -->
    <section class="grid-section">
        <div class="container">
            <h2>Búsquedas disponibles</h2>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('search/byShiftNoPosition') }}" class="grid-card">
                        <div class="gc-label">Método principal</div>
                        <h4>{!! trans('applicationResource.submenu.desplazamiento') !!}</h4>
                        <p>Buscar compuestos por valores de desplazamiento químico δ(ppm) con sistema de tolerancias ±0 a ±5 y visualización por colores</p>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('search/byName') }}" class="grid-card">
                        <div class="gc-label">Texto</div>
                        <h4>{!! trans('applicationResource.submenu.nombre') !!}</h4>
                        <p>Buscar por nombre trivial, nombre sistemático, bibliografía, fórmula molecular o peso molecular</p>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('search/bySubstructure') }}" class="grid-card">
                        <div class="gc-label">Estructura</div>
                        <h4>{!! trans('applicationResource.submenu.subestructura') !!}</h4>
                        <p>Dibujar o importar subestructuras moleculares en formato SMILES para encontrar fragmentos específicos</p>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('search/byCarbonType') }}" class="grid-card">
                        <div class="gc-label">Filtro</div>
                        <h4>{!! trans('applicationResource.submenu.tipocarbono') !!}</h4>
                        <p>Filtrar por tipos de carbono: CH, CH₂, CH₃ y carbonos cuaternarios C con rangos personalizados</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <hr class="invisible">
@endsection

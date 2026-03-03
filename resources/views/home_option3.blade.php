@extends('layouts.master')

@section('estilos')
<style>
    /* ===== PORTADA 3: ELEGANTE MINIMALISTA ===== */

    /* Hero split */
    .hero-split {
        display: flex;
        min-height: 420px;
        overflow: hidden;
    }
    .hero-left {
        flex: 1;
        background: #fff;
        display: flex;
        align-items: center;
        padding: 50px 40px 50px 60px;
    }
    .hero-right {
        flex: 0 0 45%;
        position: relative;
        overflow: hidden;
    }
    .hero-right img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .hero-right::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, rgba(203,2,35,0.3), rgba(139,0,0,0.5));
    }
    .hero-left-content {
        max-width: 480px;
    }
    .usal-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 5px 14px;
        border: 2px solid #cb0223;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        color: #cb0223;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 22px;
    }
    .hero-left h1 {
        font-size: 40px;
        font-weight: 800;
        color: #1a1a1a;
        line-height: 1.1;
        margin-bottom: 5px;
    }
    .hero-left h1 .red { color: #cb0223; }
    .hero-left h1 sup { font-size: 0.5em; color: #cb0223; }
    .hero-left .hero-text {
        font-size: 16px;
        color: #666;
        line-height: 1.65;
        margin-bottom: 28px;
    }
    .hero-left .hero-text strong { color: #333; }
    .hero-actions-split {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .btn-red-solid {
        display: inline-block;
        padding: 13px 28px;
        background: #cb0223;
        color: #fff;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        border-radius: 6px;
        transition: all 0.3s;
        letter-spacing: 0.3px;
    }
    .btn-red-solid:hover {
        background: #a80020;
        color: #fff;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(203,2,35,0.3);
    }
    .btn-gray-outline {
        display: inline-block;
        padding: 13px 28px;
        background: transparent;
        border: 2px solid #ddd;
        color: #555;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        border-radius: 6px;
        transition: all 0.3s;
    }
    .btn-gray-outline:hover {
        border-color: #cb0223;
        color: #cb0223;
        text-decoration: none;
    }

    /* Divider line */
    .red-divider {
        height: 4px;
        background: linear-gradient(90deg, #cb0223, #e8163b, #cb0223);
    }

    /* Stats strip */
    .stats-strip {
        background: #fafafa;
        border-bottom: 1px solid #eee;
        padding: 28px 0;
    }
    .ss-item {
        text-align: center;
        position: relative;
    }
    .ss-item::after {
        content: '';
        position: absolute;
        right: 0;
        top: 20%;
        height: 60%;
        width: 1px;
        background: #ddd;
    }
    .ss-item:last-child::after { display: none; }
    .ss-item .ss-number {
        font-size: 28px;
        font-weight: 900;
        color: #cb0223;
    }
    .ss-item .ss-text {
        font-size: 11px;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 600;
    }

    /* Search grid */
    .search-grid-section {
        padding: 50px 0;
        background: #fff;
    }
    .search-grid-section .sg-title {
        font-size: 11px;
        font-weight: 700;
        color: #cb0223;
        text-transform: uppercase;
        letter-spacing: 3px;
        text-align: center;
        margin-bottom: 6px;
    }
    .search-grid-section h2 {
        font-size: 28px;
        font-weight: 800;
        color: #1a1a1a;
        text-align: center;
        margin-bottom: 35px;
    }
    .sg-card {
        display: block;
        background: #fff;
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 28px 22px;
        margin-bottom: 20px;
        text-decoration: none;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    .sg-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 4px;
        height: 100%;
        background: #cb0223;
        transform: scaleY(0);
        transition: transform 0.3s;
        transform-origin: top;
    }
    .sg-card:hover {
        border-color: #cb0223;
        box-shadow: 0 8px 30px rgba(203,2,35,0.08);
        transform: translateY(-3px);
        text-decoration: none;
    }
    .sg-card:hover::before { transform: scaleY(1); }
    .sg-card .sg-num {
        font-size: 36px;
        font-weight: 900;
        color: #f0f0f0;
        line-height: 1;
        margin-bottom: 10px;
        transition: color 0.3s;
    }
    .sg-card:hover .sg-num { color: #fce4e4; }
    .sg-card h4 {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 6px;
    }
    .sg-card p {
        font-size: 13px;
        color: #888;
        line-height: 1.55;
        margin: 0;
    }
    .sg-card .sg-arrow {
        position: absolute;
        right: 20px;
        bottom: 20px;
        font-size: 20px;
        color: #ddd;
        transition: all 0.3s;
    }
    .sg-card:hover .sg-arrow {
        color: #cb0223;
        transform: translateX(4px);
    }

    /* Tolerance section */
    .tol-section {
        padding: 40px 0;
        background: #f8f8f8;
        border-top: 1px solid #eee;
    }
    .tol-section h3 {
        font-size: 22px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 8px;
    }
    .tol-section p {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
        margin-bottom: 18px;
    }
    .tol-colors {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    .tol-chip {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        background: #fff;
        border: 1px solid #eee;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }
    .tol-dot {
        width: 14px; height: 14px;
        border-radius: 4px;
    }
    .td-0 { background: #00ff00; }
    .td-1 { background: #00ffff; }
    .td-2 { background: #ffff00; }
    .td-3 { background: #ff8800; }
    .td-4 { background: #ff88ff; }
    .td-5 { background: #ff0000; }

    @media (max-width: 768px) {
        .hero-split { flex-direction: column; }
        .hero-right { flex: none; height: 220px; }
        .hero-left { padding: 30px 20px; }
        .hero-left h1 { font-size: 28px; }
        .ss-item::after { display: none; }
        .ss-item { margin-bottom: 15px; }
    }
</style>
@endsection

@section('mainContainer')
    <!-- HERO SPLIT -->
    <section class="hero-split">
        <div class="hero-left">
            <div class="hero-left-content">
                <div class="usal-tag">Universidad de Salamanca</div>
                <h1>
                    NAPROC<sup>13</sup><br>
                    <span class="red">¹³C NMR</span> Database
                </h1>
                <p class="hero-text">
                    {!! trans('applicationResource.sesion.subtituloc') !!}
                </p>
                <div class="hero-actions-split">
                    <a href="{{ url('search/byShiftNoPosition') }}" class="btn-red-solid">
                        Buscar compuestos
                    </a>
                    <a href="{{ url('search/byName') }}" class="btn-gray-outline">
                        {!! trans('applicationResource.submenu.nombre') !!}
                    </a>
                </div>
            </div>
        </div>
        <div class="hero-right hidden-xs">
            <img src="{!! asset('images/plumeria.jpg') !!}" alt="NAPROC 13">
        </div>
    </section>

    <!-- RED DIVIDER -->
    <div class="red-divider"></div>

    <!-- STATS -->
    <section class="stats-strip">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 ss-item">
                    <div class="ss-number">8,000+</div>
                    <div class="ss-text">Compuestos</div>
                </div>
                <div class="col-sm-3 ss-item">
                    <div class="ss-number">200K+</div>
                    <div class="ss-text">Desplazamientos</div>
                </div>
                <div class="col-sm-3 ss-item">
                    <div class="ss-number">4</div>
                    <div class="ss-text">Tipos de búsqueda</div>
                </div>
                <div class="col-sm-3 ss-item">
                    <div class="ss-number">25+</div>
                    <div class="ss-text">Años de datos</div>
                </div>
            </div>
        </div>
    </section>

    <!-- SEARCH OPTIONS -->
    <section class="search-grid-section">
        <div class="container">
            <div class="sg-title">Herramientas</div>
            <h2>Tipos de búsqueda</h2>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/byShiftNoPosition') }}" class="sg-card">
                        <div class="sg-num">01</div>
                        <h4>{!! trans('applicationResource.submenu.desplazamiento') !!}</h4>
                        <p>Buscar por valores δ(ppm) con tolerancias ±0 a ±5</p>
                        <span class="sg-arrow">→</span>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/byName') }}" class="sg-card">
                        <div class="sg-num">02</div>
                        <h4>{!! trans('applicationResource.submenu.nombre') !!}</h4>
                        <p>Nombre trivial, sistemático, bibliografía</p>
                        <span class="sg-arrow">→</span>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/bySubstructure') }}" class="sg-card">
                        <div class="sg-num">03</div>
                        <h4>{!! trans('applicationResource.submenu.subestructura') !!}</h4>
                        <p>Dibujar fragmentos moleculares SMILES</p>
                        <span class="sg-arrow">→</span>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/byCarbonType') }}" class="sg-card">
                        <div class="sg-num">04</div>
                        <h4>{!! trans('applicationResource.submenu.tipocarbono') !!}</h4>
                        <p>CH, CH₂, CH₃ y carbonos cuaternarios</p>
                        <span class="sg-arrow">→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- TOLERANCE -->
    <section class="tol-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h3>Sistema de tolerancia por colores</h3>
                    <p>Los resultados de búsqueda por desplazamiento se clasifican visualmente según su nivel de coincidencia con los valores buscados.</p>
                    <div class="tol-colors" style="justify-content:center;">
                        <div class="tol-chip"><span class="tol-dot td-0"></span> ±0 Exacto</div>
                        <div class="tol-chip"><span class="tol-dot td-1"></span> ±1 ppm</div>
                        <div class="tol-chip"><span class="tol-dot td-2"></span> ±2 ppm</div>
                        <div class="tol-chip"><span class="tol-dot td-3"></span> ±3 ppm</div>
                        <div class="tol-chip"><span class="tol-dot td-4"></span> ±4 ppm</div>
                        <div class="tol-chip"><span class="tol-dot td-5"></span> ±5 ppm</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="invisible">
@endsection

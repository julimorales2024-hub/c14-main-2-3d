@extends('layouts.master')

@section('estilos')
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@300;400;600;700;900&display=swap" rel="stylesheet">
<style>
    /* ===== PORTADA 2: MODERNA UNIVERSITARIA ===== */
    .hero-univ {
        position: relative;
        min-height: 480px;
        background: linear-gradient(160deg, #cb0223 0%, #8b0000 40%, #4a0011 100%);
        display: flex;
        align-items: center;
        overflow: hidden;
        font-family: 'Source Sans 3', sans-serif;
    }
    .hero-univ::before {
        content: '';
        position: absolute;
        top: -100px; right: -100px;
        width: 500px; height: 500px;
        border: 60px solid rgba(255,255,255,0.04);
        border-radius: 50%;
    }
    .hero-univ::after {
        content: '';
        position: absolute;
        bottom: -80px; left: -80px;
        width: 350px; height: 350px;
        border: 40px solid rgba(255,255,255,0.03);
        border-radius: 50%;
    }
    .hero-inner {
        position: relative;
        z-index: 2;
        padding: 50px 0;
    }
    .hero-univ .usal-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(10px);
        padding: 6px 18px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        color: rgba(255,255,255,0.9);
        letter-spacing: 0.8px;
        margin-bottom: 22px;
    }
    .hero-univ h1 {
        font-size: 46px;
        font-weight: 900;
        color: #fff;
        line-height: 1.1;
        margin-bottom: 6px;
        text-shadow: 0 2px 20px rgba(0,0,0,0.2);
    }
    .hero-univ h1 .light { font-weight: 300; opacity: 0.85; }
    .hero-univ h1 sup { font-size: 0.45em; vertical-align: super; }
    .hero-univ .hero-desc {
        font-size: 17px;
        color: rgba(255,255,255,0.7);
        line-height: 1.6;
        max-width: 480px;
        margin-bottom: 28px;
        font-weight: 300;
    }
    .hero-ctas {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .btn-white {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 26px;
        background: #fff;
        color: #cb0223;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        border-radius: 8px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    .btn-white:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        color: #8b0000;
        text-decoration: none;
    }
    .btn-outline-w {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 26px;
        background: transparent;
        border: 2px solid rgba(255,255,255,0.35);
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        border-radius: 8px;
        transition: all 0.3s;
    }
    .btn-outline-w:hover {
        background: rgba(255,255,255,0.1);
        border-color: rgba(255,255,255,0.6);
        color: #fff;
        text-decoration: none;
    }

    /* Stats bar */
    .stats-bar {
        background: #fff;
        border-bottom: 3px solid #cb0223;
        padding: 0;
    }
    .stat-col {
        text-align: center;
        padding: 22px 15px;
        border-right: 1px solid #eee;
    }
    .stat-col:last-child { border-right: none; }
    .stat-col .s-num {
        font-family: 'Source Sans 3', sans-serif;
        font-size: 30px;
        font-weight: 900;
        color: #cb0223;
        line-height: 1;
    }
    .stat-col .s-label {
        font-size: 11px;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-top: 4px;
        font-weight: 600;
    }

    /* Search cards */
    .search-section {
        padding: 50px 0;
        background: #f5f5f7;
    }
    .search-section .section-head {
        text-align: center;
        margin-bottom: 35px;
    }
    .search-section .section-head h2 {
        font-family: 'Source Sans 3', sans-serif;
        font-size: 30px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 8px;
    }
    .search-section .section-head p {
        font-size: 15px;
        color: #777;
    }
    .search-card {
        background: #fff;
        border-radius: 16px;
        padding: 32px 24px;
        text-align: center;
        margin-bottom: 20px;
        border: 1px solid #eee;
        transition: all 0.35s cubic-bezier(0.4,0,0.2,1);
        text-decoration: none;
        display: block;
        min-height: 200px;
    }
    .search-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.1);
        border-color: #cb0223;
        text-decoration: none;
    }
    .search-card .sc-icon {
        width: 60px; height: 60px;
        margin: 0 auto 18px;
        background: linear-gradient(135deg, #fff0f0, #ffe0e0);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        transition: all 0.35s;
    }
    .search-card:hover .sc-icon {
        background: linear-gradient(135deg, #cb0223, #e8163b);
        transform: scale(1.1);
    }
    .search-card:hover .sc-icon-emoji { filter: brightness(10); }
    .search-card h4 {
        font-family: 'Source Sans 3', sans-serif;
        font-size: 17px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
    }
    .search-card p {
        font-size: 13px;
        color: #888;
        line-height: 1.5;
        margin: 0;
    }

    /* About section */
    .about-section {
        padding: 50px 0;
        background: #fff;
    }
    .about-section .about-img {
        border-radius: 16px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        border: 4px solid #f0f0f0;
    }
    .about-section h3 {
        font-family: 'Source Sans 3', sans-serif;
        font-size: 26px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 12px;
    }
    .about-section p {
        font-size: 15px;
        color: #555;
        line-height: 1.7;
    }
    .about-section .usal-logo-about {
        height: 50px;
        opacity: 0.6;
        margin-top: 20px;
    }

    /* Tolerance preview */
    .tolerance-preview {
        display: flex;
        gap: 6px;
        margin-top: 18px;
        flex-wrap: wrap;
    }
    .tol-badge {
        padding: 4px 12px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 700;
        font-family: monospace;
    }
    .tol-0 { background: #00ff00; color: #000; }
    .tol-1 { background: #00ffff; color: #000; }
    .tol-2 { background: #ffff00; color: #000; }
    .tol-3 { background: #ff8800; color: #000; }
    .tol-4 { background: #ff88ff; color: #000; }
    .tol-5 { background: #ff0000; color: #fff; }

    @media (max-width: 768px) {
        .hero-univ h1 { font-size: 30px; }
        .stat-col { border-right: none; border-bottom: 1px solid #eee; }
    }
</style>
@endsection

@section('mainContainer')
    <!-- HERO -->
    <section class="hero-univ">
        <div class="container hero-inner">
            <div class="row">
                <div class="col-md-7">
                    <div class="usal-badge">
                        <img src="{!! asset('images/Logo_Usal_Hor_Eng_Blanco_2011.png') !!}" alt="USAL" style="height:18px;opacity:0.9;">
                        Dpto. Ciencias Farmacéuticas
                    </div>
                    <h1>
                        NAPROC<sup>13</sup><br>
                        <span class="light">Natural Products ¹³C NMR</span>
                    </h1>
                    <p class="hero-desc">
                        {!! trans('applicationResource.sesion.subtituloc') !!}
                    </p>
                    <div class="hero-ctas">
                        <a href="{{ url('search/byShiftNoPosition') }}" class="btn-white">
                            &#x1F50D; {!! trans('applicationResource.submenu.desplazamiento') !!}
                        </a>
                        <a href="{{ url('search/byName') }}" class="btn-outline-w">
                            {!! trans('applicationResource.submenu.nombre') !!}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS -->
    <section class="stats-bar">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 stat-col">
                    <div class="s-num">8,000+</div>
                    <div class="s-label">Compuestos</div>
                </div>
                <div class="col-sm-3 stat-col">
                    <div class="s-num">200K+</div>
                    <div class="s-label">Desplazamientos</div>
                </div>
                <div class="col-sm-3 stat-col">
                    <div class="s-num">6</div>
                    <div class="s-label">Niveles tolerancia</div>
                </div>
                <div class="col-sm-3 stat-col">
                    <div class="s-num">25+</div>
                    <div class="s-label">Años de datos</div>
                </div>
            </div>
        </div>
    </section>

    <!-- SEARCH OPTIONS -->
    <section class="search-section">
        <div class="container">
            <div class="section-head">
                <h2>{!! trans('applicationResource.menu.busqueda') !!}</h2>
                <p>Seleccione el tipo de búsqueda que desea realizar</p>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/byShiftNoPosition') }}" class="search-card">
                        <div class="sc-icon"><span class="sc-icon-emoji">🔬</span></div>
                        <h4>{!! trans('applicationResource.submenu.desplazamiento') !!}</h4>
                        <p>Buscar por valores δ(ppm) con tolerancias ajustables</p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/byName') }}" class="search-card">
                        <div class="sc-icon"><span class="sc-icon-emoji">📝</span></div>
                        <h4>{!! trans('applicationResource.submenu.nombre') !!}</h4>
                        <p>Buscar por nombre trivial o sistemático</p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/bySubstructure') }}" class="search-card">
                        <div class="sc-icon"><span class="sc-icon-emoji">🧬</span></div>
                        <h4>{!! trans('applicationResource.submenu.subestructura') !!}</h4>
                        <p>Dibujar o importar fragmentos moleculares</p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/byCarbonType') }}" class="search-card">
                        <div class="sc-icon"><span class="sc-icon-emoji">⚗️</span></div>
                        <h4>{!! trans('applicationResource.submenu.tipocarbono') !!}</h4>
                        <p>Filtrar por CH, CH₂, CH₃ y C cuaternarios</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <img src="{!! asset('images/plumeria.jpg') !!}" alt="NAPROC" class="img-responsive about-img center-block">
                </div>
                <div class="col-md-5" style="display:flex;flex-direction:column;justify-content:center;padding:30px;">
                    <h3>{!! trans('applicationResource.sesion.tituloc') !!}</h3>
                    <p>{!! trans('applicationResource.sesion.subtituloc') !!}</p>
                    <div class="tolerance-preview">
                        <span class="tol-badge tol-0">±0</span>
                        <span class="tol-badge tol-1">±1</span>
                        <span class="tol-badge tol-2">±2</span>
                        <span class="tol-badge tol-3">±3</span>
                        <span class="tol-badge tol-4">±4</span>
                        <span class="tol-badge tol-5">±5</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="invisible">
@endsection

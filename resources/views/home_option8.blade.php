@extends('layouts.master')

@section('estilos')
<style>
    /* ===== PORTADA 8: GRADIENTE ANIMADO + CARDS ===== */
    .hero-gradient {
        position: relative;
        min-height: 460px;
        background: linear-gradient(-45deg, #1a0005, #3d0010, #0d0d2b, #1a0020);
        background-size: 400% 400%;
        animation: gradMove 12s ease infinite;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    @keyframes gradMove {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .hero-gradient::after {
        content: '';
        position: absolute;
        bottom: -2px; left: 0; right: 0;
        height: 80px;
        background: linear-gradient(to top, #fff, transparent);
    }
    /* Floating circles */
    .float-circle {
        position: absolute;
        border-radius: 50%;
        border: 1px solid rgba(203,2,35,0.15);
        animation: floatUp 8s ease-in-out infinite;
    }
    .fc1 { width: 200px; height: 200px; top: 10%; right: 10%; animation-delay: 0s; }
    .fc2 { width: 120px; height: 120px; top: 60%; right: 25%; animation-delay: 2s; }
    .fc3 { width: 80px; height: 80px; top: 30%; right: 40%; animation-delay: 4s; border-color: rgba(255,215,0,0.1); }
    .fc4 { width: 160px; height: 160px; bottom: 10%; left: 5%; animation-delay: 1s; }
    @keyframes floatUp {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }

    .hero-grad-content {
        position: relative;
        z-index: 2;
        padding: 50px 0;
    }
    .hg-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 18px;
        background: rgba(255,255,255,0.08);
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        color: rgba(255,255,255,0.7);
        margin-bottom: 22px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.1);
    }
    .hg-badge .hg-dot {
        width: 7px; height: 7px;
        background: #ff4d5e;
        border-radius: 50%;
        animation: pulse-d 2s infinite;
    }
    @keyframes pulse-d {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(0.8); }
    }
    .hero-gradient h1 {
        font-size: 50px;
        font-weight: 900;
        color: #fff;
        line-height: 1.05;
        margin-bottom: 10px;
        letter-spacing: -1px;
    }
    .hero-gradient h1 sup { font-size: 0.4em; color: #ff4d5e; vertical-align: super; }
    .hero-gradient h1 .sub-h {
        display: block;
        font-size: 0.42em;
        font-weight: 300;
        color: rgba(255,255,255,0.5);
        letter-spacing: 0;
        margin-top: 6px;
    }
    .hg-desc {
        font-size: 16px;
        color: rgba(255,255,255,0.45);
        line-height: 1.65;
        max-width: 500px;
        margin-bottom: 30px;
    }
    .hg-btns { display: flex; gap: 10px; flex-wrap: wrap; }
    .btn-hg-main {
        padding: 13px 30px;
        background: #cb0223;
        color: #fff;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        border-radius: 10px;
        transition: all 0.3s;
        box-shadow: 0 6px 25px rgba(203,2,35,0.35);
    }
    .btn-hg-main:hover {
        background: #e8163b;
        transform: translateY(-2px);
        box-shadow: 0 10px 35px rgba(203,2,35,0.5);
        color: #fff; text-decoration: none;
    }
    .btn-hg-ghost {
        padding: 13px 30px;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.15);
        color: rgba(255,255,255,0.75);
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        border-radius: 10px;
        transition: all 0.3s;
    }
    .btn-hg-ghost:hover {
        background: rgba(255,255,255,0.12);
        color: #fff; text-decoration: none;
    }

    /* Big stat cards */
    .stat-cards {
        padding: 0;
        margin-top: -50px;
        position: relative;
        z-index: 5;
    }
    .sc-inner {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        padding: 30px 0;
        display: flex;
        flex-wrap: wrap;
    }
    .sc-col {
        flex: 1;
        text-align: center;
        padding: 10px 20px;
        border-right: 1px solid #f0f0f0;
        min-width: 140px;
    }
    .sc-col:last-child { border-right: none; }
    .sc-col .sc-n {
        font-size: 34px;
        font-weight: 900;
        color: #cb0223;
        line-height: 1;
    }
    .sc-col .sc-l {
        font-size: 11px;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 600;
        margin-top: 4px;
    }

    /* Search section */
    .search-cards-section {
        padding: 60px 0 50px;
        background: #fff;
    }
    .scs-head {
        text-align: center;
        margin-bottom: 35px;
    }
    .scs-head .scs-label {
        font-size: 11px;
        font-weight: 700;
        color: #cb0223;
        text-transform: uppercase;
        letter-spacing: 3px;
        margin-bottom: 6px;
    }
    .scs-head h2 {
        font-size: 30px;
        font-weight: 800;
        color: #1a1a1a;
    }
    .scs-card {
        display: block;
        position: relative;
        background: #fff;
        border-radius: 14px;
        padding: 30px 24px;
        margin-bottom: 20px;
        text-decoration: none;
        border: 1px solid #f0f0f0;
        transition: all 0.35s cubic-bezier(0.4,0,0.2,1);
        overflow: hidden;
    }
    .scs-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, #cb0223, #ff4d5e);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.35s;
    }
    .scs-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 45px rgba(0,0,0,0.08);
        border-color: transparent;
        text-decoration: none;
    }
    .scs-card:hover::before { transform: scaleX(1); }
    .scs-card .scs-icon {
        width: 50px; height: 50px;
        background: #fff5f5;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 16px;
        transition: all 0.3s;
    }
    .scs-card:hover .scs-icon {
        background: #cb0223;
        transform: scale(1.08);
        box-shadow: 0 4px 15px rgba(203,2,35,0.25);
    }
    .scs-card h4 {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 6px;
    }
    .scs-card p {
        font-size: 13px;
        color: #999;
        line-height: 1.5;
        margin: 0;
    }

    /* Image + info */
    .info-gradient {
        padding: 50px 0;
        background: #f9f9fb;
        border-top: 1px solid #f0f0f0;
    }
    .info-gradient .ig-img {
        border-radius: 20px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.1);
    }
    .info-gradient h3 {
        font-size: 24px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 12px;
    }
    .info-gradient p {
        font-size: 15px;
        color: #666;
        line-height: 1.7;
    }
    .tol-line {
        display: flex;
        gap: 6px;
        margin-top: 20px;
        flex-wrap: wrap;
    }
    .tlp {
        width: 36px; height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 800;
        font-family: monospace;
        transition: transform 0.2s;
    }
    .tlp:hover { transform: scale(1.2); }
    .t0g { background: #00ff00; color: #000; }
    .t1g { background: #00ffff; color: #000; }
    .t2g { background: #ffff00; color: #000; }
    .t3g { background: #ff8800; color: #000; }
    .t4g { background: #ff88ff; color: #000; }
    .t5g { background: #ff0000; color: #fff; }

    @media (max-width: 768px) {
        .hero-gradient h1 { font-size: 32px; }
        .sc-inner { flex-direction: column; }
        .sc-col { border-right: none; border-bottom: 1px solid #f0f0f0; padding: 15px; }
        .sc-col:last-child { border-bottom: none; }
        .float-circle { display: none; }
    }
</style>
@endsection

@section('mainContainer')
    <!-- HERO -->
    <section class="hero-gradient">
        <div class="float-circle fc1"></div>
        <div class="float-circle fc2"></div>
        <div class="float-circle fc3"></div>
        <div class="float-circle fc4"></div>
        <div class="container hero-grad-content">
            <div class="row">
                <div class="col-md-7">
                    <div class="hg-badge">
                        <span class="hg-dot"></span>
                        Universidad de Salamanca · Dpto. Ciencias Farmacéuticas
                    </div>
                    <h1>
                        NAPROC<sup>13</sup>
                        <span class="sub-h">Natural Products ¹³C NMR Database</span>
                    </h1>
                    <p class="hg-desc">{!! trans('applicationResource.sesion.subtituloc') !!}</p>
                    <div class="hg-btns">
                        <a href="{{ url('search/byShiftNoPosition') }}" class="btn-hg-main">🔬 {!! trans('applicationResource.submenu.desplazamiento') !!}</a>
                        <a href="{{ url('search/byName') }}" class="btn-hg-ghost">{!! trans('applicationResource.submenu.nombre') !!}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STAT CARDS -->
    <section class="stat-cards">
        <div class="container">
            <div class="sc-inner">
                <div class="sc-col"><div class="sc-n">8,000+</div><div class="sc-l">Compuestos</div></div>
                <div class="sc-col"><div class="sc-n">200K+</div><div class="sc-l">Desplazamientos ¹³C</div></div>
                <div class="sc-col"><div class="sc-n">6</div><div class="sc-l">Niveles tolerancia</div></div>
                <div class="sc-col"><div class="sc-n">25+</div><div class="sc-l">Años de datos</div></div>
            </div>
        </div>
    </section>

    <!-- SEARCH -->
    <section class="search-cards-section">
        <div class="container">
            <div class="scs-head">
                <div class="scs-label">Herramientas</div>
                <h2>{!! trans('applicationResource.menu.busqueda') !!}</h2>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/byShiftNoPosition') }}" class="scs-card">
                        <div class="scs-icon">🔬</div>
                        <h4>{!! trans('applicationResource.submenu.desplazamiento') !!}</h4>
                        <p>Valores δ(ppm) con tolerancias ±0 a ±5</p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/byName') }}" class="scs-card">
                        <div class="scs-icon">📝</div>
                        <h4>{!! trans('applicationResource.submenu.nombre') !!}</h4>
                        <p>Nombre trivial o sistemático</p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/bySubstructure') }}" class="scs-card">
                        <div class="scs-icon">🧬</div>
                        <h4>{!! trans('applicationResource.submenu.subestructura') !!}</h4>
                        <p>Fragmentos moleculares SMILES</p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/byCarbonType') }}" class="scs-card">
                        <div class="scs-icon">⚗️</div>
                        <h4>{!! trans('applicationResource.submenu.tipocarbono') !!}</h4>
                        <p>CH, CH₂, CH₃ y cuaternarios</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- INFO -->
    <section class="info-gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <img src="{!! asset('images/plumeria.jpg') !!}" alt="NAPROC" class="img-responsive ig-img">
                </div>
                <div class="col-md-5" style="display:flex;flex-direction:column;justify-content:center;padding:30px;">
                    <h3>{!! trans('applicationResource.sesion.tituloc') !!}</h3>
                    <p>{!! trans('applicationResource.sesion.subtituloc') !!}</p>
                    <div class="tol-line">
                        <div class="tlp t0g">±0</div>
                        <div class="tlp t1g">±1</div>
                        <div class="tlp t2g">±2</div>
                        <div class="tlp t3g">±3</div>
                        <div class="tlp t4g">±4</div>
                        <div class="tlp t5g">±5</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr class="invisible">
@endsection

@extends('layouts.master')

@section('estilos')
<style>
    /* ===== PORTADA 6: NATURALEZA BOTÁNICA ===== */
    .hero-nature {
        position: relative;
        min-height: 480px;
        background: linear-gradient(170deg, #1b3a2d 0%, #0f2318 50%, #0a1a10 100%);
        overflow: hidden;
        display: flex;
        align-items: center;
    }
    .hero-nature::before {
        content: '';
        position: absolute;
        top: -20%; right: -10%;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(34,139,34,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    .hero-nature::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 120px;
        background: linear-gradient(to top, rgba(10,26,16,1), transparent);
    }
    /* Leaf pattern overlay */
    .leaf-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 5c-8 8-12 20-4 28s20 4 28-4' fill='none' stroke='rgba(34,139,34,0.04)' stroke-width='1'/%3E%3C/svg%3E");
        opacity: 0.5;
    }
    .hero-nat-content {
        position: relative;
        z-index: 3;
        padding: 50px 0;
    }
    .nat-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 5px 16px;
        background: rgba(34,139,34,0.15);
        border: 1px solid rgba(34,139,34,0.25);
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        color: #66bb6a;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 20px;
    }
    .nat-badge .leaf { font-size: 14px; }
    .hero-nature h1 {
        font-size: 46px;
        font-weight: 800;
        color: #fff;
        line-height: 1.1;
        margin-bottom: 8px;
    }
    .hero-nature h1 .green { color: #66bb6a; }
    .hero-nature h1 sup { font-size: 0.45em; color: #66bb6a; }
    .hero-nature .nat-desc {
        font-size: 16px;
        color: rgba(255,255,255,0.5);
        line-height: 1.65;
        max-width: 500px;
        margin-bottom: 25px;
    }
    .nat-stats {
        display: flex;
        gap: 30px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }
    .nat-stats .ns-i .ns-n {
        font-size: 28px;
        font-weight: 900;
        color: #fff;
    }
    .nat-stats .ns-i .ns-n span { color: #66bb6a; }
    .nat-stats .ns-i .ns-l {
        font-size: 10px;
        color: rgba(255,255,255,0.3);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 600;
    }
    .nat-btns { display: flex; gap: 10px; flex-wrap: wrap; }
    .btn-green {
        padding: 12px 28px;
        background: linear-gradient(135deg, #2e7d32, #388e3c);
        color: #fff;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        border-radius: 10px;
        transition: all 0.3s;
        box-shadow: 0 4px 20px rgba(46,125,50,0.3);
    }
    .btn-green:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(46,125,50,0.5);
        color: #fff; text-decoration: none;
    }
    .btn-nat-outline {
        padding: 12px 28px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.15);
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        border-radius: 10px;
        transition: all 0.3s;
    }
    .btn-nat-outline:hover {
        background: rgba(255,255,255,0.1);
        color: #fff; text-decoration: none;
    }

    /* Image float right */
    .nat-img-float {
        position: absolute;
        right: 3%;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
        width: 340px;
        height: 340px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid rgba(102,187,106,0.2);
        box-shadow: 0 30px 60px rgba(0,0,0,0.4);
    }
    .nat-img-float img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Green divider */
    .green-strip {
        height: 4px;
        background: linear-gradient(90deg, #1b5e20, #388e3c, #66bb6a, #388e3c, #1b5e20);
    }

    /* Categories */
    .cat-section {
        padding: 50px 0;
        background: #fafdf8;
    }
    .cat-section .cat-title {
        text-align: center;
        font-size: 11px;
        font-weight: 700;
        color: #2e7d32;
        text-transform: uppercase;
        letter-spacing: 3px;
        margin-bottom: 6px;
    }
    .cat-section h2 {
        text-align: center;
        font-size: 28px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 35px;
    }
    .cat-card {
        display: block;
        background: #fff;
        border-radius: 14px;
        padding: 28px 22px;
        margin-bottom: 20px;
        text-decoration: none;
        border: 1px solid #e8f0e6;
        transition: all 0.3s;
        text-align: center;
    }
    .cat-card:hover {
        border-color: #66bb6a;
        box-shadow: 0 12px 35px rgba(46,125,50,0.1);
        transform: translateY(-5px);
        text-decoration: none;
    }
    .cat-card .cc-icon {
        width: 55px; height: 55px;
        margin: 0 auto 14px;
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        transition: all 0.3s;
    }
    .cat-card:hover .cc-icon {
        background: linear-gradient(135deg, #2e7d32, #388e3c);
        transform: scale(1.1) rotate(5deg);
    }
    .cat-card h4 {
        font-size: 15px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 6px;
    }
    .cat-card p {
        font-size: 12px;
        color: #888;
        line-height: 1.5;
        margin: 0;
    }

    /* Tolerance natural */
    .tol-natural {
        padding: 40px 0;
        background: #f0f5ee;
        border-top: 1px solid #dde8da;
    }
    .tol-natural h3 {
        font-size: 20px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 15px;
    }
    .tol-natural p {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
        margin-bottom: 16px;
    }
    .tol-list {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: center;
    }
    .tl-item {
        padding: 6px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        font-family: monospace;
    }
    .tl0 { background: #00ff00; color: #000; }
    .tl1 { background: #00ffff; color: #000; }
    .tl2 { background: #ffff00; color: #000; }
    .tl3 { background: #ff8800; color: #000; }
    .tl4 { background: #ff88ff; color: #000; }
    .tl5 { background: #ff0000; color: #fff; }

    @media (max-width: 991px) {
        .nat-img-float { display: none; }
        .hero-nature h1 { font-size: 32px; }
    }
</style>
@endsection

@section('mainContainer')
    <!-- HERO -->
    <section class="hero-nature">
        <div class="leaf-overlay"></div>
        <div class="container hero-nat-content">
            <div class="row">
                <div class="col-md-7">
                    <div class="nat-badge"><span class="leaf">🌿</span> Productos Naturales · Universidad de Salamanca</div>
                    <h1>NAPROC<sup>13</sup><br><span class="green">Natural Products</span><br>¹³C NMR Database</h1>
                    <p class="nat-desc">{!! trans('applicationResource.sesion.subtituloc') !!}</p>
                    <div class="nat-stats">
                        <div class="ns-i"><div class="ns-n">8<span>,</span>000<span>+</span></div><div class="ns-l">Compuestos</div></div>
                        <div class="ns-i"><div class="ns-n">200<span>K</span></div><div class="ns-l">Desplazamientos</div></div>
                        <div class="ns-i"><div class="ns-n">25<span>+</span></div><div class="ns-l">Años</div></div>
                    </div>
                    <div class="nat-btns">
                        <a href="{{ url('search/byShiftNoPosition') }}" class="btn-green">🔬 {!! trans('applicationResource.submenu.desplazamiento') !!}</a>
                        <a href="{{ url('search/byName') }}" class="btn-nat-outline">{!! trans('applicationResource.submenu.nombre') !!}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="nat-img-float hidden-xs hidden-sm">
            <img src="{!! asset('images/plumeria.jpg') !!}" alt="NAPROC">
        </div>
    </section>

    <div class="green-strip"></div>

    <!-- SEARCH -->
    <section class="cat-section">
        <div class="container">
            <div class="cat-title">Herramientas</div>
            <h2>Tipos de búsqueda</h2>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/byShiftNoPosition') }}" class="cat-card">
                        <div class="cc-icon">🔬</div>
                        <h4>{!! trans('applicationResource.submenu.desplazamiento') !!}</h4>
                        <p>Valores δ(ppm) con tolerancias ±0 a ±5</p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/byName') }}" class="cat-card">
                        <div class="cc-icon">📝</div>
                        <h4>{!! trans('applicationResource.submenu.nombre') !!}</h4>
                        <p>Nombre trivial o sistemático</p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/bySubstructure') }}" class="cat-card">
                        <div class="cc-icon">🧬</div>
                        <h4>{!! trans('applicationResource.submenu.subestructura') !!}</h4>
                        <p>Fragmentos moleculares SMILES</p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/byCarbonType') }}" class="cat-card">
                        <div class="cc-icon">⚗️</div>
                        <h4>{!! trans('applicationResource.submenu.tipocarbono') !!}</h4>
                        <p>CH, CH₂, CH₃ y cuaternarios</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- TOLERANCE -->
    <section class="tol-natural">
        <div class="container text-center">
            <h3>Sistema de tolerancia por colores</h3>
            <p>Clasificación visual de coincidencias con los valores de desplazamiento buscados</p>
            <div class="tol-list">
                <span class="tl-item tl0">±0 Exacto</span>
                <span class="tl-item tl1">±1 ppm</span>
                <span class="tl-item tl2">±2 ppm</span>
                <span class="tl-item tl3">±3 ppm</span>
                <span class="tl-item tl4">±4 ppm</span>
                <span class="tl-item tl5">±5 ppm</span>
            </div>
        </div>
    </section>
    <hr class="invisible">
@endsection

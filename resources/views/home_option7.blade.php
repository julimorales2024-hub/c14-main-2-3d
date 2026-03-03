@extends('layouts.master')

@section('estilos')
<style>
    /* ===== PORTADA 7: ACADÉMICA CLÁSICA CÁLIDA ===== */
    .hero-classic {
        position: relative;
        background: #faf8f5;
        padding: 40px 0 0;
        border-bottom: 1px solid #e8e2d8;
    }
    .hero-classic .top-accent {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 6px;
        background: linear-gradient(90deg, #8b0000, #cb0223, #d4483c, #cb0223, #8b0000);
    }
    .classic-row {
        display: flex;
        align-items: stretch;
        min-height: 400px;
    }
    .classic-text {
        flex: 1;
        padding: 40px 40px 40px 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .classic-img-col {
        flex: 0 0 42%;
        position: relative;
        overflow: hidden;
    }
    .classic-img-col img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .classic-img-col::before {
        content: '';
        position: absolute;
        top: 0; left: 0; bottom: 0;
        width: 80px;
        background: linear-gradient(to right, #faf8f5, transparent);
        z-index: 1;
    }
    .usal-classic {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }
    .usal-classic img { height: 36px; }
    .usal-classic .usal-text {
        font-size: 11px;
        font-weight: 600;
        color: #8b6914;
        text-transform: uppercase;
        letter-spacing: 2px;
        line-height: 1.3;
        border-left: 2px solid #d4a017;
        padding-left: 10px;
    }
    .hero-classic h1 {
        font-size: 42px;
        font-weight: 800;
        color: #2c1810;
        line-height: 1.1;
        margin-bottom: 6px;
        font-family: Georgia, 'Times New Roman', serif;
    }
    .hero-classic h1 sup { font-size: 0.45em; color: #cb0223; }
    .hero-classic h1 .subtitle-line {
        display: block;
        font-size: 20px;
        font-weight: 400;
        color: #8b6914;
        font-style: italic;
        letter-spacing: 0;
        margin-top: 4px;
        font-family: Georgia, 'Times New Roman', serif;
    }
    .classic-desc {
        font-size: 15px;
        color: #7a6e60;
        line-height: 1.7;
        margin-bottom: 25px;
        max-width: 480px;
    }
    .classic-btns { display: flex; gap: 10px; flex-wrap: wrap; }
    .btn-classic-red {
        padding: 12px 30px;
        background: #cb0223;
        color: #fff;
        text-decoration: none;
        font-weight: 700;
        font-size: 13px;
        border-radius: 4px;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 3px 12px rgba(203,2,35,0.25);
    }
    .btn-classic-red:hover { background: #a80020; color: #fff; text-decoration: none; transform: translateY(-1px); }
    .btn-classic-border {
        padding: 12px 30px;
        background: transparent;
        border: 2px solid #c4b89a;
        color: #5a4e3c;
        text-decoration: none;
        font-weight: 700;
        font-size: 13px;
        border-radius: 4px;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .btn-classic-border:hover { border-color: #cb0223; color: #cb0223; text-decoration: none; }

    /* Stats warm */
    .stats-warm {
        background: #2c1810;
        padding: 28px 0;
    }
    .sw-item { text-align: center; }
    .sw-item .sw-n {
        font-size: 30px;
        font-weight: 900;
        color: #fff;
        font-family: Georgia, serif;
    }
    .sw-item .sw-n span { color: #d4a017; }
    .sw-item .sw-l {
        font-size: 10px;
        color: rgba(255,255,255,0.4);
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
    }

    /* Búsquedas */
    .search-warm {
        padding: 50px 0;
        background: #faf8f5;
    }
    .search-warm h2 {
        text-align: center;
        font-size: 28px;
        font-weight: 800;
        color: #2c1810;
        margin-bottom: 8px;
        font-family: Georgia, serif;
    }
    .search-warm .sw-sub {
        text-align: center;
        font-size: 14px;
        color: #a09480;
        margin-bottom: 35px;
        font-style: italic;
    }
    .sw-card {
        display: block;
        background: #fff;
        border: 1px solid #ebe6dc;
        border-radius: 8px;
        padding: 26px 22px;
        margin-bottom: 18px;
        text-decoration: none;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    .sw-card::after {
        content: '→';
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: #ddd;
        transition: all 0.3s;
    }
    .sw-card:hover {
        border-color: #cb0223;
        box-shadow: 0 8px 25px rgba(44,24,16,0.08);
        transform: translateX(4px);
        text-decoration: none;
    }
    .sw-card:hover::after { color: #cb0223; right: 14px; }
    .sw-card .sw-num {
        font-size: 11px;
        font-weight: 800;
        color: #d4a017;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 4px;
    }
    .sw-card h4 {
        font-size: 16px;
        font-weight: 700;
        color: #2c1810;
        margin-bottom: 4px;
    }
    .sw-card p {
        font-size: 12px;
        color: #a09480;
        margin: 0;
        padding-right: 30px;
    }

    /* Tolerance warm */
    .tol-warm {
        padding: 35px 0;
        background: #f3efe8;
        border-top: 1px solid #e8e2d8;
    }
    .tol-warm h3 {
        font-size: 18px;
        font-weight: 700;
        color: #2c1810;
        margin-bottom: 14px;
        font-family: Georgia, serif;
    }
    .tw-badges { display: flex; gap: 8px; flex-wrap: wrap; justify-content: center; }
    .tw-b {
        padding: 5px 14px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 700;
        font-family: monospace;
        border: 1px solid rgba(0,0,0,0.06);
    }
    .tw0 { background: #00ff00; color: #000; }
    .tw1 { background: #00ffff; color: #000; }
    .tw2 { background: #ffff00; color: #000; }
    .tw3 { background: #ff8800; color: #000; }
    .tw4 { background: #ff88ff; color: #000; }
    .tw5 { background: #ff0000; color: #fff; }

    @media (max-width: 768px) {
        .classic-row { flex-direction: column; }
        .classic-img-col { flex: none; height: 220px; }
        .classic-img-col::before { display: none; }
        .classic-text { padding: 30px 15px; }
        .hero-classic h1 { font-size: 30px; }
    }
</style>
@endsection

@section('mainContainer')
    <!-- HERO -->
    <section class="hero-classic">
        <div class="top-accent"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7" style="display:flex;flex-direction:column;justify-content:center;padding:40px 20px 40px 60px;">
                    <div class="usal-classic">
                        <div class="usal-text">Universidad<br>de Salamanca</div>
                    </div>
                    <h1>
                        NAPROC<sup>13</sup>
                        <span class="subtitle-line">Natural Products ¹³C NMR Database</span>
                    </h1>
                    <p class="classic-desc">{!! trans('applicationResource.sesion.subtituloc') !!}</p>
                    <div class="classic-btns">
                        <a href="{{ url('search/byShiftNoPosition') }}" class="btn-classic-red">{!! trans('applicationResource.submenu.desplazamiento') !!}</a>
                        <a href="{{ url('search/byName') }}" class="btn-classic-border">{!! trans('applicationResource.submenu.nombre') !!}</a>
                    </div>
                </div>
                <div class="col-md-5 hidden-xs" style="padding:0;position:relative;min-height:400px;overflow:hidden;">
                    <img src="{!! asset('images/plumeria.jpg') !!}" style="width:100%;height:100%;object-fit:cover;" alt="NAPROC">
                    <div style="position:absolute;top:0;left:0;bottom:0;width:80px;background:linear-gradient(to right,#faf8f5,transparent);z-index:1;"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS -->
    <section class="stats-warm">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 sw-item"><div class="sw-n">8<span>,</span>000<span>+</span></div><div class="sw-l">Compuestos</div></div>
                <div class="col-sm-3 sw-item"><div class="sw-n">200<span>K</span></div><div class="sw-l">Desplazamientos</div></div>
                <div class="col-sm-3 sw-item"><div class="sw-n">4</div><div class="sw-l">Búsquedas</div></div>
                <div class="col-sm-3 sw-item"><div class="sw-n">25<span>+</span></div><div class="sw-l">Años</div></div>
            </div>
        </div>
    </section>

    <!-- BÚSQUEDAS -->
    <section class="search-warm">
        <div class="container">
            <h2>Métodos de búsqueda</h2>
            <p class="sw-sub">Seleccione la herramienta adecuada para su investigación</p>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('search/byShiftNoPosition') }}" class="sw-card">
                        <div class="sw-num">I · Principal</div>
                        <h4>{!! trans('applicationResource.submenu.desplazamiento') !!}</h4>
                        <p>Buscar por valores δ(ppm) con tolerancias ±0 a ±5 y sistema de colores</p>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('search/byName') }}" class="sw-card">
                        <div class="sw-num">II · Texto</div>
                        <h4>{!! trans('applicationResource.submenu.nombre') !!}</h4>
                        <p>Nombre trivial, sistemático, bibliografía y fórmula molecular</p>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('search/bySubstructure') }}" class="sw-card">
                        <div class="sw-num">III · Estructura</div>
                        <h4>{!! trans('applicationResource.submenu.subestructura') !!}</h4>
                        <p>Dibujar o importar fragmentos moleculares SMILES</p>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('search/byCarbonType') }}" class="sw-card">
                        <div class="sw-num">IV · Filtro</div>
                        <h4>{!! trans('applicationResource.submenu.tipocarbono') !!}</h4>
                        <p>Filtrar por CH, CH₂, CH₃ y carbonos cuaternarios</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- TOLERANCE -->
    <section class="tol-warm text-center">
        <div class="container">
            <h3>Niveles de tolerancia</h3>
            <div class="tw-badges">
                <span class="tw-b tw0">±0 Exacto</span>
                <span class="tw-b tw1">±1 ppm</span>
                <span class="tw-b tw2">±2 ppm</span>
                <span class="tw-b tw3">±3 ppm</span>
                <span class="tw-b tw4">±4 ppm</span>
                <span class="tw-b tw5">±5 ppm</span>
            </div>
        </div>
    </section>
    <hr class="invisible">
@endsection

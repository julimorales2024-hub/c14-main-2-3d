@extends('layouts.master')

@section('estilos')
<style>
    /* ===== PORTADA 5: GLASS DARK CON PARTÍCULAS ===== */
    .hero-glass {
        position: relative;
        min-height: 500px;
        background: #0d0d1a;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    .hero-glass canvas {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
    }
    .hero-glass-content {
        position: relative;
        z-index: 2;
        padding: 50px 0;
    }
    .glass-card {
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 24px;
        padding: 45px 40px;
        max-width: 560px;
    }
    .glass-card .uni-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 700;
        color: #ff6b7a;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 18px;
    }
    .glass-card .uni-label::before {
        content: '';
        width: 8px; height: 8px;
        background: #cb0223;
        border-radius: 50%;
        animation: blink 2s ease-in-out infinite;
    }
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }
    .glass-card h1 {
        font-size: 44px;
        font-weight: 800;
        color: #fff;
        line-height: 1.1;
        margin-bottom: 12px;
    }
    .glass-card h1 sup {
        font-size: 0.45em;
        color: #ff4d5e;
        vertical-align: super;
    }
    .glass-card .desc {
        font-size: 15px;
        color: rgba(255,255,255,0.5);
        line-height: 1.65;
        margin-bottom: 25px;
    }
    .glass-stats {
        display: flex;
        gap: 28px;
        margin-bottom: 28px;
        flex-wrap: wrap;
    }
    .gs-item .gs-num {
        font-size: 26px;
        font-weight: 800;
        color: #fff;
    }
    .gs-item .gs-num span { color: #cb0223; }
    .gs-item .gs-lbl {
        font-size: 10px;
        color: rgba(255,255,255,0.3);
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }
    .glass-btns {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .btn-glass-red {
        padding: 12px 26px;
        background: linear-gradient(135deg, #cb0223, #e8163b);
        color: #fff;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        border-radius: 10px;
        transition: all 0.3s;
        box-shadow: 0 4px 20px rgba(203,2,35,0.3);
    }
    .btn-glass-red:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(203,2,35,0.5);
        color: #fff; text-decoration: none;
    }
    .btn-glass-outline {
        padding: 12px 26px;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.15);
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        border-radius: 10px;
        transition: all 0.3s;
    }
    .btn-glass-outline:hover {
        background: rgba(255,255,255,0.12);
        color: #fff; text-decoration: none;
    }

    /* Right side floating elements */
    .float-mol {
        position: absolute;
        right: 8%;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1;
        opacity: 0.12;
    }

    /* Search cards dark */
    .search-dark {
        background: #111122;
        padding: 55px 0;
    }
    .search-dark .sd-head {
        text-align: center;
        margin-bottom: 35px;
    }
    .search-dark .sd-head h2 {
        font-size: 28px;
        font-weight: 800;
        color: #fff;
    }
    .search-dark .sd-head p {
        color: rgba(255,255,255,0.4);
        font-size: 14px;
    }
    .sd-card {
        display: block;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 16px;
        padding: 28px 24px;
        margin-bottom: 20px;
        text-decoration: none;
        transition: all 0.35s;
        position: relative;
        overflow: hidden;
    }
    .sd-card:hover {
        background: rgba(203,2,35,0.08);
        border-color: rgba(203,2,35,0.3);
        transform: translateY(-4px);
        text-decoration: none;
    }
    .sd-card .sd-icon {
        width: 48px; height: 48px;
        background: rgba(203,2,35,0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 14px;
        transition: all 0.3s;
    }
    .sd-card:hover .sd-icon {
        background: rgba(203,2,35,0.2);
        transform: scale(1.1);
    }
    .sd-card h4 {
        font-size: 16px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 6px;
    }
    .sd-card p {
        font-size: 13px;
        color: rgba(255,255,255,0.4);
        line-height: 1.5;
        margin: 0;
    }

    /* Image section */
    .img-section-dark {
        background: #0d0d1a;
        padding: 50px 0;
        border-top: 1px solid rgba(255,255,255,0.05);
    }
    .img-section-dark img {
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        border: 1px solid rgba(255,255,255,0.05);
    }
    .img-section-dark h3 {
        font-size: 24px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 12px;
    }
    .img-section-dark p {
        font-size: 15px;
        color: rgba(255,255,255,0.45);
        line-height: 1.7;
    }
    .tol-row-dark {
        display: flex;
        gap: 6px;
        margin-top: 20px;
        flex-wrap: wrap;
    }
    .tol-pill {
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        font-family: monospace;
    }
    .tp0 { background: #00ff00; color: #000; }
    .tp1 { background: #00ffff; color: #000; }
    .tp2 { background: #ffff00; color: #000; }
    .tp3 { background: #ff8800; color: #000; }
    .tp4 { background: #ff88ff; color: #000; }
    .tp5 { background: #ff0000; color: #fff; }

    @media (max-width: 768px) {
        .glass-card { padding: 30px 20px; }
        .glass-card h1 { font-size: 30px; }
        .float-mol { display: none; }
    }
</style>
@endsection

@section('scripts')
<script>
    // Particle animation
    document.addEventListener('DOMContentLoaded', function() {
        var c = document.getElementById('particleCanvas');
        if (!c) return;
        var ctx = c.getContext('2d');
        var nodes = [];
        function resize() {
            c.width = c.parentElement.offsetWidth;
            c.height = c.parentElement.offsetHeight;
        }
        resize();
        window.addEventListener('resize', resize);
        for (var i = 0; i < 50; i++) {
            nodes.push({
                x: Math.random() * c.width,
                y: Math.random() * c.height,
                vx: (Math.random() - 0.5) * 0.3,
                vy: (Math.random() - 0.5) * 0.3,
                r: Math.random() * 2.5 + 1
            });
        }
        function draw() {
            ctx.clearRect(0, 0, c.width, c.height);
            for (var i = 0; i < nodes.length; i++) {
                for (var j = i + 1; j < nodes.length; j++) {
                    var dx = nodes[i].x - nodes[j].x;
                    var dy = nodes[i].y - nodes[j].y;
                    var d = Math.sqrt(dx*dx + dy*dy);
                    if (d < 130) {
                        ctx.beginPath();
                        ctx.moveTo(nodes[i].x, nodes[i].y);
                        ctx.lineTo(nodes[j].x, nodes[j].y);
                        ctx.strokeStyle = 'rgba(203,2,35,' + (0.06*(1-d/130)) + ')';
                        ctx.stroke();
                    }
                }
            }
            nodes.forEach(function(n) {
                n.x += n.vx; n.y += n.vy;
                if (n.x < 0 || n.x > c.width) n.vx *= -1;
                if (n.y < 0 || n.y > c.height) n.vy *= -1;
                ctx.beginPath();
                ctx.arc(n.x, n.y, n.r, 0, Math.PI*2);
                ctx.fillStyle = 'rgba(203,2,35,0.35)';
                ctx.fill();
            });
            requestAnimationFrame(draw);
        }
        draw();
    });
</script>
@endsection

@section('mainContainer')
    <!-- HERO -->
    <section class="hero-glass">
        <canvas id="particleCanvas"></canvas>
        <div class="container hero-glass-content">
            <div class="row">
                <div class="col-md-7">
                    <div class="glass-card">
                        <div class="uni-label">Universidad de Salamanca</div>
                        <h1>NAPROC<sup>13</sup><br>NMR Database</h1>
                        <p class="desc">{!! trans('applicationResource.sesion.subtituloc') !!}</p>
                        <div class="glass-stats">
                            <div class="gs-item">
                                <div class="gs-num">8<span>,</span>000<span>+</span></div>
                                <div class="gs-lbl">Compuestos</div>
                            </div>
                            <div class="gs-item">
                                <div class="gs-num">200<span>K</span></div>
                                <div class="gs-lbl">Desplazamientos</div>
                            </div>
                            <div class="gs-item">
                                <div class="gs-num">25<span>+</span></div>
                                <div class="gs-lbl">Años</div>
                            </div>
                        </div>
                        <div class="glass-btns">
                            <a href="{{ url('search/byShiftNoPosition') }}" class="btn-glass-red">🔬 Buscar por δ(ppm)</a>
                            <a href="{{ url('search/byName') }}" class="btn-glass-outline">Por nombre</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative molecule -->
        <svg class="float-mol hidden-xs hidden-sm" width="350" height="350" viewBox="0 0 350 350">
            <g stroke="rgba(203,2,35,0.5)" stroke-width="1.5" fill="none">
                <polygon points="175,60 235,95 235,165 175,200 115,165 115,95"/>
                <polygon points="235,165 295,200 295,270 235,305 175,270 175,200"/>
                <polygon points="115,165 175,200 175,270 115,305 55,270 55,200"/>
                <line x1="175" y1="60" x2="175" y2="20"/>
                <line x1="235" y1="95" x2="280" y2="70"/>
                <line x1="115" y1="95" x2="70" y2="70"/>
                <line x1="295" y1="270" x2="330" y2="295"/>
                <line x1="55" y1="270" x2="20" y2="295"/>
            </g>
            <g fill="rgba(203,2,35,0.4)">
                <circle cx="175" cy="60" r="5"/><circle cx="235" cy="95" r="5"/>
                <circle cx="235" cy="165" r="5"/><circle cx="175" cy="200" r="7"/>
                <circle cx="115" cy="165" r="5"/><circle cx="115" cy="95" r="5"/>
                <circle cx="295" cy="200" r="4"/><circle cx="295" cy="270" r="4"/>
                <circle cx="235" cy="305" r="4"/><circle cx="175" cy="270" r="5"/>
                <circle cx="115" cy="305" r="4"/><circle cx="55" cy="270" r="4"/>
                <circle cx="55" cy="200" r="4"/>
            </g>
        </svg>
    </section>

    <!-- SEARCH -->
    <section class="search-dark">
        <div class="container">
            <div class="sd-head">
                <h2>{!! trans('applicationResource.menu.busqueda') !!}</h2>
                <p>Seleccione un tipo de búsqueda para comenzar</p>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/byShiftNoPosition') }}" class="sd-card">
                        <div class="sd-icon">🔬</div>
                        <h4>{!! trans('applicationResource.submenu.desplazamiento') !!}</h4>
                        <p>Valores δ(ppm) con tolerancias ±0 a ±5</p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/byName') }}" class="sd-card">
                        <div class="sd-icon">📝</div>
                        <h4>{!! trans('applicationResource.submenu.nombre') !!}</h4>
                        <p>Nombre trivial o sistemático</p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/bySubstructure') }}" class="sd-card">
                        <div class="sd-icon">🧬</div>
                        <h4>{!! trans('applicationResource.submenu.subestructura') !!}</h4>
                        <p>Fragmentos moleculares SMILES</p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('search/byCarbonType') }}" class="sd-card">
                        <div class="sd-icon">⚗️</div>
                        <h4>{!! trans('applicationResource.submenu.tipocarbono') !!}</h4>
                        <p>CH, CH₂, CH₃ y cuaternarios</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- INFO -->
    <section class="img-section-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <img src="{!! asset('images/plumeria.jpg') !!}" alt="NAPROC" class="img-responsive">
                </div>
                <div class="col-md-5" style="display:flex;flex-direction:column;justify-content:center;padding:30px;">
                    <h3>{!! trans('applicationResource.sesion.tituloc') !!}</h3>
                    <p>{!! trans('applicationResource.sesion.subtituloc') !!}</p>
                    <div class="tol-row-dark">
                        <span class="tol-pill tp0">±0</span>
                        <span class="tol-pill tp1">±1</span>
                        <span class="tol-pill tp2">±2</span>
                        <span class="tol-pill tp3">±3</span>
                        <span class="tol-pill tp4">±4</span>
                        <span class="tol-pill tp5">±5</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="invisible">
@endsection

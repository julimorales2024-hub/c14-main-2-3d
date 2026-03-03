@extends('layouts.master')

@section('estilos')
<style>
    /* ===== PORTADA 1: CIENTÍFICA ACADÉMICA ===== */
    .hero-academic {
        position: relative;
        min-height: 520px;
        background: linear-gradient(135deg, #1a0a0a 0%, #2d0a0a 30%, #0d1117 100%);
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    .hero-academic::before {
        content: '';
        position: absolute;
        top: -50%; right: -20%;
        width: 800px; height: 800px;
        background: radial-gradient(circle, rgba(203,2,35,0.15) 0%, transparent 70%);
        border-radius: 50%;
        animation: pulseGlow 6s ease-in-out infinite;
    }
    .hero-academic::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(203,2,35,0.4), transparent);
    }
    @keyframes pulseGlow {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.05); }
    }

    /* Hexagonal grid background */
    .hex-grid {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image:
            linear-gradient(30deg, rgba(203,2,35,0.03) 12%, transparent 12.5%, transparent 87%, rgba(203,2,35,0.03) 87.5%),
            linear-gradient(150deg, rgba(203,2,35,0.03) 12%, transparent 12.5%, transparent 87%, rgba(203,2,35,0.03) 87.5%),
            linear-gradient(30deg, rgba(203,2,35,0.03) 12%, transparent 12.5%, transparent 87%, rgba(203,2,35,0.03) 87.5%),
            linear-gradient(150deg, rgba(203,2,35,0.03) 12%, transparent 12.5%, transparent 87%, rgba(203,2,35,0.03) 87.5%);
        background-size: 80px 140px;
        background-position: 0 0, 0 0, 40px 70px, 40px 70px;
        opacity: 0.6;
    }

    .hero-content-ac {
        position: relative;
        z-index: 2;
        width: 100%;
        padding: 60px 15px 50px;
    }
    .hero-badge-ac {
        display: inline-block;
        padding: 5px 16px;
        background: rgba(203,2,35,0.12);
        border: 1px solid rgba(203,2,35,0.25);
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        color: #ff6b7a;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 20px;
    }
    .hero-title-ac {
        font-size: 42px;
        font-weight: 700;
        color: #fff;
        line-height: 1.15;
        margin-bottom: 8px;
    }
    .hero-title-ac .sup13 {
        font-size: 0.5em;
        vertical-align: super;
        color: #ff4d5e;
    }
    .hero-subtitle-ac {
        font-size: 18px;
        color: rgba(255,255,255,0.55);
        line-height: 1.6;
        max-width: 520px;
        margin-bottom: 30px;
    }
    .hero-stats-ac {
        display: flex;
        gap: 40px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }
    .stat-item {
        text-align: left;
    }
    .stat-item .stat-num {
        font-size: 32px;
        font-weight: 800;
        color: #fff;
        line-height: 1;
    }
    .stat-item .stat-num span { color: #cb0223; }
    .stat-item .stat-label {
        font-size: 11px;
        color: rgba(255,255,255,0.4);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-top: 4px;
    }
    .hero-btns-ac {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .btn-hero-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        background: #cb0223;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        border-radius: 8px;
        transition: all 0.3s;
        box-shadow: 0 4px 20px rgba(203,2,35,0.3);
    }
    .btn-hero-primary:hover {
        background: #e8163b;
        transform: translateY(-2px);
        color: #fff;
        text-decoration: none;
        box-shadow: 0 8px 25px rgba(203,2,35,0.4);
    }
    .btn-hero-secondary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.12);
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        border-radius: 8px;
        transition: all 0.3s;
    }
    .btn-hero-secondary:hover {
        background: rgba(255,255,255,0.1);
        color: #fff;
        text-decoration: none;
    }

    /* Molecule illustration */
    .hero-molecule {
        position: absolute;
        right: 5%;
        top: 50%;
        transform: translateY(-50%);
        width: 380px;
        height: 380px;
        opacity: 0.15;
    }

    /* ===== FEATURES ROW ===== */
    .features-row {
        background: #f7f7f8;
        padding: 50px 0;
    }
    .feature-box {
        text-align: center;
        padding: 30px 20px;
        border-radius: 12px;
        transition: all 0.3s;
        margin-bottom: 15px;
    }
    .feature-box:hover {
        background: #fff;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        transform: translateY(-4px);
    }
    .feature-icon-ac {
        width: 56px; height: 56px;
        margin: 0 auto 16px;
        background: rgba(203,2,35,0.08);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
    }
    .feature-box h4 {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 8px;
    }
    .feature-box p {
        font-size: 13px;
        color: #666;
        line-height: 1.6;
    }

    /* ===== INFO SECTION ===== */
    .info-section {
        padding: 50px 0;
        background: #fff;
    }
    .info-section h3 {
        font-size: 28px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 15px;
    }
    .info-section p {
        font-size: 15px;
        color: #555;
        line-height: 1.7;
    }
    .info-img {
        max-height: 280px;
        border-radius: 16px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.12);
    }

    @media (max-width: 768px) {
        .hero-title-ac { font-size: 28px; }
        .hero-stats-ac { gap: 20px; }
        .stat-item .stat-num { font-size: 24px; }
        .hero-molecule { display: none; }
    }
</style>
@endsection

@section('mainContainer')
    <!-- HERO -->
    <section class="hero-academic">
        <div class="hex-grid"></div>
        <div class="container hero-content-ac">
            <div class="row">
                <div class="col-md-7">
                    <div class="hero-badge-ac">🧬 Universidad de Salamanca</div>
                    <h1 class="hero-title-ac">
                        Natural Products<br>
                        <sup class="sup13">13</sup>C NMR Database
                    </h1>
                    <p class="hero-subtitle-ac">
                        {!! trans('applicationResource.sesion.subtituloc') !!}
                    </p>
                    <div class="hero-stats-ac">
                        <div class="stat-item">
                            <div class="stat-num">8<span>,</span>000<span>+</span></div>
                            <div class="stat-label">{!! trans('applicationResource.sesion.tituloc') !!}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-num">200<span>K+</span></div>
                            <div class="stat-label">Desplazamientos ¹³C</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-num">25<span>+</span></div>
                            <div class="stat-label">Años de datos</div>
                        </div>
                    </div>
                    <div class="hero-btns-ac">
                        <a href="{{ url('search/byShiftNoPosition') }}" class="btn-hero-primary">
                            🔬 {!! trans('applicationResource.submenu.desplazamiento') !!}
                        </a>
                        <a href="{{ url('search/byName') }}" class="btn-hero-secondary">
                            🔎 {!! trans('applicationResource.submenu.nombre') !!}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative molecule SVG -->
        <svg class="hero-molecule hidden-xs hidden-sm" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g stroke="rgba(203,2,35,0.6)" stroke-width="1.5">
                <polygon points="200,80 260,115 260,185 200,220 140,185 140,115"/>
                <polygon points="260,185 320,220 320,290 260,325 200,290 200,220"/>
                <polygon points="140,185 200,220 200,290 140,325 80,290 80,220"/>
                <line x1="200" y1="80" x2="200" y2="30"/>
                <line x1="260" y1="115" x2="310" y2="90"/>
                <line x1="140" y1="115" x2="90" y2="90"/>
                <line x1="320" y1="290" x2="360" y2="320"/>
                <line x1="80" y1="290" x2="40" y2="320"/>
            </g>
            <g fill="rgba(203,2,35,0.5)">
                <circle cx="200" cy="80" r="6"/><circle cx="260" cy="115" r="6"/>
                <circle cx="260" cy="185" r="6"/><circle cx="200" cy="220" r="8"/>
                <circle cx="140" cy="185" r="6"/><circle cx="140" cy="115" r="6"/>
                <circle cx="320" cy="220" r="5"/><circle cx="320" cy="290" r="5"/>
                <circle cx="260" cy="325" r="5"/><circle cx="200" cy="290" r="6"/>
                <circle cx="140" cy="325" r="5"/><circle cx="80" cy="290" r="5"/>
                <circle cx="80" cy="220" r="5"/>
            </g>
            <g fill="rgba(255,70,70,0.4)" font-size="10" font-family="monospace">
                <text x="195" y="75">C</text><text x="255" y="110">C</text>
                <text x="255" y="182">N</text><text x="195" y="218">C</text>
                <text x="310" y="218">O</text><text x="70" y="218">OH</text>
            </g>
        </svg>
    </section>

    <!-- FEATURES -->
    <section class="features-row">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="feature-box">
                        <div class="feature-icon-ac">🔬</div>
                        <h4>{!! trans('applicationResource.submenu.desplazamiento') !!}</h4>
                        <p>Busca compuestos por valores δ(ppm) con tolerancias ±0 a ±6</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-box">
                        <div class="feature-icon-ac">⚗️</div>
                        <h4>{!! trans('applicationResource.submenu.tipocarbono') !!}</h4>
                        <p>Filtra por CH, CH₂, CH₃ y carbonos cuaternarios</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-box">
                        <div class="feature-icon-ac">🧬</div>
                        <h4>{!! trans('applicationResource.submenu.subestructura') !!}</h4>
                        <p>Busca por fragmentos moleculares SMILES</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-box">
                        <div class="feature-icon-ac">📊</div>
                        <h4>Espectros 2D/3D</h4>
                        <p>Visualiza espectros DEPT interactivos</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INFO -->
    <section class="info-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{!! asset('images/plumeria.jpg') !!}" alt="NAPROC 13" class="img-responsive info-img center-block">
                </div>
                <div class="col-md-6" style="display:flex;flex-direction:column;justify-content:center;padding:30px;">
                    <h3>{!! trans('applicationResource.sesion.tituloc') !!}</h3>
                    <p>{!! trans('applicationResource.sesion.subtituloc') !!}</p>
                </div>
            </div>
        </div>
    </section>
@endsection

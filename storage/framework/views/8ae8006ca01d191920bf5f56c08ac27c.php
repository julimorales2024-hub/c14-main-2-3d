<?php $__env->startSection('scripts'); ?>
    
    <script src="<?php echo e(asset('js/highcharts/highcharts.js')); ?>"></script>
    <script src="<?php echo e(asset('js/highcharts/highcharts-3d.js')); ?>"></script>
    <script src="<?php echo e(asset('js/highcharts/exporting.js')); ?>"></script>
    <script src="//raw.githubusercontent.com/exupero/saveSvgAsPng/gh-pages/src/saveSvgAsPng.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.0/jspdf.debug.js"></script>
    <script src="<?php echo e(asset('jsme/jsme.nocache.js')); ?>"></script>
    <script src="<?php echo e(asset('js/svg_to_pdf.js')); ?>"></script>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>
        var jme = "<?php echo $molecule->jmeDisplacement ?? ''; ?>";
        var jsmeApplet;
        var chartInstances = {};
        var chartConfigs = {};
        var is3D = {};

        $(document).ready(init);

        /**
         * Funcion encargada de cargar el JSME
         */
        function jsmeOnLoad() {
            jsmeApplet = new JSApplet.JSME("jsme_container", "350px", "350px", {
                "options": "depict,xbutton,atommoveframe,number"
            });
            jsmeApplet.readMolecule(jme);
            <?php if(isset($atomos)): ?>
                jsmeApplet.setAtomBackgroundColors(1, "<?php echo e($atomos); ?>");
            <?php endif; ?>
        }

        /**
         * Procesa las series para convertir strings de funciones a funciones reales
         */
        function processSeriesEvents(series) {
            if (series) {
                series.forEach(function(serie) {
                    if (serie.data) {
                        serie.data.forEach(function(point) {
                            if (point.events) {
                                if (typeof point.events.mouseOver === 'string') {
                                    point.events.mouseOver = eval('(' + point.events.mouseOver + ')');
                                }
                                if (typeof point.events.mouseOut === 'string') {
                                    point.events.mouseOut = eval('(' + point.events.mouseOut + ')');
                                }
                            }
                        });
                    }
                });
            }
            return series;
        }

        /**
         * Renderiza un grafico en 2D o 3D
         */
        function renderChart(containerId, config, enable3D) {
            var plotOptions = {};
            if (config.plotOptions && config.plotOptions.column) {
                plotOptions.column = $.extend(true, {}, config.plotOptions.column);
            } else {
                plotOptions.column = {
                    dataLabels: {
                        enabled: true,
                        rotation: -45,
                        y: -20,
                        crop: false,
                        overflow: 'none',
                        format: '{x}'
                    }
                };
            }

            if (enable3D) {
                plotOptions.column.depth = 35;
                plotOptions.column.groupZPadding = 10;
            }

            var chartOptions = {
                chart: {
                    type: config.type || 'column',
                    zoomType: config.zoomType || 'xy',
                    options3d: {
                        enabled: enable3D,
                        alpha: 15,
                        beta: 20,
                        depth: 60,
                        viewDistance: 25
                    }
                },
                title: {
                    text: config.title || null
                },
                subtitle: config.subtitle ? { text: config.subtitle } : undefined,
                xAxis: config.xAxis || {
                    reversed: true,
                    min: 0,
                    max: 235,
                    tickInterval: 20
                },
                yAxis: config.yAxis || {
                    labels: { enabled: false },
                    title: { text: null }
                },
                tooltip: config.tooltip || {
                    headerFormat: '',
                    pointFormat: '<b>{point.x}</b> ppm<br/><b>Num: {point.id}</b><br/>'
                },
                plotOptions: plotOptions,
                series: config.series || []
            };

            if (chartInstances[containerId]) {
                chartInstances[containerId].destroy();
            }

            chartInstances[containerId] = new Highcharts.Chart(containerId, chartOptions);
        }

        /**
         * Alterna entre vista 2D y 3D para un grafico especifico
         */
        function toggle3D(containerId) {
            is3D[containerId] = !is3D[containerId];
            var config = chartConfigs[containerId];
            renderChart(containerId, config, is3D[containerId]);

            var btn = document.getElementById('btn3d_' + containerId);
            if (btn) {
                if (is3D[containerId]) {
                    btn.innerHTML = '<i class="fa fa-cube"></i> 2D';
                    btn.classList.remove('btn-3d-off');
                    btn.classList.add('btn-3d-on');
                } else {
                    btn.innerHTML = '<i class="fa fa-cube"></i> 3D';
                    btn.classList.remove('btn-3d-on');
                    btn.classList.add('btn-3d-off');
                }
            }
        }

        /**
         * Alterna todos los graficos entre 2D y 3D
         */
        var allIn3D = false;
        function toggleAll3D() {
            allIn3D = !allIn3D;
            var containers = ['topLinechart', 'middleLinechart', 'lowerLinechart'];
            containers.forEach(function(containerId) {
                if (chartConfigs[containerId]) {
                    is3D[containerId] = allIn3D;
                    renderChart(containerId, chartConfigs[containerId], allIn3D);

                    var btn = document.getElementById('btn3d_' + containerId);
                    if (btn) {
                        if (allIn3D) {
                            btn.innerHTML = '<i class="fa fa-cube"></i> 2D';
                            btn.classList.remove('btn-3d-off');
                            btn.classList.add('btn-3d-on');
                        } else {
                            btn.innerHTML = '<i class="fa fa-cube"></i> 3D';
                            btn.classList.remove('btn-3d-on');
                            btn.classList.add('btn-3d-off');
                        }
                    }
                }
            });

            var globalBtn = document.getElementById('btnToggleAll3D');
            if (globalBtn) {
                if (allIn3D) {
                    globalBtn.innerHTML = '<i class="fa fa-cube"></i> Todo en 2D';
                    globalBtn.classList.remove('btn-3d-off');
                    globalBtn.classList.add('btn-3d-on');
                } else {
                    globalBtn.innerHTML = '<i class="fa fa-cube"></i> Todo en 3D';
                    globalBtn.classList.remove('btn-3d-on');
                    globalBtn.classList.add('btn-3d-off');
                }
            }
        }

        /**
         * Funcion que inicia lo necesario en la carga de la pagina
         */
        function init() {
            html2canvas(document.body, {
                onrendered(canvas) {
                    var link = document.getElementById('download');
                    if (link) {
                        var image = canvas.toDataURL();
                        link.href = image;
                        link.download = 'screenshot.png';
                    }
                }
            });

            /** Para arrastrar la molecula */
            $('#jsme_container').on('mousedown', function(e) {
                $(this).addClass('active');
                var oTop = e.pageY - $('.active').offset().top;
                var oLeft = e.pageX - $('.active').offset().left;

                $(this).parents().on('mousemove', function(e) {
                    $('.active').offset({
                        top: e.pageY - oTop,
                        left: e.pageX - oLeft
                    }).on('mouseup', function() {
                        $(this).removeClass('active');
                    });
                });
                return false;
            });

            // Renderizar graficos usando los arrays de configuracion
            <?php $__currentLoopData = $charts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                (function() {
                    var chartConfig = <?php echo json_encode($chart, 15, 512) ?>;
                    chartConfig.series = processSeriesEvents(chartConfig.series);

                    // Guardar configuracion y estado
                    chartConfigs[chartConfig.renderTo] = chartConfig;
                    is3D[chartConfig.renderTo] = false;

                    // Renderizar en 2D inicialmente
                    renderChart(chartConfig.renderTo, chartConfig, false);
                })();
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        }
    </script>

    <style>
        .chart-wrapper {
            position: relative;
            margin-bottom: 15px;
        }
        .chart-controls {
            position: absolute;
            right: 15px;
            top: 5px;
            z-index: 10;
        }
        .btn-3d-off {
            background-color: #5bc0de;
            border-color: #46b8da;
            color: #fff;
            font-size: 11px;
            padding: 3px 10px;
            border-radius: 3px;
            cursor: pointer;
            border: 1px solid #46b8da;
            transition: all 0.3s ease;
        }
        .btn-3d-off:hover {
            background-color: #31b0d5;
            border-color: #269abc;
            color: #fff;
        }
        .btn-3d-on {
            background-color: #f0ad4e;
            border-color: #eea236;
            color: #fff;
            font-size: 11px;
            padding: 3px 10px;
            border-radius: 3px;
            cursor: pointer;
            border: 1px solid #eea236;
            transition: all 0.3s ease;
        }
        .btn-3d-on:hover {
            background-color: #ec971f;
            border-color: #d58512;
            color: #fff;
        }
        .btn-3d-global {
            font-size: 12px;
            padding: 5px 15px;
            margin-bottom: 5px;
        }
        /* Separar menu exportacion de Highcharts */
        .highcharts-exporting-group {
            transform: translate(-50px, 0);
        }
        /* Responsive */
        #topLinechart, #middleLinechart, #lowerLinechart {
            min-width: 300px;
            height: 300px;
            width: 100% !important;
            margin: 0 auto;
        }
        #jsme_container {
            max-width: 350px;
            max-height: 350px;
        }
        @media (max-width: 768px) {
            #topLinechart, #middleLinechart, #lowerLinechart {
                height: 250px;
            }
            #jsme_container {
                position: relative !important;
                margin: 0 auto 15px auto;
                display: block;
            }
            .chart-controls {
                right: 40px;
                top: 5px;
            }
        }
        @media print {
            .chart-controls, .btn-3d-global-wrapper {
                display: none !important;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContainer'); ?>
    <section class="container main-container" id="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-0 col-md-12">

                <!--si la busqueda se hizo por desplazamiento pone la tabla de tolerancias-->
                <?php if(isset($atomos)): ?>
                    
                <?php endif; ?>

                
                <div class="text-right btn-3d-global-wrapper" style="margin-bottom: 5px;">
                    <button id="btnToggleAll3D" class="btn-3d-off btn-3d-global" onclick="toggleAll3D()">
                        <i class="fa fa-cube"></i> Todo en 3D
                    </button>
                </div>

                <hr class="invisible" />
                <div class="hidden-xs" style="border: 2px solid #cb0223; position: absolute; cursor: move; z-index: 20; width: 350px; height: 350px; overflow: hidden;"
                    id="jsme_container"></div>

                
                <div class="chart-wrapper">
                    <div class="chart-controls">
                        <button id="btn3d_topLinechart" class="btn-3d-off" onclick="toggle3D('topLinechart')">
                            <i class="fa fa-cube"></i> 3D
                        </button>
                    </div>
                    <div class="row" id="topLinechart" style="min-width: 300px; height: 300px; margin: 0 auto"></div>
                </div>

                
                <div class="chart-wrapper">
                    <div class="chart-controls">
                        <button id="btn3d_middleLinechart" class="btn-3d-off" onclick="toggle3D('middleLinechart')">
                            <i class="fa fa-cube"></i> 3D
                        </button>
                    </div>
                    <div class="row" id="middleLinechart" style="min-width: 300px; height: 300px; margin: 0 auto"></div>
                </div>

                
                <div class="chart-wrapper">
                    <div class="chart-controls">
                        <button id="btn3d_lowerLinechart" class="btn-3d-off" onclick="toggle3D('lowerLinechart')">
                            <i class="fa fa-cube"></i> 3D
                        </button>
                    </div>
                    <div class="row" id="lowerLinechart" style="min-width: 300px; height: 300px; margin: 0 auto"></div>
                </div>

                <div class="row">
                    <div class="col-xs-12 text-center">
                        <button id="btnPrint" class="btn btn-danger" onclick="window.print()">
                            <i class="fa fa-btn fa-user"></i><?php echo e(trans('applicationResource.menu.print')); ?>

                        </button>
                        <button class="btn btn-danger" onclick="window.history.back()">
                            <i class="fa fa-btn fa-user"></i><?php echo e(trans('applicationResource.button.back')); ?>

                        </button>
                    </div>
                </div>

                <hr class="invisible"/>

            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\C14-main-2\resources\views/search/spectrum.blade.php ENDPATH**/ ?>
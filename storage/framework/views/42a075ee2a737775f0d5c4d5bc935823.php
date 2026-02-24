<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('//code.highcharts.com/4.1.8/highcharts.js')); ?>"></script>
    <script src="<?php echo e(asset('//code.highcharts.com/4.1.8/modules/exporting.js')); ?>"></script>
    <script src="<?php echo e(asset('//raw.githubusercontent.com/exupero/saveSvgAsPng/gh-pages/src/saveSvgAsPng.js')); ?>"></script>
    <script src="<?php echo e(asset('//cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.0/jspdf.debug.js')); ?>"></script>
    <script src="<?php echo e(asset('jsme/jsme.nocache.js')); ?>"></script>
    <script src="<?php echo e(asset('js/svg_to_pdf.js')); ?>"></script>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>
        var jme = "<?php echo $molecule->jmeDisplacement; ?>";
        var jsmeApplet;

        $(document).ready(init);

        /**
         * Funcion encargada de cargar el JSME
         */
        function jsmeOnLoad() {

            jsmeApplet = new JSApplet.JSME("jsme_container", "350px", "350px", {
                "options": "depict",
            });
            jsmeApplet.readMolecule(jme);
            <?php if(isset($atomos)): ?>
                jsmeApplet.setAtomBackgroundColors(1, "<?php echo e($atomos); ?>");
            <?php endif; ?>
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

            // CORRECCIÓN: Renderizar gráficos usando los arrays de configuración
            <?php $__currentLoopData = $charts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                (function() {
                    var chartConfig = <?php echo json_encode($chart, 15, 512) ?>;
                    
                    // Procesar las series para convertir strings de funciones a funciones reales
                    if (chartConfig.series) {
                        chartConfig.series.forEach(function(serie) {
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
                    
                    Highcharts.chart(chartConfig.renderTo, {
                        chart: {
                            type: chartConfig.type,
                            zoomType: chartConfig.zoomType
                        },
                        title: {
                            text: chartConfig.title
                        },
                        subtitle: chartConfig.subtitle ? { text: chartConfig.subtitle } : undefined,
                        xAxis: chartConfig.xAxis,
                        yAxis: chartConfig.yAxis,
                        tooltip: chartConfig.tooltip,
                        plotOptions: chartConfig.plotOptions,
                        series: chartConfig.series
                    });
                })();
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContainer'); ?>
    <section class="container main-container" id="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-0 col-md-12">

                <!--si la busqueda se hizo por desplazamiento pone la tabla de tolerancias-->
                <?php if(isset($atomos)): ?>
                    
                <?php endif; ?>


                <hr class="invisible" />
                <div class="hidden-xs" style="border: 2px solid #cb0223; position: absolute; cursor: move; z-index: 20"
                    id="jsme_container"></div>
                <div class="row" id="topLinechart" style="min-width: 300px; height: 300px; margin: 0 auto"></div>
                <div class="row" id="middleLinechart" style="min-width: 300px; height: 300px; margin: 0 auto"></div>
                <div class="row" id="lowerLinechart" style="min-width: 300px; height: 300px; margin: 0 auto"></div>

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
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/usuario/Downloads/C14-CORREGIDO/C14-main-2/resources/views/search/spectrum.blade.php ENDPATH**/ ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/spin.js')); ?>"></script>
    <script src="<?php echo e(asset('js/loadingScreen.js')); ?>"></script>
    <script src="<?php echo e(asset('jsme/jsme.nocache.js')); ?>"></script>
    <script src="<?php echo e(asset('jsme/hideResult.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $('a').not($('#resultadosnumdesp a, .dropdown-toggle')).click(showLoading);
        });
    </script>

    <script>

        //Numero de moleculas
        var jsmeApplets = new Array();
        var type = 1; //1.jme, 2.jmeNum, 3.Desp
        $(document).ready(init);

        /**
         * Funcion que carga las moleculas
         */
        function loadJmeFile() {
            switch (type) {
                case 1: //jme
                    <?php for($i = 0; $i < sizeof($molecules); $i++): ?>
                        jsmeApplets["<?php echo $i; ?>"].readMolecule("<?php echo $molecules[$i]->jme; ?>");
                    <?php endfor; ?>
                    break;
                case 2: //jmeNum
                    <?php for($i = 0; $i < sizeof($molecules); $i++): ?>
                        jsmeApplets["<?php echo $i; ?>"].readMolecule("<?php echo $molecules[$i]->jmeNumeration; ?>");
                    <?php endfor; ?>
                    break;
                case 3: //Desp
                    <?php for($i = 0; $i < sizeof($molecules); $i++): ?>
                        jsmeApplets["<?php echo $i; ?>"].readMolecule("<?php echo $molecules[$i]->jmeDisplacement; ?>");

                        <?php
                            // echo "*DATOS<pre>";
                            // print_r($data['datos']);
                            // echo "</pre>*";
                        ?>


                        /**si la busqueda se hizo por desplazamiento la variable $data['datos'] (en la que
                         * se encuentran todos los datos necesarios) existira*/
                        <?php if(isset($data['datos'])): ?>
                            index = "";

                            // Fix: Para corregir el problema de las busquedas combinadas por 1not2
                            <?php if(isset($data['datos'][$molecules[$i]->id])): ?>
                                // /Fix: Para corregir el problema de las busquedas combinadas por 1not2

                                <?php for($h = 0; $h < sizeof($data['datos'][$molecules[$i]->id]); $h++): ?>

                                    <?php for($x = 0; $x < sizeof($data['datos'][$molecules[$i]->id][$h]); $x++): ?>

                                        diferencia = <?php echo e($data['desplazamientos'][$molecules[$i]->id][$h]); ?> + 1;

                                        switch (diferencia) {
                                            case 1:
                                                diferencia = 5;
                                                break;
                                            case 2:
                                                diferencia = 4;
                                                break;
                                            case 3:
                                                diferencia = 3;
                                                break;
                                            case 4:
                                                diferencia = 2;
                                                break;
                                            case 5:
                                                diferencia = 1;
                                                break;
                                            case 6:
                                                diferencia = 6;
                                                break;
                                        }

                                        index += <?php echo e($data['datos'][$molecules[$i]->id][$h][$x]); ?> + "," + diferencia + ",";

                                        saveAtomNumberProperties(<?php echo e($i); ?>,
                                            <?php echo e($data['numeracion'][$molecules[$i]->id][$h]); ?>, diferencia);
                                    <?php endfor; ?>
                                <?php endfor; ?>
                            <?php endif; ?>



                            guardarIndex(index, <?php echo e($i); ?>);
                            jsmeApplets["<?php echo $i; ?>"].setAtomBackgroundColors(1, index);
                        <?php endif; ?>
                    <?php endfor; ?>
                    break;
            }
        }

        /**guarda en el formulario de spectrum datos de que atomo es el que se tendra que pintar**/
        function guardarIndex(index, pos) {
            spectrum = document.getElementById("formuOcultoSpec" + pos);

            oculto = document.createElement("input");
            oculto.setAttribute("type", 'text');
            //oculto.setAttribute("id","index");
            oculto.setAttribute("name", "atomos");
            oculto.setAttribute("value", index);
            oculto.hidden = true;

            spectrum.appendChild(oculto);
            addToProperties(index, pos);

        }
        /**guarda en el formulario de properties datos de que atomo es el que se tendra que pintar**/
        function addToProperties(index, pos) {
            properties = document.getElementById("formuOcultoProp" + pos);

            oculto = document.createElement("input");
            oculto.setAttribute("type", 'text');
            //oculto.setAttribute("id","index");
            oculto.setAttribute("name", "atomos");
            oculto.setAttribute("value", index);
            oculto.hidden = true;

            properties.appendChild(oculto);
        }

        /**guardara el numero del atomo y la tolerancia a pintar en la vista properties**/
        function saveAtomNumberProperties(pos, number, diferencia) {
            properties = document.getElementById("formuOcultoProp" + pos);

            numAto = document.createElement("input");
            numAto.setAttribute("type", 'text');
            //oculto.setAttribute("id","index");
            numAto.setAttribute("name", "numeracion[]");
            numAto.setAttribute("value", number);
            numAto.hidden = true;

            properties.appendChild(numAto);

            dif = document.createElement("input");
            dif.setAttribute("type", 'text');
            dif.setAttribute("name", "diferencia[]");
            dif.setAttribute("value", diferencia);
            dif.hidden = true;

            properties.appendChild(dif);
        }

        /**
         * Funcion que inicia tod lo necesario
         */
        function init() {
            /*$("#numeration").click(loadNumeration);
            $("#shift").click(loadDisplacement);
            $("#noNumeration").click(loadNoNumeration);*/

            //mantener el numero de compuestos
            var nMolecules = "<?php echo $count; ?>";
            if (nMolecules != 0) {
                sessionStorage.setItem("numero", nMolecules);
            }
            if (nMolecules == 0) {
                sessionStorage.setItem("numero", 0);
            }


            //mantener los checkboxes apretados al cambiar de pagina
            checkboxValues = JSON.parse(localStorage.getItem('checkboxValues')) || {};
            $checkboxes = $("#resultadosnumdesp :radio");


            $checkboxes.on("change", function() {
                $checkboxes.each(function() {
                    checkboxValues[this.id] = this.checked;
                });
                localStorage.setItem("checkboxValues", JSON.stringify(checkboxValues));
            });
            $.each(checkboxValues, function(key, value) {
                $("#" + key).prop('checked', value);
            });
            numerar = document.getElementById('numeration2');
            numerar.addEventListener("change", cambiar, false);

            desplazar = document.getElementById('desplazamiento2');
            desplazar.addEventListener("change", cambiar, false);

            noNumerar = document.getElementById('nonumeration2');
            noNumerar.addEventListener("change", cambiar, false);
            //cambiar();
        }

        function cambiar() {
            if (numerar.checked) {
                loadNumeration();
            }
            if (desplazar.checked) {
                loadDisplacement();
            }
            if (noNumerar.checked) {
                loadNoNumeration();
            }
        }

        /**
         * Cambia al formato numerado
         */
        function loadNumeration() {
            type = 2;
            loadJmeFile();
            return false;
        }

        /**
         * Cambia al formato con desplazamiento
         */
        function loadDisplacement() {
            type = 3;
            loadJmeFile();
            return false;
        }

        /**
         * Cambia al formato sin numerar
         */
        function loadNoNumeration() {
            type = 1;
            loadJmeFile();
            return false;
        }

        /**
         * Inicializa el jsme
         */
        function jsmeOnLoad() {

            <?php for($i = 0; $i < sizeof($molecules); $i++): ?>

                var startingStructure = "<?php echo e($molecules[$i]->jme); ?>";

                jsmeApplets["<?php echo $i; ?>"] = new JSApplet.JSME("jsme_container" + "<?php echo e($i); ?>", "100%", "100%", {
                    "options": "depict, number",
                    "jme": startingStructure,
                });

            <?php endfor; ?>
            cambiar();
        }

        function showNext() {
            var element = document.getElementById("mol<?php echo e($i + 1); ?>");
        }

        // Eliminado: uso de sessionStorage para "selected molecules"
        var selectedMols = [];
        
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContainer'); ?>
    <section class="container main-container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-0 col-md-12">

                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h4><b><?php echo trans('applicationResource.result.results'); ?>: <span id="numMol"><?php echo e(count($selectedMols)); ?></span> <?php echo trans('applicationResource.result.compounds'); ?></b></h4>
                    </div>
                </div>

                <div class="row combinations" id="resultadosnumdesp">
                    <div class="col-xs-12 text-center">
                        <input type="radio" id="numeration2" name="resultados" /><label
                            for="numeration2"><?php echo trans('applicationResource.result.numeration'); ?></label>
                        <input type="radio" id="desplazamiento2" name="resultados" /><label
                            for="desplazamiento2">&delta;(ppm)</label>
                        <input type="radio" id="nonumeration2" name="resultados" /><label
                            for="nonumeration2"><?php echo trans('applicationResource.result.noNumeration'); ?></label>
                    </div>
                </div>

                <?php if(isset($data['desplazamientos'])): ?>
                    <?php echo $__env->make('layouts.toleranceTable', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endif; ?>

                <div class="row">
                    <?php for($i = 0; $i < sizeof($molecules); $i++): ?>
                        <div class="col-xs-12 col-sm-6 col-md-4 text-center" id="mol<?php echo e($i); ?>" style="margin-bottom: 30px;">
                            <div class="jme jme2" id="jsme_container<?php echo e($i); ?>"></div>

                            <div class="descripcion">
                                <!--formulario en el que se van a guardar los datos ocultos para pasarselos al spectrum-->
                                <form id="formuOcultoProp<?php echo e($i); ?>" role="form" method="GET"
                                    action="<?php echo e(url('properties/' . $molecules[$i]->id)); ?>">
                                    <button class=" btn-danger" type="submit" name="submitBtn" value="submitBtn"
                                        style="padding: 2px; border-radius: 5px">
                                        <i class="fa fa-btn fa-user"></i><?php echo trans('applicationResource.properties.properties'); ?>

                                    </button>
                                </form>

                                <!--formulario en el que se van a guardar los datos ocultos para pasarselos al spectrum-->
                                <form id="formuOcultoSpec<?php echo e($i); ?>" role="form" method="GET"
                                    action="<?php echo e(url('spectrum/' . $molecules[$i]->id)); ?>">
                                    <button class=" btn-danger" type="submit" name="submitBtn" value="submitBtn"
                                        style="padding: 2px; border-radius: 5px">
                                        <i class="fa fa-btn fa-user"></i><?php echo trans('applicationResource.molecule.spectrum'); ?>

                                    </button>
                                </form>

                                <?php if(isset($molecules[$i]->doi) && !empty($molecules[$i]->doi)): ?>
                                    <a href="<?php echo e($molecules[$i]->doi); ?>" class="btn btn-danger" target="_blank"
                                        style="padding: 1px; border-radius: 5px">DOI</a>
                                <?php endif; ?>
                                <?php if(Auth::user() && Auth::user()->allowed): ?>
                                    <span> <?php echo e($molecules[$i]->reference); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="descripcion">
                                <span> <?php echo e($molecules[$i]->family); ?></span>
                                <span> <?php echo e($molecules[$i]->subFamily); ?></span>
                                <span> <?php echo e($molecules[$i]->subSubFamily); ?></span>
                                <span> <?php echo e($molecules[$i]->solvent); ?> </span>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\C14-main-2\resources\views/search/compareResults.blade.php ENDPATH**/ ?>
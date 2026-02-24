<?php

namespace App\Http\Controllers;

use App\Carbon;
use App\Http\Requests\Request;
use App\Molecule;

class SpectrumController extends Controller
{
    public function get($id) {
        //Alturas de los carbonos
        $size = [
            'C' => 50,
            'CH' => 120,
            'CH2' => 100,
            'CH3' => 110,
        ];

        $data['molecule'] = Molecule::find($id);
        $data['charts'][] = $this->getLowerChart($id, $size);
        $data['charts'][] = $this->getMiddleChart($id, $size);
        $data['charts'][] = $this->getTopChart($id, $size);
        if(isset($_GET['atomos'])){
            $data['atomos']=$_GET['atomos'];
        }

        return view('search.spectrum', $data);
    }

    /**
     * Devuelve la formula con formato
     * @param $molecule
     * @return string
     */
    public function getFormula($molecule) {
        $form = "";
        for ($i = 0; $i < strlen($molecule->molecularFormula); $i++) {
            if (is_numeric(substr($molecule->molecularFormula, $i, 1))) {
                $form .= "<sub>".substr($molecule->molecularFormula, $i, 1)."</sub>";
            } else {
                $form .= substr($molecule->molecularFormula, $i, 1);
            }
        }
        return $form;
    }

    /**
     * Devuelve el disolvente a partir de la letra de la base de datos
     * @param $char
     * @return string
     */
    public function getThinner($char) {
        if(strpos(trans('applicationResource.solvent.'.$char), 'applicationResource') != null) {
            return $char;
        }
        else {
            return trans('applicationResource.solvent.'.$char);
        }
    }

    /**
     * Devuelve el grafico que representa todos los datos
     * @param $id
     * @param $size
     * @return array
     */
    public function getLowerChart($id, $size) {
        //Cogemos los datos para esta grafica
        $data = $this->getChartData($id, $size, 1, false);
	 $series = [];
        foreach($data as $key) {
            $series[] = $key;
        }
        if($this->getDataSolvent($id, 1))
            $series[] = $this->getDataSolvent($id, 1);

        //Configuracion de la grafica
        return [
            'renderTo' => 'lowerLinechart',
            'type' => 'column',
            'title' => null,
            'tooltip' => [
                'headerFormat' => '',
                'pointFormat' => '<b>{point.x}</b> ppm<br/><b>Num: {point.id}</b><br/>'
            ],
            'zoomType' => 'xy',
            'xAxis' => [
                'reversed' => true,
                'title' => ['text' => trans('applicationResource.molecule.shift').' (ppm)'],
                'min' => 0,
                'max' => 235,
                'tickInterval' => 20
            ],
            'yAxis' => [
                'labels' => ['enabled' => false],
                'title' => ['text' => null]
            ],
            'plotOptions' => [
                'column' => [
                    'dataLabels' => [
                        'enabled' => true,
                        'rotation' => -45,
                        'y' => -20,
                        'crop' => false,
                        'overflow' => 'none',
                        'format' => '{x}'
                    ]
                ]
            ],
            'series' => $series
        ];
    }

    /**
     * Devuelve el grafico que representa solo los CH
     * @param $id
     * @param $size
     * @return array
     */
    public function getMiddleChart($id, $size) {
        //Cogemos los datos para esta grafica
       $data = $this->getChartData($id, $size, 1, false);
        $series = [];
        if (isset($data['CH'])) $series[] = $data['CH'];
        //Configuracion de la grafica
        return [
            'renderTo' => 'middleLinechart',
            'type' => 'column',
            'title' => null,
            'tooltip' => [
                'headerFormat' => '',
                'pointFormat' => '<b>{point.x}</b> ppm<br/><b>Num: {point.id}</b><br/>'
            ],
            'zoomType' => 'xy',
            'xAxis' => [
                'reversed' => true,
                'title' => ['text' => trans('applicationResource.molecule.shift').' (ppm)'],
                'min' => 0,
                'max' => 235,
                'tickInterval' => 20
            ],
            'yAxis' => [
                'labels' => ['enabled' => false],
                'title' => ['text' => null]
            ],
            'plotOptions' => [
                'column' => [
                    'dataLabels' => [
                        'enabled' => true,
                        'rotation' => -45,
                        'y' => -20,
                        'crop' => false,
                        'overflow' => 'none',
                        'format' => '{x}'
                    ]
                ]
            ],
            'series' => $series
        ];
    }

    /**
     * Devuelve el grafico que representa los CH,CH2 y CH3
     * @param $id
     * @param $size
     * @return array
     */
    public function getTopChart($id, $size) {
        //Consulta de la molecula
        $molecule = Molecule::find($id);
        if (!$molecule) {
            return [];
        }
        $name = $molecule->name;
        $solvent = $this->getThinner($molecule->solvent);

        //Cogemos los datos para esta grafica
        $data = $this->getChartData($id, $size, 1, true);
        $series = [];
        if(isset($data['CH']))
            $series[] = $data['CH'];
        if(isset($data['CH2']))
            $series[] = $data['CH2'];
        if(isset($data['CH3']))
            $series[] = $data['CH3'];

        //Configuracion de la grafica
        return [
            'renderTo' => 'topLinechart',
            'type' => 'column',
            'title' => trans('applicationResource.criteria.triName').': '.$name,
            'subtitle' => trans('applicationResource.molecule.solvent').': '.$solvent,
            'tooltip' => [
                'headerFormat' => '',
                'pointFormat' => '<b>{point.x}</b> ppm<br/><b>Num: {point.id}</b><br/>'
            ],
            'zoomType' => 'xy',
            'xAxis' => [
                'reversed' => true,
                'title' => ['text' => trans('applicationResource.molecule.shift').' (ppm)'],
                'min' => 0,
                'max' => 235,
                'tickInterval' => 20
            ],
            'yAxis' => [
                'labels' => ['enabled' => false],
                'title' => ['text' => null]
            ],
            'plotOptions' => [
                'column' => [
                    'dataLabels' => [
                        'enabled' => true,
                        'rotation' => -45,
                        'y' => -20,
                        'crop' => false,
                        'overflow' => 'none',
                        'format' => '{x}'
                    ]
                ]
            ],
            'series' => $series
        ];
    }

    /**
     * Recoge los datos para el disolvente
     * @param $id
     * @param $scale
     * @return null
     * @internal param $size
     */
    public function getDataSolvent($id, $scale) {
        //Consulta de la molecula
        $molecule = Molecule::find($id);
        if (!$molecule) {
            return null;
        }
        $solventChar = $molecule->solvent;
        $infoSolvents = $this->getInfoSolvents();
        $data = array();

        if(isset($infoSolvents[$solventChar]['name'])) {
            $data['name'] = $infoSolvents[$solventChar]['name'];
            for ($i = 0; $i < sizeof($infoSolvents[$solventChar]['shifts']); $i++) {
                $data['data'][] = array($infoSolvents[$solventChar]['shifts'][$i], $scale * $infoSolvents[$solventChar]['heights'][$i]);
            }
            $data['dataLabels'] = ["enabled" => false];
            $data['color'] = 'black';
            $data['pointWidth'] = 1; //Ancho de la barra

            return $data;
        }
        else {
            return null;
        }
    }

    /**
     * Prepara toda la informacion de los disolventes para dibujarlos
     * @return array
     */
    public function getInfoSolvents() {
        $solventSize = 30;

        $solvents = [
            'C' => [    //Cloroformo-d - 77ppm
                'name' => trans('applicationResource.solvent.C'),
                'shifts' => array(
                    76,
                    77,
                    78,
                ),
                'heights' => array(
                    $solventSize,
                    $solventSize,
                    $solventSize
                ),
            ],
            'M' => [    //Metanol-d4 - 49ppm
                'name' => trans('applicationResource.solvent.M'),
                'shifts' => array(
                    46,
                    47,
                    48,
                    49,
                    50,
                    51,
                    52,
                ),
                'heights' => array(
                    $solventSize*0.2,
                    $solventSize*0.6,
                    $solventSize*0.8,
                    $solventSize,
                    $solventSize*0.8,
                    $solventSize*0.6,
                    $solventSize*0.2
                ),
            ],
            'A' => [    //Acetona-d6 - 29.8ppm
                'name' => trans('applicationResource.solvent.A'),
                'shifts' => array(
                    26.8,
                    27.8,
                    28.8,
                    29.8,
                    30.8,
                    31.8,
                    32.8,
                ),
                'heights' => array(
                    $solventSize*0.2,
                    $solventSize*0.6,
                    $solventSize*0.8,
                    $solventSize,
                    $solventSize*0.8,
                    $solventSize*0.6,
                    $solventSize*0.2
                ),
            ],
            'P' => [    //Piridina-d5
                'name' => trans('applicationResource.solvent.P'),
                'shifts' => array(
                    123.9,
                    135.9,
                    150.3,
                ),
                'heights' => array(
                    $solventSize,
                    $solventSize * 0.5,
                    $solventSize,
                ),
            ],
            'D' => [    //Dimetilsulfoxido-d6
                'name' => trans('applicationResource.solvent.D'),
                'shifts' => array(
                    36.8,
                    37.8,
                    38.8,
                    39.7,
                    40.7,
                    41.7,
                    42.7,
                ),
                'heights' => array(
                    $solventSize*0.2,
                    $solventSize*0.6,
                    $solventSize*0.8,
                    $solventSize,
                    $solventSize*0.8,
                    $solventSize*0.6,
                    $solventSize*0.2
                ),
            ],
            'Ac' => [ //Acetonitrilo-d3
                'name' => trans('applicationResource.solvent.Ac'),
                'shifts' => array(
                    117.8,
                    2.4,
                    2.0,
                    1.6,
                    1.2,
                    0.8,
                    0.4,
                    0.0,
                ),
                'heights' => array(
                    0.30*$solventSize,
                    0.30*$solventSize*0.2,
                    0.30*$solventSize*0.6,
                    0.30*$solventSize*0.8,
                    0.30*$solventSize,
                    0.30*$solventSize*0.8,
                    0.30*$solventSize*0.6,
                    0.30*$solventSize*0.2
                ),
            ],
            'B' => [ //Benceno-d6
                'name' => trans('applicationResource.solvent.B'),
                'shifts' => array(
                    127,
                    128,
                    129,
                ),
                'heights' => array(
                    $solventSize,
                    $solventSize,
                    $solventSize
                ),
            ],
            'W' => [ //Agua
                'name' => trans('applicationResource.solvent.W'),
                'shifts' => array(

                ),
                'heights' => array(

                ),
            ],
            'T' => [ //Tetracloruro de carbono
                'name' => trans('applicationResource.solvent.T'),
                'shifts' => array(
                    96.1,
                ),
                'heights' => array(
                    $solventSize,
                ),
            ],
            'DC' => [ //Diclorometano-d2
                'name' => trans('applicationResource.solvent.DC'),
                'shifts' => array(
                    51.5,
                    52.5,
                    53.5,
                    54.5,
                    55.5,
                ),
                'heights' => array(
                    $solventSize*0.4,
                    $solventSize*0.6,
                    $solventSize,
                    $solventSize*0.6,
                    $solventSize*0.4,
                ),
            ],
            'F' => [ //Acido Trifluoroacetico-d4
                'name' => trans('applicationResource.solvent.F'),
                'shifts' => array(
                    161.8,
                    162.8,
                    163.8,
                    164.8,
                ),
                'heights' => array(
                    0.4 * $solventSize,
                    $solventSize,
                    $solventSize,
                    0.4 * $solventSize,
                ),
            ],
            'Di' => [ //1,4-Dioxan
                'name' => trans('applicationResource.solvent.Di'),
                'shifts' => array(
                    67.3,
                ),
                'heights' => array(
                    $solventSize,
                ),
            ],
            'AT' => [ //Acido Trifluoroacetico
                'name' => trans('applicationResource.solvent.AT'),
                'shifts' => array(

                ),
                'heights' => array(

                ),
            ],
        ];

        /**Añadimos los combinados y los similares*/

        ////Dimetilsulfoxido-d6
        $solvents['DMSO']['name'] = $solvents['D']['name'];
        $solvents['DMSO']['shifts'] = $solvents['D']['shifts'];
        $solvents['DMSO']['heights'] = $solvents['D']['heights'];

        //Cloroformo-d + Dimetilsulfoxido-d6
        $solvents['C+D']['name'] = trans('applicationResource.solvent.C+D');
        $solvents['C+D']['shifts'] = array_merge($solvents['C']['shifts'],$solvents['D']['shifts']);
        $solvents['C+D']['heights'] = array_merge($solvents['C']['heights'],$solvents['D']['heights']);

        //Cloroformo-d + Metanol-d4
        $solvents['C+M']['name'] = trans('applicationResource.solvent.C+M');
        $solvents['C+M']['shifts'] = array_merge($solvents['C']['shifts'], $solvents['M']['shifts']);
        $solvents['C+M']['heights'] = array_merge($solvents['C']['heights'],$solvents['M']['heights']);

        //Cloroformo-d + Acetonitrilo-d3
        $solvents['C+Ac']['name'] = trans('applicationResource.solvent.C+Ac');
        $solvents['C+Ac']['shifts'] = array_merge($solvents['C']['shifts'], $solvents['Ac']['shifts']);
        $solvents['C+Ac']['heights'] = array_merge($solvents['C']['heights'], $solvents['Ac']['heights']);

        //Metanol-d4 + Metanol-d4
        $solvents['M+M']['name'] = $solvents['M']['name'];
        $solvents['M+M']['shifts'] = $solvents['M']['shifts'];
        $solvents['M+M']['heights'] = $solvents['M']['heights'];

        //Metanol-d4 + Agua
        $solvents['M+W']['name'] = trans('applicationResource.solvent.M+W');
        $solvents['M+W']['shifts'] = $solvents['M']['shifts'];
        $solvents['M+W']['heights'] = $solvents['M']['heights'];

        return $solvents;
    }

    /**
     * Prepara los datos para el espectro
     * @param $id
     * @param $size
     * @param $scale
     * @param $inverted
     * @return mixed
     */
    public function getChartData($id, $size, $scale, $inverted) {
        //Funcion para resaltar el carbono - ahora como string JavaScript
        $funcOver = "function() {
            var csv = '';
            for(var i = 0; i < this.indexes.length; i++)
                csv += this.indexes[i] + ',4,';
            jsmeApplet.resetAtomColors(1);
            jsmeApplet.setAtomBackgroundColors(1, csv);
        }";
        $funcOut = "function() {
            jsmeApplet.resetAtomColors(1);
        }";

        //Carbonos
        $carbons = Carbon::select('shift', 'num2', 'carbonType')
            ->where('molecularId', $id)
            ->where('shift', '<>', '-9999')
            ->orderBy('shift', 'asc')
            ->remember(config('rememberTime.time'))->get();

        //Recorremos el listado
        $auxList = array();
         $accHeight = 0;
        $data = [];
        foreach($carbons as $carbon) {          
		 $data[$carbon->carbonType]['name'] = $carbon->carbonType;
            //Si el desplazamiento coincide con el del ultimo carbono introducido vamos aumentando la altura
            if(sizeof($auxList) != 0 && $auxList[sizeof($auxList)- 1]['shift'] == $carbon->shift) {
                $accHeight += $size[$carbon->carbonType];
            }
            //Si no coincide reiniciamos la altura
            else {
                $accHeight = $size[$carbon->carbonType];
            }
            $auxList[] = ['name' => $carbon->carbonType, 'shift' => $carbon->shift];

            //A continuacion introducimos los datos
            if($inverted && $carbon->carbonType == 'CH2') {
                $data[$carbon->carbonType]['data'][] = [
                    'x' => $carbon->shift,
                    'y' => -$scale*$size['CH2'],
                    'id' => $carbon->num2,
                    'indexes' => Carbon::indices( $id, $carbon->num2),
                    'events' => [
                        'mouseOver' => $funcOver,
                        'mouseOut' => $funcOut,
                    ]
                ];
            }
            else {
                $data[$carbon->carbonType]['data'][] = [
                    'x' => $carbon->shift,
                    'y' => $scale*$accHeight,
                    'id' => $carbon->num2,
                    'indexes' => Carbon::indices( $id, $carbon->num2),
                    'events' => [
                        'mouseOver' => $funcOver,
                        'mouseOut' => $funcOut,
                    ]
                ];
            }

            //Color
            switch($carbon->carbonType) {
                case 'C':
                    $data[$carbon->carbonType]['color'] = 'blue';
                    break;
                case 'CH':
                    $data[$carbon->carbonType]['color'] = 'red';
                    break;
                case 'CH2':
                    $data[$carbon->carbonType]['color'] = 'green';
                    break;
                case 'CH3':
                    $data[$carbon->carbonType]['color'] = 'purple';
                    break;
                default:
                    break;
            }
            $data[$carbon->carbonType]['pointWidth'] = 1;
        }
        return $data;
    }

    /**
     * Devuelve un array con los indices de los atomos que cumplen ese desplazamiento acorde con el jme
     * @param $shift
     * @param $id
     * @return array
     */
    public function getShiftIndexes($shift, $id) {
        $molecule = Molecule::find($id);
        if (!$molecule) {
            return [];
        }        $subKey = array();

        //$re = "/[aA-zZ]:?[0-9]*/";
        preg_match_all("/[aA-zZ]:?[0-9]*/" , $molecule->jmeDisplacement ,$matches);
        foreach($matches[0] as $key) {
            $result[] = explode(':', $key);
        }

        foreach($result as $key => $item){
            if (is_array($item) && isset($item[1])){
                if ($item[1] == round($shift)){ //Desplazamiento a comprobar
                    $subKey[$key+1] = $item;
                }
            }
        }

        $indexes = array();

        foreach($subKey as $key => $value) {
            array_push($indexes, (int)$key);
        }

        return $indexes;
    }
}
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>statistika calculator</title>
</head>

<body>
    <center>
        <h1>STATISTIKA KALKULATOR</h1>
        <?php
        $_GET['kondisi1'] = "range table";
        if (($_GET['kondisi1'] == "range table") xor (isset($_GET['kondisi3']) == "to table") xor (isset($_GET['kondisi2']) == "in score")) { ?>
            <form action="" method="get">
                <input type="number" name="kolom" placeholder="kolom" id="">
                <input type="number" name="baris" placeholder="baris" id=""><br><br>
                <input type="number" name="desil" placeholder="desil" id="">
                <input type="number" name="presentil" placeholder="presentil" id="">
                <input type="hidden" name="kondisi2" value="in score"><br><br>
                <input type="submit" name="kirim" value="kirim">
            </form>
        <?php } ?><br><br>

        <?php if (isset($_GET['kondisi2']) == "in score") { ?>
            <form action="" method="get">
                <table>
                    <?php for ($xbaris = 1; $xbaris <= $_GET['baris']; $xbaris++) { ?><tr>
                            <?php for ($xkolom = 1; $xkolom <= $_GET['kolom']; $xkolom++) { ?>
                                <td><input type="number" placeholder="<?= $xbaris . $xkolom ?>" name="<?= $xbaris . $xkolom ?>" style="padding:10px; width:40px;" id="datax"></td>
                        <?php }
                        } ?>
                </table><br>
                <input type="hidden" name="baris" value="<?= $_GET['baris'] ?>">
                <input type="hidden" name="kolom" value="<?= $_GET['kolom'] ?>">
                <input type="hidden" name="desil" value="<?= $_GET['desil'] ?>">
                <input type="hidden" name="presentil" value="<?= $_GET['presentil'] ?>">
                <input type="hidden" name="kondisi3" value="to table">
                <input type="submit" value="kirim">
            </form>
        <?php } ?>
    </center>

    <?php
    if (isset($_GET['kondisi3']) == "to table") {
        $data = [];
        $i = 1;
        // print_r($_GET);
        foreach ($_GET as $j => $k) {
            if (is_numeric($j)) {
                $data += [$j => $k];
                $i++;
            }
        }
        $nsdata = $data;
        // print_r($data);
        $Klog = round(1 + 3.3 * (round(log10($_GET['baris'] * $_GET['kolom']), 2)));
        $Rx = (max($data)) - (min($data));
        $Intnotround = $Rx / $Klog;
        $Int = round($Rx / $Klog);
        $Intlopp = $Int - 1; //original -1 
        //Membuat tabel kelas -->
        $min = min($data);
        // print_r($data);
        rsort($data);
        // print_r($data);
        $p = 0;
        $NF = [];
        $fi = [];

        for ($cls = 1; $cls <= $Intlopp + 1; $cls++) {
            //echo "<br>pertama = $min";
            $firsnilai = $min;
            for ($cl = 0; $cl <= $Intlopp; $cl++) {
                $cdata = count($data);
                for ($nm = 0; $nm <= $cdata; $nm++) {
                    if ($data[$nm] == $min) {
                        $p++;
                    }
                    error_reporting(E_ERROR | E_PARSE);
                    // if ( $cl==$Intlopp ){
                    //     $NF += [ $cls => $p ];
                    // }
                } //echo "$min";
                $min++;
            }
            $secondnilai = $min - 1;
            $NF += [$cls => [$firsnilai, $secondnilai, $p]];
            $fi += [$cls => $p];
            $p = 0;
        } ?><br>
        <?php $h = 0;
        $l = 0;
        $aa = 2; ?>
        <?php for ($a = 1; $a <= ($cls - 1); $a++) {
            $h++;
            $aa++;
            if ($a == 1) {
                $mm = $fk = $NF[1][2];
            } else {
                // $a;
                $oo = $mm + $NF[$a][2];
                for ($pp = 2; $pp <= $a; $pp++) {
                    $fk = $oo;
                    $oo = $oo + $NF[$pp][2];
                }
                $fk;
            }
            $tb = $NF[$a][0] - 0.5;
            $Int2 = $Int;
            $xi = ($NF[$a][0] + $NF[$a][1]) / 2;
            // if ($Int2 % 2 == 0) {
            //     $axi = "genap";
            //     $xi = $NF[$a][0];
            //     for ($t = 2; $t <= ($Int2 / 2); $t++) {
            //         $xi++;
            //     }
            //     $xi + 0.5;
            // } else {
            //     $axi = "ganjil";
            //     $xi = $NF[$a][0];
            //     for ($t = 2; $t <= (round($Int2 / 2)); $t++) {
            //         $xi++;
            //     }
            //     $xi;
            // }
            array_push($NF[$a], $fk, $tb, $xi);
            $fixxi = $NF[$a][2] * $NF[$a][5];
            $fixxi; ?>
            <?php array_push($NF[$a], $fixxi); ?>
            <?php $fixim = $NF[$a][6] //[6] fixxi
            ?>
        <?php if ($a == 1) { //jumlah fi x xi
                array_push($NF[$a], $fixxi);
            } else {
                $nfx = $NF[1][6];
                $ofx = $nfx + $NF[$a][6];
                for ($jj = 2; $jj <= $a; $jj++) {
                    $jfixi = $ofx;
                    $ofx = $ofx + $NF[$jj][6];
                }
                array_push($NF[$a], $jfixi); //no[7]
            }
        }
        $hasil = [];
        $abcd = '$X = ((sum_iFI * XI) / (FI)) = ((<?= $NF[$Int][7]?>) / <?php echo $NF[$Int][3]?>)=<?= $nrata2 = round($NF[$Int][7]/$NF[$Int][3],2)?>$';
        $nrata2 = round($NF[$Int][7] / $NF[$Int][3], 2);
        $hasil += ["nilai rata rata" => ["fi kali xi" => $NF[$Int][7], "fi" => $NF[$Int][3], "hasil" => $nrata2]]; //print_r($hasil);
        $me = $NF[$Int][3] / 2;
        for ($meloop = 1; $meloop <= $Int; $meloop++) {
            if ($me <= $NF[$meloop][3]) {
                $lme = $meloop;
                goto median;
            }
        }
        median:
        $metb = $NF[$lme][4];
        $nfk = $NF[$lme - 1][3];
        $nfi = $NF[$lme][2];
        $Int = $Int; //original tidak ditambah 1
        $median = round(($metb + (($me - $nfk) / $nfi) * $Int), 1);
        $abcd = '$Median = Tb+(((n/2)-Fk)/(FI))*Interval = <?=$metb?>+((<?=$me?>-<?=$nfk?>)/(<?=$nfi?>))*<?=$Int?> = <?=$median?>$';
        $hasil += ["median" => ["tb" => $metb, "titik" => $me, "fk" => $nfk, "fi" => $nfi, "interval" => $Int, "hasil" => $median]]; //print_r($hasil); 
        $momax = max($fi); //print_r($fi);
        for ($moloop = 1; $moloop <= $Int; $moloop++) {
            if ($momax == $fi[$moloop]) {
                $mol = $moloop;
                goto modus;
            }
        }
        modus:
        $d1 = $fi[$mol] - $fi[$mol - 1];
        $d2 = $fi[$mol] - $fi[$mol + 1];
        $motb = $NF[$mol][4];
        $modus = ($motb + (($d1 / ($d1 + $d2)) * $Int));
        $abcd = '$Modus = Tb+((d1)/(d1+d2))*Interval = <?=$motb?>+(<?=$d1?>/(<?=$d1?>+<?=$d2?>))*<?=$Int?> = <?=$modus?>$';
        $hasil += ["modus" => ["tb" => $motb, "titik modus" => $momax, "d1" => $d1, "d2" => $d2, "interval" => $Int, "hasil" => $modus]]; //print_r($hasi
        $tq1 = 1 / 4 * count($data);
        for ($q1loop = 1; $q1loop <= $Int; $q1loop++) {
            if ($tq1 <= $NF[$q1loop][3]) {
                $lq1 = $q1loop;
                goto q1;
            }
        }
        q1:
        $q1tb = $NF[$lq1][4];
        $q1fk = $NF[$lq1 - 1][3];
        $q1fi = $NF[$lq1][2];
        $q1 = round(($q1tb + (((($tq1) - $q1fk) / $q1fi) * $Int)), 2);
        $abcd = '$Q_1 = Tb + (((1/4*F_<?=count($data)?>)-Fk)/(Fi))*Interval = <?=$q1tb?> + ((<?=$tq1?>-<?=$q1fk?>)/(<?=$q1fi?>))*<?=$Int?> = <?=$q1?>$';
        $hasil += ["quartil 1" => ["titik" => $tq1, "tb" => $q1tb, "fk" => $q1fk, "fi" => $q1fi, "interval" => $Int, "hasil" => $q1]];
        $tq2 = 1 / 2 * count($data);
        for ($q2loop = 1; $q2loop <= $Int; $q2loop++) {
            if ($tq2 <= $NF[$q2loop][3]) {
                $lq2 = $q2loop;
                goto q2;
            }
        }
        q2:
        $q2tb = $NF[$lq2][4];
        $q2fk = $NF[$lq2 - 1][3];
        $q2fi = $NF[$lq2][2];
        $q2 = round(($q2tb + (((($tq2) - $q2fk) / $q2fi) * $Int)), 2);
        $abcd = '$Q_2 = Tb + (((1/2*F_<?=count($data)?>)-Fk)/(Fi))*Interval = <?=$q2tb?> + ((<?=$tq2?>-<?=$q2fk?>)/(<?=$q2fi?>))*<?=$Int?> = <?=$q2?>$';
        $hasil += ["quartil 2" => ["titik" => $tq2, "tb" => $q2tb, "fk" => $q2fk, "fi" => $q2fi, "interval" => $Int, "hasil" => $q2]];
        $tq3 = 3 / 4 * count($data);
        for ($q3loop = 1; $q3loop <= $Int; $q3loop++) {
            if ($tq3 <= $NF[$q3loop][3]) {
                $lq3 = $q3loop;
                goto q3;
            }
        }
        q3:
        $q3tb = $NF[$lq3][4];
        $q3fk = $NF[$lq3 - 1][3];
        $q3fi = $NF[$lq3][2];
        $q3 = round(($q3tb + (((($tq3) - $q3fk) / $q3fi) * $Int)), 2);
        $abcd = '$Q_3 = Tb + (((3/4*F_<?=count($data)?>)-Fk)/(Fi))*Interval = <?=$q3tb?> + ((<?=$tq3?>-<?=$q3fk?>)/(<?=$q3fi?>))*<?=$Int?> = <?=$q3?>$';
        $hasil += ["quartil 3" => ["titik" => $tq3, "tb" => $q3tb, "fk" => $q3fk, "fi" => $q3fi, "interval" => $Int, "hasil" => $q3]];
        $de = $_GET['desil'];
        $tdes = $_GET['desil'] / 10 * count($data);
        for ($desloop = 1; $desloop <= $Int; $desloop++) {
            if ($tdes <= $NF[$desloop][3]) {
                $ldes = $desloop;
                goto des;
            }
        }
        des:
        $destb = $NF[$ldes][4];
        $desfk = $NF[$ldes - 1][3];
        $desfi = $NF[$ldes][2];
        $des = round(($destb + (((($tdes) - $desfk) / $desfi) * $Int)), 2);
        $abcd = '$D_<?=$de?> = Tb + ((((D<?=$de?>)/10*F_<?=count($data)?>)-Fk)/(Fi))*Interval = <?=$destb?> + (((<?=$tdes?>)-<?=$desfk?>)/(<?=$desfi?>))*<?=$Int?> = <?=$des?>$';
        $hasil += ["desil" => ["ke" => $de, "titik" => $tdes, "tb" => $destb, "fk" => $desfk, "fi" => $desfi, "interval" => $Int, "hasil" => $des]];
        $pe = $_GET['presentil'];
        $tpre = $_GET['presentil'] / 100 * count($data);
        for ($preloop = 1; $preloop <= $Int; $preloop++) {
            if ($tpre <= $NF[$preloop][3]) {
                $lpre = $preloop;
                goto pre;
            }
        }
        pre:
        $pretb = $NF[$lpre][4];
        $prefk = $NF[$lpre - 1][3];
        $prefi = $NF[$lpre][2];
        $pre = round(($pretb + (((($tpre) - $prefk) / $prefi) * $Int)), 2);
        $abcd = '$P_<?=$pe?> = Tb + ((((P_<?=$pe?>)/100*F_<?=count($data)?>)-Fk)/(Fi))*Interval = <?=$pretb?> + (((<?=$tpre?>)-<?=$prefk?>)/(<?=$prefi?>))*<?=$Int?> = <?=$pre?>$';
        $hasil += ["presentil" => ["ke" => $pe, "titik" => $tpre, "tb" => $pretb, "fk" => $prefk, "fi" => $prefi, "interval" => $Int, "hasil" => $pre]];
        for ($w = 1; $w <= $Int; $w++) { //original int tidak -1
            // $xix = $NF[$w][5] - $nrata2; //$NF[$w][5]-$nrata2; // xi kurang x
            $xix = round($NF[$w][5] - $nrata2, 4); //$NF[$w][5]-$nrata2; // xi kurang x
            $xixkuadrat = round(pow($xix, 2), 2); // xi kurang x
            // print_r($NF);
            $fixix = $NF[$w][2] * $xixkuadrat;
            array_push($NF[$w], $fixix);
            if ($w == 1) { //jumlah fi x xi
                array_push($NF[$w], $fixxi, $xix, $xixkuadrat);
            } else {
                $nfixix = $NF[1][8];
                $ofixix = $nfixix + $NF[$w][8];
                for ($ww = 2; $ww <= $w; $ww++) {
                    $jfixix = $ofixix;
                    $ofixix = $ofixix + $NF[$ww][8];
                }
                array_push($NF[$w], $jfixix, $xix, $xixkuadrat); //no[9]
            }
        }
        $Int = $Int; //original iint tidak -1
        $sr = round(($NF[$Int][9] / $NF[$Int][3]), 2);
        $abcd = '$Sr = \sqrt{(sumfi*(XI-X)^2)} / (sumfi) = ((<?= $NF[$Int][9]?>) / <?=$NF[$Int][3]?>)=<?=$sr = round(($NF[$Int][9]/$NF[$Int][3]), 2)?>$';
        $hasil += ["simpangan rata rata" => ["fixix" => $NF[$Int][9], "fn" => $NF[$Int][3], "hasil" => $sr]];
        $sb1 = round(($NF[$Int][9] / $NF[$Int][3]), 2);
        $sb2 = round((sqrt($sb1)), 4);
        $abcd = '$Sb = \sqrt{1/n(sum fi*(XI-X)^2)} = \sqrt{1/<?=$NF[$Int][3]?>*<?=$NF[$Int][9]?>}=\sqrt{<?= $sb1 = round(($NF[$Int][9]/$NF[$Int][3]), 2)?>}=<?=$sb2 = round((sqrt($sb1)),4)?> = <?=round((sqrt($sb1)),1)?>$';
        $hasil += ["simpangan baku" => ["fixix" => $NF[$Int][9], "fn" => $NF[$Int][3], "akar" => $sb1, "hasil" => $sb2]];
        $data = $nsdata;
        for ($xbaris = 1; $xbaris <= $_GET['baris']; $xbaris++) {
            for ($xkolom = 1; $xkolom <= $_GET['kolom']; $xkolom++) {
                $xkolombaris = $xbaris . $xkolom;
                $dataacak = $data[$xkolombaris];
            }
        }
        rsort($data);
        $nmcount = count($data) - 1;
        for ($xbaris = 1; $xbaris <= $_GET['baris']; $xbaris++) {
            for ($xkolom = 1; $xkolom <= $_GET['kolom']; $xkolom++) {
                $xkolombaris = $xbaris . $xkolom;
                $dataurut = $data[$nmcount];
                //echo $nmcount;
                $nmcount--;
                // if ( $data[$xkolombaris]==2 ){ echo "halo";}
            }
        } ?>
        <center>
            <table class="td">
                <tr>
                    <?php $data = $nsdata; ?>
                    <td>
                        <center>
                            <h4 style="margin:10px;">Data Acak</h4>
                        </center>
                        <table>
                            <?php for ($xbaris = 1; $xbaris <= $_GET['baris']; $xbaris++) { ?><tr>
                                    <?php for ($xkolom = 1; $xkolom <= $_GET['kolom']; $xkolom++) {
                                        $xkolombaris = $xbaris . $xkolom; ?>
                                        <td>
                                            <?php echo $dataacak = $data[$xkolombaris]; ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                    <td class="td"></td>
                    <?php
                    //print_r($NF); print_r($aaray); print_r($data); 
                    rsort($data);
                    //print_r($data);
                    ?>
                    <td>
                        <center>
                            <h4 style="margin:10px;">Data Urut</h4>
                        </center>
                        <table>
                            <?php $nmcount = count($data) - 1; ?>
                            <?php for ($xbaris = 1; $xbaris <= $_GET['baris']; $xbaris++) { ?><tr>
                                    <?php for ($xkolom = 1; $xkolom <= $_GET['kolom']; $xkolom++) {
                                        $xkolombaris = $xbaris . $xkolom; ?>
                                        <td>
                                            <?php
                                            echo $dataurut = $data[$nmcount];
                                            //echo $nmcount;
                                            $nmcount-- ?>
                                            <?php // if ( $data[$xkolombaris]==2 ){ echo "halo";}
                                            ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>
            </table><br>
            <table>
                <tr>
                    <td>
                        <h4>$Kelas$</h4>
                    </td>
                    <td>
                        <h4>$Siswa$</h4>
                    </td>
                    <td>
                        <h4>$fi$</h4>
                    </td>
                    <td>
                        <h4>$fk$</h4>
                    </td>
                    <td>
                        <h4>$Tb$</h4>
                    </td>
                    <td>
                        <h4>$XI$</h4>
                    </td>
                    <td>
                        <h4>$FI*XI$</h4>
                    </td>
                    <td>
                        <h4>$XI-X$</h4>
                    </td>
                    <td>
                        <h4>$|XI-X|^2$</h4>
                    </td>
                    <td>
                        <h4>$FI*|XI-X|^2$</h4>
                    </td>
                </tr>
                <?php for ($tr = 1; $tr <= $Int; $tr++) { ?>
                    <tr>
                        <td><?= $tr ?></td>
                        <td><?= $NF[$tr][0] . "-" . $NF[$tr][1]  //siswa  
                            ?></td>
                        <td><?= $NF[$tr][2]  //fi  
                            ?></td>
                        <td><?= $NF[$tr][3]  //fk  
                            ?></td>
                        <td><?= $NF[$tr][4]  //tb  
                            ?></td>
                        <td><?= $NF[$tr][5]  //xi  
                            ?></td>
                        <td><?= $NF[$tr][6]  //fi x xi  
                            ?></td>
                        <td><?= $NF[$tr][10] //xi - x  
                            ?></td>
                        <td><?= $NF[$tr][11] //|xi - x |^2  
                            ?></td>
                        <td><?= $NF[$tr][8]  //fi x |xi - x|^2  
                            ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2">Jumlah Data (fi)</td>
                    <td><?php echo $NF[$Int][3] ?></td>
                    <td colspan="3">Jumlah fi x Xi</td>
                    <td><?php echo $NF[$Int][7] ?></td>
                    <td colspan="2">Jumlah fi x |xi - x|</td>
                    <td><?php echo $NF[$Int][9] ?></td>
                </tr>
            </table><br>
            <table>
                <tr>
                    <td>
                        <h3>Panjang Kelas (interval)</h3>
                    </td>
                </tr>
                <?php $pertama = "K = 1 + 3,3 * log n = 1 + 3,3 * log" . $_GET['baris'] * $_GET['kolom'] . " = 1 + 3,3 * " . round(log10($_GET['baris'] * $_GET['kolom']), 2) . " = $Klog" ?><br>
                <?php $kedua = "R = (nilai max - nilai min) = " . max($data) . " - " . min($data) . " = " . $Rx; ?><br>
                <?php $ketiga = "I = R : K = $Rx : $Klog = " . round($Intnotround, 2) . " => " . $Int ?>
                <tr>
                    <td class="tdleft">
                        $<?= $pertama ?>$ <br>
                        $<?= $kedua ?>$ <br>
                        $<?= $ketiga ?>$ <br>
                    </td>
                </tr>

                <tr>
                    <td class="td"></td>
                </tr>
                <tr>
                    <td>
                        <h3>Rata - rata (X)</h3>
                    </td>
                </tr>
                <tr>
                    <td class="tdleft">
                        $X = ((sum_iFI * XI) / (FI)) = ((<?= $NF[$Int][7] ?>) / <?php echo $NF[$Int][3] ?>)=<?= $hasil["nilai rata rata"]["hasil"] ?>$
                    </td>
                </tr>

                <tr>
                    <td class="td"></td>
                </tr>
                <tr>
                    <td>
                        <h3>Median (Me)</h3>
                    </td>
                </tr>
                <tr>
                    <td class="tdleft">
                        <?php $median = $hasil["median"] ?>
                        $Me_<?= $median["titik"] ?> = Tb+(((<?= count($data) ?>/2)-Fk)/(FI))*Interval = <?= $median["tb"] ?>+((<?= $median["titik"] ?>-<?= $median["fk"] ?>)/(<?= $median["fi"] ?>))*<?= $median["interval"] ?> = <?= $median["hasil"] ?>$
                    </td>
                </tr>

                <tr>
                    <td class="td"></td>
                </tr>
                <tr>
                    <td>
                        <h3>Modus (Mo)</h3>
                    </td>
                </tr>
                <tr>
                    <td class="tdleft">
                        <?php $modus = $hasil["modus"] ?>
                        $Mo_<?= $modus["titik modus"] ?> = Tb+((d1)/(d1+d2))*Interval = <?= $modus["tb"] ?>+(<?= $modus["d1"] ?>/(<?= $modus["d1"] ?>+<?= $modus["d2"] ?>))*<?= $modus["interval"] ?> = <?= $modus["hasil"] ?>$
                    </td>
                </tr>

                <tr>
                    <td class="td"></td>
                </tr>
                <tr>
                    <td>
                        <h3>Quartil (Qn)</h3>
                    </td>
                </tr>
                <tr>
                    <td class="tdleft">
                        <?php $quartil1 = $hasil["quartil 1"]; ?>
                        $Q_1 = Tb + (((1/4*F_<?= count($data) ?>)-Fk)/(Fi))*Interval = <?= $quartil1["tb"] ?> + (((<?= $quartil1["titik"] ?>)-<?= $quartil1["fk"] ?>)/(<?= $quartil1["fi"] ?>))*<?= $quartil1["interval"] ?> = <?= $quartil1["hasil"] ?>$
                    </td>
                </tr>
                <tr>
                    <td class="tdleft">
                        <?php $quartil2 = $hasil["quartil 2"]; ?>
                        $Q_2 = Tb + (((1/2*F_<?= count($data) ?>)-Fk)/(Fi))*Interval = <?= $quartil2["tb"] ?> + (((<?= $quartil2["titik"] ?>)-<?= $quartil2["fk"] ?>)/(<?= $quartil2["fi"] ?>))*<?= $quartil2["interval"] ?> = <?= $quartil2["hasil"] ?>$
                    </td>
                </tr>
                <tr>
                    <td class="tdleft">
                        <?php $quartil3 = $hasil["quartil 3"]; ?>
                        $Q_2 = Tb + (((3/4*F_<?= count($data) ?>)-Fk)/(Fi))*Interval = <?= $quartil3["tb"] ?> + (((<?= $quartil3["titik"] ?>)-<?= $quartil3["fk"] ?>)/(<?= $quartil3["fi"] ?>))*<?= $quartil3["interval"] ?> = <?= $quartil3["hasil"] ?>$
                    </td>
                </tr>

                <tr>
                    <td class="td"></td>
                </tr>
                <tr>
                    <td>
                        <h3>Desil (Dn)</h3>
                    </td>
                </tr>
                <tr>
                    <td class="tdleft">
                        <?php $desil = $hasil["desil"]; ?>
                        $D_<?= $desil["ke"] ?> = Tb + ((((P_<?= $desil["ke"] ?>)/100*F_<?= count($data) ?>)-Fk)/(Fi))*Interval = <?= $desil["tb"] ?> + (((<?= $desil["titik"] ?>)-<?= $desil["fk"] ?>)/(<?= $desil["fi"] ?>))*<?= $desil["interval"] ?> = <?= $desil["hasil"] ?>$
                    </td>
                </tr>

                <tr>
                    <td class="td"></td>
                </tr>
                <tr>
                    <td>
                        <h3>Presentil (Pn)</h3>
                    </td>
                </tr>
                <tr>
                    <td class="tdleft">
                        <?php $presentil = $hasil["presentil"]; ?>
                        $P_<?= $presentil["ke"] ?> = Tb + ((((P_<?= $presentil["ke"] ?>)/100*F_<?= count($data) ?>)-Fk)/(Fi))*Interval = <?= $presentil["tb"] ?> + (((<?= $presentil["titik"] ?>)-<?= $presentil["fk"] ?>)/(<?= $presentil["fi"] ?>))*<?= $presentil["interval"] ?> = <?= $presentil["hasil"] ?>$
                    </td>
                </tr>

                <tr>
                    <td class="td"></td>
                </tr>
                <tr>
                    <td>
                        <h3>Simpangan Rata - Rata (Sr)</h3>
                    </td>
                </tr>
                <tr>
                    <td class="tdleft">
                        <?php $simpanganratarata = $hasil["simpangan rata rata"] ?>
                        $Sr = \sqrt{(sumfi*(XI-X)^2)} / (sumfi) = ((<?= $simpanganratarata["fixix"] ?>) / <?= $simpanganratarata["fn"] ?>)=<?= $simpanganratarata["hasil"] ?>$
                    </td>
                </tr>

                <tr>
                    <td class="td"></td>
                </tr>
                <tr>
                    <td>
                        <h3>Simpangan Baku (Sb)</h3>
                    </td>
                </tr>
                <tr>
                    <td class="tdleft">
                        <?php $simpanganbaku = $hasil["simpangan baku"] ?>
                        $Sb = \sqrt{1/n(sum fi*(XI-X)^2)} = \sqrt{1/<?= $simpanganbaku["fn"] ?>*<?= $simpanganbaku["fixix"] ?>}=\sqrt{<?= $sb1 = $simpanganbaku["akar"] ?>}=<?= $sbh = $simpanganbaku["hasil"] ?> = <?= round($sbh, 1) ?>$
                    </td>
                </tr>
            </table>
        </center>
    <?php } ?>

    <h4 style="padding:50px;">&copy; copyright 2022 Deny Electra @dheny4420</h4>
    <?php //print_r($NF);print_r($hasil);?>
</body>

<script>
    MathJax = {
        loader: {
            load: ['input/asciimath', 'output/chtml', 'ui/menu']
        },
        asciimath: {
            delimiters: [
                ['$', '$'],
                ['`', '`']
            ]
        }
    };
</script>
<script type="text/javascript" id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/startup.js">
</script>
<style>
    th,
    td {
        border: 1px solid black;
        padding: 10px;
        text-align: center;
    }

    table {
        border: 1px solid black;
        padding: 10px;
    }

    .td {
        border: 1px solid white;
        padding: 10px;
        text-align: center;
    }

    .tdleft {
        text-align: left;
    }

    h3 {
        padding: 0px;
        margin: 0px
    }

    h4 {
        padding: 0px;
        margin: 0px;
    }

    footer {
        padding: 50px;
    }
</style>

</html>
<!-- http://localhost/statistika/main.php?kolom=&baris=&kondisi2=in+score&kirim=kirim -->
<!-- http://localhost/statistika/main.php?11=67&12=86&13=77&14=92&15=75&16=70&21=63&22=79&23=89&24=72&25=83&26=74&31=75&32=100&33=81&34=95&35=72&36=63&41=66&42=78&43=88&44=87&45=85&46=67&51=72&52=96&53=78&54=93&55=82&56=71&baris=5&kolom=6&kondisi3=to+table -->
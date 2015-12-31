<?php
function stworz_miniaturke($orginalny_obrazek,$docelowy_obrazek,$docelowa_szerokosc,$docelowa_wysokosc){
   
    // Pobranie orginalnych parametrów i kalkulacja skali
    list($szerokosc, $wysokosc) = getimagesize($orginalny_obrazek);
    $xskala=$szerokosc/$docelowa_szerokosc;
    $yskala=$wysokosc/$docelowa_wysokosc;
   
    // Kalkulacja nowego rozmiaru
    if ($yskala>$xskala){
        $nowa_szerokosc = round($szerokosc*(1/$yskala));
        $nowa_wysokosc = round($wysokosc * (1/$yskala));
    }
    else {
        $nowa_szerokosc = round($szerokosc * (1/$xskala));
        $nowa_wysokosc = round($wysokosc * (1/$xskala));
    }

    // Zmiana rozmiaru orginalnego obrazu
    $nowy_obrazek = imagecreatetruecolor($nowa_szerokosc, $nowa_wysokosc);
    $id_obrazka     = imagecreatefromjpeg ($orginalny_obrazek);
    imagecopyresampled($nowy_obrazek, $id_obrazka, 0, 0, 0, 0, $nowa_szerokosc, $nowa_wysokosc, $szerokosc, $wysokosc);
		
		imagejpeg($nowy_obrazek,$docelowy_obrazek,100);
    return $nowy_obrazek;
}
?> 
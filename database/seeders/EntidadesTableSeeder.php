<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EntidadesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('entidades')->delete();

        \DB::table('entidades')->insert([
            ['entidad'=>'ABZAC IBERICA, S.A.','entidad5'=>'ABZA','cuentactble'=>'40010005','direccion'=>'Newton, 1','cp'=>'8784','localidad'=>'Piera','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A60739307','tfno'=>'937794770','emailgral'=>'abzac@abzaciberica.es','emailadm'=>'','web'=>'www.abzac.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'ACTUALITY QUATRE, S.L.','entidad5'=>'ACTU','cuentactble'=>'40010013','direccion'=>'Cadillac, 10, P. 1, PTA. 3','cp'=>'8360','localidad'=>'Canet de Mar','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B65391575','tfno'=>'930013929','emailgral'=>'oscar@actualityquatre.com','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'AGFA GRAPHICS N.V.','entidad5'=>'AGFA','cuentactble'=>'40010031','direccion'=>'Gaspar Fˆbregas i Roses, 81 - 3» Pta.','cp'=>'8950','localidad'=>'Esplugues de Llobregat','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'W0172342H','tfno'=>'934767800','emailgral'=>'','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'ANTALIS IBERIA, S.A.','entidad5'=>'ANTA','cuentactble'=>'40010025','direccion'=>'Pintores, 10 (Sector XIII) - Velilla de San Antonio','cp'=>'28891','localidad'=>'Madrid','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A78456506','tfno'=>'916604130','emailgral'=>'','emailadm'=>'','web'=>'www.antalis.es','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'COMUNICACION SPANDEX ESPAÑA,SA','entidad5'=>'COMU','cuentactble'=>'40011526','direccion'=>'Crta. Sant Boi, 24','cp'=>'8620','localidad'=>'Sant Vicens del Horts','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A58172875','tfno'=>'936569040','emailgral'=>'comercial@spandex.com','emailadm'=>'','web'=>'www.shop.spandex.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'DEL RIO CARTONATGES, S.L.U.','entidad5'=>'DELR','cuentactble'=>'40010317','direccion'=>'Energia, 37','cp'=>'8940','localidad'=>'Cornellˆ de LLobregat','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B64233372','tfno'=>'934742729','emailgral'=>'info@delrio.cat','emailadm'=>'quim@delrio.cat','web'=>'www.delrio.cat','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'DPIS SUMINIST. DIGITALES, S.A','entidad5'=>'DPIS','cuentactble'=>'40010312','direccion'=>'Torrassa, nave 6 - Pol. Ind. sur sector p-3','cp'=>'8440','localidad'=>'Cardedeu','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B63316467','tfno'=>'938455034','emailgral'=>'comercial@dpis.es','emailadm'=>'Aleix@dpis.es','web'=>'www.dpis.es','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'DUGOPA, S.A.','entidad5'=>'DUGO','cuentactble'=>'40010054','direccion'=>'Alcal‡, 18','cp'=>'28014','localidad'=>'Madrid','provincia_id'=>'Madrid','pais_id'=>'ES','nif'=>'A28025732','tfno'=>'932013999','emailgral'=>'smontesinos@dugopa.com','emailadm'=>'amartinez@dugopa.com','web'=>'www.dugopa.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'DURST IMAGE TECHNO. IBERICA,SA','entidad5'=>'DURS','cuentactble'=>'40010310','direccion'=>'Basauri, 6, 1¼ - La Florida','cp'=>'28023','localidad'=>'Madrid','provincia_id'=>'Madrid','pais_id'=>'ES','nif'=>'A85169225','tfno'=>'902108328','emailgral'=>'Sergio.Rodriguez@durst-group.com','emailadm'=>'','web'=>'www.durst-group.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'EMBALAJES Y GRAPAS, S.A.','entidad5'=>'EMBA','cuentactble'=>'40010403','direccion'=>'Galileo, 286','cp'=>'8028','localidad'=>'Barcelona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A58087537','tfno'=>'934909637','emailgral'=>'','emailadm'=>'','web'=>'www.embagrap.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'EMILIANO MARTIN, S.A.','entidad5'=>'EMIL','cuentactble'=>'40010421','direccion'=>'Fundici—n, 22 - Ribas Vaciamadrid','cp'=>'28528','localidad'=>'Madrid','provincia_id'=>'Madrid','pais_id'=>'ES','nif'=>'A28675908','tfno'=>'913292989','emailgral'=>'barcelona@emilianomartin.com','emailadm'=>'','web'=>'www.emilianomartin.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'tel.Bcn: 933778155','estado'=>'0'],
            ['entidad'=>'ENDUTEX IBERICA,S.A','entidad5'=>'ENDU','cuentactble'=>'40010437','direccion'=>'Boters, 8  Pol. Ind.Vilanoveta - \N','cp'=>'8810','localidad'=>'Sant Pere de Ribas','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A58673849','tfno'=>'902435363','emailgral'=>'dani@endutex.es','emailadm'=>'eli@endutexiberica.es','web'=>'www.endutex.es','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'ESKO-GRAPHICS NV','entidad5'=>'ESKO','cuentactble'=>'40010435','direccion'=>'Kortrjksesteenweg 1095 - Gent','cp'=>'9051','localidad'=>'Belgium','provincia_id'=>'','pais_id'=>'BE','nif'=>'BE0475099565','tfno'=>'','emailgral'=>'','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'FARGAS FLORIACH, JUAN','entidad5'=>'FARG','cuentactble'=>'40010427','direccion'=>'Comte d«Urgell, 55 bis','cp'=>'8036','localidad'=>'Barcelona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'36449835X','tfno'=>'934548324','emailgral'=>'maderasfargas@gmail.com','emailadm'=>'','web'=>'www.fustesfargas.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'FEDRIGONI ESPAÑA, S.L.','entidad5'=>'FEDR','cuentactble'=>'40010430','direccion'=>'Investigaci—n, 3 - Pol.Ind. Los Olivos','cp'=>'28906','localidad'=>'Getafe','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B80521701','tfno'=>'916846118','emailgral'=>'','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'FRANCESC CODINA, S.L.','entidad5'=>'FRAN','cuentactble'=>'40010457','direccion'=>'Doctor Cabanes, 6','cp'=>'8221','localidad'=>'Terrassa','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B61275145','tfno'=>'937801704 - 647587798','emailgral'=>'info@tuboscodina.com','emailadm'=>'','web'=>'www.tuboscodina.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'FUJIFILM ESPANA, S.A.','entidad5'=>'FUJI','cuentactble'=>'40010404','direccion'=>'Arag—n, 180','cp'=>'8011','localidad'=>'Barcelona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'W0047861J','tfno'=>'934511515','emailgral'=>'','emailadm'=>'','web'=>'www.fujifilm.es','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'ISA.117721','password'=>'FUJIFILMISA4','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'www.fujifilm.es/pedidosonline','estado'=>'0'],
            ['entidad'=>'HERRAMIENTAS SALVADOR, S.L.','entidad5'=>'HERR','cuentactble'=>'40010704','direccion'=>'Horizontal, 25','cp'=>'8016','localidad'=>'Barcelona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B60662434','tfno'=>'933547199','emailgral'=>'','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'HEXIS GRAPHICS ESPAÑA, S.L.','entidad5'=>'HEXI','cuentactble'=>'40010710','direccion'=>'Frances Maciˆ, Naves 68 y 70 - P.I. Can Terrers','cp'=>'8530','localidad'=>'La Garriga','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B97171037','tfno'=>'937322500 - 617593168','emailgral'=>'atencionalcliente@hexis.es','emailadm'=>'Aitor.HERRERO@hexis.es','web'=>'www.hexis-graphics.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'HIPER ALUMINIO, S.A.','entidad5'=>'HIPE','cuentactble'=>'40010703','direccion'=>'C—rcega, 561','cp'=>'8025','localidad'=>'Barcelona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A58087818','tfno'=>'933478556','emailgral'=>'','emailadm'=>'','web'=>'www.hiperaluminio.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'JUGUETES TEIXIDO, S.C.P.','entidad5'=>'JUGE','cuentactble'=>'40010804','direccion'=>'LLu’s Companys, 38','cp'=>'8921','localidad'=>'Sta. Coloma de Gramanet','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'G08970089','tfno'=>'933852490','emailgral'=>'jt@juguetesteixido.com','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'JORGE HERNANDEZ, S.L.','entidad5'=>'JORG','cuentactble'=>'40010802','direccion'=>'Flassaders, S/N - Tall. 2 Nave 15','cp'=>'8130','localidad'=>'Sta. Perpetœa de la Mogoda','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B60198462','tfno'=>'937181192','emailgral'=>'info@jhernandezsl.com','emailadm'=>'','web'=>'www.jhernandezsl.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'MAUSA MAD. DEL ALTO URGELL,S.A','entidad5'=>'MAUS','cuentactble'=>'40011226','direccion'=>'Tirso de Molina, 2','cp'=>'8940','localidad'=>'Cornellˆ de LLobregat','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A08132656','tfno'=>'933774050','emailgral'=>'samuelcenteno@mausa.net','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'MORA Y GOMA, S.A.','entidad5'=>'MORA','cuentactble'=>'40011210','direccion'=>'F‡brica, 20 - La Riba','cp'=>'43450','localidad'=>'Tarragona','provincia_id'=>'Tarragona','pais_id'=>'ES','nif'=>'A43005024','tfno'=>'977876211','emailgral'=>'moraygoma@gmail.com; ','emailadm'=>'moragoma57@gmail.com','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'NET DISPLAY, S.L.','entidad5'=>'NETD','cuentactble'=>'40011217','direccion'=>'C/ de Hormigueras, 115 - P.I. Vallecas','cp'=>'28031','localidad'=>'Madrid','provincia_id'=>'Madrid','pais_id'=>'ES','nif'=>'B82491283','tfno'=>'914250247','emailgral'=>'info@netdisplay.es','emailadm'=>'','web'=>'www.netdisplay.es','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'NOVA PRISMA DIGITAL, S.L.','entidad5'=>'NOVA','cuentactble'=>'40011222','direccion'=>'Crta. Molins-Sabadell, km 13 - Pol. Can Roses/ La Bastida, Nave 26','cp'=>'8191','localidad'=>'Rub’','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B63776223','tfno'=>'936992000','emailgral'=>'comercial@novaprisma.com','emailadm'=>'','web'=>'www.novaprisma.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'PROFESIONAL L«ART, S.L.','entidad5'=>'PROF','cuentactble'=>'40011310','direccion'=>'P¼ Picasso, 22','cp'=>'8003','localidad'=>'Barcelona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B58328758','tfno'=>'933107733','emailgral'=>'ventas@artprofessional.com','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'UNION PAPELERA MERCHANTING, S.L.','entidad5'=>'UNIO','cuentactble'=>'','direccion'=>'GREGAL','cp'=>'8820','localidad'=>'El Prat de Llobregat','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B62219290','tfno'=>'933740315','emailgral'=>'clientes@unionpapelera.es','emailadm'=>'','web'=>'www.updirecto.es','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'POSTER AND PANEL, S.L.','entidad5'=>'POST','cuentactble'=>'40011325','direccion'=>'Pol.Ind.Illa Sud-Pere Andorra - n.5-6','cp'=>'8650','localidad'=>'Sallent','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B65565749','tfno'=>'938372565','emailgral'=>'','emailadm'=>'','web'=>'www.posterandpanel.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'007774 — 7774','password'=>'786hh5','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'RAJAPACK, S.A.','entidad5'=>'RAJA','cuentactble'=>'40011407','direccion'=>'Montcada, 12 - Pol.Ind. Camp Pereres','cp'=>'8130','localidad'=>'Sta. Perptua de la Mogoda','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A63232805','tfno'=>'935603892','emailgral'=>'contacto@rajapack.es','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'REMS EMBALATGES, S.L.','entidad5'=>'REMS','cuentactble'=>'40011401','direccion'=>'Llull, 57-61','cp'=>'8005','localidad'=>'Barcelona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B63431613','tfno'=>'934864646','emailgral'=>'rems@remssl.net','emailadm'=>'','web'=>'www.remssl.net','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'RIBERA DIGITAL, S.L.','entidad5'=>'RIBE','cuentactble'=>'40011424','direccion'=>'Pol’gono Industrial Bufalvent, Carrer d Esteve Terradas, 37B','cp'=>'8243','localidad'=>'Manresa','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B65614166','tfno'=>'938202831','emailgral'=>'jsinfreu@ribera-digital.com','emailadm'=>'','web'=>'www.ribera-digital.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'RICOH ESPAÑA, S.L.U.','entidad5'=>'RICO','cuentactble'=>'40011402','direccion'=>'Avda. Via Augusta, 71-73','cp'=>'8174','localidad'=>'Sant Cugat del Valls','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B82080177','tfno'=>'935821200','emailgral'=>'','emailadm'=>'','web'=>'www.ricoh.es/cac','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'grafitex','password'=>'grafi8266','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'SERVICIO ESTACION, S.A.','entidad5'=>'SERV','cuentactble'=>'40011505','direccion'=>'Arag—n, 270','cp'=>'8007','localidad'=>'Barcelona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A08023780','tfno'=>'933932410','emailgral'=>'info@serveiestacio.com','emailadm'=>'','web'=>'www.serveiestacio.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'SITOUR','entidad5'=>'SITF','cuentactble'=>'40011512','direccion'=>'15 Bi Rue Charles Michels - 95012 BP 30049 Argenteuil','cp'=>'','localidad'=>'France','provincia_id'=>'','pais_id'=>'FR','nif'=>'FR84562064972','tfno'=>'130258850','emailgral'=>'info@sitour.fr','emailadm'=>'','web'=>'www.sitour.fr','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'SUMINISTROS IND. SUGAR, S.L.','entidad5'=>'SUMI','cuentactble'=>'40011521','direccion'=>'La Sagrera, 173 bis','cp'=>'8027','localidad'=>'Barcelona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B60746443','tfno'=>'933529311','emailgral'=>'info@sugar.es','emailadm'=>'','web'=>'www.sugar.es','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'SUNCLEAR, S.A.U.','entidad5'=>'SUNC','cuentactble'=>'40011504','direccion'=>'Raiguer, S/N - Pol. Ind. El Raiguer','cp'=>'8160','localidad'=>'Montmel—','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A60291655','tfno'=>'933369980','emailgral'=>'Diana.Pico@sunclear.es','emailadm'=>'','web'=>'www.sunclear.es','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'THYSSENKRUPP PLASTIC IBERIC,SL','entidad5'=>'THYS','cuentactble'=>'40011334','direccion'=>'Frente Estaci—n Renfe, S/N - \N','cp'=>'46080','localidad'=>'MASSALFASSAR','provincia_id'=>'Valencia','pais_id'=>'ES','nif'=>'B97011365','tfno'=>'961417030','emailgral'=>'joseluis.saez@thyssenkrupp.com','emailadm'=>'','web'=>'www.thyssenkrupp-plastics.es','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'VEGIO, S.L.','entidad5'=>'VEGI','cuentactble'=>'40011645','direccion'=>'Granatxa, 12 - P.Emp. Cervell˜','cp'=>'8758','localidad'=>'Cervell˜','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B60389657','tfno'=>'936730525','emailgral'=>'vegio@vegio.es','emailadm'=>'comercial@vegio.es','web'=>'www.papelycarton.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'VINK PLASTICS SPAIN, S.L.U','entidad5'=>'VINK','cuentactble'=>'40011016','direccion'=>'Can Bosquerons, 3, nave 1','cp'=>'8170','localidad'=>'Montorns del Valls','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B65697203','tfno'=>'935683961','emailgral'=>'kilian@lermontplastics.es','emailadm'=>'','web'=>'www.vinkplastics.es','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'WERKHAUS,S.L.','entidad5'=>'WERK','cuentactble'=>'40011636','direccion'=>'P¼ Zona Franca, 99-105','cp'=>'8038','localidad'=>'Barcelona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'D59474577','tfno'=>'932231923','emailgral'=>'','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'GLOBAL PACKANGING INDUSTRIES SL','entidad5'=>'GLOB','cuentactble'=>'','direccion'=>'Pol.Ind.Mol’ D en Xec Nave 8','cp'=>'8291','localidad'=>'Ripollet','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B62287495','tfno'=>'9343278181','emailgral'=>'globalpack@globalpack.es','emailadm'=>'','web'=>'www.globalpack.es','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'CANON ESPAÑA, S.A.','entidad5'=>'CANO','cuentactble'=>'','direccion'=>'de Europa, 6','cp'=>'28108','localidad'=>'Alcobendas y la Moraleja','provincia_id'=>'Madrid','pais_id'=>'ES','nif'=>'A28122125','tfno'=>'93 484 4800','emailgral'=>'','emailadm'=>'','web'=>'www.papel.canon.es','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'miguelbeltran@grafitex.net','password'=>'Grafitex(2018) — GraFI8266','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'FUSTIER, S.A.','entidad5'=>'FUST','cuentactble'=>'','direccion'=>'Afonso XII, 579-585','cp'=>'8918','localidad'=>'Badalona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A58284902','tfno'=>'934600479','emailgral'=>'','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'COMERCIAL ARTEPLASTICA, S.A.','entidad5'=>'ARTE','cuentactble'=>'','direccion'=>'de la Industria, 7','cp'=>'28947','localidad'=>'Fuenlabrada','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A28873099','tfno'=>'91 642 43 00','emailgral'=>'barcelona@arteplastica.es','emailadm'=>'damian@arteplastica.es','web'=>'www.arteplastica.es','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'PAPERGRAPHICS WIDE FORMAT SPECIALIST SL','entidad5'=>'PAPE','cuentactble'=>'','direccion'=>'Arenys, 3','cp'=>'8380','localidad'=>'Malgrat de Mar','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B65695900','tfno'=>'937612221','emailgral'=>'info.es@paper-graphics.com','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'LA MURTRA, S.L.','entidad5'=>'MURT','cuentactble'=>'','direccion'=>'Veneuela, 58','cp'=>'8019','localidad'=>'Barcelona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B08826299','tfno'=>'936731496','emailgral'=>'','emailadm'=>'','web'=>'www.mecaring.net','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'JANSEN DISPLAY IBERIA, S.L.','entidad5'=>'JANS','cuentactble'=>'','direccion'=>'Pelayo, 12','cp'=>'8001','localidad'=>'Barcelona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B65970576','tfno'=>'650 68 13 76','emailgral'=>'ordersES@showdowndisplays.eu','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'JUGUETES TEIXIDO, S.L.','entidad5'=>'JUGU','cuentactble'=>'','direccion'=>'Llu’s Companys, 38','cp'=>'8921','localidad'=>'Santa Coloma de Gramanet','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B66798851','tfno'=>'933852490','emailgral'=>'','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'METALART, S.C.C.L.','entidad5'=>'META','cuentactble'=>'','direccion'=>'Berqueda, 15','cp'=>'8130','localidad'=>'Santa Perpetua de Moguda','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'F66206376','tfno'=>'935740980','emailgral'=>'pbello@mtlprojects.es','emailadm'=>'administracion@mtlprojects.es','web'=>'www.mtlprojects.es','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'DISTRITECNO TECNO ADHESIVO, S.L.','entidad5'=>'DIST','cuentactble'=>'','direccion'=>'Del Cementiri, 35','cp'=>'8319','localidad'=>'Dosrius','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B60719341','tfno'=>'937918060','emailgral'=>'info@distritecno.com','emailadm'=>'','web'=>'www.distritecno.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'INAPA ESPAÑA DISTRIBUCIîN DE PAPEL, S.A.','entidad5'=>'INAP','cuentactble'=>'','direccion'=>'Deico, 2','cp'=>'28914','localidad'=>'Leganes','provincia_id'=>'Madrid','pais_id'=>'ES','nif'=>'A81828410','tfno'=>'639893917','emailgral'=>'ernesto.puertas@inapa.es','emailadm'=>'','web'=>'www.inapa.es','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'CARPAPSA','entidad5'=>'CARP','cuentactble'=>'','direccion'=>'De Les Garrigues, 33','cp'=>'8820','localidad'=>'El Prat del Llobregat','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A58015645','tfno'=>'','emailgral'=>'','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'BRILDOR, S.L.','entidad5'=>'BRIL','cuentactble'=>'','direccion'=>'Pol.Ind. La Creueta - Calle Constituci—n 7E','cp'=>'3827','localidad'=>'Benimarfull','provincia_id'=>'Alicante','pais_id'=>'ES','nif'=>'B03308681','tfno'=>'966516572','emailgral'=>'atencionalcliente@brildor.com','emailadm'=>'','web'=>'www.brildor.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'SAINT HONORƒ, S.A.','entidad5'=>'SAIN','cuentactble'=>'','direccion'=>'Alfonso XII, 617-633','cp'=>'8918','localidad'=>'Badalona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A08126641','tfno'=>'','emailgral'=>'','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'SUPERIMANES, S.L.','entidad5'=>'SUPE','cuentactble'=>'','direccion'=>'Azahar, 36','cp'=>'41120','localidad'=>'Gelves','provincia_id'=>'Sevilla','pais_id'=>'ES','nif'=>'B90195587','tfno'=>'','emailgral'=>'','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'HERME PLUS, S.L.','entidad5'=>'HERM','cuentactble'=>'','direccion'=>'Puerto de Navacerrada, 83','cp'=>'28935','localidad'=>'Mostoles','provincia_id'=>'Madrid','pais_id'=>'ES','nif'=>'B85356160','tfno'=>'','emailgral'=>'','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'ROTULA TU MISMO, S.L.','entidad5'=>'ROTU','cuentactble'=>'','direccion'=>'Alejandro VI, 6B','cp'=>'46136','localidad'=>'Museros','provincia_id'=>'Valencia','pais_id'=>'ES','nif'=>'B98901366','tfno'=>'960659400','emailgral'=>'info@rotulatumismo.com','emailadm'=>'','web'=>'www.rotulatumismo.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'SITOUR IBER, S.L.','entidad5'=>'SITO','cuentactble'=>'','direccion'=>'Sant Pere, 66','cp'=>'8010','localidad'=>'Barcelona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B67310540','tfno'=>'','emailgral'=>'','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'MECANIZADOS PROMEI, S.L.','entidad5'=>'MECA','cuentactble'=>'','direccion'=>'Guadalajara, 2','cp'=>'2520','localidad'=>'Chinchilla de Monte Aragon','provincia_id'=>'Arag—n','pais_id'=>'ES','nif'=>'B02275378','tfno'=>'967260641','emailgral'=>'promei@promei.com','emailadm'=>'','web'=>'www.promei.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'OFIJET, S.L.','entidad5'=>'OFIJ','cuentactble'=>'','direccion'=>'Mare de Deu del Remei, 16','cp'=>'8004','localidad'=>'Barcelona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B58558693','tfno'=>'933494366','emailgral'=>'ofijet@ofijet.net','emailadm'=>'','web'=>'www.ofijet.net','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'METHOD ZERO, S.L.U.','entidad5'=>'METH','cuentactble'=>'','direccion'=>'Retama, 5','cp'=>'13005','localidad'=>'Ciudad Real','provincia_id'=>'Ciudad Real','pais_id'=>'ES','nif'=>'B80597818','tfno'=>'','emailgral'=>'','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'ABARNON, S.L.','entidad5'=>'ABAR','cuentactble'=>'','direccion'=>'Navarra, 5','cp'=>'8184','localidad'=>'Palau-Solita i Plegamans','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B64460579','tfno'=>'931145304 - 678802969','emailgral'=>'abarnom@abarnom.com','emailadm'=>'','web'=>'www.abarnom.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'CREACIONES DOFI, S.L.','entidad5'=>'CREA','cuentactble'=>'','direccion'=>'Dolores Almeda, 39','cp'=>'8940','localidad'=>'Cornellˆ de Llobregat','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B60477890','tfno'=>'933776018 - 931160780','emailgral'=>'fabricantesregalos@gmail.com','emailadm'=>'','web'=>'www.creacionesdofi.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'ESPUMAS DEL VALLES, S.A.','entidad5'=>'ESPU','cuentactble'=>'','direccion'=>'Pintor Vila Cinca, 20','cp'=>'8213','localidad'=>'Polinya','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A58113226','tfno'=>'937134330','emailgral'=>'info@espumasdelvalles.com','emailadm'=>'saviles@espumadelvalles.com','web'=>'www.espumadelvalles.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'BOLSAVAL IMPRESORES, S.L.','entidad5'=>'BOLS','cuentactble'=>'','direccion'=>'Matalafers, 30','cp'=>'46394','localidad'=>'Granja Ecuela Hermanas Chavas','provincia_id'=>'Valencia','pais_id'=>'ES','nif'=>'B98735301','tfno'=>'963050747','emailgral'=>'info@creabolsas.com','emailadm'=>'','web'=>'www.creabolsas.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'HIJOS DE FRANCISCO CAMINA, S.L.','entidad5'=>'HIJO','cuentactble'=>'','direccion'=>'Miquel Servet, 19','cp'=>'3203','localidad'=>'Elche','provincia_id'=>'Alicante','pais_id'=>'ES','nif'=>'B03929270','tfno'=>'965434790','emailgral'=>'info@grupo-gp.com','emailadm'=>'','web'=>'www.grupo-gp.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'GLOBAL DISPLAY, S.L.','entidad5'=>'GDIS','cuentactble'=>'','direccion'=>'Mollet, 18','cp'=>'8120','localidad'=>'La Llagosta','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B62804943','tfno'=>'935740503','emailgral'=>'info@globaldisplayplv.com','emailadm'=>'','web'=>'www.globaldisplay.info','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'PRESOLME, S.L.','entidad5'=>'PRES','cuentactble'=>'','direccion'=>'Pereda, 9-11','cp'=>'8930','localidad'=>'Sant Adri‡ del Besos','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B62157037','tfno'=>'933815913 - 933812130','emailgral'=>'presolmesl@presolmesl.com','emailadm'=>'','web'=>'www.presolmesl.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'PRIPLAK SAS','entidad5'=>'PRIP','cuentactble'=>'','direccion'=>'De L Europe','cp'=>'60530','localidad'=>'Neuilly en Thelle','provincia_id'=>'Francia','pais_id'=>'FR','nif'=>'FR29316709500','tfno'=>'33344269890','emailgral'=>'contact@priplak.com','emailadm'=>'','web'=>'www.priplak.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'CAYFI, S.L.','entidad5'=>'CAYF','cuentactble'=>'','direccion'=>'Torrent D en Baiell, 32','cp'=>'8181','localidad'=>'Sentmenat','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'B08723017','tfno'=>'937151900','emailgral'=>'tienda@cayfi.com','emailadm'=>'','web'=>'www.cayfi.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'CABLEMATIC, S.A.','entidad5'=>'CABL','cuentactble'=>'','direccion'=>'Santander, 61','cp'=>'8020','localidad'=>'Barcelona','provincia_id'=>'Barcelona','pais_id'=>'ES','nif'=>'A0121189','tfno'=>'934987113','emailgral'=>'info@cablematic.com','emailadm'=>'','web'=>'www.cablematic.com','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'KONSBERG PRECISION CUTTING SYSTEMS','entidad5'=>'KONS','cuentactble'=>'','direccion'=>'Kortrjksesteenweg 1095 - Gent','cp'=>'9051','localidad'=>'Belgium','provincia_id'=>'','pais_id'=>'BE','nif'=>'BE0759743392','tfno'=>'','emailgral'=>'','emailadm'=>'','web'=>'','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
            ['entidad'=>'METACRILATO.EU','entidad5'=>'METC','cuentactble'=>'','direccion'=>'De la Floresta, 15','cp'=>'46022','localidad'=>'Valencia','provincia_id'=>'Valencia','pais_id'=>'ES','nif'=>'B98060494','tfno'=>'963816628','emailgral'=>'ventas@metacrilato.eu','emailadm'=>'','web'=>'www.metacrilato.eu','banco1'=>'','iban1'=>'','banco2'=>'','iban2'=>'','banco3'=>'','iban3'=>'','usuario'=>'','password'=>'','metodopago_id'=>'1','diafactura'=>'1','diavencimiento'=>'10','observaciones'=>'','estado'=>'0'],
        ]);
    }
}

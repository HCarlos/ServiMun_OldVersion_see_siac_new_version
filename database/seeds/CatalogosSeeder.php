<?php

use App\Models\Catalogos\Area;
use App\Models\Catalogos\Dependencia;
use App\Models\Catalogos\Domicilios\Afiliacion;
use App\Models\Catalogos\Domicilios\Asentamiento;
use App\Models\Catalogos\Domicilios\Calle;
use App\Models\Catalogos\Domicilios\Ciudad;
use App\Models\Catalogos\Domicilios\Codigopostal;
use App\Models\Catalogos\Domicilios\Colonia;
use App\Models\Catalogos\Domicilios\Comunidad;
use App\Models\Catalogos\Domicilios\Estado;
use App\Models\Catalogos\Domicilios\Localidad;
use App\Models\Catalogos\Domicilios\Municipio;
use App\Models\Catalogos\Domicilios\Pais;
use App\Models\Catalogos\Domicilios\Sepomex;
use App\Models\Catalogos\Domicilios\Tipoasentamiento;
use App\Models\Catalogos\Domicilios\Tipocomunidad;
use App\Models\Catalogos\Estatu;
use App\Models\Catalogos\Medida;
use App\Models\Catalogos\Origen;
use App\Models\Catalogos\Prioridad;
use App\Models\Catalogos\Servicio;
use App\Models\Catalogos\Subarea;
use App\Models\Users\Categoria;
use Illuminate\Database\Seeder;

class CatalogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Categoria::findOrImport( 'Ciudadano');
        Categoria::findOrImport( 'Gestor Social');
        Categoria::findOrImport( 'líder');
        Categoria::findOrImport( 'Delegado Municipal');
        Categoria::findOrImport( 'Funcionario');
        Categoria::findOrImport( 'COMISARIADO EJIDAL');
        Categoria::findOrImport( 'LIDER RELIGIOSO');
        Categoria::findOrImport( 'JEFE DE MANZANA');
        Categoria::findOrImport( 'PASTOR');
        Categoria::findOrImport( 'JEFE DE SECCION');
        Categoria::findOrImport( 'PRESIDENTE DE CAMINO');
        Categoria::findOrImport( 'GERENTE');
        Categoria::findOrImport( 'DIRECTOR(A) DE ESCUELA');
        Categoria::findOrImport( 'REPRESENTANTE DE COMITE RELIGIOSO');
        Categoria::findOrImport( 'COMITE DEL FRACCIONAMIENTO');
        Categoria::findOrImport( 'SUBSECRETARIO');
        Categoria::findOrImport( 'COMITE DE ARMINISTRACION');
        Categoria::findOrImport( 'INMOBILIARIO');
        Categoria::findOrImport( 'NOTARIA');
        Categoria::findOrImport( 'NOTARIO PUBLICO');
        Categoria::findOrImport( 'COORDINADOR DEL EVENTO');
        Categoria::findOrImport( 'DIRECTORA DE MUSEOS');
        Categoria::findOrImport( 'PRESBITERO');
        Categoria::findOrImport( 'PRESIDENTE DE A.C');
        Categoria::findOrImport( 'PARROCO');
        Categoria::findOrImport( 'COORDINADOR ESTATAL');
        Categoria::findOrImport( 'COORDINADOR ESTATAL DE ASOCIACION CIVIL');
        Categoria::findOrImport( 'MINISTRO ASOCIADO');
        Categoria::findOrImport( 'PRESIDENTE');
        Categoria::findOrImport( 'MIEMBRO DE LA IGLESIA ');
        Categoria::findOrImport( 'DELEGADA(O)');
        Categoria::findOrImport( 'PRESIDENTA DE LA FUNDACION');
        Categoria::findOrImport( 'REPRESENTANTE LEGAL');
        Categoria::findOrImport( 'JEFE DE PAQUETERIA');
        Categoria::findOrImport( 'PROPIETARIO');
        Categoria::findOrImport( 'ADMINISTRADORA');
        Categoria::findOrImport( 'PRESIDENTA DE LA SOC. DE ALUMNOS');
        Categoria::findOrImport( 'SUBDIRECTOR');
        Categoria::findOrImport( 'DIRECTORA');
        Categoria::findOrImport( 'COORDINADOR');
        Categoria::findOrImport( 'COMITE DE PARTICIPACION CIUDADANA');
        Categoria::findOrImport( 'ENCARGADO(A)');
        Categoria::findOrImport( 'SUBGERENTE');
        Categoria::findOrImport( 'COORDINADOR GENERAL SAS');
        Categoria::findOrImport( 'JEFE DE SEGURIDAD');
        Categoria::findOrImport( 'CIUDADANO(A)');
        Categoria::findOrImport( 'SECRETARIA');
        Categoria::findOrImport( 'SUB-COORDINADOR');
        Categoria::findOrImport( 'REPORTERO');
        Categoria::findOrImport( 'CAPITAN 30/A ZONA MILITAR');
        Categoria::findOrImport( 'SECRETARIO GENERAL');
        Categoria::findOrImport( 'RECTOR');
        Categoria::findOrImport( 'ARTESANO');
        Categoria::findOrImport( 'ESTUDIANTE');
        Categoria::findOrImport( 'DIRECTOR');
        Categoria::findOrImport( 'PRESIDENTE DEL COMITE DE DESAYUNOS ESCOLARES');
        Categoria::findOrImport( 'SUPERVISORA DE EDUCACIÓN ESPECIAL');
        Categoria::findOrImport( 'PRESTADOR DE SERVICIOS DE TURISMO DE AVENTURA');
        Categoria::findOrImport( 'PRESTADOR DE SERVICIOS TURÍSTICOS');
        Categoria::findOrImport( 'SUPERVISOR');
        Categoria::findOrImport( 'PRESIDENTE DE LA SOC. DE PADRES DE FAMILIA');
        Categoria::findOrImport( 'DIACONO ');
        Categoria::findOrImport( 'PASTORA');
        Categoria::findOrImport( 'SECRETARIO DE TRABAJO Y CONFLICTO TIANGUIS JESUS T');
        Categoria::findOrImport( 'JEFE DE MANZA');
        Categoria::findOrImport( 'ESCULTOR/ARTISTA PLASTICO');
        Categoria::findOrImport( 'PRESIDENTE DE CONFEDERACION');
        Categoria::findOrImport( 'COORDINADOR DE LA PASTORAL JUVENIL');
        Categoria::findOrImport( 'PROMOTORA COMUNITARIA');
        Categoria::findOrImport( 'PROMOTOR COMUNITARIO');
        Categoria::findOrImport( 'COORDINADOR DE ATENCION CIUDADANA DEL GOBIERNO DEL ESTADO');
        Categoria::findOrImport( 'PROMOTORES SOCIALES');

        Dependencia::findOrImport( 'DECUR', 'DECU','',1,0,1,1);
        Dependencia::findOrImport( 'COORDINACION DE SALUD', 'SS','',1,0,1,1);
        Dependencia::findOrImport( 'OTROS', 'OTRO','',0,0,1,1);
        Dependencia::findOrImport( 'SAS', 'SAS','',1,0,1,1);
        Dependencia::findOrImport( 'OBRAS PUBLICAS', 'OP','',1,0,1,1);
        Dependencia::findOrImport( 'DIRECCION DE DESARROLLO', 'DES','',1,0,1,1);
        Dependencia::findOrImport( 'SERVICIOS MUNICIPALES', 'SM','',1,1,1,1);
        Dependencia::findOrImport( 'COORDINACION DE FISCALIZACION', 'FIS','',1,0,1,1);
        Dependencia::findOrImport( 'DIF MUNICIPAL', 'DIF','',1,1,1,1);
        Dependencia::findOrImport( 'DIRECCION DE ATENCION CIUDADANA', 'DAC','',0,0,1,1);
        Dependencia::findOrImport( 'PROTECCION AMBIENTAL Y DESARROLLO SUSTENTABLE', 'PADS','',1,0,1,1);
        Dependencia::findOrImport( 'COORDINACION DE DELEGADOS', 'CDEL','',0,0,1,1);
        Dependencia::findOrImport( 'COORDINACION DE ASUNTOS RELIGIOSOS', 'CAR','',1,0,1,1);
        Dependencia::findOrImport( 'PRESIDENCIA', 'PRES','',0,0,1,1);
        Dependencia::findOrImport( 'INMUDEC', 'INM','',1,0,1,1);
        Dependencia::findOrImport( 'FINANZAS', 'FIN','',0,0,1,1);
        Dependencia::findOrImport( 'JURIDICO', 'JUR','',0,0,1,1);
        Dependencia::findOrImport( 'DIRECCION  DE ADMINISTRACION', 'DADM','',0,0,1,1);
        Dependencia::findOrImport( 'DIRECCION DE ATENCION A LAS MUJERES', 'DAM','',0,0,1,1);
        Dependencia::findOrImport( 'UNIDAD DE PROTECCION CIVIL', 'UPC','',1,0,1,1);
        Dependencia::findOrImport( 'FOMENTO ECONOMICO Y TURISMO', 'FET','',1,0,1,1);
        Dependencia::findOrImport( 'DEPENDENCIA DE GOBIERNO DEL ESTADO', 'GOBT','',0,0,1,1);
        Dependencia::findOrImport( 'SECRETARIA DEL AYUNTAMIENTO', 'SAYU','',0,0,1,1);
        Dependencia::findOrImport( 'COORDINACION DE JEFES DE MANZANA', 'CJM','',0,0,1,1);

        Area::findOrImport('BACHEO',5,1);
        Area::findOrImport('URBANA',5,1);
        Area::findOrImport('EDUCACIÓN',1,1);
        Area::findOrImport('INFRAESTRUCTURA',1,1);
        Area::findOrImport('DEPORTES',1,1);
        Area::findOrImport('RURAL',5,1);
        Area::findOrImport('JURÍDICO',5,1);
        Area::findOrImport('REGULACIÓN',5,1);
        Area::findOrImport('COMERCIO AMBULANTE',8,1);
        Area::findOrImport('ALCOHOLES Y ESPECTACULOS PUBLICOS',8,1);
        Area::findOrImport('ANUENCIAS Y ADMINISTRATIVOS',8,1);
        Area::findOrImport('DESARROLLO Y FORTALECIMIENTO RURAL',6,1);
        Area::findOrImport('DESARROLLO Y ORGANIZACIÓN SOCIAL',6,1);
        Area::findOrImport('Atención a la Discapacidad',9,1);
        Area::findOrImport('Concejo de Ancianos',9,1);
        Area::findOrImport('Coordinación de Salud DIF',9,1);
        Area::findOrImport('Voluntariado y Centros Asistenciales',9,1);
        Area::findOrImport('RURAL',3,1);
        Area::findOrImport('URBANA',3,1);
        Area::findOrImport('RURAL',3,1);
        Area::findOrImport('URBANA',3,1);
        Area::findOrImport('Recursos Materiales',18,1);
        Area::findOrImport('ZONA LUZ',21,1);
        Area::findOrImport('EMPLEO',21,1);
        Area::findOrImport('CASA DE LA TIERRA / MUSEVI',21,1);
        Area::findOrImport('MUSEVI',21,1);
        Area::findOrImport('COMERCIAL',4,1);
        Area::findOrImport('TÉCNICA',4,1);
        Area::findOrImport('OPERACIONES',4,1);
        Area::findOrImport('ADMINISTRATIVA',4,1);
        Area::findOrImport('REDES',4,1);
        Area::findOrImport('RURAL',4,1);
        Area::findOrImport('LABORATORIO',4,1);
        Area::findOrImport('CONTROL DE CALIDAD',4,1);
        Area::findOrImport('PARQUES,  JARDINES Y MONUMENTOS',7,1);
        Area::findOrImport('PANTEONES',7,1);
        Area::findOrImport('MERCADOS',7,1);
        Area::findOrImport('LIMPIA',7,1);
        Area::findOrImport('ALUMBRADO PÚBLICO',7,1);
        Area::findOrImport('UNIDAD JURÍDICA',23,1);
        Area::findOrImport('UNIDAD TÉCNICA',23,1);
        Area::findOrImport('OFICIALíAS DEL REGISTRO CIVIL',23,1);
        Area::findOrImport('SUBDIRECCIÓN DE CATASTRO',16,1);
        Area::findOrImport('SUBDIRECCIÓN DE INGRESOS',16,1);
        Area::findOrImport('JURÍDICO',7,1);
        Area::findOrImport('UNIDAD DE ATENCIÓN A ESPACIOS TRANSFERIDOS',7,1);
        Area::findOrImport('TURISMO',21,1);

        Subarea::findOrImport("general",1,1);

        Estatu::findOrImport("en proceso");

        Medida::findOrImport("pza");

        Origen::findOrImport("atención directa");

        Prioridad::findOrImport("urgente",0,"");

        Servicio::findOrImport('computador',1,1,1);

        Afiliacion::findOrImport('grupo 1');

        Asentamiento::findOrImport('Portal Del Agua');

        Calle::findOrImport('NARCIZO SAENZ ');

        Ciudad::findOrImport('villahermosa');

        Localidad::findOrImport('COL. 18 DE MARZO (SAN JOAQUIN)');

        Municipio::findOrImport('centro');

        Estado::findOrImport('tabasco');

        Pais::findOrImport('méxico');

        Codigopostal::findOrImport('86000','86100');

        Tipoasentamiento::findOrImport('Fraccionamiento');

        Tipocomunidad::findOrImport('tipocomunidad');

        Comunidad::findOrImport('COL. 18 DE MARZO (SAN JOAQUIN)',1,1);

        Colonia::findOrImport('18 DE MARZO (SAN JOAQUIN)','86000',0.00,0.00,0.00,1,1,1);

        Sepomex::findOrImport('urbana',1,1,1,1,1,1);

    }

}

<?php
  
namespace App\Support;
  
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Form;
use View;
use Validator;
use Input;
use Redirect;
use Session;
use DateTime;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use App\Models\Front\Freelancer;
use App\Models\Front\FormacionAcademica;
use App\Models\Front\ExperienciaLaboral;
use App\Models\Front\SupervisionTecnica;
use App\Models\Front\Revision;
use App\Models\Front\ModelacionBim;
use App\Models\Front\Idioma;
use App\Models\Front\Documento;
use App\Models\Admin\Profesion;
use App\Models\Admin\AreaProfesion;
use Illuminate\Routing\Controller;
use App\Models\Front\Galeria;
use App\Models\Front\ImagenGaleria;
use App\Models\Front\ComentarioGaleria;

  
trait Perfiles {
  
    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function saveFormacionAcademica( $tipo_relacion,
                                            $idrelacion,
                                            $tipoFormacion,
                                            $nivelFormacion,
                                            $titulo,
                                            $universidad,
                                            $anio_culminacion ) {
        
        if($nivelFormacion == NULL){
            return true;
        }
  
        for($count = 0; $count < count($nivelFormacion); $count++)
        {
            $data = array(
                'tipo_relacion' => $tipo_relacion,
                'idrelacion' => $idrelacion*1,
                'tipoFormacion' => $tipoFormacion,
                'nivelFormacion' => $nivelFormacion[$count],
                'titulo' => $titulo[$count],    
                'universidad' => $universidad[$count],
                'anio_culminacion'  => $anio_culminacion[$count]*1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );

            $insert_data[] = $data; 

        }

        $saveFormacion = FormacionAcademica::insert($insert_data);  
        
        if($saveFormacion){

            return true;

        }else{

            return false;
        }
    }

    public function saveExperienciaLaboral ($tipo_relacion,
                                            $idrelacion,
                                            $anios_experiencia,
                                            $m2_disenados,
                                            $tipo_estructuras_disenadas,
                                            $actividades_desempena,
                                            $uso_software,
                                            $disponibilidad_personal,
                                            $certificados_cursos_seminarios,
                                            $disponibilidad_viajar,
                                            $tipo_contratacion,
                                            $costo_por_unidad_contratacion,
                                            $iddisciplina)
    
    {
        $success = false;
        DB::beginTransaction();
        try {
            $experiencia = ExperienciaLaboral::where('tipo_relacion',$tipo_relacion)->where('idrelacion',$idrelacion)->where('iddisciplina',$iddisciplina)->first();
            if($experiencia == NULL){
                $experiencia = New ExperienciaLaboral;
            }
            
            $experiencia->tipo_relacion = $tipo_relacion;
            $experiencia->idrelacion = $idrelacion;
            $experiencia->iddisciplina = $iddisciplina;
            $experiencia->anios_experiencia = $anios_experiencia;
            $experiencia->m2_disenados = $m2_disenados;
            $experiencia->tipo_estructuras_disenadas = $tipo_estructuras_disenadas;
            $experiencia->actividades_desempena = $actividades_desempena;
            $experiencia->uso_software = $uso_software;
            $experiencia->disponibilidad_personal = $disponibilidad_personal;
            $experiencia->certificados_cursos_seminarios = $certificados_cursos_seminarios;
            $experiencia->disponibilidad_viajar = $disponibilidad_viajar;
            $experiencia->tipo_contratacion = $tipo_contratacion;
            $experiencia->costo_por_unidad_contratacion = $costo_por_unidad_contratacion;

            if($experiencia->save()){
                $success = true;
            }else{
                $success = false;
            }


        }catch (\Exception $e) {
            echo $e->getMessage();die();
            // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
        }

        if($success){
            DB::commit();
            return true;
        }else{
            DB::rollback();
            return false;
        }

    }

    public function saveIdiomas( $tipo_relacion,
                                $idrelacion,
                                $nombreIdioma,
                                $nivelIdioma,
                                $iddisciplina ) 
    {

        if($nombreIdioma == NULL){
            return true;
        }
        for($count = 0; $count < count($nombreIdioma); $count++)
        {
            $data = array(
                'tipo_relacion' => $tipo_relacion,
                'idrelacion' => $idrelacion*1,
                'iddisciplina' => $iddisciplina*1,
                'nombreIdioma' => $nombreIdioma[$count],
                'nivelIdioma' => $nivelIdioma[$count],    
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );

            $insert_idioma[] = $data; 

        }

        $saveIdioma = Idioma::insert($insert_idioma);  

        if($saveIdioma){

            return true;

        }else{

            return false;
        }
    }

    public function saveModelacion ($tipo_relacion,
                                    $idrelacion,
                                    $ha_trabajado_bim,
                                    $anios_experiencia,
                                    $m2_disenados_bim,
                                    $tipo_estructuras_disenadas,
                                    $uso_software_bim,
                                    $tiene_certificados_bim,
                                    $desea_aprender_bim,
                                    $iddisciplina)

    {
        $success = false;
        DB::beginTransaction();
        try {
            $modelacion = ModelacionBim::where('tipo_relacion',$tipo_relacion)->where('idrelacion',$idrelacion)->where('iddisciplina',$iddisciplina)->first();
            if($modelacion == NULL){
                $modelacion = New ModelacionBim;
            }


            if($ha_trabajado_bim == "0"){

                $modelacion->tipo_relacion = $tipo_relacion;
                $modelacion->idrelacion = $idrelacion;
                $modelacion->iddisciplina = $iddisciplina;
                $modelacion->ha_trabajado_bim = $ha_trabajado_bim;
                $modelacion->desea_aprender_bim = $desea_aprender_bim;

                if($modelacion->save()){
                    $success = true;
                }else{
                    $success = false;
                }

            }else{

                $modelacion->tipo_relacion = $tipo_relacion;
                $modelacion->idrelacion = $idrelacion;
                $modelacion->iddisciplina = $iddisciplina;
                $modelacion->ha_trabajado_bim = $ha_trabajado_bim;
                $modelacion->anios_experiencia = $anios_experiencia;
                $modelacion->m2_disenados_bim = $m2_disenados_bim;
                $modelacion->tipo_estructuras_disenadas = $tipo_estructuras_disenadas;
                $modelacion->uso_software_bim = $uso_software_bim;
                $modelacion->tiene_certificados_bim = $tiene_certificados_bim;
    
                if($modelacion->save()){
                    $success = true;
                }else{
                    $success = false;
                }

            }

        }catch (\Exception $e) {
            echo $e->getMessage();die();
            // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
        }

        if($success){
            DB::commit();
            return true;
        }else{
            DB::rollback();
            return false;
        }

    }

    public function saveRevision($tipo_relacion,
                                $idrelacion,
                                $realiza_funcion_revision_diseno,
                                $anios_experiencia_revision,
                                $m2_revisados,
                                $tipos_estructuras,
                                $iddisciplina)

    {
        $success = false;
        DB::beginTransaction();
        try {

            $revision = Revision::where('tipo_relacion',$tipo_relacion)->where('idrelacion',$idrelacion)->where('iddisciplina',$iddisciplina)->first();
            if($revision == NULL){
                $revision = New Revision;
            }
            $revision->iddisciplina = $iddisciplina;
            if($realiza_funcion_revision_diseno == "0"){

                $revision->tipo_relacion = $tipo_relacion;
                $revision->idrelacion = $idrelacion;
                $revision->realiza_funcion_revision_diseno = $realiza_funcion_revision_diseno;

                if($revision->save()){
                    $success = true;
                }else{
                    $success = false;
                }

            }else{

                $revision->tipo_relacion = $tipo_relacion;
                $revision->idrelacion = $idrelacion;
                $revision->realiza_funcion_revision_diseno = $realiza_funcion_revision_diseno;
                $revision->anios_experiencia_revision = $anios_experiencia_revision;
                $revision->m2_revisados = $m2_revisados;
                $revision->tipos_estructuras = $tipos_estructuras;

                if($revision->save()){
                    $success = true;
                }else{
                    $success = false;
                }

            }

        }catch (\Exception $e) {
            echo $e->getMessage();die();
            // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
        }

        if($success){
            DB::commit();
            return true;
        }else{
            DB::rollback();
            return false;
        }

    }

    public function saveSupervision($tipo_relacion,
                                $idrelacion,
                                $realiza_supervision_tecnica,
                                $anios_experiencia_supervision,
                                $m2_supervisados,
                                $tipo_estructura,
                                $iddisciplina)

    {
        $success = false;
        DB::beginTransaction();
        try {

            $supervision = SupervisionTecnica::where('tipo_relacion',$tipo_relacion)->where('idrelacion',$idrelacion)->where('iddisciplina',$iddisciplina)->first();
            if($supervision == NULL){
                $supervision = New SupervisionTecnica;
            }

            $supervision->iddisciplina = $iddisciplina;
            if($realiza_supervision_tecnica == "0"){

                $supervision->tipo_relacion = $tipo_relacion;
                $supervision->idrelacion = $idrelacion;
                $supervision->realiza_supervision_tecnica = $realiza_supervision_tecnica;

                if($supervision->save()){
                    $success = true;
                }else{
                    $success = false;
                }

            }else{

                $supervision->tipo_relacion = $tipo_relacion;
                $supervision->idrelacion = $idrelacion;
                $supervision->realiza_supervision_tecnica = $realiza_supervision_tecnica;
                $supervision->anios_experiencia_supervision = $anios_experiencia_supervision;
                $supervision->m2_supervisados = $m2_supervisados;
                $supervision->tipo_estructura = $tipo_estructura;

                if($supervision->save()){
                    $success = true;
                }else{
                    $success = false;
                }

            }

        }catch (\Exception $e) {
            echo $e->getMessage();die();
            // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
        }

        if($success){
            DB::commit();
            return true;
        }else{
            DB::rollback();
            return false;
        }

    }

    public function saveDocumento($tipoDocumento,
                                $idrelacion,
                                $doc,
                                $cover)

    {
        $success = false;
        DB::beginTransaction();
        try {

        
            $arrayValue = explode("_",$doc);

            $tagDocumento = $arrayValue[0];
            $idtag = $arrayValue[1];
            $nombre = $tagDocumento.'_'.$idrelacion;

            $documento = New Documento;
            $documento->tipoDocumento = $tipoDocumento;
            $documento->idrelacion = $idrelacion;
            $documento->tagDocumento = $tagDocumento;
            $documento->nombre = $nombre;

            $extension = time() . '.' . $cover->getClientOriginalExtension();

            if($tipoDocumento == "freelancer"){
                $destinationPath = public_path('uploads/front/freelancer/documentos/'.$idrelacion.'');
            }elseif($tipoDocumento == "empresa"){
                $destinationPath = public_path('uploads/front/empresa/documentos/'.$idrelacion.'');
            }elseif($tipoDocumento == "proveedor"){
                $destinationPath = public_path('uploads/front/proveedor/documentos/'.$idrelacion.'');
            }else{
                $destinationPath = public_path('uploads/front/proyecto/documentos/'.$idrelacion.'');
            }

            $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
            $documento->urlDoc = $cover->getFilename().'.'.$extension;


            if($documento->save())
            {   
                $success = true;
            }



        }catch (\Exception $e) {
            echo $e->getMessage();die();
            // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
        }

        if($success){
            DB::commit();
            return true;
        }else{
            DB::rollback();
            return false;
        }

    }


    public function saveGaleria($tipo_relacion,
    $idrelacion,
    $idproyecto,
    $nombre,
    $descripcion,
    $estado)

    {
        $success = false;
        DB::beginTransaction();
        try {


            $galeria = New Galeria;
            $galeria->idproyecto = $idproyecto;
            $galeria->tipo_relacion = $tipo_relacion;
            $galeria->idrelacion = $idrelacion;
            $galeria->nombre = $nombre;
            $galeria->descripcion = $descripcion;
            $galeria->estado = $estado;



            if($galeria->save())
            {   
                $success = true;
            }



        }catch (\Exception $e) {
            echo $e->getMessage();die();
            // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
        }

        if($success){
            DB::commit();
            return true;
        }else{
            DB::rollback();
            return false;
        }

    }

    public function editGaleria($idgaleria,
    $image,

    $descripcion,
    $estado)

    {
        $success = false;
        DB::beginTransaction();
        try {

            for($count = 0; $count < count($descripcion); $count++)
            {   
                $imagen = New ImagenGaleria;
                $imagen->idgaleria = $idgaleria;
                $imagen->descripcion = $descripcion[$count];
                $imagen->estado = $estado;

                $extension = time() . '.' . $image[$count]->getClientOriginalExtension();

                $destinationPath = public_path('uploads/front/galerias/'.$idgaleria.'');
                $image[$count]->move($destinationPath, $image[$count]->getFilename().'.'.$extension);
                $imagen->image = $image[$count]->getFilename().'.'.$extension;

                if($imagen->save())
                {   
                    $success = true;
                }
    
    
            }





        }catch (\Exception $e) {
            echo $e->getMessage();die();
            // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
        }

        if($success){
            DB::commit();
            return true;
        }else{
            DB::rollback();
            return false;
        }

    }

    public function saveComentario($tipo_relacion,
    $idrelacion,
    $idgaleria,
    $descripcion)

    {
        $success = false;
        DB::beginTransaction();
        try {


            $comentario = New ComentarioGaleria;
            $comentario->tipo_relacion = $tipo_relacion;
            $comentario->idrelacion = $idrelacion;
            $comentario->idgaleria = $idgaleria;
            $comentario->descripcion = $descripcion;

            if($comentario->save())
            {   
                $success = true;
            }



        }catch (\Exception $e) {
            echo $e->getMessage();die();
            // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
        }

        if($success){
            DB::commit();
            return true;
        }else{
            DB::rollback();
            return false;
        }

    }


  
}
<?php
/*--------------------------------------------------------------------------------------------
*********************						GETS VS 					***********************
--------------------------------------------------------------------------------------------*/
//------------------------------------------------------------------------
function get_es_admin($admin_user)
{
   	$conn = db_connect();
   	$query = "select esadmin from admin
             		where username = '".$admin_user."'"; 

//	echo "<p>Q:".$query.":</p>";

   	$result = @mysqli_query($conn,$query);
   	if (!$result)
     	return false;
   	$num_cats = @mysqli_num_rows($result);
   	if ($num_cats ==0)
      	return false;  
/*
   	$result = mysql_result($result, 0, administrador);
   	return $result; 
*/
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $result = $row['esadmin'];

}
//------------------------------------------------------------------------
function get_es_editor($admin_user)
{
   $conn = db_connect();
   $query = "select editor
             from enews_rvt_escritores
             where username = '".$admin_user."'"; 

//	echo "<p>Q:".$query.":</p>";

   $result = @mysql_query($query);
   if (!$result)
     return false;
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
      return false;  
   $result = mysql_result($result, 0, editor);
   return $result; 
}
//------------------------------------------------------------------------
function get_id_escritor($admin_user)
{
   $conn = db_connect();
   $query = "select id_escritor
             from enews_rvt_escritores
             where username = '".$admin_user."'"; 

//	echo "<p>Q:".$query.":</p>";

   $result = @mysql_query($query);
   if (!$result)
     return false;
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
      return false;  
   $result = mysql_result($result, 0, id_escritor);
   return $result; 
}
//------------------------------------------------------------------------
function get_id_tema($id_nota)
{
   $conn = db_connect();
   $query = "select id_tema
             from enews_rvt_notas
             where id_nota = '$id_nota'"; 

//	echo "<p>Q:".$query.":</p>";

   $result = @mysql_query($query);
   if (!$result)
     return false;
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
      return false;  
   $result = mysql_result($result, 0, id_tema);
   return $result; 
}
//-----------------------------------------------------------------------
function get_prox_subtema()
{
	$conn = db_connect();

	$query="select max(id_subtema)+1 as prox
			from enews_rvt_subtemas";
	$result = @mysql_query($query);
	if (!$result)
	{
    	echo "<p><strong>fallo la query get_prox_subtema</strong></p>";
     	return false;
	}
   	$num_cats = @mysql_num_rows($result);
   	if ($num_cats ==0)
	{
    	echo "<p><strong>La query get_prox_subtema trajo 0 filas</strong></p>";
      	return false;  
	}
   	$cat_array = db_result_to_array($result);
	foreach ($cat_array as $row)
	{
		$x=$row[prox];
	}
   return $x;
}
//-----------------------------------------------------------------------
function get_prox_ejemplar()
{
	$conn = db_connect();

	$query="select max(id_ejemplar)+1 as prox
			from enews_rvt_ejemplares";
	$result = @mysql_query($query);
	if (!$result)
	{
    	echo "<p><strong>fallo la query get_prox_ejemplar</strong></p>";
     	return false;
	}
   	$num_cats = @mysql_num_rows($result);
   	if ($num_cats ==0)
	{
    	echo "<p><strong>La query get_prox_ejemplar trajo 0 filas</strong></p>";
      	return false;  
	}
   	$cat_array = db_result_to_array($result);
	foreach ($cat_array as $row)
	{
		$x=$row[prox];
	}
   return $x;
}
//------------------------------------------------------------------------
function get_ejemplares1()
{
   $conn = db_connect();
   $query = "select id_ejemplar,concat(format(id_ejemplar,0),' ',leyenda) as leyenda
				from enews_rvt_ejemplares
				order by id_ejemplar";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_ejemplares1</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_ejemplares1 trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_boletines1()
{
   $conn = db_connect();
   $query = "select id_boletin,encabezado
				from enews_rvt_boletines
				order by id_boletin";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_boletines1</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_ejemplares1 trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_boletines11()
{
   $conn = db_connect();
   $query = "select id_boletin,encabezado
				from enews_rvt_boletines
				where mostrar2='S'
				order by id_boletin desc";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_boletines11</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_ejemplares1 trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_tickets1()
{
   $conn = db_connect();
   $query = "select id_ticket,concat(s.Razon,' - ',substring(texto,1,20)) as texto
				from enews_rvt_ticket t, enews_rvt_sponsor s
				where t.ID_Sponsor=s.id_sponsor and t.habilitado='S'
				order by s.Razon,id_ticket";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_tickets</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_adm_tickets trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_tipeventos()
{
   $conn = db_connect();
   $query = "SELECT ID_TipEvento,descripcion
				FROM  enews_evt_eventos_tipos
				order by descripcion"; 

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_tipeventos</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_adm_tickets trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_empresas()
{
   $conn = db_connect();
   $query = "select id_empresa,razon,domicilio,telefono,email
				from enews_empresas
				order by razon";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_empresas</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_ejemplares1 trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_eventos() //05/12/04
{
   $conn = db_connect();
   $query = "SELECT  razon,id_evento,t.descripcion,fecha,nombre
				FROM enews_evt_eventos e, enews_evt_eventos_tipos t, enews_empresas x
				WHERE e.id_empresa = x.id_empresa AND e.ID_TipEvento = t.ID_TipEvento
				Order by razon,id_evento";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_eventos</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_ejemplares1 trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_temas_escritor($admin_user)
{
   $conn = db_connect();
   $query = "select distinct et.id_tema as id_tema,t.nombre as nombre
				from enews_rvt_escritores_temas et, enews_rvt_escritores e, enews_rvt_temas t
				where e.username='$admin_user'
					and et.id_escritor=e.id_escritor
					and t.id_tema=et.id_tema
				order by t.nombre";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_temas_escritor</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_temas_escritor trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_subtemas_escritor($admin_user,$id_tema)
{
   $conn = db_connect();
   $query = "select et.id_subtema as id_subtema, s.nombre as nombre
				from enews_rvt_escritores_temas et, enews_rvt_escritores e, enews_rvt_subtemas s
				where et.id_escritor=e.id_escritor
					and et.id_subtema=s.id_subtema
					and e.username='$admin_user'
					and et.id_tema='$id_tema'
				order by s.nombre";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_subtemas_escritor</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_subtemas_escritor trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_habilitado()
{
   $conn = db_connect();
   $query = 'select id,descripcion
             from enews_rvt_aux_habilitado
			 order by descripcion'; 
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_habilitado</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_habilitado trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_mas()
{
   $conn = db_connect();
   $query = 'select id,descripcion
             from enews_rvt_aux_mas
			 order by descripcion'; 
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_mas</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_mas trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_publicar()
{
   $conn = db_connect();
   $query = 'select id,descripcion
             from enews_rvt_aux_publicar
			 order by descripcion'; 
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_publicar</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_publicar trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_mostrar()
{
   $conn = db_connect();
   $query = 'select id,descripcion
             from enews_rvt_aux_mostrar
			 order by descripcion'; 
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_mostrar</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_mostrar trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_editor()
{
   $conn = db_connect();
   $query = 'select id,descripcion
             from enews_rvt_aux_editor
			 order by descripcion'; 
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_editor</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_editor trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_administrador()
{
   $conn = db_connect();
   $query = 'select id,descripcion
             from enews_rvt_aux_administrador
			 order by descripcion'; 
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_administrador</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_administrador trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_sponsor()
{
   $conn = db_connect();
   $query = 'select id_sponsor,Razon
             from enews_rvt_sponsor
			 order by Razon'; 
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_sponsor</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_sponsor trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
/*--------------------------------------------------------------------------------------------
*********************					GETS DETALLES   				***********************
--------------------------------------------------------------------------------------------*/
//------------------------------------------------------------------------
function get_detalle_nota1($id_nota)
{
  if (!$id_nota || $id_nota=='')
     return false;

   $conn = db_connect();
   $query = "select * from enews_rvt_notas where id_nota='$id_nota'";
   $result = @mysql_query($query);
   if (!$result)
     return false;
   $result = @mysql_fetch_array($result);
   return $result;
}
//------------------------------------------------------------------------
function get_detalle_noticia($id_noticia)
{
  if (!$id_noticia || $id_noticia=='')
     return false;

   $conn = db_connect();
   $query = "select * from enews_rvt_noticias where id_noticia='$id_noticia'";
   $result = @mysql_query($query);
   if (!$result)
     return false;
   $result = @mysql_fetch_array($result);
   return $result;
}
//------------------------------------------------------------------------
function get_detalle_tema($id_tema)
{
  if (!$id_tema || $id_tema=='')
     return false;

   $conn = db_connect();
   $query = "select * from enews_rvt_temas where id_tema='$id_tema'";
   $result = @mysql_query($query);
   if (!$result)
     return false;
   $result = @mysql_fetch_array($result);
   return $result;
}
//------------------------------------------------------------------------
function get_detalle_sponsor($id_sponsor)
{
  if (!$id_sponsor || $id_sponsor=='')
     return false;

   $conn = db_connect();
   $query = "select * from enews_rvt_sponsor where id_sponsor='$id_sponsor'";
   $result = @mysql_query($query);
   if (!$result)
     return false;
   $result = @mysql_fetch_array($result);
   return $result;
}
//------------------------------------------------------------------------
function get_detalle_idioma($id_idioma)
{
  if (!$id_idioma || $id_idioma=='')
     return false;

   $conn = db_connect();
   $query = "select * from enews_rvt_idiomas where id_idioma='$id_idioma'";
   $result = @mysql_query($query);
   if (!$result)
     return false;
   $result = @mysql_fetch_array($result);
   return $result;
}
//------------------------------------------------------------------------
function get_detalle_subtema($id_subtema)
{
//	echo "<p>Xcategoria:".$xcategoria."</p>";
//	echo "<p>idsubcategoria:".$idsubcategoria."</p>";
  if (!$id_subtema || $id_subtema=='')
     return false;

   $conn = db_connect();
   $query = "select * from enews_rvt_subtemas
   		where id_subtema='$id_subtema'";
   $result = @mysql_query($query);
   if (!$result)
     return false;
   $result = @mysql_fetch_array($result);
   return $result;
}
//------------------------------------------------------------------------
function get_detalle_escritor($id_escritor)
{
//	echo "<p>Xcategoria:".$xcategoria."</p>";
//	echo "<p>idsubcategoria:".$idsubcategoria."</p>";
  if (!$id_escritor || $id_escritor=='')
     return false;

   $conn = db_connect();
   $query = "select * from enews_rvt_escritores
   		where id_escritor='$id_escritor'";
   $result = @mysql_query($query);
   if (!$result)
     return false;
   $result = @mysql_fetch_array($result);
   return $result;
}
/*--------------------------------------------------------------------------------------------
*********************					GETS            				***********************
--------------------------------------------------------------------------------------------*/
//------------------------------------------------------------------------
function get_adm_subtemasx()
{
   $conn = db_connect();
   $query = "select id_tema,id_subtema
				from enews_rvt_subtemas";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_subtemasx</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_adm_subtemasx trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_temas()
{
   $conn = db_connect();
   $query = "select * 
				from enews_rvt_temas
				order by nombre";
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_temas</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_adm_temas trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_cursos()
{
   $conn = db_connect();
   $query = "select * 
				from enews_cursos
				order by fecha";
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_cursos</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_adm_cursos trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_notas1($username)
{
   $conn = db_connect();
   $query = "select n.id_nota,t.nombre as tema,s.nombre as subtema, encabezado,i.nombre as idioma
				from enews_rvt_notas n, enews_rvt_temas t, enews_rvt_subtemas s, enews_rvt_escritores e, enews_rvt_idiomas i
				where n.id_tema=t.id_tema
					and n.id_subtema=s.id_subtema
					and t.id_tema=s.id_tema
					and n.id_idioma=i.id_idioma
					and e.id_escritor=n.id_escritor
					and e.username='$username'
					and publicar='N'
					and n.listo='N'
				order by t.nombre,s.nombre";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_notas1</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_adm_notas1 trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_notast($username)
{
   $conn = db_connect();
   $query = "select n.id_nota,t.nombre as tema,s.nombre as subtema, encabezado,i.nombre as idioma
				from enews_rvt_notas n, enews_rvt_temas t, enews_rvt_subtemas s, enews_rvt_escritores e, enews_rvt_idiomas i
				where n.id_tema=t.id_tema
					and n.id_subtema=s.id_subtema
					and t.id_tema=s.id_tema
					and n.id_idioma=i.id_idioma
					and e.id_escritor=n.id_escritor
					and publicar='N'
					and n.listo='N'
				order by t.nombre,s.nombre";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_notast</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_adm_notas1 trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_noticias($username)
{
   $conn = db_connect();
   $query = "select id_noticia,encabezado,resumen,texto,hiperlink,fuente,listo
				from enews_rvt_noticias n, enews_rvt_escritores e
				where e.id_escritor=n.id_escritor and e.username='$username'
				and publicar='N' and listo='N'";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_noticias</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_adm_notas1 trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_notas2()
{
   $conn = db_connect();
   $query = "select n.id_nota,t.nombre as tema,s.nombre as subtema, e.username, encabezado,i.nombre as idioma, n.publicar
				from enews_rvt_notas n, enews_rvt_temas t, enews_rvt_subtemas s, enews_rvt_escritores e, enews_rvt_idiomas i
				where n.id_tema=t.id_tema
					and n.id_subtema=s.id_subtema
					and t.id_tema=s.id_tema
					and n.id_idioma=i.id_idioma
					and e.id_escritor=n.id_escritor
					and n.listo='S'
					order by n.publicar,t.nombre,s.nombre";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_notas2</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_adm_notas2 trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_noticias2()
{
   	$conn = db_connect();
	$query="SELECT n.id_boletin, b.encabezado AS bencabezado, n.id_noticia,
			 e.username, n.encabezado AS nencabezado, n.publicar
			FROM enews_rvt_noticias n, enews_rvt_escritores e, enews_rvt_boletines b
			WHERE b.id_boletin = n.id_boletin AND e.id_escritor = n.id_escritor
				AND n.listo =  'S'
			ORDER  BY n.id_boletin, n.id_noticia";

/*
	$query="select n.id_boletin,n.id_noticia, e.username, encabezado, n.publicar
				from enews_rvt_noticias n, enews_rvt_escritores e
				where e.id_escritor=n.id_escritor
					and n.listo='S'
					order by n.id_boletin,n.id_noticia";
*/
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_noticias2</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_adm_notas2 trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_subtemas()
{
   $conn = db_connect();
   $query = "select t.nombre as tnombre,id_subtema,s.habilitado,s.nombre as snombre
				from enews_rvt_subtemas s, enews_rvt_temas t
				where s.id_tema=t.id_tema
				order by t.nombre";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_subtemas</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_adm_subtemas trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_sponsors()
{
   $conn = db_connect();
   $query = "select * 
				from enews_rvt_sponsor
				order by razon";
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_sponsors</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_adm_sponsors trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_idiomas()
{
   $conn = db_connect();
   $query = "select id_idioma, nombre, habilitado, observaciones, flag_file
				from enews_rvt_idiomas";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_idiomas</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_adm_idiomas trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_tickets()
{
   $conn = db_connect();
   $query = "select id_ticket, texto, habilitado, s.Razon, t.imagen
				from enews_rvt_ticket t, enews_rvt_sponsor s
				where t.ID_Sponsor=s.id_sponsor
				order by s.Razon,id_ticket";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_tickets</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_adm_tickets trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_boletines()
{
   $conn = db_connect();
   $query = "select publicar,id_boletin,fecha,encabezado,pie,mostrar,mostrar2
				from enews_rvt_boletines
				order by fecha";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_boletines</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_adm_tickets trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_ejemplares()
{
   $conn = db_connect();
   $query = "select id_ejemplar,x.nombre,fecha,publicar,leyenda,editorial
				from enews_rvt_ejemplares e, enews_rvt_escritores x
				where e.id_escritor=x.id_escritor
				order by id_ejemplar";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_ejemplares</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_adm_tickets trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_escritores()
{
   $conn = db_connect();
   $query = "select id_escritor,username,nombre,email,habilitado,observaciones
				from enews_rvt_escritores
				order by username";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_escritores</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_adm_escritores trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}

/*--------------------------------------------------------------------------------------------
*********************						INSERT					***********************
--------------------------------------------------------------------------------------------*/
//-------------------------------------------------------------------------
function insert_evento($id_tipevento, $nombre, $publicar, $fecha, $id_empresa,
				$id_ejemplar, $descripcion, $pagina, $lugar, $informes, $precio) //05/12/04
{
   $conn = db_connect();
   $query = "insert into enews_evt_eventos (ID_TipEvento, nombre, publicar, fecha,
   				id_empresa, ID_ejemplar, descripcion, pagina, lugar, informes, precio)
   				values ('$id_tipevento', '$nombre', '$publicar', '$fecha', '$id_empresa',
				'$id_ejemplar', '$descripcion', '$pagina', '$lugar', '$informes', '$precio')";
   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;
}
//-------------------------------------------------------------------------
function insert_nota1($publicar, $id_ejemplar, $fecha, $id_escritor, $id_tema,
				$id_subtema, $encabezado, $frace, $texto, $habilitado, $id_idioma,
				$id_ticket, $id_sponsor,$listo)
{
   $conn = db_connect();
   $query = "insert into enews_rvt_notas (publicar, id_ejemplar, fecha, id_escritor, id_tema,
				id_subtema, encabezado, frace, texto, habilitado, id_idioma,
				id_ticket, id_sponsor,listo)
   				values ('$publicar', '$id_ejemplar', '$fecha', '$id_escritor', '$id_tema',
				'$id_subtema', '$encabezado', '$frace', '$texto', '$habilitado', '$id_idioma',
				'$id_ticket', '$id_sponsor','$listo')";
   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;
}
//-------------------------------------------------------------------------
function insert_noticia($id_escritor, $encabezado, $resumen, $texto,
					$hiperlink, $fuente,$listo,$id_boletin,$mas)
{
   $conn = db_connect();
   $query = "insert into enews_rvt_noticias (id_escritor, encabezado, resumen, texto
   				, hiperlink, fuente, listo, id_boletin,mas)
   				values ('$id_escritor','$encabezado', '$resumen', '$texto'
						,'$hiperlink', '$fuente','$listo','$id_boletin','$mas')";
   $result = mysql_query($query);
   if (!$result)
   {
		echo "<p>Q: ".$query."</p>";
    	return false;
    }	
   else
     return true;
}
//-------------------------------------------------------------------------
function insert_tema($nombre,$habilitado)
{
   $conn = db_connect();
   $query = "select nombre
             from enews_rvt_temas
             where nombre='$nombre'";

   $result = mysql_query($query);
   if (!$result || mysql_num_rows($result)!=0)
	{
	 echo '<p>Ya existe un tema con ese nombre</p>';
     return false;
 	}
   $query = "insert into enews_rvt_temas (nombre,habilitado)
   				values ('$nombre','$habilitado')";  
   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;
}
//-------------------------------------------------------------------------
function insert_tipevento($descripcion)
{
   $conn = db_connect();
   $query = "select descripcion
             from enews_evt_eventos_tipos
             where descripcion='$descripcion'";

   $result = mysql_query($query);
   if (!$result || mysql_num_rows($result)!=0)
	{
	 echo '<p>Ya existe un tipo de evento con ese nombre</p>';
     return false;
 	}
   $query = "insert into enews_evt_eventos_tipos (descripcion)
   				values ('$descripcion')";  
   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;
}
//-------------------------------------------------------------------------
function insert_sponsor($razon,$email,$web,$otros,$imagen)
{
   $conn = db_connect();
   $query = "select razon
             from enews_rvt_sponsor
             where Razon='$razon'";

   $result = mysql_query($query);
   if (!$result || mysql_num_rows($result)!=0)
	{
	 echo '<p>Ya existe un Spnsor con esa Razon</p>';
     return false;
 	}
   $query = "insert into enews_rvt_sponsor(Razon,email,web,otros,imagen)
   				values ('$razon','$email','$web','$otros','$imagen')";  
   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;
}
//-------------------------------------------------------------------------
function insert_idioma($nombre,$habilitado,$observaciones,$flag_file)
{
   $conn = db_connect();
   $query = "select nombre
             from enews_rvt_idiomas
             where nombre='$nombre'";

   $result = mysql_query($query);
   if (!$result || mysql_num_rows($result)!=0)
	{
	 echo '<p>Ya existe un idioma con ese nombre</p>';
     return false;
 	}
   $query = "insert into enews_rvt_idiomas(nombre,habilitado,observaciones,flag_file)
   				values ('$nombre','$habilitado','$observaciones','$flag_file')";  
   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;
}
//-------------------------------------------------------------------------
function insert_subtema($xsubtema,$id_tema,$nombre,$habilitado)
{
   $conn = db_connect();
   $query = "select nombre
             from enews_rvt_subtemas
             where id_tema='$id_tema' and nombre='$nombre'";

   $result = mysql_query($query);
   if (!$result || mysql_num_rows($result)!=0)
	{
	 echo '<p>Ya existe una subtema con ese nombre</p>';
     return false;
 	}
   $query = "insert into enews_rvt_subtemas (id_tema,id_subtema,nombre,habilitado)
   				values ('$id_tema','$xsubtema','$nombre','$habilitado')";  
   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;
}
//-------------------------------------------------------------------------
function insert_escritor($username, $password, $nombre, $email, $web, $habilitado,
			 $observaciones, $editor, $administrador)
{
   $conn = db_connect();
   $query = "select username
             from enews_rvt_escritores
             where username='$username'";

   $result = mysql_query($query);
   if (!$result || mysql_num_rows($result)!=0)
	{
	 echo '<p>Ya existe un escritor con ese username</p>';
     return false;
 	}
   $query = "insert into enews_rvt_escritores (username, password, nombre, email, web, habilitado, observaciones,administrador,editor)
   				values ('$username', password('$password'), '$nombre', '$email', '$web', '$habilitado', '$observaciones','$administrador','$editor')";  

//	echo "<p>Q:".$query."</p>";

   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;
}
//-------------------------------------------------------------------------
function insert_escritor_tema($id_escritor, $id_tema, $id_subtema, $habilitado, $observaciones)
{
   $conn = db_connect();
   $query = "select *
             from enews_rvt_escritores_temas
             where id_tema='$id_tema' and id_subtema='$id_subtema' and id_escritor='$id_escritor'";

   $result = mysql_query($query);
   if (!$result || mysql_num_rows($result)!=0)
	{
	 echo '<p>Ya existe una combinacion escritor-tema-subtema</p>';
     return false;
 	}
   $query = "insert into enews_rvt_escritores_temas (id_escritor, id_tema, id_subtema, habilitado, observaciones)
   				values ('$id_escritor', '$id_tema', '$id_subtema', '$habilitado', '$observaciones')";  

//	echo "<p>Q:".$query."</p>";

   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;
}
//-------------------------------------------------------------------------
function insert_escritor_tema2($id_escritor, $id_tema, $id_subtema, $habilitado, $observaciones)
{
   $conn = db_connect();
   $query = "select *
             from enews_rvt_escritores_temas
             where id_tema='$id_tema' and id_subtema='$id_subtema' and id_escritor='$id_escritor'";

   $result = mysql_query($query);
   if (!$result || mysql_num_rows($result)!=0)
	{
//	 echo '<p>Ya existe una combinacion escritor-tema-subtema</p>';
     return false;
 	}
   $query = "insert into enews_rvt_escritores_temas (id_escritor, id_tema, id_subtema, habilitado, observaciones)
   				values ('$id_escritor', '$id_tema', '$id_subtema', '$habilitado', '$observaciones')";  

//	echo "<p>Q:".$query."</p>";

   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;
}

/*--------------------------------------------------------------------------------------------
*********************						UPDATE					***********************
--------------------------------------------------------------------------------------------*/
//-------------------------------------------------------------------------
function update_tema($oldid_tema, $id_tema, $nombre, $habilitado)
{
   $conn = db_connect();

   $query = "update enews_rvt_temas
             set nombre='$nombre',
			 habilitado='$habilitado'
             where id_tema='$oldid_tema'";

//	echo $query;
   $result = @mysql_query($query);
   if (!$result)
     return false;
   else
     return true; 
}
//-------------------------------------------------------------------------
function update_nota1($oldid_nota, $id_nota, $id_subtema, $id_idioma, $encabezado,
						$frace, $texto, $fecha,$listo)
{
   $conn = db_connect();

   $query = "update enews_rvt_notas
             set id_subtema='$id_subtema',
             id_idioma='$id_idioma',
             encabezado='$encabezado',
			 frace='$frace',
			 texto='$texto',
			 listo='$listo',
			 fecha='$fecha'
             where id_nota='$oldid_nota'";

//	echo $query;
   $result = @mysql_query($query);
   if (!$result)
     return false;
   else
     return true; 
}
//-------------------------------------------------------------------------
function update_noticia($oldid_noticia, $id_noticia, $encabezado, $resumen,
						 $texto, $hiperlink, $fuente, $listo, $mas)
{
   $conn = db_connect();

   $query = "update enews_rvt_noticias
             set encabezado='$encabezado',
			 resumen='$resumen',
			 texto='$texto',
			 hiperlink='$hiperlink',
			 fuente='$fuente',
			 listo='$listo',
			 mas='$mas'
             where id_noticia='$oldid_noticia'";

//	echo $query;
   $result = @mysql_query($query);
   if (!$result)
     return false;
   else
     return true; 
}
//-------------------------------------------------------------------------
function update_nota2($oldid_nota, $id_nota, $encabezado, $frace, $texto,
				$publicar, $id_ejemplar, $id_ticket, $listo, $fecha, $id_sponsor)
{
   $conn = db_connect();

   $query = "update enews_rvt_notas
				set encabezado='$encabezado',
			 	frace='$frace',
			 	texto='$texto',
			 	listo='$listo',
				publicar='$publicar',
				id_ejemplar='$id_ejemplar',
				id_ticket='$id_ticket',
				id_sponsor='$id_sponsor',
			 	fecha_pub='$fecha'
             where id_nota='$oldid_nota'";

//   echo $query;
   $result = @mysql_query($query);
   if (!$result)
     return false;
   else
     return true; 
}
//-------------------------------------------------------------------------
function update_noticia2($oldid_noticia, $id_noticia, $encabezado, $resumen,
			 	$texto, $publicar, $hiperlink, $fuente, $listo,$id_boletin,$mas)
{
   $conn = db_connect();

   $query = "update enews_rvt_noticias
				set encabezado='$encabezado',
			 	resumen='$resumen',
			 	texto='$texto',
			 	listo='$listo',
				publicar='$publicar',
				id_boletin='$id_boletin',
				hiperlink='$hiperlink',
				mas='$mas',
				fuente='$fuente'
             where id_noticia='$oldid_noticia'";

//   echo $query;
   $result = @mysql_query($query);
   if (!$result)
     return false;
   else
     return true; 
}
//-------------------------------------------------------------------------
function update_escritor($oldid_escritor, $id_escritor, $username, $password,
			 $nombre, $email, $web, $habilitado, $observaciones, $editor, $administrador)
{
   $conn = db_connect();

   $query = "update enews_rvt_escritores
             set username='$username',
			 password=password('$password'),
			 nombre='$nombre',
			 email='$email',
			 web='$web',
			 observaciones='$observaciones',
			 habilitado='$habilitado',
			 editor='$editor',
			 administrador='$administrador'
             where id_escritor='$oldid_escritor'";

//	echo $query;
   $result = @mysql_query($query);
   if (!$result)
     return false;
   else
     return true; 
}
//-------------------------------------------------------------------------
function update_idioma($oldid_idioma, $id_idioma, $nombre, $habilitado, $observaciones, $flag_file)
{
   $conn = db_connect();

   $query = "update enews_rvt_idiomas
             set nombre='$nombre',
			 habilitado='$habilitado',
			 observaciones='$observaciones',
			 flag_file='$flag_file'
             where id_idioma='$oldid_idioma'";

//	echo $query;
   $result = @mysql_query($query);
   if (!$result)
     return false;
   else
     return true; 
}
//-------------------------------------------------------------------------
function update_sponsor($oldid_sponsor, $id_sponsor, $razon, $email, $web, $otros, $imagen)
{
   $conn = db_connect();

   $query = "update enews_rvt_sponsor
             set Razon='$razon',
			 email='$email',
			 web='$web',
			 otros='$otros',
			 imagen='$imagen'
             where id_sponsor='$oldid_sponsor'";

//	echo $query;
   $result = @mysql_query($query);
   if (!$result)
     return false;
   else
     return true; 
}
//-------------------------------------------------------------------------
function update_subtema($oldid_subtema, $id_subtema, $id_tema, $nombre, $habilitado)
{
   $conn = db_connect();

   $query = "update enews_rvt_subtemas
             set nombre='$nombre',
			 habilitado='$habilitado',
			 id_tema='$id_tema'
             where id_subtema='$oldid_subtema'";

//	echo $query;
   $result = @mysql_query($query);
   if (!$result)
     return false;
   else
     return true; 
}


/*--------------------------------------------------------------------------------------------
*********************						DELETE					***********************
--------------------------------------------------------------------------------------------*/
//-------------------------------------------------------------------------
function delete_nota1($id_nota)
{
	$conn = db_connect();

	$query = "delete from enews_rvt_notas
             where id_nota='$id_nota'";
   	$result = @mysql_query($query);
   	if (!$result)
    	return false;
   else
     	return true;
}
//-------------------------------------------------------------------------
function delete_noticia($id_noticia)
{
	$conn = db_connect();

	$query = "delete from enews_rvt_noticias
             where id_noticia='$id_noticia'";
   	$result = @mysql_query($query);
   	if (!$result)
    	return false;
   else
     	return true;
}
//-------------------------------------------------------------------------
function delete_sponsor($id_sponsor)
{
	$conn = db_connect();

	$query="select * from enews_rvt_notas where id_sponsor='$id_sponsor'";
	$result = @mysql_query($query);
	if (!$result || mysql_num_rows($result)!=0)
	{
		echo '<p>Existen Notas con este Sponsor</p><br />';
     	return false;
 	}
/*
	$query="select * from enews_rvt_noticias where id_sponsor='$id_sponsor'";
	$result = @mysql_query($query);
	if (!$result || mysql_num_rows($result)!=0)
	{
		echo '<p>Existen Noticias con este Sponsor</p><br />';
     	return false;
 	}
*/
	$query = "delete from enews_rvt_sponsor
             where id_sponsor='$id_sponsor'";
   	$result = @mysql_query($query);
   	if (!$result)
    	return false;
   else
     	return true;
}
//-------------------------------------------------------------------------
function delete_escritor($id_escritor)
{
	$conn = db_connect();

	$query="select * from enews_rvt_notas where id_escritor='$id_escritor'";
	$result = @mysql_query($query);
	if (!$result || mysql_num_rows($result)!=0)
	{
		echo '<p>Existen Notas con este Escritor</p><br />';
     	return false;
 	}
/*
	$query="select * from enews_rvt_noticias where id_sponsor='$id_sponsor'";
	$result = @mysql_query($query);
	if (!$result || mysql_num_rows($result)!=0)
	{
		echo '<p>Existen Noticias con este Sponsor</p><br />';
     	return false;
 	}
*/
	$query = "delete from enews_rvt_escritores
             where id_escritor='$id_escritor'";
   	$result = @mysql_query($query);
   	if (!$result)
    	return false;
   else
     	return true;
}
//-------------------------------------------------------------------------
function delete_subtema($id_subtema)
{
	$conn = db_connect();

	$query="select * from enews_rvt_notas where id_subtema='$id_subtema'";
	$result = @mysql_query($query);
	if (!$result || mysql_num_rows($result)!=0)
	{
		echo '<p>Existen Notas con este subtema</p><br />';
     	return false;
 	}
	$query="select * from enews_rvt_noticias where id_subtema='$id_subtema'";
	$result = @mysql_query($query);
	if (!$result || mysql_num_rows($result)!=0)
	{
		echo '<p>Existen Noticias con este subtema</p><br />';
     	return false;
 	}
	$query = "delete from enews_rvt_subtemas
             where id_subtema='$id_subtema'";

//	echo "<p>Q:".$query."</p>";

   	$result = @mysql_query($query);
   	if (!$result)
    	return false;
   else
     	return true;
}
//-------------------------------------------------------------------------
function delete_idioma($id_idioma)
{
	$conn = db_connect();

	$query="select * from enews_rvt_notas where id_idioma='$id_idioma'";
	$result = @mysql_query($query);
	if (!$result || mysql_num_rows($result)!=0)
	{
		echo '<p>Existen Notas con este idioma</p><br />';
     	return false;
 	}
/*
	$query="select * from enews_rvt_noticias where id_idioma='$id_idioma'";
	$result = @mysql_query($query);
	if (!$result || mysql_num_rows($result)!=0)
	{
		echo '<p>Existen Noticias con este idioma</p><br />';
     	return false;
 	}
*/
	$query = "delete from enews_rvt_idiomas
             where id_idioma='$id_idioma'";

//	echo "<p>Q:".$query.":</p>";

   	$result = @mysql_query($query);
   	if (!$result)
    	return false;
	else
     	return true;
}
//-------------------------------------------------------------------------
function delete_tema($id_tema)
{
	$conn = db_connect();

	$query="select * from enews_rvt_notas where id_tema='$id_tema'";
	$result = @mysql_query($query);
	if (!$result || mysql_num_rows($result)!=0)
	{
		echo '<p>Existen Notas con este tema</p><br />';
     	return false;
 	}
	$query="select * from enews_rvt_subtemas where id_tema='$id_tema'";
	$result = @mysql_query($query);
	if (!$result || mysql_num_rows($result)!=0)
	{
		echo '<p>Existen Subtemas con este tema</p><br />';
     	return false;
 	}
	$query = "delete from enews_rvt_temas
             where id_tema='$id_tema'";
   	$result = @mysql_query($query);
   	if (!$result)
    	return false;
   else
     	return true;
}













//------------------------------------------------------------------------
function get_cat_marca_items($xmarca,$xfiltro)
{
   $conn = db_connect();
   $query = "select iditem,m.representa,m.nombre as marca,i.nombre,
   				s.descripcion as subcategoria, i.descripcion,
				t.descripcion as tipo,e.descripcion as estado,
				p.descripcion as plan
			from mw_items i, mw_marcas m, mw_categorias c,
				mw_subcategorias s, mw_tipos t, mw_estados e,
				mw_planes p
			where i.idplan=p.idplan and i.idestado=e.idestado
				and i.idtipo=t.idtipo and i.idmarca=m.idmarca
				and c.idcat=i.idcat and s.idsubcat=i.idsubcat
				and s.idcat=c.idcat
				and i.idmarca='$xmarca'
				and i.idtipo='$xfiltro'
				order by s.descripcion,i.iditem";
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_cat_marca_items</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_cat_marca_items trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_item_detallex($xcategoria,$xsubcategoria)
{
   $conn = db_connect();
   $query = "select i.iditem,i.nombre as inombre,d.tipo,d.nombre as anombre,d.detalle
				from mw_item_detalles d, mw_items i
				where d.iditem=i.iditem
				and i.idcat='$xcategoria'
				and i.idsubcat='$xsubcategoria'";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_item_detalle</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_adm_item_detalle trajo 0 filas</strong></p>";
      return false;  
	}
   echo "<p><strong>items:".$num_cats."</strong></p>";
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_adm_item_folleto($xcategoria,$xsubcategoria)
{
   $conn = db_connect();
   $query = "select i.iditem,i.nombre as inombre,d.tipo,d.tipo,d.nombre as anombre,d.detalle
				from mw_item_folletos d, mw_items i
				where d.iditem=i.iditem
				and i.idcat='$xcategoria'
				and i.idsubcat='$xsubcategoria'";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_adm_item_folleto</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_adm_item_detalle trajo 0 filas</strong></p>";
      return false;  
	}
   echo "<p><strong>items:".$num_cats."</strong></p>";
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_categorias()
{
   $conn = db_connect();
   $query = 'select idcat,descripcion
             from categorias
			 order by descripcion'; 
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_categorias</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_categorias trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_xcategorias($xfiltro)
{
   $conn = db_connect();
   $query = "select i.idcat,c.descripcion,count(*) as titems
				from mw_items i, mw_categorias c
				where i.idcat=c.idcat and i.idtipo='$xfiltro'
				group by idcat
				order by descripcion";

/*   
   $query = 'select idcat,descripcion
             from mw_categorias
			 order by descripcion'; 
*/
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_xcategorias</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_xcategorias trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_marcas()
{
   $conn = db_connect();
   $query = 'select idmarca,nombre,n.descripcion,pagina,representa
				from mw_marcas m,mw_nacionalidades n
				where m.idnacionalidad=n.idnacionalidad
				order by nombre';
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_marcas</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_marcas trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_tipos()
{
   $conn = db_connect();
   $query = 'select idtipo,descripcion
             from mw_tipos'; 
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_tipos</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_tipos trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_aux_tipos()
{
   $conn = db_connect();
   $query = 'select id_tipo,descripcion
             from enews_aux_tipos'; 
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_aux_tipos</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_aux_tipos trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_planes()
{
   $conn = db_connect();
   $query = 'select idplan,descripcion
             from mw_planes'; 
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_planes</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_planes trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_nacionalidades()
{
   $conn = db_connect();
   $query = 'select idnacionalidad,descripcion,flag
             from mw_nacionalidades
			 order by descripcion'; 
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_nacionalidades</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_nacionalidades trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_estados()
{
   $conn = db_connect();
   $query = 'select idestado,descripcion
             from mw_estados'; 
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_estados</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La query get_categorias trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_subcategorias($catid,$xfiltro)
{
//	echo "<p>Xcategoria:".$xcategoria.":</p>";
//	echo "<p>catid:".$catid.":</p>";
	$conn = db_connect();

	if ($xfiltro==0)
	{
	   $query = "select i.idsubcat,s.descripcion 
					from mw_items i, mw_subcategorias s
					where i.idsubcat=s.idsubcat and i.idcat=s.idcat
						and i.idcat='$catid' 
					group by i.idsubcat	
					order by descripcion";
	}
	else
	{
	   $query = "select i.idsubcat,s.descripcion 
					from mw_items i, mw_subcategorias s
					where i.idsubcat=s.idsubcat and i.idcat=s.idcat
						and i.idcat='$catid' and i.idtipo='$xfiltro'
					group by i.idsubcat	
					order by descripcion";
	}
/*
   $query = "select idsubcat,descripcion
				from mw_subcategorias
				where idcat='$catid'
				order by descripcion";
*/
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_subcategorias</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_subcategorias trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_subcategorias2($catid)
{
//	echo "<p>Xcategoria:".$xcategoria.":</p>";
//	echo "<p>catid:".$catid.":</p>";
   $conn = db_connect();

   $query = "select idsubcat,descripcion
				from mw_subcategorias
				where idcat='$catid'
				order by descripcion";

   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>fallo la query get_subcategorias2</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
//      echo "<p><strong>La query get_subcategorias trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_categories()
{
   // query database for a list of categories
   $conn = db_connect();
   $query = 'select catid, catname
             from dbbook_categories'; 
   $result = mysql_query($query);
   if (!$result)
	{
     echo "<p><strong>Fallo la Query</strong></p>";
     return false;
	}
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
	{
      echo "<p><strong>La Query trajo 0 filas</strong></p>";
      return false;  
	}
   $result = db_result_to_array($result);
   return $result; 
}
//------------------------------------------------------------------------
function get_nombre_categoria($idcategoria)
{
   $conn = db_connect();
   $query = "select descripcion
             from mw_categorias 
             where idcat = $idcategoria"; 
   $result = @mysql_query($query);
   if (!$result)
     return false;
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
      return false;  
   $result = mysql_result($result, 0, 'descripcion');
   return $result; 
}
//------------------------------------------------------------------------
function get_nombre_subcategoria($xcategoria,$xsubcategoria)
{
   $conn = db_connect();
   $query = "select descripcion
             from mw_subcategorias 
             where idcat = $xcategoria
			 and idsubcat=$xsubcategoria"; 
   $result = @mysql_query($query);
   if (!$result)
     return false;
   $num_cats = @mysql_num_rows($result);
   if ($num_cats ==0)
      return false;  
   $result = mysql_result($result, 0, 'descripcion');
   return $result; 
}
//------------------------------------------------------------------------
function get_cat_items($xcategoria,$xsubcategoria,$xfiltro)
{
   	$conn = db_connect();
	
//	echo "<p>xcategoria:".$xcategoria.":</p>";
//	echo "<p>xsubcategoria:".$xsubcategoria.":</p>";
   	$query = "select iditem,m.representa,m.nombre as marca,i.nombre,
				s.descripcion as subcategoria,
				i.descripcion,t.descripcion as tipo,
				e.descripcion as estado,p.descripcion as plan, pagina
			  from mw_items i, mw_marcas m, mw_categorias c,
			  	mw_subcategorias s, mw_tipos t, mw_estados e,
				mw_planes p
			  where i.idplan=p.idplan and i.idestado=e.idestado
			  	and i.idtipo=t.idtipo and i.idmarca=m.idmarca
				and c.idcat=i.idcat and s.idsubcat=i.idsubcat
				and s.idcat=c.idcat
				and i.idcat='$xcategoria'
				and i.idsubcat='$xsubcategoria'
				and i.idtipo='$xfiltro'
				order by i.ean13";
//	echo "<p>Query:".$query."</p>";
   	$result = @mysql_query($query);
   	if (!$result)
		{
		echo "<p>fallo la query get_cat_items</p>";
     	return false;
		}
   	$num_cats = @mysql_num_rows($result);
   	if ($num_cats ==0)
    	{
//		echo "<p>la query get_cat_items trajo 0 filas</p>";
	  	return false;  
		}
   	$result = db_result_to_array($result);
   	return $result; 
}

//-------------------------------------------------------------------------
function insert_folleto($iditem,$tipo,$nombre,$ContArchivo)
{
   $conn = db_connect();
   $query = "select iditem
             from mw_item_folletos
             where iditem='$iditem'";

   $result = mysql_query($query);
   if (!$result || mysql_num_rows($result)!=0)
	{
	 echo '<p>Ya existe un folleto para este item</p>';
     return false;
 	}
   $query = "insert into mw_item_folletos (iditem,tipo,nombre,detalle)
   				values ('$iditem','$tipo','$nombre','$ContArchivo')";  
   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;
}
//-------------------------------------------------------------------------
function insert_item($proxitem,$ean13,$idmarca,$nombre,$xcategoria,
			$idsubcat,$descripcion,$idtipo,$idestado,$idplan,$precio)
{
	if($xcategoria==0)
	{
		echo "<p>Error: Function insert_item, categoria=0</p>";
		return false;		
	}
	if($idsubcat==0)
	{
		echo "<p>Error: Function insert_item, subcategoria=0</p>";
		return false;		
	}


   $conn = db_connect();
   $query = "insert into mw_items(iditem,ean13,idmarca,nombre,idcat,
   				idsubcat,descripcion,idtipo,idestado,idplan,precio)
   				values ('$proxitem','$ean13','$idmarca','$nombre','$xcategoria',
				'$idsubcat','$descripcion','$idtipo','$idestado',
				'$idplan','$precio')";
//   echo "<p>Query:".$query;
   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;
}
//-------------------------------------------------------------------------
function insert_marca($nombre,$idnacionalidad,$pagina,$representa)
{
   $conn = db_connect();
   $query = "select nombre
             from mw_marcas
             where nombre='$nombre'";

   $result = mysql_query($query);
   if (!$result || mysql_num_rows($result)!=0)
	{
	 echo '<p>Ya existe una marca con ese nombre</p>';
     return false;
 	}
   $query = "insert into mw_marcas (nombre,idnacionalidad,pagina,representa)
   				values ('$nombre','$idnacionalidad','$pagina','$representa')";  
   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;
}
//-------------------------------------------------------------------------
function insert_tipo($descripcion)
{
   $conn = db_connect();
   $query = "select descripcion
             from mw_tipos
             where descripcion='$descripcion'";

   $result = mysql_query($query);
   if (!$result || mysql_num_rows($result)!=0)
	{
	 echo '<p>Ya existe un tipo con ese nombre</p>';
     return false;
 	}
   $query = "insert into mw_tipos (descripcion)
   				values ('$descripcion')";  
   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;
}
//-------------------------------------------------------------------------
function insert_plan($descripcion)
{
   $conn = db_connect();
   $query = "select descripcion
             from mw_planes
             where descripcion='$descripcion'";

   $result = mysql_query($query);
   if (!$result || mysql_num_rows($result)!=0)
	{
	 echo '<p>Ya existe un plan con ese nombre</p>';
     return false;
 	}
   $query = "insert into mw_planes (descripcion)
   				values ('$descripcion')";  
   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;
}
//-------------------------------------------------------------------------
function incrementar_contador()
{
   $conn = db_connect();

   $query = "update mw_visitas
             set visitas=visitas+1";


//	echo $query;
   $result = @mysql_query($query);
   if (!$result)
     return false;
   else
     return true; 
}
//-------------------------------------------------------------------------
function mostrar_contador()
{
   $conn = db_connect();

   $query = "select visitas
   				from mw_visitas";

//	echo $query;
   $result = @mysql_query($query);
   if (!$result)
     return false;
   else
     return  @mysql_fetch_array($result);
}
//------------------------------------------------------------------------
function get_bandera($item)
{
	$conn = db_connect();
	$query="select n.flag
				from mw_items i, mw_marcas m, mw_nacionalidades n
				where i.idmarca=m.idmarca and
				n.idnacionalidad=m.idnacionalidad
				and iditem='$item'";
	$result = @mysql_query($query);
	if (!$result)
	{
    	echo "<p><strong>fallo la query get_bandera</strong></p>";
     	return false;
	}
   	$num_cats = @mysql_num_rows($result);
   	if ($num_cats ==0)
	{
    	echo "<p><strong>La query get_bandera trajo 0 filas</strong></p>";
      	return false;  
	}
   	$cat_array = db_result_to_array($result);
	foreach ($cat_array as $row)
	{
		$x=$row[flag];
	}
   return $x;
}
//-----------------------------------------------------------------------
function ver_imagen($xitem)
{
//  	include ('fns_tv.php');
//	$iditem=$_GET['iditem'];
	$conn = db_connect();
	$query="select * from mw_item_detalles
			where iditem='$xitem'";
	$result=mysql_query($query);
	if (mysql_num_rows($result))
	{
		$datos=mysql_fetch_array($result);
		header("Content-Type:{$datos['tipo']}");
		echo $datos['detalle'];
	}
}

//------------------------------Sql_Php V:1.1.1-------------------------------------
function get_detalle_tickets($ID_Ticket)
{
	if (!$ID_Ticket || $ID_Ticket=='')
		return false;
	$conn = db_connect();
	$query = "select * from enews_rvt_ticket where ID_Ticket='$ID_Ticket'";
	$result = @mysql_query($query);
	if (!$result)
		return false;
	$result = @mysql_fetch_array($result);
	return $result;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function get_detalle_evento($id_evento)
{
	if (!$id_evento || $id_evento=='')
		return false;
	$conn = db_connect();
	$query = "select * from enews_evt_eventos where ID_evento='$id_evento'";
	$result = @mysql_query($query);
	if (!$result)
		return false;
	$result = @mysql_fetch_array($result);
	return $result;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function get_detalle_tipevento($x) //05/12/04
{
	if (!$x || $x=='')
		return false;
	$conn = db_connect();
	$query = "select * from enews_evt_eventos_tipos where ID_TipEvento ='$x'";
	$result = @mysql_query($query);
	if (!$result)
	{
		echo "<p>Fallo get_detalle_tipevento</p>";
		return false;
	}
	$result = @mysql_fetch_array($result);
	return $result;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function get_detalle_boletin($id_boletin)
{
	if (!$id_boletin || $id_boletin=='')
		return false;
	$conn = db_connect();
	$query = "select * from enews_rvt_boletines where id_boletin='$id_boletin'";
	$result = @mysql_query($query);
	if (!$result)
		return false;
	$result = @mysql_fetch_array($result);
	return $result;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function get_detalle_curso($id_curso)
{
	if (!$id_curso || $id_curso=='')
		return false;
	$conn = db_connect();
	$query = "select * from enews_cursos where id_curso='$id_curso'";
	$result = @mysql_query($query);
	if (!$result)
		return false;
	$result = @mysql_fetch_array($result);
	return $result;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function get_detalle_ejemplar($id_ejemplar)
{
	if (!$id_ejemplar || $id_ejemplar=='')
		return false;
	$conn = db_connect();
	$query = "select * from enews_rvt_ejemplares where id_ejemplar='$id_ejemplar'";
	$result = @mysql_query($query);
	if (!$result)
		return false;
	$result = @mysql_fetch_array($result);
	return $result;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function insert_tickets($texto, $habilitado, $ID_Sponsor, $imagen)
{
	$conn = db_connect();
	$query = "Select texto From enews_rvt_ticket where texto='$texto'";
	$result = mysql_query($query);
	if (!$result || mysql_num_rows($result)!=0)
	{
		echo '<p>Ya existe un tema con ese nombre</p>';
		return false;
	}
	$query = "insert into enews_rvt_ticket(texto, habilitado, ID_Sponsor, imagen)
		values('$texto','$habilitado','$ID_Sponsor','$imagen')";

//	echo "<p>Q: ".$query.":</p>";

	$result = mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function insert_boletin($fecha, $texto, $publicar, $encabezado, $pie, $mostrar,$mostrar2)
{
	$conn = db_connect();
	$query = "insert into enews_rvt_boletines(fecha,texto,publicar,encabezado,pie,mostrar,mostrar2)
		values('$fecha','$texto','$publicar','$encabezado','$pie','$mostrar','$mostrar2')";

//	echo "<p>Q: ".$query.":</p>";

	$result = mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function insert_curso($id_tipo, $texto, $publicar, $fecha, $tema, $orador, $precio, $lugar, $materiales, $tipo)
{
	$conn = db_connect();
	$query = "insert into enews_cursos(id_tipo, texto, publicar, fecha, tema, orador, precio, lugar, materiales, tipo)
		values('$id_tipo', '$texto', '$publicar', '$fecha', '$tema', '$orador', '$precio', '$lugar', '$materiales', '$tipo')";

//	echo "<p>Q: ".$query.":</p>";

	$result = mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function insert_ejemplar($id_eje,$fecha, $editorial, $publicar, $leyenda)
{
	$conn = db_connect();
	$query = "insert into enews_rvt_ejemplares(id_ejemplar,id_escritor,fecha,publicar,leyenda,editorial)
		values('$id_eje','2','$fecha','$publicar','$leyenda','$editorial')";

//	echo "<p>Q: ".$query.":</p>";

	$result = mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function update_tickets($oldID_Ticket, $ID_Ticket, $texto, $habilitado, $ID_Sponsor, $imagen)
{
	$conn = db_connect();
	$query = "update enews_rvt_ticket
	set texto='$texto',
	habilitado='$habilitado',
	ID_Sponsor='$ID_Sponsor',
	imagen='$imagen'
	where ID_Ticket='$oldID_Ticket'";

//	echo "<p>Q:".$query."</p>";

	$result = @mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function update_evento($oldid_evento, $id_tipevento, $nombre, $publicar, $fecha,
					$id_empresa, $id_ejemplar, $descripcion, $pagina, $lugar, $informes, $precio)
{
	$conn = db_connect();
	$query = "update enews_evt_eventos
	set ID_TipEvento='$id_tipevento',
	nombre='$nombre',
	publicar='$publicar',
	fecha='$fecha',
	id_empresa='$id_empresa',
	id_ejemplar='$id_ejemplar',
	pagina='$pagina',
	lugar='$lugar',
	informes='$informes',
	precio='$precio',
	descripcion='$descripcion'
	where ID_evento='$oldid_evento'";

//	echo "<p>Q:".$query."</p>";

	$result = @mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function update_tipevento($oldid_tipevento, $descripcion) //05/12/04
{
	$conn = db_connect();
	$query = "update enews_evt_eventos_tipos
	set descripcion='$descripcion'
	where ID_TipEvento ='$oldid_tipevento'";

//	echo "<p>Q:".$query."</p>";

	$result = @mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function update_boletines($oldid_boletin, $texto, $publicar, $fecha, $encabezado,$pie,$mostrar,$mostrar2)
{
	$conn = db_connect();
	$query = "update enews_rvt_boletines
	set texto='$texto',
	publicar='$publicar',
	mostrar='$mostrar',
	mostrar2='$mostrar2',
	fecha='$fecha',
	encabezado='$encabezado',
	pie='$pie'
	where id_boletin='$oldid_boletin'";

//	echo "<p>Q:".$query."</p>";

	$result = @mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function update_curso($oldid_curso, $id_tipo, $texto, $publicar, $fecha, $tema, $orador, $precio, $lugar, $materiales, $tipo)
{
	$conn = db_connect();
	$query = "update enews_cursos
	set id_tipo='$id_tipo',
	texto='$texto',
	publicar='$publicar',
	fecha='$fecha',
	tema='$tema',
	orador='$orador',
	precio='$precio',
	lugar='$lugar',
	tipo='$tipo',
	materiales='$materiales'
	where id_curso='$oldid_curso'";

//	echo "<p>Q:".$query."</p>";

	$result = @mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function update_ejemplar($oldid_ejemplar, $editorial, $publicar, $fecha, $leyenda)
{
	$conn = db_connect();
	$query = "update enews_rvt_ejemplares
	set editorial='$editorial',
	publicar='$publicar',
	fecha='$fecha',
	leyenda='$leyenda'
	where id_ejemplar='$oldid_ejemplar'";

//	echo "<p>Q:".$query."</p>";

	$result = @mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function delete_tickets($ID_Ticket)
{
	$conn = db_connect();
//	$query="select * from enews_rvt_ticket where ID_Ticket='$ID_Ticket'";
//	            $result = @mysql_query($query);
//	            if (!$result || mysql_num_rows($result)!=0)
//	            {
//		echo '<p>Existen Notas con este tema</p><br />';
//		return false;
//	            }

	$query = "delete from enews_rvt_ticket
		where ID_Ticket='$ID_Ticket'";
	$result = @mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function delete_evento($id_evento)
{
	$conn = db_connect();
//	$query="select * from enews_rvt_ticket where ID_Ticket='$ID_Ticket'";
//	            $result = @mysql_query($query);
//	            if (!$result || mysql_num_rows($result)!=0)
//	            {
//		echo '<p>Existen Notas con este tema</p><br />';
//		return false;
//	            }

	$query = "delete from enews_evt_eventos
		where ID_evento='$id_evento'";
	$result = @mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function delete_tipevento($id_tipevento)
{
	$conn = db_connect();
	$query="select * from enews_evt_eventos where ID_TipEvento='$id_tipevento'";
    $result = @mysql_query($query);
    if (!$result || mysql_num_rows($result)!=0)
	{
		echo '<p>Existen eventos con ese tipo</p><br />';
		return false;
	}

	$query = "delete from enews_evt_eventos_tipos
		where ID_TipEvento ='$id_tipevento'";
	$result = @mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}
//------------------------------Sql_Php V:1.1.1-------------------------------------
function delete_boletin($id_boletin)
{
	$conn = db_connect();
//	$query="select * from enews_rvt_ticket where ID_Ticket='$ID_Ticket'";
//	            $result = @mysql_query($query);
//	            if (!$result || mysql_num_rows($result)!=0)
//	            {
//		echo '<p>Existen Notas con este tema</p><br />';
//		return false;
//	            }

	$query = "delete from enews_rvt_boletines
		where id_boletin='$id_boletin'";
	$result = @mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}

//------------------------------Sql_Php V:1.1.1-------------------------------------
function delete_curso($id_curso)
{
	$conn = db_connect();
//	$query="select * from enews_rvt_ticket where ID_Ticket='$ID_Ticket'";
//	            $result = @mysql_query($query);
//	            if (!$result || mysql_num_rows($result)!=0)
//	            {
//		echo '<p>Existen Notas con este tema</p><br />';
//		return false;
//	            }

	$query = "delete from enews_cursos
		where id_curso='$id_curso'";
	$result = @mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}

//------------------------------Sql_Php V:1.1.1-------------------------------------
function delete_ejemplar($id_ejemplar)
{
	$conn = db_connect();
//	$query="select * from enews_rvt_ticket where ID_Ticket='$ID_Ticket'";
//	            $result = @mysql_query($query);
//	            if (!$result || mysql_num_rows($result)!=0)
//	            {
//		echo '<p>Existen Notas con este tema</p><br />';
//		return false;
//	            }

	$query = "delete from enews_rvt_ejemplares
		where id_ejemplar='$id_ejemplar'";
	$result = @mysql_query($query);
	if (!$result)
		return false;
	else
		return true;
}
//-------------------------------------------------------------------------
function insert_empresa($razon, $domicilio, $cuit, $codpos, $localidad, $provincia,
    					$telefono, $fax, $email, $web, $username, $password, $observ) // 05/12/04
{
   $conn = db_connect();
   $query = "insert into enews_empresas(razon,domicilio,cuit,codpos,localidad,provincia,
    					telefono,fax,email,web,username,password,observ)
   				values ('$razon','$domicilio','$cuit','$codpos','$localidad','$provincia',
    					'$telefono','$fax','$email','$web','$username','$password','$observ')";
   $result = mysql_query($query);
   if (!$result)
   {
		echo "<p>Q : ".$query."</p>";
    	return false;
    }	
   else
     return true;
}
//-------------------------------------------------------------------------
function update_empresa($oldid_empresa, $razon, $domicilio, $cuit, $codpos, $localidad,
						$provincia,	$telefono, $fax, $email, $web, $username,
						$password, $observ) //05/12/04
{
   $conn = db_connect();

   $query = "update enews_empresas
             set razon='$razon',
			 domicilio='$domicilio',
			 cuit='$cuit',
			 codpos='$codpos',
			 localidad='$localidad',
			 provincia='$provincia',
			 telefono='$telefono',
			 fax='$fax',
			 email='$email',
			 web='$web',
			 username='$username',
			 password='$password',
			 observ='$observ'
             where id_empresa='$oldid_empresa'";

   $result = @mysql_query($query);
   if (!$result)
   {
		echo "<p>Q: ".$query."</p>";
     	return false;
   }
   else
     return true; 
}
//------------------------------------------------------------------------
function get_detalle_empresa($x)	//05/12/04
{
  if (!$x || $x=='')
     return false;

   $conn = db_connect();
   $query = "select * from enews_empresas where id_empresa='$x'";
   $result = @mysql_query($query);
   if (!$result)
     return false;
   $result = @mysql_fetch_array($result);
   return $result;
}
//-------------------------------------------------------------------------
function delete_empresa($id_empresa)
{
	$conn = db_connect();
/*
	$query="select * from enews_empresas where id_empresas='$id_empresa'";
	$result = @mysql_query($query);
	if (!$result || mysql_num_rows($result)!=0)
	{
		echo '<p>Existen Notas con este Sponsor</p><br />';
     	return false;
 	}

	$query="select * from enews_rvt_noticias where id_sponsor='$id_sponsor'";
	$result = @mysql_query($query);
	if (!$result || mysql_num_rows($result)!=0)
	{
		echo '<p>Existen Noticias con este Sponsor</p><br />';
     	return false;
 	}
*/
	$query = "delete from enews_empresas
             where id_empresa='$id_empresa'";
   	$result = @mysql_query($query);
   	if (!$result)
    	return false;
   else
     	return true;
}



?>

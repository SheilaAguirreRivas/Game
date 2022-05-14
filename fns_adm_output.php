<?php
/*-------------------------------------------------------------------------------------------
Funciones Generales para todo el Sitio

-------------------------------------------------------------------------------------------*/
//------------------------------------------------------------------------
function do_html_header($title = '')
{
	// print an HTML header
	date_default_timezone_set('America/Buenos_Aires');
?>
  <html>
  
<head>
<title><?php echo $title; ?></title>
<style>
      h2 {
	font-family: Tahoma;
	font-size: 20px;
color = black; margin = 6px ; 	color: #666666;
}
      h3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
color = black; margin = 6px ; 	color: #FF6600;
}
      body {
	font-family: Tahoma;
	font-size: 13px;
	background-color: #EEEEEE;
	color: #999999;
}
      li, td {
	font-family: Tahoma;
	font-size: 13px;
	color: #336699;
}
      hr { color: #FF9900; width=70%; text-align=center}
      a {  font-family: Tahoma; color: #9966FF}
    .style1 {color: #FFFFFF}
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
  <body text="#FFFFFF" vlink="#00FF00"><body>
  
<table width=100% border=0 cellspacing = 0 bgcolor=#EEEEEE>
  <tr> 
    <td colspan="2" bgcolor="#6565E1">      <div align="center" class="style2 style1"><strong>IFTS</strong></div>      
      <div align="center"> </div>      <div align="center"> </div></td>
    <td width = 338 align = right bgcolor="#6565E1"> <span class="style1"><font size="3" face="Tahoma">Modulo 
      Administracion </font></span>
  </tr>
</table>
<?php
  if($title)
    do_html_heading($title);
}
//------------------------------------------------------------------------
function do_html_header2($title = '')
{
	// print an HTML header
?>
  <html>
  <head>
    <title><?php echo $title; ?></title>
    <style>
      h2 { font-family: Tahoma; font-size: 20px; color = black; margin = 6px }
      body { font-family: Tahoma; font-size: 13px }
      li, td { font-family: Tahoma; font-size: 13px }
      hr { color: #FFFFFF; width=70%; text-align=center}
      a {  font-family: Tahoma; color: #FFFF99 }
    </style>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
  <body bgcolor="#065CF2" text="#FFFFFF" vlink="#00FF00"><body>
  
<?php
  if($title)
    do_html_heading($title);
}
//------------------------------------------------------------------------
function do_html_footer()
{
  // print an HTML footer
?>
<table width="100%"  border="1">
    <tr>
      <td bgcolor="#665E16">&nbsp;</td>
      <td bgcolor="#6565E1">&nbsp;</td>
      <td bgcolor="#6565E1">&nbsp;</td>
    </tr>
  </table>  </body>
  </html>
<?php
}
//------------------------------------------------------------------------
function do_html_heading($heading)
{
  // print heading
?>
  <h2><?php echo $heading; ?></h2>
<?php
}
//------------------------------------------------------------------------
function do_html_URL($url, $name,$target)
{
  // output URL as link and br
	if ($target=='')
	{
	?>
		<a href="<?php echo $url; ?>"><?php echo $name; ?></a><br />
	<?php
	}
	else
	{
	?>
		<a href="<?php echo $url; ?>" target="<?php echo $target; ?>"><?php echo $name; ?></a><br />
	<?php
	}
}
/*-------------------------------------------------------------------------------------------
Funciones fomularios para el Ingreso de datos

-------------------------------------------------------------------------------------------*/
//------------------------------------------------------------------------
function display_login_form()
{
  // dispaly form asking for name and password
?>
  <form method=post action="admin.php">
  <table bgcolor=#FFCCCC>
   <tr>
     <td>Usuario:</td>
     <td><input type=text name=username></td></tr>
   <tr>
     <td>Password:</td>
     <td><input type=password name=passwd></td></tr>
   <tr>
     <td colspan=2 align=center>
     <input type=submit value="Log in"></td></tr>
   <tr>
 </table></form>
<?php
}
//--------------------------------------------------------------------------
function display_temas_form($tema = '')
{
  $edit = is_array($tema);
?>
  <form method=post
        action="<?php echo $edit?'adm_temas_edit.php':'adm_temas_insert.php';?>">
  <table border=0>
  <tr>
    <td>Nombre:</td>
    <td><input name=nombre type=text 
         value="<?php echo $edit?$tema['nombre']:''; ?>" size="50" maxlength="250"></td>
  </tr>
  <tr>
  	<td>Habilitado:</td>
    <td><select name=habilitado>
      <?php
          $hab_array=get_habilitado();
          foreach ($hab_array as $this_hab)
          {
               echo '<option value="';
               echo $this_hab['id'];
               echo '"';
               if ($edit && $this_hab['id'] == $tema['habilitado'])
                   echo ' selected';
               echo '>'; 
               echo $this_hab['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>


    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldid_tema 
                    value="'.$tema['id_tema'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Tema">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_temas_delete.php">';
             echo '<input type=hidden name=id_tema 
                    value="'.$tema['id_tema'].'">';
             echo '<input type=submit 
                    value="Eliminar Tema">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
//--------------------------------------------------------------------------
function display_subtemas_form($subtema = '')
{
  $edit = is_array($subtema);
?>
  <form method=post
        action="<?php echo $edit?'adm_subtemas_edit.php':'adm_subtemas_insert.php';?>">
  <table border=0>
  <tr>
  	<td>Tema:</td>
    <td><select name=id_tema>
      <?php
          $tem_array=get_adm_temas();
          foreach ($tem_array as $this_tem)
          {
               echo '<option value="';
               echo $this_tem['id_tema'];
               echo '"';
               if ($edit && $this_tem['id_tema'] == $subtema['id_tema'])
                   echo ' selected';
               echo '>'; 
               echo $this_tem['nombre'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>

  <tr>
    <td>Nombre:</td>
    <td><input type=text name=nombre size='50'
         value="<?php echo $edit?$subtema['nombre']:''; ?>"></td>
  </tr>
  <tr>
  	<td>Habilitado:</td>
    <td><select name=habilitado>
      <?php
          $hab_array=get_habilitado();
          foreach ($hab_array as $this_hab)
          {
               echo '<option value="';
               echo $this_hab['id'];
               echo '"';
               if ($edit && $this_hab['id'] == $subtema['habilitado'])
                   echo ' selected';
               echo '>'; 
               echo $this_hab['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldid_subtema 
                    value="'.$subtema['id_subtema'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Subtema">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_subtemas_delete.php">';
             echo '<input type=hidden name=id_subtema 
                    value="'.$subtema['id_subtema'].'">';
             echo '<input type=submit 
                    value="Eliminar Subtema">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
//--------------------------------------------------------------------------
function display_eventos_form($evento = '')
{
  $edit = is_array($evento);
?>
  <form method=post
        action="<?php echo $edit?'adm_eventos_edit.php':'adm_eventos_insert.php';?>">
  <table border=0>
  <tr>
  	<td>Tipo:</td>
    <td><select name=id_tipevento>
      <?php
          $tev_array=get_adm_tipeventos();
          foreach ($tev_array as $this_tev)
          {
               echo '<option value="';
               echo $this_tev['ID_TipEvento'];
               echo '"';
               if ($edit && $this_tev['ID_TipEvento'] == $evento['ID_TipEvento'])
                   echo ' selected';
               echo '>'; 
               echo $this_tev['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>

  <tr>
    <td>Nombre:</td>
    <td><input type=text name=nombre size='80'
         value="<?php echo $edit?$evento['nombre']:''; ?>"></td>
  </tr>
  <tr>
  	<td>Publicar:</td>
    <td><select name=publicar>
      <?php
          $pub_array=get_publicar();
          foreach ($pub_array as $this_pub)
          {
               echo '<option value="';
               echo $this_pub['id'];
               echo '"';
               if ($edit && $this_pub['id'] == $evento['publicar'])
                   echo ' selected';
               echo '>'; 
               echo $this_pub['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
  <tr>
    <td>Fecha:</td>
    <td><input type=text name=fecha size='10'
         value="<?php echo $edit?$evento['fecha']:''; ?>"></td>
  </tr>
  <tr>
  	<td>Empresa:</td>
    <td><select name=id_empresa>
      <?php
          $emp_array=get_adm_empresas();
          foreach ($emp_array as $this_emp)
          {
               echo '<option value="';
               echo $this_emp['id_empresa'];
               echo '"';
               if ($edit && $this_emp['id_empresa'] == $evento['id_empresa'])
                   echo ' selected';
               echo '>'; 
               echo $this_emp['razon'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
  <tr>
  	<td>Ejemplar:</td>
    <td><select name=id_ejemplar>
      <?php
          $eje_array=get_ejemplares1();
          foreach ($eje_array as $this_eje)
          {
               echo '<option value="';
               echo $this_eje['id_ejemplar'];
               echo '"';
               if ($edit && $this_eje['id_ejemplar'] == $evento['id_ejemplar'])
                   echo ' selected';
               echo '>'; 
               echo $this_eje['leyenda'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
   	<tr>
    	<td>Descripcion:</td>
     	<td><textarea rows=4 cols=50 name=descripcion><?php echo $edit?$evento['descripcion']:''; ?></textarea></td>
    </tr>
  <tr>
    <td>Pagina:</td>
    <td><input type=text name=pagina size='80'
         value="<?php echo $edit?$evento['pagina']:''; ?>"></td>
  </tr>
  <tr>
    <td>Lugar:</td>
    <td><input type=text name=lugar size='80'
         value="<?php echo $edit?$evento['lugar']:''; ?>"></td>
  </tr>
  <tr>
    <td>Informes:</td>
    <td><input type=text name=informes size='80'
         value="<?php echo $edit?$evento['informes']:''; ?>"></td>
  </tr>
  <tr>
    <td>Precio:</td>
    <td><input type=text name=precio size='10'
         value="<?php echo $edit?$evento['precio']:''; ?>"></td>
  </tr>




    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldid_evento 
                    value="'.$evento['ID_evento'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Evento">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_eventos_delete.php">';
             echo '<input type=hidden name=id_evento 
                    value="'.$evento['ID_evento'].'">';
             echo '<input type=submit 
                    value="Eliminar Evento">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
//--------------------------------------------------------------------------
function display_sponsors_form($sponsor = '')
{
	$edit = is_array($sponsor);
?>
  	<form method=post
    	action="<?php echo $edit?'adm_sponsors_edit.php':'adm_sponsors_insert.php';?>">
	<table border=0>
  	<tr>
    	<td>Razon:</td>
    	<td><input type=text name=razon size='60'
         	value="<?php echo $edit?$sponsor['Razon']:''; ?>"></td>
  	</tr>
  	<tr>
    	<td>email:</td>
    	<td><input type=text name=email size='60'
         	value="<?php echo $edit?$sponsor['email']:''; ?>"></td>
  	</tr>
  	<tr>
    	<td>web:</td>
    	<td><input type=text name=web size='60'
         	value="<?php echo $edit?$sponsor['web']:''; ?>"></td>
  	</tr>
  	<tr>
    	<td>imagen:</td>
    	<td><input type=text name=imagen size='60'
         	value="<?php echo $edit?$sponsor['imagen']:''; ?>"></td>
  	</tr>
   	<tr>
    	<td>Otros:</td>
     	<td><textarea rows=4 cols=50 name=otros><?php echo $edit?$sponsor['otros']:''; ?></textarea></td>
    </tr>

    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldid_sponsor 
                    value="'.$sponsor['id_sponsor'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Sponsor">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_sponsors_delete.php">';
             echo '<input type=hidden name=id_sponsor 
                    value="'.$sponsor['id_sponsor'].'">';
             echo '<input type=submit 
                    value="Eliminar Sponsor">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
//--------------------------------------------------------------------------
function display_idiomas_form($idioma = '')
{
  $edit = is_array($idioma);
?>
  <form method=post
        action="<?php echo $edit?'adm_idiomas_edit.php':'adm_idiomas_insert.php';?>">
  <table border=0>
  <tr>
    <td>Nombre:</td>
    <td><input type=text name=nombre 
         value="<?php echo $edit?$idioma['nombre']:''; ?>"></td>
  </tr>
  <tr>
  	<td>Habilitado:</td>
    <td><select name=habilitado>
      <?php
          $hab_array=get_habilitado();
          foreach ($hab_array as $this_hab)
          {
               echo '<option value="';
               echo $this_hab['id'];
               echo '"';
               if ($edit && $this_hab['id'] == $idioma['habilitado'])
                   echo ' selected';
               echo '>'; 
               echo $this_hab['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
   	<tr>
    	<td>Observaciones:</td>
     	<td><textarea name=observaciones cols=50 rows=4 wrap="PHYSICAL"><?php echo $edit?$idioma['observaciones']:''; ?></textarea></td>
    </tr>
  <tr>
    <td>Bandera:</td>
    <td><input type=text name=flag_file
         value="<?php echo $edit?$idioma['flag_file']:''; ?>"></td>
  </tr>

  <tr>
	<td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
        <?php 
		if ($edit)
		{
        	echo '<input type=hidden name=oldid_idioma
                    value="'.$idioma['id_idioma'].'">';
		}
        ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Idioma">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_idiomas_delete.php">';
             echo '<input type=hidden name=id_idioma 
                    value="'.$idioma['id_idioma'].'">';
             echo '<input type=submit 
                    value="Eliminar Idioma">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
//--------------------------------------------------------------------------
function display_tickets_form($ticket = '')
{
  $edit = is_array($ticket);
?>
  <form method=post
        action="<?php echo $edit?'adm_tickets_edit.php':'adm_tickets_insert.php';?>">
  <table border=0>
   	<tr>
    	<td>Texto:</td>
     	<td><textarea name=texto cols=50 rows=4 wrap="PHYSICAL"><?php echo $edit?$ticket['texto']:''; ?></textarea></td>
    </tr>
  <tr>
  	<td>Habilitado:</td>
    <td><select name=habilitado>
      <?php
          $hab_array=get_habilitado();
          foreach ($hab_array as $this_hab)
          {
               echo '<option value="';
               echo $this_hab['id'];
               echo '"';
               if ($edit && $this_hab['id'] == $tema['habilitado'])
                   echo ' selected';
               echo '>'; 
               echo $this_hab['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
  <tr>
  	<td>Sponsor:</td>
    <td><select name=ID_Sponsor>
      <?php
          $spo_array=get_sponsor();
          foreach ($spo_array as $this_spo)
          {
               echo '<option value="';
               echo $this_spo['id_sponsor'];
               echo '"';
               if ($edit && $this_spo['id_sponsor'] == $ticket['ID_Sponsor'])
                   echo ' selected';
               echo '>'; 
               echo $this_spo['Razon'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
  	<tr>
    	<td>imagen:</td>
    	<td><input type=text name=imagen size='60'
         	value="<?php echo $edit?$ticket['imagen']:''; ?>"></td>
  	</tr>


    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldid_ticket
                    value="'.$ticket['ID_Ticket'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Ticket">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_tickets_delete.php">';
             echo '<input type=hidden name=id_ticket 
                    value="'.$ticket['ID_Ticket'].'">';
             echo '<input type=submit 
                    value="Eliminar Ticket">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
//--------------------------------------------------------------------------
function display_boletines_form($boletin = '')
{
  $edit = is_array($boletin);
?>
  <form method=post
        action="<?php echo $edit?'adm_boletines_edit.php':'adm_boletines_insert.php';?>">
  <table border=0>
  <tr>
  	<td>Fecha:</td>
    <td><input type=text name=fecha size='20'
         	value="<?php echo $edit?$boletin['fecha']:''; ?>"></td>
  </tr>
  <tr>
  	<td>Encabezado:</td>
    <td><input type=text name=encabezado size='100'
         	value="<?php echo $edit?$boletin['encabezado']:''; ?>"></td>
  </tr>

   	<tr>
    	<td>Texto:</td>
     	<td><textarea name=texto cols=50 rows=4 wrap="PHYSICAL"><?php echo $edit?$boletin['texto']:''; ?></textarea></td>
    </tr>
  <tr>
  	<td>Pie:</td>
    <td><input type=text name=pie size='100'
         	value="<?php echo $edit?$boletin['pie']:''; ?>"></td>
  </tr>
  <tr>
  	<td>Publicar:</td>
    <td><select name=publicar>
      <?php
          $hab_array=get_publicar();
          foreach ($hab_array as $this_hab)
          {
               echo '<option value="';
               echo $this_hab['id'];
               echo '"';
               if ($edit && $this_hab['id'] == $boletin['publicar'])
                   echo ' selected';
               echo '>'; 
               echo $this_hab['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
  <tr>
  	<td>Mostrar:</td>
    <td><select name=mostrar>
      <?php
          $mos_array=get_mostrar();
          foreach ($mos_array as $this_mos)
          {
               echo '<option value="';
               echo $this_mos['id'];
               echo '"';
               if ($edit && $this_mos['id'] == $boletin['mostrar'])
                   echo ' selected';
               echo '>'; 
               echo $this_mos['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
  <tr>
  	<td>Mostrar2:</td>
    <td><select name=mostrar2>
      <?php
          $mo2_array=get_mostrar();
          foreach ($mo2_array as $this_mo2)
          {
               echo '<option value="';
               echo $this_mo2['id'];
               echo '"';
               if ($edit && $this_mo2['id'] == $boletin['mostrar2'])
                   echo ' selected';
               echo '>'; 
               echo $this_mo2['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>


    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldid_boletin
                    value="'.$boletin['id_boletin'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Boletin">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_boletines_delete.php">';
             echo '<input type=hidden name=id_boletin 
                    value="'.$boletin['id_boletin'].'">';
             echo '<input type=submit 
                    value="Eliminar Boletin">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
//--------------------------------------------------------------------------
function display_cursos_form($curso = '')
{
  $edit = is_array($curso);
?>
  <form method=post
        action="<?php echo $edit?'adm_cursos_edit.php':'adm_cursos_insert.php';?>">
  <table border=0>
  <tr>
  	<td>Fecha:</td>
    <td><input type=text name=fecha size='20'
         	value="<?php echo $edit?$curso['fecha']:''; ?>"></td>
  </tr>
  <tr>
  	<td>Tema:</td>
    <td><input type=text name=tema size='100'
         	value="<?php echo $edit?$curso['tema']:''; ?>"></td>
  </tr>

   	<tr>
    	<td>Texto:</td>
     	<td><textarea name=texto cols=50 rows=4 wrap="PHYSICAL"><?php echo $edit?$curso['texto']:''; ?></textarea></td>
    </tr>
  <tr>
  	<td>Orador:</td>
    <td><input type=text name=orador size='100'
         	value="<?php echo $edit?$curso['orador']:''; ?>"></td>
  </tr>
  <tr>
  	<td>Publicar:</td>
    <td><select name=publicar>
      <?php
          $hab_array=get_publicar();
          foreach ($hab_array as $this_hab)
          {
               echo '<option value="';
               echo $this_hab['id'];
               echo '"';
               if ($edit && $this_hab['id'] == $curso['publicar'])
                   echo ' selected';
               echo '>'; 
               echo $this_hab['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>

  <tr>
  	<td>Precio:</td>
    <td><input type=text name=precio size='100'
         	value="<?php echo $edit?$curso['precio']:''; ?>"></td>
  </tr>
  <tr>
  	<td>Lugar:</td>
    <td><input type=text name=lugar size='100'
         	value="<?php echo $edit?$curso['lugar']:''; ?>"></td>
  </tr>
  <tr>
  	<td>Materiales:</td>
    <td><input type=text name=materiales size='100'
         	value="<?php echo $edit?$curso['materiales']:''; ?>"></td>
  </tr>
  <tr>
  	<td>1 Curso/ 2 Charla:</td>
    <td><input type=text name=tipo size='20'
         	value="<?php echo $edit?$curso['tipo']:''; ?> "></td>
  </tr>
  <tr>
  	<td>Tipo:</td>
    <td><select name=id_tipo>
      <?php
          $tip_array=get_aux_tipos();
          foreach ($tip_array as $this_tip)
          {
               echo '<option value="';
               echo $this_tip['id_tipo'];
               echo '"';
               if ($edit && $this_tip['id_tipo'] == $curso['id_tipo'])
                   echo ' selected';
               echo '>'; 
               echo $this_tip['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>

    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldid_curso
                    value="'.$curso['id_curso'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Curso">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_cursos_delete.php">';
             echo '<input type=hidden name=id_curso 
                    value="'.$curso['id_curso'].'">';
             echo '<input type=submit 
                    value="Eliminar Curso">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
//--------------------------------------------------------------------------
function display_ejemplares_form($ejemplar = '')
{
  $edit = is_array($ejemplar);
?>
  <form method=post
        action="<?php echo $edit?'adm_ejemplares_edit.php':'adm_ejemplares_insert.php';?>">
  <table border=0>
  <tr>
  	<td>Fecha:</td>
    <td><input type=text name=fecha size='20'
         	value="<?php echo $edit?$ejemplar['fecha']:''; ?>"></td>
  </tr>
  <tr>
  	<td>Leyenda:</td>
    <td><input type=text name=leyenda size='100'
         	value="<?php echo $edit?$ejemplar['leyenda']:''; ?>"></td>
  </tr>

   	<tr>
    	<td>Editorial:</td>
     	<td><textarea name=editorial cols=50 rows=4 wrap="PHYSICAL"><?php echo $edit?$ejemplar['editorial']:''; ?></textarea></td>
    </tr>
  <tr>
  	<td>Publicar:</td>
    <td><select name=publicar>
      <?php
          $hab_array=get_publicar();
          foreach ($hab_array as $this_hab)
          {
               echo '<option value="';
               echo $this_hab['id'];
               echo '"';
               if ($edit && $this_hab['id'] == $ejemplar['publicar'])
                   echo ' selected';
               echo '>'; 
               echo $this_hab['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>


    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldid_ejemplar
                    value="'.$ejemplar['id_ejemplar'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Ejamplar">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_ejemplares_delete.php">';
             echo '<input type=hidden name=id_ejemplar 
                    value="'.$ejemplar['id_ejemplar'].'">';
             echo '<input type=submit 
                    value="Eliminar Ejemplar">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
//--------------------------------------------------------------------------
function display_notas1_form($nota = '',$admin_user,$id_tema)
{
  $edit = is_array($nota);
?>
  <form method=post
        action="<?php echo $edit?'adm_notas1_edit.php':'adm_notas1_insert.php';?>">
  <table border=0>

  <tr>
  	<td>Subtema:</td>
    <td><select name=id_subtema>
      <?php
          $stm_array=get_subtemas_escritor($admin_user,$id_tema);
          foreach ($stm_array as $this_stm)
          {
               echo '<option value="';
               echo $this_stm['id_subtema'];
               echo '"';
               if ($edit && $this_stm['id_subtema'] == $nota['id_subtema'])
                   echo ' selected';
               echo '>'; 
               echo $this_stm['nombre'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>

  <tr>
  	<td>Idioma:</td>
    <td><select name=id_idioma>
      <?php
          $idm_array=get_adm_idiomas();
          foreach ($idm_array as $this_idm)
          {
               echo '<option value="';
               echo $this_idm['id_idioma'];
               echo '"';
               if ($edit && $this_idm['id_idioma'] == $nota['id_idioma'])
                   echo ' selected';
               echo '>'; 
               echo $this_idm['nombre'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>

  <tr>
    <td>Encabezado:</td>
    <td><input name=encabezado type=text 
         value="<?php echo $edit?$nota['encabezado']:''; ?>" size="100" maxlength="250"></td>
  </tr>
  <tr>
    <td>Frace:</td>
    <td><input name=frace type=text 
         value="<?php echo $edit?$nota['frace']:''; ?>" size="100" maxlength="250"></td>
  </tr>
  <tr>
  	<td>Texto:</td>
    <td><textarea name=texto cols=100 rows=10 wrap="PHYSICAL"><?php echo $edit?$nota['texto']:''; ?></textarea>
	</td>
  </tr>
  <tr>
  	<td>Listo:</td>
    <td><select name=listo>
      <?php
          $hab_array=get_habilitado();
          foreach ($hab_array as $this_hab)
          {
               echo '<option value="';
               echo $this_hab['id'];
               echo '"';
               if ($edit && $this_hab['id'] == $nota['listo'])
                   echo ' selected';
               echo '>'; 
               echo $this_hab['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>


    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldid_nota 
                    value="'.$nota['id_nota'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Nota">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_notas1_delete.php">';
             echo '<input type=hidden name=id_nota 
                    value="'.$nota['id_nota'].'">';
             echo '<input type=submit 
                    value="Eliminar Nota">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
//--------------------------------------------------------------------------
function display_noticias_form($noticia = '',$admin_user)
{
  $edit = is_array($noticia);
?>
  <form method=post
        action="<?php echo $edit?'adm_noticias_edit.php':'adm_noticias_insert.php';?>">
  <table border=0>

  <tr>
    <td>Encabezado:</td>
    <td><input name=encabezado type=text 
         value="<?php echo $edit?$noticia['encabezado']:''; ?>" size="100" maxlength="250"></td>
  </tr>
  <tr>
    <td>Resumen:</td>
    <td><input name=resumen type=text 
         value="<?php echo $edit?$noticia['resumen']:''; ?>" size="100" maxlength="250"></td>
  </tr>
  <tr>
  	<td>Texto:</td>
    <td><textarea name=texto cols=100 rows=10 wrap="PHYSICAL"><?php echo $edit?$noticia['texto']:''; ?></textarea>
	</td>
  </tr>
  <tr>
    <td>HiperLink:</td>
    <td><input name=hiperlink type=text 
         value="<?php echo $edit?$noticia['hiperlink']:''; ?>" size="100" maxlength="250"></td>
  </tr>
  <tr>
    <td>Fuente:</td>
    <td><input name=fuente type=text 
         value="<?php echo $edit?$noticia['fuente']:''; ?>" size="100" maxlength="250"></td>
  </tr>
  <tr>
  	<td>Listo:</td>
    <td><select name=listo>
      <?php
          $hab_array=get_habilitado();
          foreach ($hab_array as $this_hab)
          {
               echo '<option value="';
               echo $this_hab['id'];
               echo '"';
               if ($edit && $this_hab['id'] == $noticia['listo'])
                   echo ' selected';
               echo '>'; 
               echo $this_hab['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
  <tr>
  	<td>Mas:</td>
    <td><select name=mas>
      <?php
          $mas_array=get_mas();
          foreach ($mas_array as $this_mas)
          {
               echo '<option value="';
               echo $this_mas['id'];
               echo '"';
               if ($edit && $this_mas['id'] == $noticia['mas'])
                   echo ' selected';
               echo '>'; 
               echo $this_mas['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>


    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldid_noticia 
                    value="'.$noticia['id_noticia'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Noticia">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_noticias_delete.php">';
             echo '<input type=hidden name=id_noticia 
                    value="'.$noticia['id_noticia'].'">';
             echo '<input type=submit 
                    value="Eliminar Noticia">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
//--------------------------------------------------------------------------
function display_notas2_form($nota)
{
  $edit = is_array($nota);
?>
  <form method=post
        action="<?php echo $edit?'adm_pubnotas_edit.php':'adm_pubnotas_insert.php';?>">
  <table border=0>

  <tr>
  	<td>Publicar:</td>
    <td><select name=publicar>
      <?php
          $pub_array=get_publicar();
          foreach ($pub_array as $this_pub)
          {
               echo '<option value="';
               echo $this_pub['id'];
               echo '"';
               if ($edit && $this_pub['id'] == $nota['publicar'])
                   echo ' selected';
               echo '>'; 
               echo $this_pub['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
  <tr>
  	<td>Ejemplar:</td>
    <td><select name=id_ejemplar>
      <?php
          $eje_array=get_ejemplares1();
          foreach ($eje_array as $this_eje)
          {
               echo '<option value="';
               echo $this_eje['id_ejemplar'];
               echo '"';
               if ($edit && $this_eje['id_ejemplar'] == $nota['id_ejemplar'])
                   echo ' selected';
               echo '>'; 
               echo $this_eje['leyenda'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
  <tr>
  	<td>Sponsor:</td>
    <td><select name=id_sponsor>
      <?php
          $spo_array=get_sponsor();
          foreach ($spo_array as $this_spo)
          {
               echo '<option value="';
               echo $this_spo['id_sponsor'];
               echo '"';
               if ($edit && $this_spo['id_sponsor'] == $nota['id_sponsor'])
                   echo ' selected';
               echo '>'; 
               echo $this_spo['Razon'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
  <tr>
  	<td>Ticket:</td>
    <td><select name=id_ticket>
      <?php
          $tkt_array=get_tickets1();
          foreach ($tkt_array as $this_tkt)
          {
               echo '<option value="';
               echo $this_tkt['id_ticket'];
               echo '"';
               if ($edit && $this_tkt['id_ticket'] == $nota['id_ticket'])
                   echo ' selected';
               echo '>'; 
               echo $this_tkt['texto'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>

  <tr>
    <td>Encabezado:</td>
    <td><input name=encabezado type=text 
         value="<?php echo $edit?$nota['encabezado']:''; ?>" size="100" maxlength="250"></td>
  </tr>
  <tr>
    <td>Frace:</td>
    <td><input name=frace type=text 
         value="<?php echo $edit?$nota['frace']:''; ?>" size="100" maxlength="250"></td>
  </tr>
  <tr>
  	<td>Texto:</td>
    <td><textarea name="texto" cols="100" rows="10"><?php echo $edit?htmlspecialchars(stripcslashes($nota['texto'])):''; ?></textarea>
	</td>
  </tr>
  <tr>
  	<td>Listo:</td>
    <td><select name=listo>
      <?php
          $hab_array=get_habilitado();
          foreach ($hab_array as $this_hab)
          {
               echo '<option value="';
               echo $this_hab['id'];
               echo '"';
               if ($edit && $this_hab['id'] == $nota['listo'])
                   echo ' selected';
               echo '>'; 
               echo $this_hab['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>


    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldid_nota 
                    value="'.$nota['id_nota'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Nota">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_pubnotas_delete.php">';
             echo '<input type=hidden name=id_nota 
                    value="'.$nota['id_nota'].'">';
             echo '<input type=submit 
                    value="Eliminar Nota">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
//--------------------------------------------------------------------------
function display_noticias2_form($noticia)
{
  $edit = is_array($noticia);
?>
  <form method=post
        action="<?php echo $edit?'adm_pubnoticias_edit.php':'adm_pubnoticias_insert.php';?>">
  <table border=0>

  <tr>
  	<td>Publicar:</td>
    <td><select name=publicar>
      <?php
          $pub_array=get_publicar();
          foreach ($pub_array as $this_pub)
          {
               echo '<option value="';
               echo $this_pub['id'];
               echo '"';
               if ($edit && $this_pub['id'] == $noticia['publicar'])
                   echo ' selected';
               echo '>'; 
               echo $this_pub['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
  <tr>
  	<td>Boletin:</td>
    <td><select name=id_boletin>
      <?php
          $eje_array=get_boletines11();
          foreach ($eje_array as $this_eje)
          {
               echo '<option value="';
               echo $this_eje['id_boletin'];
               echo '"';
               if ($edit && $this_eje['id_boletin'] == $noticia['id_boletin'])
                   echo ' selected';
               echo '>'; 
               echo $this_eje['encabezado'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
  <tr>
    <td>Encabezado:</td>
    <td><input name=encabezado type=text 
         value="<?php echo $edit?$noticia['encabezado']:''; ?>" size="100" maxlength="250"></td>
  </tr>
  <tr>
    <td>Resumen:</td>
    <td><input name=resumen type=text 
         value="<?php echo $edit?$noticia['resumen']:''; ?>" size="100" maxlength="250"></td>
  </tr>
  <tr>
  	<td>Texto:</td>
    <td><textarea name="texto" cols="100" rows="10"><?php echo $edit?htmlspecialchars(stripcslashes($noticia['texto'])):''; ?></textarea>
	</td>
  </tr>
  <tr>
    <td>Hiperlink:</td>
    <td><input name=hiperlink type=text 
         value="<?php echo $edit?$noticia['hiperlink']:''; ?>" size="100" maxlength="250"></td>
  </tr>
  <tr>
    <td>Fuente:</td>
    <td><input name=fuente type=text 
         value="<?php echo $edit?$noticia['fuente']:''; ?>" size="100" maxlength="250"></td>
  </tr>

  <tr>
  	<td>Listo:</td>
    <td><select name=listo>
      <?php
          $hab_array=get_habilitado();
          foreach ($hab_array as $this_hab)
          {
               echo '<option value="';
               echo $this_hab['id'];
               echo '"';
               if ($edit && $this_hab['id'] == $noticia['listo'])
                   echo ' selected';
               echo '>'; 
               echo $this_hab['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
  <tr>
  	<td>Mas:</td>
    <td><select name=mas>
      <?php
          $mas_array=get_mas();
          foreach ($mas_array as $this_mas)
          {
               echo '<option value="';
               echo $this_mas['id'];
               echo '"';
               if ($edit && $this_mas['id'] == $noticia['mas'])
                   echo ' selected';
               echo '>'; 
               echo $this_mas['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>


    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldid_noticia 
                    value="'.$noticia['id_noticia'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Noticia">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_pubnoticias_delete.php">';
             echo '<input type=hidden name=id_noticia 
                    value="'.$noticia['id_noticia'].'">';
             echo '<input type=submit 
                    value="Eliminar Noticia">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
/*-------------------------------------------------------------------------------------------
Funciones Mostrar Datos 

-------------------------------------------------------------------------------------------*/
//------------------------------------------------------------------------
function display_admin_menu()
{
?>
<br />
<?php
	echo "<h3>Funciones del Administrador</h3>";
	echo "<a href='adm_categorias_show.php'>*Actualizar Categorias</a>";
	echo " - ! - ";
	echo "<a href='adm_tipvta_show.php'>*Actualizar Tipos de Venta</a>";
//	echo " - ! - ";
//	echo "<a href='adm_empresas_show.php'>*Actualizar Empresas</a><br />";
//	echo "<br />";
//	echo "<a href='adm_tipeventos_show.php'>*Actualizar Tipos de Eventos</a>";
//	echo " - ! - ";
//	echo "<a href='adm_eventos_show.php'>*Actualizar Eventos</a><br />";
//	echo "<br />";
//	echo "<a href='adm_idiomas_show.php'>*ABM Idiomas</a>";
//	echo " - ! - ";
//	echo "<a href='adm_sponsors_show.php'>*ABM Sponsors</a>";
//	echo " - ! - ";
//	echo "<a href='adm_tickets_show.php'>*ABM Tickets</a><br />";
//	echo "<br />";
//	echo "<a href='adm_escritores_show.php'>*Administrar Escritores</a>";
//	echo " - ! - ";
//	echo "<a href='adm_esctemas_show.php'>Administrar Escritores-Temas</a><br />";
//	echo "<a href='adm_cursos_show.php'>Administrar Cursos</a>";
//	echo " - ! - ";
//	echo "<a href='adm_notacursos_show.php'>Administrar Nota-Cursos</a><br />";
//	echo "<h3>Funciones del Usuario</h3>";
//	echo "<a href='adm_categorias_show.php'>*Administrar Categorias</a><br />";
//	echo "<a href='adm_items_show.php'>Administrar Items</a><br />";
//echo "<a href='adm_noticias_show.php'>*Administrar Noticias</a><br />";
//echo "<a href='adm_n2busquedas_show.php'>Administrar Noticias-Busquedas</a><br />";
}
//------------------------------------------------------------------------
function display_adm_temas($temas_array)
{
	if (!is_array($temas_array))
	{
		echo 'No hay Temas <br />';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Id</td>";
		echo "<td width='80%'><font size='2' face='Tahoma'>Nombre</td>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Habilitado</td>";
		echo "</tr>";
		$rn=0;
		foreach ($temas_array as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}

			$url = 'adm_temas_edit_form.php?id_tema='.($row['id_tema']);
	        $title =  $row['id_tema'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['nombre']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['habilitado']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
	echo "<a href='adm_temas_insert_form.php'>Agregar un Tema</a><br />";
	echo "<a href='admin.php'>Menú Administración</a><br />";
}
//------------------------------------------------------------------------
function display_adm_cursos($cursos_array)
{
	if (!is_array($cursos_array))
	{
		echo 'No hay Cursos <br />';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='5%'><font size='2' face='Tahoma'>IdCurso</td>";
		echo "<td width='5%'><font size='2' face='Tahoma'>Publicar</td>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Fecha</td>";
		echo "<td width='39%'><font size='2' face='Tahoma'>Tema</td>";
		echo "<td width='39%'><font size='2' face='Tahoma'>Orador</td>";
		echo "<td width='2%'><font size='2' face='Tahoma'>Tipo</td>";
		echo "</tr>";
		$rn=0;
		foreach ($cursos_array as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}

			$url = 'adm_cursos_edit_form.php?id_curso='.($row['id_curso']);
	        $title =  $row['id_curso'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['publicar']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['fecha']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['tema']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['orador']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['tipo']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
	echo "<a href='adm_cursos_insert_form.php'>Agregar un Curso</a><br />";
	echo "<a href='admin.php'>Menú Administración</a><br />";
}
//------------------------------------------------------------------------
function display_adm_categorias($x) //05/12/04
{
	if (!is_array($x))
	{
		echo '<p>No hay Categorias</p>';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='20%'><font size='2' face='Tahoma'>Id</td>";
		echo "<td width='80%'><font size='2' face='Tahoma'>Descripcion</td>";
		echo "</tr>";
		$rn=0;
		foreach ($x as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}

			$url = 'adm_categorias_edit_form.php?idcat='.($row['idcat']);
	        $title =  $row['idcat'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['descripcion']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
	echo "<a href='adm_categorias_insert_form.php'>Agregar una Categoria</a><br />";
	echo "<a href='admin.php'>Menu Administracion</a><br />";
}
//------------------------------------------------------------------------
function display_adm_notas1($notas_array)
{
	if (!is_array($notas_array))
	{
		echo '<p>No hay Notas para este escritor </p>';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='5%'><font size='2' face='Tahoma'>Id</td>";
		echo "<td width='30%'><font size='2' face='Tahoma'>Tema</td>";
		echo "<td width='30%'><font size='2' face='Tahoma'>Subtema</td>";
		echo "<td width='30%'><font size='2' face='Tahoma'>Encabezado</td>";
		echo "<td width='5%'><font size='2' face='Tahoma'>Idioma</td>";
		echo "</tr>";
		$rn=0;
		foreach ($notas_array as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}

			$url = 'adm_notas1_edit_form.php?id_nota='.($row['id_nota']);
	        $title =  $row['id_nota'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['tema']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['subtema']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['encabezado']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['idioma']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
	echo "<a href='adm_notas1_insert_form.php'>Agregar una Nota</a><br />";
	echo "<a href='admin.php'>Menú Administración</a><br />";
}
//------------------------------------------------------------------------
function display_adm_noticias($x_array)
{
	if (!is_array($x_array))
	{
		echo '<p>No hay Noticias </p>';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Id</td>";
		echo "<td width='30%'><font size='2' face='Tahoma'>Encabezado</td>";
		echo "<td width='30%'><font size='2' face='Tahoma'>Resumen</td>";
		echo "<td width='30%'><font size='2' face='Tahoma'>Fuente</td>";
		echo "</tr>";
		$rn=0;
		foreach ($x_array as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}

			$url = 'adm_noticias_edit_form.php?id_noticia='.($row['id_noticia']);
	        $title =  $row['id_noticia'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['encabezado']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['resumen']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['fuente']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
	echo "<a href='adm_noticias_insert_form.php'>Agregar una Noticia</a><br />";
	echo "<a href='admin.php'>Menú Administración</a><br />";
}
//------------------------------------------------------------------------
function display_adm_notas2($notas_array)
{
	if (!is_array($notas_array))
	{
		echo 'No hay Notas <br />';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='5%'><font size='2' face='Tahoma'>Publicar</td>";
		echo "<td width='5%'><font size='2' face='Tahoma'>Id</td>";
		echo "<td width='15%'><font size='2' face='Tahoma'>Tema</td>";
		echo "<td width='15%'><font size='2' face='Tahoma'>Subtema</td>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Escritor</td>";
		echo "<td width='40%'><font size='2' face='Tahoma'>Encabezado</td>";
		echo "<td width='5%'><font size='2' face='Tahoma'>Idioma</td>";
		echo "</tr>";
		$rn=0;
		foreach ($notas_array as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}

    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['publicar']))."</font></td>";
			$url = 'adm_pubnotas_edit_form.php?id_nota='.($row['id_nota']);
	        $title =  $row['id_nota'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['tema']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['subtema']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['username']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['encabezado']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['idioma']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
//	echo "<a href='adm_pubnotas_insert_form.php'>Agregar una Nota</a><br />";
	echo "<a href='admin.php'>Menú Administración</a><br />";
}
//------------------------------------------------------------------------
function display_adm_noticias2($x_array)
{
	if (!is_array($x_array))
	{
		echo '<p>No hay Noticias </p>';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='5%'><font size='2' face='Tahoma'>Publicar</td>";
		echo "<td width='5%'><font size='2' face='Tahoma'>Boletin</td>";
		echo "<td width='25%'><font size='2' face='Tahoma'>Boletin</td>";
		echo "<td width='5%'><font size='2' face='Tahoma'>Id</td>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Escritor</td>";
		echo "<td width='35%'><font size='2' face='Tahoma'>Encabezado</td>";
		echo "</tr>";
		$rn=0;
		foreach ($x_array as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}

    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['publicar']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['id_boletin']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['bencabezado']))."</font></td>";
			$url = 'adm_pubnoticias_edit_form.php?id_noticia='.($row['id_noticia']);
	        $title =  $row['id_noticia'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['username']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['nencabezado']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
//	echo "<a href='adm_pubnotas_insert_form.php'>Agregar una Nota</a><br />";
	echo "<a href='admin.php'>Menú Administración</a><br />";
}
//------------------------------------------------------------------------
function display_adm_sponsors($sponsors_array)
{
	if (!is_array($sponsors_array))
	{
		echo 'No hay Sponsors <br />';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Id</td>";
		echo "<td width='20%'><font size='2' face='Tahoma'>Razón</td>";
		echo "<td width='20%'><font size='2' face='Tahoma'>email</td>";
		echo "<td width='20%'><font size='2' face='Tahoma'>web</td>";
		echo "<td width='20%'><font size='2' face='Tahoma'>otros</td>";
		echo "<td width='20%'><font size='2' face='Tahoma'>imagen</td>";
		echo "</tr>";
		$rn=0;
		foreach ($sponsors_array as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}
			$url = 'adm_sponsors_edit_form.php?id_sponsor='.($row['id_sponsor']);
	        $title =  $row['id_sponsor'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['Razon']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['email']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['web']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['otros']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['imagen']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
	echo "<a href='adm_sponsors_insert_form.php'>Agregar un Sponsors</a><br />";
	echo "<a href='admin.php'>Menú Administración</a><br />";
}
//------------------------------------------------------------------------
function display_adm_eventos($eventos_array)
{
	if (!is_array($eventos_array))
	{
		echo '<p>No hay Eventos</p>';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='22%'><font size='2' face='Tahoma'>Empresa</td>";
		echo "<td width='12%'><font size='2' face='Tahoma'>Id</td>";
		echo "<td width='22%'><font size='2' face='Tahoma'>Tipo</td>";
		echo "<td width='22%'><font size='2' face='Tahoma'>Fecha</td>";
		echo "<td width='22%'><font size='2' face='Tahoma'>Nombre</td>";
		echo "</tr>";
		$rn=0;
		foreach ($eventos_array as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['razon']))."</font></td>";
			$url = 'adm_eventos_edit_form.php?id_evento='.($row['id_evento']);
	        $title =  $row['id_evento'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['descripcion']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['fecha']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['nombre']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
	echo "<a href='adm_eventos_insert_form.php'>Agregar un Evento</a><br />";
	echo "<a href='admin.php'>Menú Administración</a><br />";
}
//------------------------------------------------------------------------
function display_adm_subtemas($subtemas_array)
{
	if (!is_array($subtemas_array))
	{
		echo 'No hay Subtemas <br />';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='30%'><font size='2' face='Tahoma'>Tema</td>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Id</td>";
		echo "<td width='50%'><font size='2' face='Tahoma'>Nombre</td>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Habilitado</td>";
		echo "</tr>";
		$rn=0;
		foreach ($subtemas_array as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['tnombre']))."</font></td>";
			$url = 'adm_subtemas_edit_form.php?id_subtema='.($row['id_subtema']);
	        $title =  $row['id_subtema'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['snombre']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['habilitado']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
	echo "<a href='adm_subtemas_insert_form.php'>Agregar un Subtema</a><br />";
	echo "<a href='admin.php'>Menú Administración</a><br />";
}
//------------------------------------------------------------------------
function display_adm_idiomas($idiomas_array)
{
	if (!is_array($idiomas_array))
	{
		echo 'No hay Idiomas<br />';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Id</td>";
		echo "<td width='20%'><font size='2' face='Tahoma'>Nombre</td>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Hab</td>";
		echo "<td width='40%'><font size='2' face='Tahoma'>Observaciones</td>";
		echo "<td width='20%'><font size='2' face='Tahoma'>Bandera</td>";
		echo "</tr>";
		$rn=0;
		foreach ($idiomas_array as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}
			$url = 'adm_idiomas_edit_form.php?id_idioma='.($row['id_idioma']);
	        $title =  $row['id_idioma'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['nombre']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['habilitado']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['observaciones']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['flag_file']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
	echo "<a href='adm_idiomas_insert_form.php'>Agregar un Idioma</a><br />";
	echo "<a href='admin.php'>Menú Administración</a><br />";
}
//------------------------------------------------------------------------
function display_adm_tickets($tickets_array)
{
	if (!is_array($tickets_array))
	{
		echo 'No hay Tickets<br />';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='20%'><font size='2' face='Tahoma'>Sponsor</td>";
		echo "<td width='5%'><font size='2' face='Tahoma'>Id</td>";
		echo "<td width='50%'><font size='2' face='Tahoma'>Texto</td>";
		echo "<td width='5%'><font size='2' face='Tahoma'>Habilitado</td>";
		echo "<td width='20%'><font size='2' face='Tahoma'>Imagen</td>";
		echo "</tr>";
		$rn=0;
		foreach ($tickets_array as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}

    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['Razon']))."</font></td>";
			$url = 'adm_tickets_edit_form.php?id_ticket='.($row['id_ticket']);
	        $title =  $row['id_ticket'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['texto']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['habilitado']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['imagen']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
	echo "<a href='adm_tickets_insert_form.php'>Agregar un Ticket</a><br />";
	echo "<a href='admin.php'>Menú Administración</a><br />";
}
//------------------------------------------------------------------------
function display_adm_boletines($x_array)
{
	if (!is_array($x_array))
	{
		echo '<p>No hay Boletines</p>';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='5%'><font size='2' face='Tahoma'>Publicar</td>";
		echo "<td width='5%'><font size='2' face='Tahoma'>Mostrar</td>";
		echo "<td width='5%'><font size='2' face='Tahoma'>Mostrar2</td>";
		echo "<td width='5%'><font size='2' face='Tahoma'>Id</td>";
		echo "<td width='9%'><font size='2' face='Tahoma'>Fecha</td>";
		echo "<td width='35%'><font size='2' face='Tahoma'>Encabezado</td>";
		echo "<td width='35%'><font size='2' face='Tahoma'>Pie</td>";
		echo "</tr>";
		$rn=0;
		foreach ($x_array as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}

    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['publicar']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['mostrar']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['mostrar2']))."</font></td>";
			$url = 'adm_boletines_edit_form.php?id_boletin='.($row['id_boletin']);
	        $title =  $row['id_boletin'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['fecha']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['encabezado']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['pie']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
	echo "<a href='adm_boletines_insert_form.php'>Agregar un Boletin</a><br />";
	echo "<a href='admin.php'>Menú Administración</a><br />";
}
//------------------------------------------------------------------------
function display_adm_ejemplares($x_array)
{
	if (!is_array($x_array))
	{
		echo '<p>No hay Ejemplares</p>';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Publicar</td>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Id</td>";
		echo "<td width='20%'><font size='2' face='Tahoma'>Fecha</td>";
		echo "<td width='30%'><font size='2' face='Tahoma'>Leyenda</td>";
		echo "<td width='30%'><font size='2' face='Tahoma'>Escritor</td>";
		echo "</tr>";
		$rn=0;
		foreach ($x_array as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}

    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['publicar']))."</font></td>";
			$url = 'adm_ejemplares_edit_form.php?id_ejemplar='.($row['id_ejemplar']);
	        $title =  $row['id_ejemplar'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['fecha']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['leyenda']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['nombre']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
	echo "<a href='adm_ejemplares_insert_form.php'>Agregar un Ejemplar</a><br />";
	echo "<a href='admin.php'>Menú Administración</a><br />";
}
//------------------------------------------------------------------------
function display_adm_escritores($escritores_array)
{
	if (!is_array($escritores_array))
	{
		echo 'No hay Escritores<br />';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Id</td>";
		echo "<td width='20%'><font size='2' face='Tahoma'>UserName</td>";
		echo "<td width='20%'><font size='2' face='Tahoma'>Nombre</td>";
		echo "<td width='20%'><font size='2' face='Tahoma'>email</td>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Habilitado</td>";
		echo "<td width='20%'><font size='2' face='Tahoma'>Observ</td>";
		echo "</tr>";
		$rn=0;
		foreach ($escritores_array as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}

			$url = 'adm_escritores_edit_form.php?id_escritor='.($row['id_escritor']);
	        $title =  $row['id_escritor'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['username']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['nombre']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['email']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['habilitado']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['observaciones']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
	echo "<a href='adm_escritores_insert_form.php'>Agregar un Escritor</a><br />";
	echo "<a href='admin.php'>Menú Administración</a><br />";
}




//--------------------------------------------------------------------------
function display_escritores_form($escritor = '')
{
  $edit = is_array($escritor);
?>
  <form method=post
        action="<?php echo $edit?'adm_escritores_edit.php':'adm_escritores_insert.php';?>">
  <table border=0>
  <tr>
    <td>UserName:</td>
    <td><input type=text name=username size='20'
         value="<?php echo $edit?$escritor['username']:''; ?>"></td>
  </tr>
  <tr>
    <td>Password:</td>
    <td><input type=text name=password size='20'
         value="<?php echo $edit?$escritor['password']:''; ?>"></td>
  </tr>
  <tr>
    <td>Nombre:</td>
    <td><input type=text name=nombre size='50'
         value="<?php echo $edit?$escritor['nombre']:''; ?>"></td>
  </tr>
  <tr>
    <td>email:</td>
    <td><input type=text name=email size='50'
         value="<?php echo $edit?$escritor['email']:''; ?>"></td>
  </tr>
  <tr>
    <td>Web:</td>
    <td><input type=text name=web size='50'
         value="<?php echo $edit?$escritor['web']:''; ?>"></td>
  </tr>
  <tr>
  	<td>Habilitado:</td>
    <td><select name=habilitado>
      <?php
          $hab_array=get_habilitado();
          foreach ($hab_array as $this_hab)
          {
               echo '<option value="';
               echo $this_hab['id'];
               echo '"';
               if ($edit && $this_hab['id'] == $escritor['habilitado'])
                   echo ' selected';
               echo '>'; 
               echo $this_hab['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
  <tr>
  	<td>Editor:</td>
    <td><select name=editor>
      <?php
          $edi_array=get_editor();
          foreach ($edi_array as $this_edi)
          {
               echo '<option value="';
               echo $this_edi['id'];
               echo '"';
               if ($edit && $this_edi['id'] == $escritor['editor'])
                   echo ' selected';
               echo '>'; 
               echo $this_edi['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>
  <tr>
  	<td>Administrador:</td>
    <td><select name=administrador>
      <?php
          $adm_array=get_administrador();
          foreach ($adm_array as $this_adm)
          {
               echo '<option value="';
               echo $this_adm['id'];
               echo '"';
               if ($edit && $this_adm['id'] == $escritor['administrador'])
                   echo ' selected';
               echo '>'; 
               echo $this_adm['descripcion'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   	</tr>

   	<tr>
    	<td>Observaciones:</td>
     	<td><textarea rows=4 cols=50 name=observaciones><?php echo $edit?$escritor['observaciones']:''; ?></textarea></td>
    </tr>

    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldid_escritor 
                    value="'.$escritor['id_escritor'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Escritor">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_escritores_delete.php">';
             echo '<input type=hidden name=id_escritor 
                    value="'.$escritor['id_escritor'].'">';
             echo '<input type=submit 
                    value="Eliminar Escritor">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
//--------------------------------------------------------------------------
function display_tipos_form($tipo = '')
{
  $edit = is_array($tipo);
?>
  <form method=post
        action="<?php echo $edit?'adm_edit_tipos.php':'adm_insert_tipos.php';?>">
  <table border=0>
  <tr>
    <td>Descripcion:</td>
    <td><input type=text name=descripcion 
         value="<?php echo $edit?$tipo['descripcion']:''; ?>"></td>
  </tr>
    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldidtipo
                    value="'.$tipo['idtipo'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Update':'Add'; ?> Tipo">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_delete_tipos.php">';
             echo '<input type=hidden name=idtipo 
                    value="'.$tipo['idtipo'].'">';
             echo '<input type=submit 
                    value="Eliminar Tipo">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
//--------------------------------------------------------------------------
function display_tipeventos_form($t = '')
{
  $edit = is_array($t);
?>
  <form method=post
        action="<?php echo $edit?'adm_tipeventos_edit.php':'adm_tipeventos_insert.php';?>">
  <table border=0>
  <tr>
    <td>Descripcion:</td>
    <td><input type=text name=descripcion 
         value="<?php echo $edit?$t['descripcion']:''; ?>"></td>
  </tr>
    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldid_tipevento
                    value="'.$t['ID_TipEvento'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Tipo de Evento">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_tipeventos_delete.php">';
             echo '<input type=hidden name=id_tipevento 
                    value="'.$t['ID_TipEvento'].'">';
             echo '<input type=submit 
                    value="Eliminar Tipo de Evento">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
//------------------------------------------------------------------------
function display_adm_empresas($x_array) //05/11/04
{
	if (!is_array($x_array))
	{
		echo 'No hay Empresas<br />';
  	}
  	else
  	{
		echo "<table width='100%' border='1' cellspacing='1' cellpadding='1'>";
	  	echo "<tr bgcolor='#66FFCC'>";
		echo "<td width='10%'><font size='2' face='Tahoma'>Id</td>";
		echo "<td width='25%'><font size='2' face='Tahoma'>Razon</td>";
		echo "<td width='25%'><font size='2' face='Tahoma'>Domicilio</td>";
		echo "<td width='25%'><font size='2' face='Tahoma'>Telefono</td>";
		echo "<td width='25%'><font size='2' face='Tahoma'>email</td>";
		echo "</tr>";
		$rn=0;
		foreach ($x_array as $row)
		{
			if ($rn==0)
			{
				echo "<tr bgcolor='#EEEEEE'>"; //'#003399'
				$rn=1;
			}
			else
			{
				echo "<tr bgcolor='#E0E0E0'>";
				$rn=0;
			}

			$url = 'adm_empresas_edit_form.php?id_empresa='.($row['id_empresa']);
	        $title =  $row['id_empresa'];
    		echo "<td><font size='2' face='Tahoma'>";
			do_html_url($url, $title,'');
			echo "</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['razon']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['domicilio']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['telefono']))."</font></td>";
    		echo "<td><font size='2' face='Tahoma'>".htmlspecialchars(stripcslashes($row['email']))."</font></td>";
    		echo "</tr>";
  		}    
  		echo '</table>';
	}
  	echo '<hr />';
	echo "<a href='adm_empresas_insert_form.php'>Agregar una Empresa</a><br />";
	echo "<a href='admin.php'>Menú Administración</a><br />";
}
//--------------------------------------------------------------------------
function display_empresas_form($x = '') //05/12/04
{
  $edit = is_array($x);
?>
  <form method=post
        action="<?php echo $edit?'adm_empresas_edit.php':'adm_empresas_insert.php';?>">
  <table border=0>
  <tr>
    <td>Razon:</td>
    <td><input type=text name=razon size='30' maxlength='50'
         value="<?php echo $edit?$x['razon']:''; ?>"></td>
  </tr>
  <tr>
    <td>Domicilio:</td>
    <td><input type=text name=domicilio size='30' maxlength='50'
         value="<?php echo $edit?$x['domicilio']:''; ?>"></td>
  </tr>
  <tr>
    <td>CUIT:</td>
    <td><input type=text name=cuit size='15'
         value="<?php echo $edit?$x['cuit']:''; ?>"></td>
  </tr>
  <tr>
    <td>CodPos:</td>
    <td><input type=text name=codpos size='8'
         value="<?php echo $edit?$x['codpos']:''; ?>"></td>
  </tr>
  <tr>
    <td>Localidad:</td>
    <td><input type=text name=localidad size='30' maxlength='50'
         value="<?php echo $edit?$x['localidad']:''; ?>"></td>
  </tr>
  <tr>
    <td>Provincia:</td>
    <td><input type=text name=provincia size='30' maxlength='50'
         value="<?php echo $edit?$x['provincia']:''; ?>"></td>
  </tr>
  <tr>
    <td>Telefono:</td>
    <td><input type=text name=telefono size='20'
         value="<?php echo $edit?$x['telefono']:''; ?>"></td>
  </tr>
  <tr>
    <td>Fax:</td>
    <td><input type=text name=fax size='20'
         value="<?php echo $edit?$x['fax']:''; ?>"></td>
  </tr>
  <tr>
  <td>email:</td>
    <td><input type=text name=email size='30' maxlength='70'
         value="<?php echo $edit?$x['email']:''; ?>"></td>
  </tr>
  <td>WEB:</td>
    <td><input type=text name=web size='30' maxlength='70'
         value="<?php echo $edit?$x['web']:''; ?>"></td>
  </tr>
  <td>UserName:</td>
    <td><input type=text name=username size='20'
         value="<?php echo $edit?$x['username']:''; ?>"></td>
  </tr>
  <td>Password:</td>
    <td><input type=text name=password size='20'
         value="<?php echo $edit?$x['password']:''; ?>"></td>
  </tr>
   	<tr>
    	<td>Observaciones:</td>
     	<td><textarea rows=4 cols=50 name=observ><?php echo $edit?$x['observ']:''; ?></textarea></td>
    </tr>

    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align=center>
         <?php 
            if ($edit)
				{
             	echo '<input type=hidden name=oldid_empresa
                    value="'.$x['id_empresa'].'">';
				}
         ?>
        <input type=submit
               value="<?php echo $edit?'Modificar':'Agregar'; ?> Empresa">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method=post action="adm_empresas_delete.php">';
             echo '<input type=hidden name=id_empresa 
                    value="'.$x['id_empresa'].'">';
             echo '<input type=submit 
                    value="Eliminar Empresa">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}
?>



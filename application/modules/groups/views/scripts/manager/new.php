<?php

echo '<h1>' . $this->PAGE->label . '</h1>';
echo '<center>';
echo '<form method="post" action="" accept-charset="utf-8">';
echo '<input type="hidden" name="return" value="' . $this->lastPage() . '" />';
echo '<table>';
echo '<tr>';
echo '<td><b>Nombre/Numero de grupo (*):</b></td>';
echo '<td><input type="text" name="label" value="' . $this->group->label . '" maxlength="64" /></td>';
echo '</tr>';
echo '<tr>';
echo '<td><b>Docente (*):</b></td>';
echo '<td>' . $this->teacher('teacher', $this->group->teacher, $this->subject) . '</td>';
echo '</tr>';
echo '<tr>';
echo '<td><b>Metodo de evaluación (*):</b></td>';
echo '<td>' . $this->evaluation('evaluation', $this->group->evaluation) . '</td>';
echo '</tr>';
echo '<tr>';
echo '<td colspan="2"><b>Descripción :</b></td>';
echo '</tr>';
echo '<tr>';
echo '<td colspan="2">';
echo '<textarea name="description" cols="50" rows="5">' . $this->group->description . '</textarea>';
echo '</td>';
echo '</tr>';
echo '<tr>';
echo '<td colspan="2">(*) Campos obligatorios.</td>';
echo '</tr>';
echo '<tr>';
echo '<td>&nbsp;</td>';
echo '<td>';
echo '<input type="submit" value="Crear grupo" />';
echo '<a href="' . $this->lastPage() . '">Cancelar</a>';
echo '</td>';
echo '</tr>';
echo '</table>';
echo '</form>';
echo '</center>';
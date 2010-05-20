<h1>Administrador de materias</h1>
<i><b>Gestion: </b><?= $this->utf2html($this->gestion->label) ?></i>

<form method="post" action="#">
    <input type="hidden" name="return" value="<?= $this->currentPage() ?>" />
    <table>
        <tr>
        <?php if (Yeah_Acl::hasPermission('subjects', 'list')) { ?>
            <td><input type="button" value="Lista" onclick="location.href='<?= $this->url(array(), 'subjects_list') ?>'" /></td>
        <?php } ?>
        <?php if (Yeah_Acl::hasPermission('subjects', 'new')) { ?>
            <td><input type="button" value="Nuevo" onclick="location.href='<?= $this->url(array(), 'subjects_new') ?>'" /></td>
        <?php } ?>
        <?php if (Yeah_Acl::hasPermission('subjects', 'lock')) { ?>
            <td><input type="submit" name="unlock" value="Activar" /></td>
            <td><input type="submit" name="lock" value="Desactivar" /></td>
        <?php } ?>
        <?php if (Yeah_Acl::hasPermission('subjects', 'delete')) { ?>
            <td><input type="submit" name="delete" value="Eliminar" /></td>
        <?php } ?>
        <?php if (Yeah_Acl::hasPermission('subjects', 'import')) { ?>
            <td><input type="button" value="Importar" onclick="location.href='<?= $this->url(array(), 'subjects_import') ?>'" /></td>
        <?php } ?>
        <?php if (Yeah_Acl::hasPermission('subjects', 'export')) { ?>
            <td><input type="button" value="Exportar" onclick="location.href='<?= $this->url(array(), 'subjects_export') ?>'" /></td>
        <?php } ?>
        </tr>
    </table>

    <hr />
<?php if (count($this->subjects)) { ?>
    <center>
        <table width="100%">
            <tr>
                <th>&nbsp;</th>
                <th><?= $this->utf2html($this->model->_mapping['code']) ?></th>
                <th><?= $this->utf2html($this->model->_mapping['label']) ?></th>
                <th>Opciones</th>
                <th><?= $this->utf2html($this->model->_mapping['tsregister']) ?></th>
            </tr>
        <?php foreach ($this->subjects as $subject) { ?>
            <tr>
                <td>
                <?php if (Yeah_Acl::hasPermission('subjects', array('lock', 'delete'))) { ?>
                    <input type="checkbox" name="check[]" value="<?= $subject->ident ?>" />
                <?php } ?>
                </td>
                <td><center><?= $subject->code ?></center></td>
                <td><?= $this->utf2html($subject->label) ?></td>
                <td>
                <?php if (Yeah_Acl::hasPermission('subjects', 'view')) { ?>
                        <a href="<?= $this->url(array('subject' => $subject->url), 'subjects_subject_view') ?>">Ver</a>
                <?php } ?>
                <?php if (Yeah_Acl::hasPermission('subjects', 'edit')) { ?>
                        <a href="<?= $this->url(array('subject' => $subject->url), 'subjects_subject_edit') ?>">Editar</a>
                <?php } ?>
                <?php if (Yeah_Acl::hasPermission('subjects', 'lock')) { ?>
                    <?php if ($subject->status == 'inactive') { ?>
                        <a href="<?= $this->url(array('subject' => $subject->url), 'subjects_subject_unlock') ?>">Activar</a>
                    <?php } else { ?>
                        <a href="<?= $this->url(array('subject' => $subject->url), 'subjects_subject_lock') ?>">Desactivar</a>
                    <?php } ?>
                <?php } ?>
                <?php if (Yeah_Acl::hasPermission('subjects', 'delete')) { ?>
                    <?php if ($subject->isEmpty()) { ?>
                        <a href="<?= $this->url(array('subject' => $subject->url), 'subjects_subject_delete') ?>">Eliminar</a>
                    <?php } ?>
                <?php } ?>
                </td>
                <td><center><?= $this->timestamp($subject->tsregister) ?></center></td>
            </tr>
        <?php } ?>
        </table>
    </center>
<?php } else { ?>
    <p>No existen materias registradas en la gesti&oacute;n</p>
<?php } ?>
    <hr />

    <table>
        <tr>
        <?php if (Yeah_Acl::hasPermission('subjects', 'list')) { ?>
            <td><input type="button" value="Lista" onclick="location.href='<?= $this->url(array(), 'subjects_list') ?>'" /></td>
        <?php } ?>
        <?php if (Yeah_Acl::hasPermission('subjects', 'new')) { ?>
            <td><input type="button" value="Nuevo" onclick="location.href='<?= $this->url(array(), 'subjects_new') ?>'" /></td>
        <?php } ?>
        <?php if (Yeah_Acl::hasPermission('subjects', 'lock')) { ?>
            <td><input type="submit" name="unlock" value="Activar" /></td>
            <td><input type="submit" name="lock" value="Desactivar" /></td>
        <?php } ?>
        <?php if (Yeah_Acl::hasPermission('subjects', 'delete')) { ?>
            <td><input type="submit" name="delete" value="Eliminar" /></td>
        <?php } ?>
        <?php if (Yeah_Acl::hasPermission('subjects', 'import')) { ?>
            <td><input type="button" value="Importar" onclick="location.href='<?= $this->url(array(), 'subjects_import') ?>'" /></td>
        <?php } ?>
        <?php if (Yeah_Acl::hasPermission('subjects', 'export')) { ?>
            <td><input type="button" value="Exportar" onclick="location.href='<?= $this->url(array(), 'subjects_export') ?>'" /></td>
        <?php } ?>
        </tr>
    </table>
</form>

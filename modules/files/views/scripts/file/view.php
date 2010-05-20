<h1>Archivo
<?php if ($this->resource->amAuthor()) { ?>
	<i><a href="<?= $this->url(array('file' => $this->resource->ident), 'files_file_edit') ?>">[Editar]</a></i>
<?php } ?>
</h1>
<b>Autor: </b><i>
<?php if (Yeah_Acl::hasPermission('users', 'view')) { ?>
	<a href="<?= $this->url(array('user' => $this->resource->getAuthor()->url), 'users_user_view') ?>"><?= $this->resource->getAuthor()->label ?></a>
<?php } else { ?>
	<?= $this->resource->getAuthor()->label ?>
<?php } ?>
</i>
<br/>
<b>Fecha: </b><i><?= $this->timestamp($this->resource->tsregister) ?></i>

<p><?= $this->utf2html($this->file->description) ?></p>
<?= $this->mime($this->file->mime) ?>&nbsp;
<a href="<?= $this->url(array('file' => $this->file->resource), 'files_file_download') ?>"><?= $this->utf2html($this->file->filename) ?></a>
&nbsp;<?= $this->size($this->file->size) ?>


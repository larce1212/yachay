<h1>Editar <?= ($this->note->priority) ? 'aviso' : 'nota' ?></h1>

<center>
    <form method="post" action="" accept-charset="utf-8">
        <input type="hidden" name="return" value="<?= $this->lastPage() ?>" />
        <table>
            <tr>
                <td colspan="2"><b>Mensaje (*):</b></td>
            </tr>
            <tr>
                <td colspan="2">
                    <textarea name="message"><?= $this->note->note ?></textarea>
                </td>
            </tr>
            <tr>
                <td><b>Convertir en Aviso</b></td>
                <td><input type="checkbox" name="priority" <?= ($this->note->priority) ? 'checked="checked"' : '' ?>/>
            </tr>
            <tr>
                <td colspan="2">(*) Campos obligatorios.</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="submit" value="Guardar nota" />
                    <a href="<?= $this->lastPage() ?>">Cancelar</a>
                </td>
            </tr>
        </table>
    </form>
</center>


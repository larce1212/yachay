<h1>Nueva gestion</h1>

<center>
    <form method="post" action="#">
        <input type="hidden" name="return" value="<?= $this->lastPage() ?>" />
        <table>
            <tr>
                <td><b>Gestion (*):</b></td>
                <td>
                    <input type="text" name="label" size="15" maxlength="64" value="<?= $this->utf2html($this->gestion->label) ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="2">(*) Campos obligatorios.</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="submit" value="Crear gestion" />
                    <input type="button" value="Cancelar" onclick="location.href='<?= $this->lastPage() ?>'" />
                </td>
            </tr>
        </table>
    </form>
</center>

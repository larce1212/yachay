<?php

class Yeah_Helpers_None
{
    public function none($val = 0) {
        return empty($val) ? 'No definido' : $val;
    }
}

<?php
echo Form::open($action, array('method' => 'post'));
echo Form::hidden('hddId', (isset($objData) ? $objData->id : ''));
echo 'Nome: ';
echo Form::input('txtName', (isset($objData) ? $objData->name : ''));
echo '<br/>';
echo 'Descrição: ';
echo Form::input('txtDescription', (isset($objData) ? $objData->description : ''));
echo '<br />';
echo Form::submit('btnSalvar', 'Salvar');
echo Form::close();
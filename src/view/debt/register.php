<html>
<?php

use framework\utils\Utils;
use src\model\debtor\Debtor;

include_once 'src/view/home/header.php';

?>
<link rel="stylesheet" href="<?php Utils::importCss('debt', 'debt'); ?>" crossorigin="anonymous">
<link rel="stylesheet" href="<?php Utils::importCss('jquery-ui'); ?>" crossorigin="anonymous">
<body>
<?php include_once 'src/view/home/menu.php'; ?>
<div>
    <form class="needs-validation" novalidate action="save" id="form-debt" method="post">
        <div class="col-md-6 offset-md-3" style="margin-top: 10px">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="debtor_id">Devedor</label><span> *</span>
                    <select class="form-control" name="debtor_id" id="debtor_id">
                        <option>Selecione um devedor</option>
                        <?php
                        /** @var Debtor $oDebtor */
                        foreach ($loDebtor as $oDebtor) {
                                echo "<option value={$oDebtor->getId()}>{$oDebtor->getName()}</option>";
                            }
                        ?>
                    </select>
<!--                    <input type="text" required placeholder="digite o nome do devedor">-->
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">O devedor é obrigatório</div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="amount">Valor</label><span> *</span>
                    <input type="text" onkeyup="formatValue()" class="form-control" name="amount" id="amount" placeholder="somente números"
                           required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Valor do título é obrigatório</div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="due_date">Data de validade</label><span> *</span>
                    <input type="text" class="form-control" name="due_date" id="due_date" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Data de validade é obrigatória</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="description">Descrição</label><span> *</span>
                    <textarea class="form-control" name="description" id="description" required></textarea>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Descrição é obrigatória</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-5 mb-3">
                    <label for="status">Status</label><span> *</span><br>
                    <input type="radio" class="status" name="status" id="active" value="1" required>Paga
                    <input type="radio" class="status" name="status" id="inactive" value="0" required checked>Em aberto
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">O status é obrigatório</div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Cadastrar</button>
        </div>
    </form>
</div>
<div id="status-msg" class="col-md-6 offset-md-3" style=""></div>
</body>
<?php include_once 'src/view/home/footer.php'; ?>
<script src="<?php Utils::importJs('debt', 'debt'); ?>"></script>
<script src="<?php Utils::importJs('jquery-ui'); ?>"></script>
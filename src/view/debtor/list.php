<html>
<?php

use framework\utils\Utils;
use src\model\debtor\Debtor;
use src\model\debtor\DebtorList;

include_once 'src/view/home/header.php';
?>
<link rel="stylesheet" href="<?php Utils::importCss('debtor', 'debtor'); ?>" crossorigin="anonymous">
<link rel="stylesheet" href="<?php Utils::importCss('fontawesome/css/all.min'); ?>" crossorigin="anonymous">
<body>
<?php include_once 'src/view/home/menu.php'; ?>
<div class="container">
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">CPF/CNPJ</th>
            <th scope="col">Telefone</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php
        /** @var DebtorList $loDebtor */
        if ($loDebtor->count() > 0) {
            /** @var Debtor $oDebtor */
            foreach ($loDebtor as $oDebtor) {
                $sCpfCnpj = Utils::addMaskCpfCnpj($oDebtor->getCpfCnpj());
                $sPhone = Utils::addMaskPhoneNumber($oDebtor->getPhoneNumber());
                echo "<div><tr>";
                echo "<th scope=\"row\">{$oDebtor->getId()}</th>";
                echo "<td class='name'>{$oDebtor->getName()}</td>";
                echo "<td>{$oDebtor->getEmail()}</td>";
                echo "<td>{$sCpfCnpj}</td>";
                echo "<td>{$sPhone}</td>";
                echo "<td><a href=''><i title='Adicionar dívida' class='fa fa-plus' id='add_debt'></i></a>";
                echo "<span style='color: white'> * </span>";
                echo "<a href=''><i title='Editar devedor' class='fa fa-edit' id='debtor_edit'></i></a>";
                echo "<span style='color: white'> * </span>";
                echo "<a href=''><i class='fa fa-trash' id='debtor_delete'></i></a></td>";
                echo "</tr></div>";
            }
        } else { ?>
        </tbody>
    </table>
</div>
<?php
echo "<div class='msg-empty'>Não existe nenhum devedor cadastrado.</div> "; }
?>
</body>
<?php include_once 'src/view/home/footer.php'; ?>
</html>
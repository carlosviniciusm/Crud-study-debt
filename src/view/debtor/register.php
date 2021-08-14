<html>
<?php
use framework\utils\Utils;
include_once 'src/view/home/header.php';
?>
<body>
<?php include_once 'src/view/home/menu.php';?>
<div id="div-form">
    <form class="needs-validation" novalidate action="save" id="form-debtor" method="post">
        <div class="col-md-6 offset-md-3" style="margin-top: 10px">
        <h2 style="text-align: center">Cadastro de Devedor</h2>
            <div class="form-row">
                <div class="col-md-7 mb-3">
                    <label for="name">Nome</label><span> *</span>
                    <input type="text" class="form-control" name="name" id="name" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Nome é obrigatório</div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="cpf_cnpj">CPF/CNPJ</label><span> *</span>
                    <input type="text" class="form-control" name="cpf_cnpj" id="cpf_cnpj" placeholder="somente números" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback cpf_cnpj">CPF/CNPJ é obrigatório</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="email">E-mail</label><span> *</span>
                    <input type="text" class="form-control" name="email" id="email" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">E-mail é obrigatório</div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="birthdate">Data de nascimento</label><span> *</span>
                    <input type="text" class="form-control" name="birthdate" id="birthdate" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Data de nascimento é obrigatória</div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="phone_number">Telefone</label><span> *</span>
                    <input type="text" class="form-control" name="phone_number" id="phone_number" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Telefone é obrigatório</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="zipcode">CEP</label><span> *</span>
                    <input maxlength="10" type="text" class="form-control" name="zipcode" id="zipcode" placeholder="somente números" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">CEP é obrigatório</div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="address">Logradouro</label><span> *</span>
                    <input type="text" class="form-control" id="address" name="address" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Logradouro é obrigatório</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="complement">Complemento</label>
                    <input type="text" class="form-control" name="complement" id="complement">
                </div>
                <div class="col-md-2 mb-3">
                    <label for="number">Número</label><span> *</span>
                    <input type="text" class="form-control" name="number" id="number" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Número é obrigatório</div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="neighborhood">Bairro</label><span> *</span>
                    <input type="text" class="form-control" id="neighborhood" name="neighborhood" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Cidade é obrigatório</div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="city">Cidade</label><span> *</span>
                    <input type="text" class="form-control" id="city" name="city" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Cidade é obrigatório</div>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="state">UF</label><span> *</span>
                    <input maxlength="2" type="text" class="form-control" id="state" name="state" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">UF é obrigatório</div>
                </div>

            </div>
            <button class="btn btn-primary" id="save" type="submit">Cadastrar</button>
        </div>
    </form>
</div>
<div id="status-msg" class="col-md-6 offset-md-3" style=""></div>

</body>
<?php include_once 'src/view/home/footer.php';?>
<script src="<?php Utils::importJs('debtor', 'debtor'); ?>"></script>
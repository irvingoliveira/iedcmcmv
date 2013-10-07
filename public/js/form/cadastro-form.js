$(document).ready(function() {
    $('#cadastro-form').validate();

    /*
     * Validação Fieldset Titular
     */

    $('input[type=text]').blur(function() {
        $(this).val($(this).val().toUpperCase());
    });

    $("#titularNome").rules("add", {
        
        required: true,
        minlength: 3,
        maxLength: 200,
        
        messages: {
            required: "O nome do Titular é obrigatório.",
            minlength: "O nome do Titular deve haver no mínimo três caracteres.",
            maxLength: "O nome do Titular deve haver no máximo duzentos caracteres."

        }
    });


    $("#titularCpf").mask('000.000.000-00')
            .rules("add", {
        required: true,
        minlength: 14,
        maxLength: 14,
        messages: {
            required: "O CPF do Titular é obrigatório.",
            minlength: "O CPF do Titular não é valido.",
            maxLength: "O CPF do Titular não é valido."

        }
    });


    $("#titularDataNascimento").mask('00/00/0000').rules("add", {
        required: true,
        minlength: 10,
        maxLength: 10,
        messages: {
            required: "A data de nascimento do Titular é obrigatório.",
            minlength: "A data de nascimento do Titular não é valida.",
            maxLength: "A data de nascimento do Titular não é valida."

        }
    });


    $("#titularDeficienteFisico").rules("add", {
        required: true,
        messages: {
            required: "É necessário informar se possui deficiência física"

        }
    });


    $("#titularDataInscricao").rules("add", {
        required: true,
        minlength: 10,
        maxLength: 10,
        messages: {
            required: "A data de inscrição é obrigatório.",
            minlength: "A data de inscrição não é valida.",
            maxLength: "A data de inscrição não é valida."

        }
    });


    $("#titularNis").mask('0000000000-0').rules("add", {
        required: false,
        minlength: 12,
        maxLength: 12,
        messages: {
            minlength: "O NIS do titular não é valido.",
            maxLength: "O NIS do titular não é valido."

        }
    });


    $("#titularRenda").mask("#.##0,00", {reverse: true, maxlength: false}).rules("add", {
        required: true,
        minlength: 01,
        maxLength: 10,
        messages: {
            required: "A renda do titular é obrigatório.",
            minlength: "O NIS do titular não é valido.",
            maxLength: "O NIS do titular não é valido."

        }
    });


    /*
     * Validação Fieldset conjuge
     */


    $("#conjugeNome").rules("add", {
        required: true,
        minlength: 3,
        maxLength: 200,
        messages: {
            required: "O nome do Titular é obrigatório.",
            minlength: "O nome do Titular deve haver no mínimo três caracteres.",
            maxLength: "O nome do Titular deve haver no máximo duzentos caracteres."

        }
    });


    $("#conjugeCpf").mask('000.000.000-00').rules("add", {
        required: true,
        minlength: 14,
        maxLength: 14,
        messages: {
            required: "O CPF do Titular é obrigatório.",
            minlength: "O CPF do Titular não é valido.",
            maxLength: "O CPF do Titular não é valido."

        }
    });


    $("#conjugeDataNascimento").mask('00/00/0000').rules("add", {
        required: true,
        minlength: 10,
        maxLength: 10,
        messages: {
            required: "A data de nascimento do Titular é obrigatório.",
            minlength: "A data de nascimento do Titular não é valida.",
            maxLength: "A data de nascimento do Titular não é valida."

        }
    });


    $("#conjugeDeficienteFisico").rules("add", {
        required: true,
        messages: {
            required: "É necessário informar se possui deficiência física"

        }
    });


    $("#conjugeNis").mask('0000000000-0').rules("add", {
        required: false,
        minlength: 12,
        maxLength: 12,
        messages: {
            minlength: "O NIS do titular não é valido.",
            maxLength: "O NIS do titular não é valido."

        }
    });


    $("#conjugeRenda").mask("#.##0,00", {reverse: true, maxlength: false}).rules("add", {
        required: true,
        minlength: 10,
        maxLength: 10,
        messages: {
            required: "A renda do titular é obrigatório.",
            minlength: "O NIS do titular não é valido.",
            maxLength: "O NIS do titular não é valido."

        }
    });


    /*
     * Validação Fieldset Identidade Titular
     */

    $("#identidadeTitularNumero").rules("add", {
        required: true,
        minlength: 09,
        maxLength: 15,
        messages: {
            required: "A renda do titular é obrigatório.",
            minlength: "numero da identidade não é valido.",
            maxLength: "numero da identidade não é valido."

        }
    });


    $("#identidadeTitularDataEmissao").mask('00/00/0000').rules("add", {
        required: true,
        minlength: 10,
        maxLength: 10,
        messages: {
            required: "A data de emissão da Identidade é obrigatório.",
            minlength: "A data de emissão da Identidade não é valido.",
            maxLength: "A data de emissão da Identidade não é valido."

        }
    });

    $("#identidadeTitularOrgaoEmissor").rules("add", {
        required: true,
        minlength: 05,
        maxLength: 200,
        messages: {
            required: "O orgão emissor da Identidade é obrigatório.",
            minlength: "O orgão emissor da Identidade não é valido.",
            maxLength: "O orgão emissor da Identidade não é valido."

        }
    });


    /*
     * Validação Fieldset Identidade Conjuge
     */

    $("#identidadeConjugeNumero").rules("add", {
        required: false,
        minlength: 12,
        maxLength: 12,
        messages: {
            minlength: "numero da identidade não é valido.",
            maxLength: "numero da identidade não é valido."

        }
    });


    $("#identidadeConjugeDataEmissao").mask('00/00/0000').rules("add", {
        required: false,
        minlength: 10,
        maxLength: 10,
        messages: {
            minlength: "A data de emissão da Identidade não é valido.",
            maxLength: "A data de emissão da Identidade não é valido."

        }
    });

    $("#identidadeConjugeOrgaoEmissor").rules("add", {
        required: false,
        minlength: 05,
        maxLength: 200,
        messages: {
            minlength: "O orgão emissor da Identidade não é valido.",
            maxLength: "O orgão emissor da Identidade não é valido."

        }
    });


    /*
     * Validação Fieldset endereço
     */

    $("#enderecoTipoLogradouro").rules("add", {
        required: true,
        messages: {
            required: "Informe o tipo de logradouro."

        }
    });


    $("#enderecoNomeLogradouro").rules("add", {
        required: true,
        minlength: 02,
        maxlength: 200,
        messages: {
            required: "Informe o tipo de logradouro.",
            minlength: "O nome do logradouro não é valido.",
            maxlength: "O nome do logradouro não é valido."
        }
    });

    $("#enderecoNumero").mask('#', {maxlength: false}).rules("add", {
        required: true,
        minlength: 01,
        maxlength: 05,        
        messages: {
            required: "Informe o numero.",
            minlength: "O número não é valido.",
            maxlength: "O número não é valido."            
        }
    });


    $("#enderecoComplemento").rules("add", {
        required: false,
        minlength: 05,
        maxlength: 200,
        messages: {
            minlength: "O complemento do logradouro não é valido.",
            maxlength: "O complemento do logradouro não é valido."
        }
    });


    $("#enderecoBairro").rules("add", {
        required: true,
        minlength: 03,
        maxlength: 200,
        messages: {
            required: "Informe o bairro.",
            minlength: "O bairro não é valido.",
            maxlength: "O bairro não é valido."
        }
    });


    $("#enderecoComunidade").rules("add", {
        required: false,
        minlength: 03,
        maxlength: 200,
        messages: {
            minlength: "A comunidade não é valida.",
            maxlength: "A comunidade não é valida."
        }
    });


    $("#distritoNome").rules("add", {
        required: true,
        messages: {
            required: "Informe o distrito."
        }
    });


    $("#enderecoCep").mask('00000-000').rules("add", {
        required: true,
        minlength: 09,
        maxlength: 09,
        messages: {
            required: "Informe o CEP.",
            minlength: "O CEP não é valido.",
            maxlength: "O CEP não é valido."
        }
    });


    $("#enderecoAreaDeRisco").rules("add", {
        required: true,
        messages: {
            required: "Informe se é área de risco."
        }
    });


    /*
     * Validação Fieldset Dependente
     */


    $("#dependenteNome").rules("add", {
        required: true,
        minlength: 3,
        maxLength: 200,
        messages: {
            required: "O nome do Dependente é obrigatório.",
            minlength: "O nome do Dependente deve haver no mínimo três caracteres.",
            maxLength: "O nome do Dependente deve haver no máximo duzentos caracteres."

        }
    });


    $("#dependenteCpf").rules("add", {
        required: true,
        minlength: 14,
        maxLength: 14,
        messages: {
            required: "O CPF do Dependente é obrigatório.",
            minlength: "O CPF do Dependente não é valido.",
            maxLength: "O CPF do Dependente não é valido."

        }
    });


    $("#dependenteGrauDeParentesco").rules("add", {
        required: true,
        messages: {
            required: "Iforme o grau de parentesco do dependente."
        }
    });


    $("#dependenteDataNascimento").rules("add", {
        required: true,
        minlength: 10,
        maxLength: 10,
        messages: {
            required: "A data de nascimento do Dependente é obrigatório.",
            minlength: "A data de nascimento do Dependente não é valida.",
            maxLength: "A data de nascimento do Dependente não é valida."

        }
    });


    $("#dependenteDeficienteFisico").rules("add", {
        required: true,
        messages: {
            required: "É necessário informar se possui deficiência física"

        }
    });


    $("#dependenteRenda").rules("add", {
        required: true,
        minlength: 01,
        maxLength: 10,
        messages: {
            required: "A renda do titular é obrigatório.",
            minlength: "O NIS do titular não é valido.",
            maxLength: "O NIS do titular não é valido."

        }
    });







});
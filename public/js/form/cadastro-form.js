$(document).ready(function() {

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
    
    
    $("#titularCpf").rules("add", {
        
        required: true,
        minlength: 14,
        maxLength: 14,
        
        messages: {
            
           required: "O CPF do Titular é obrigatório.",
           minlength: "O CPF do Titular não é valido.",
           maxLength: "O CPF do Titular não é valido."
           
        }
    });
    
    
    $("#titularDataNascimento").rules("add", {
        
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
    
    
    $("#titularNis").rules("add", {
        
        minlength: 12,
        maxLength: 12,
        
        messages: {
            
           minlength: "O NIS do titular não é valido.",
           maxLength: "O NIS do titular não é valido."
           
        }
    });
    
    
    $("#titularRenda").rules("add", {
        
        required: true,
        minlength: 10,
        maxLength: 10,
        
        messages: {
           
           required:  "A renda do titular é obrigatório.", 
           minlength: "O NIS do titular não é valido.",
           maxLength: "O NIS do titular não é valido."
           
        }
    });

});
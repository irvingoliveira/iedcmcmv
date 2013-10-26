IEDCMCMV - Interface de Entrada de Dados Cadastrais do Minha Casa Minha Vida
============================================================================

Introdução
------------
Esta é uma aplicação simples, que visa facilitar a vida do cidadão
que pretende se cadastrar no programa minha casa minha vida. Trata-se de 
um formulário simples, que tem por objetivo facilitar a triagem
dos cidadões que podem participar do Minha Casa Minha Vida. Ela foi
desenvolvida para a Secretaria Municipal de Planejamento, Habitação e Urbanismo
de Duque de Caxias - RJ.

Instalação
------------
Você pode usar o GIT para clonar a aplicação:

    git clone https://github.com/irvingoliveira/iedcmcmv.git --recursive

Virtual Host
------------
Após clonar, deve-se criar um Virtual Host apontando para a pasta /public da aplicação.

Alternativamente — se você está usando PHP 5.4 ou mais — você pode iniciar um servidor cli PHP interno no diretório /public:

    cd public
    php -S 0.0.0.0:8080 index.php

Com isso irá iniciar um servidor PHP interno na porta 8080, e será acessível em todas interfaces de rede.

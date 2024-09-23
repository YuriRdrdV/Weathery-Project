# Weathery

Sistema para busca de dados climaticos por região para comparações.

## Instalação

Antes de iniciar a instalação são necessários os seguintes requisitos:

1. **PHP**: Versão 8.2.18 ou superior.
2. **Composer**: Gerenciador de dependências do PHP. Você pode instalá-lo seguindo as instruções em [getcomposer.org](https://getcomposer.org/download/).
3. **Servidor Web**: Apache2.
4. **Banco de Dados**: MySQL.
5. **Git**: Para clonar o repositório.

(Pode ser utilizado o Wamp para as configurações)

Clone o repositório da sua aplicação usando o Git:

git clone https://github.com/YuriRdrdV/Weathery-Project

cd weathery

composer install

cp .env.example .env

adicionar os valores do database e chave para o weatherstack:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
weatherKey=key

php artisan migrate

php artisan serve

## Funcionalidades

- [ ] Login/Registro de usuários
- [ ] Ferramenta de Busca de Clima utilizando API do WeatherStack
- [ ] Mecanismo de Salvamento de buscas para usuários logados

## Tecnologias Utilizadas

- Linguagem: `JavaScript`, `PHP 8.2.18`
- Frameworks: `Laravel 11.9`, `Jquery`
- Banco de Dados: `MySQL`

O projeto se inicia no front onde foi implementada uma interface de acesso geral para realizar as buscas essa interface possui o suporte de JavaScript + Jquery. Estes separados em componentes com responsabilidades individuais tratam o formulário de busca do clima que conversa via AJAX com o backend do laravel para retornar a resposta da API do WeatherStack.
Uma Rota encaminha os dados da requisição para um controller chamado External que realiza a comunicação de fato, o retorno é encaminhado de volta ao AJAX que trata a informação decide o que será apresentado ao usuário, os dados ou uma mensagem explicando um possivel erro.
Ainda na interface um dos componentes ficou responsável por validar o campo de formulário CEP e por meio de outra requisição preencher automaticamente o campo localização (responsável pelo posterior envio para o Controller que se comunica com o WeatherStack).
Ao obter um retorno de sucesso a interface com os dados de clima é construida com uma ação de salvar o dado, este por usa vez encaminha os dados para que sejam salvos com um vinculo de 1N junto ao modelo de USER, ou seja, só é possivel salvar sua busca se você ja for registrado.
Os dados são enviados para uma rota que chama o controller SearchController que utiliza um Service para realizar as ações envolvendo as models e a manipulação do banco separando bem as reponsabilidades de cada parte. O usuário então pode acessar via opções no canto superior direito a tela "minhas buscas" onde pode
visualizar as buscas efetuadas e realizar duas ações, a primeira de remoção utiliza o mesmo service utilizado para Criar pelo mesmo caminho antes comentado, ja a segunda ação é de comparação. A comparação ativa um modal para comparar o registro cuja ação foi acionada com outro registro gravado, selecionando o tipo de comparação desejada. 
Para este dado momento foram implementadas 3 comparações Temperatura, Velocidade do Vento e Humidade. Visando que no futuro possam vir outros tipos de comparação para a regra de negocio foi aplicado o Pattern Strategy ibde criamos uma interface com a função principal (comparação) e implementamos classes novas para cada forma nova de comparar.
Isso permite que a regra de negocio possa sofrer alterações e adições futuras de forma mais organizada e respeitado alguns principios SOLID como Open-closed permitindo a extenção sem modificação e o Single-Responsibility delegando para cada classe implementada a partir da interface sua unica regra de negócio.
O controller referente a comparação valida o tipo de comparação enviado pelo front por uma service que contem os tipos e classes referentes e decide qual implementar devolvendo a classe para que o controller então coloque inicie a regra de negocio presente no metodo de comparação da classe.

![Gif Versão Desktop](https://github.com/YuriRdrdV/Weathery-Project/blob/master/public/gifs/weathery_desktop.gif)
![Gif Versão Mobile](https://github.com/YuriRdrdV/Weathery-Project/blob/master/public/gifs/weathery_mobile.gif)
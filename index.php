<?php
exec("composer install -q");
exec("composer update -q");
require 'vendor/autoload.php';

error_reporting(0);
use App\Controllers\Game;
use App\Resources\IO;

//Monta palavras do letras - Lucas Barbosa
//todas as informações aqui contidas estão dispostas no readme no github.
//https://github.com/lucashbarbosa/monta-palavras#readme
//
//
//
//Classes:
//Controllers/Game - classe game é a interface de controle, que aqui também serve como interface de visualização, já que o programa roda no terminal.
//Resources/App - é a classe que contém a lógica que provê os resultados para a classe Game.
//Resources/IO - extende a Interface IOStream que define métodos de controle de entrada e saída.
//Controllers/HandleWord - Classe estática responsavel por realizar transformações nas palavras, por exemplo: transformar uma palavra em um array e vice versa, encontrar o lixo(caracteres especiais) em uma palavra.
//Model/Punctuation - é a classe responsável por definir a pontuação de cada palavra.
//Model/Word - é classe que gera o objeto palavra com as informações necessárias para realizar as regras do jogo.
//Repository/WordRepository - é uma classe para abstrair os dados, é um mock, porém facilitaria a implementação de um banco de dados.
//
//
//O programa funciona da seguinte maneira.
//
//
//Index.php é chamado pelo autoloader, que instancia a classe "Game", que tem apenas uma interface pública, que é o próprio construtor da Classe, injetando a Classe IO.
//(esse ponto poderia ter um encapsulamento por uma outra classe e outra interface pública para iniciar o jogo em outro momento, mas como o projeto prevê apenas uma funcionalidade optei por fazer o mais simples)
//
//A classe Game seta o objeto IO em uma propriedade de mesmo nome, dá as boas vindas ao usuário e dá inicio ao jogo chamando o método "init";
//Instanciamos a propriedade "nonUsedLetters" que é do tipo ArrayObject, para que possamos adicionar letras não utilizadas durante a execução do programa.
//
//Pegamos jogada do usuário átravés do metodo getUserMove, que valida e limpa o input.
//Solicitamos a inserção da posição bonus, validamos através de regex e a guardamos na sua propriedade.
//verificamos, através do método collectGarbage se alguma caracter especial foi digitado através de Regex e adicionamos os encontrados a propriedade nonUsedLetters.
//
//Então através do método setMatches nós vamos verificar quais palavras foram encontradas.
//isso é feito de forma bastante simplificada, dentro do método é chamado a interface matchWords, injetado o movimento, repositório e posição bonus.
//no método matchWords
//para cada palavra no banco de palavras, limpamos* a palavra vinda do repositório retornado é aplicado um pattern** e caso a palavra faça parte desse pattern, é adicionado ao array matches uma nova instancia de uma palavra passando o valor encontrado.
//Instanciando a palavra - nesse ponto vamos instanciar a palavra e já descobrir todas as informações necessárias para os calculos de posição e valor.
//Ao instanciar uma nova palavra passando o seu nome o construtor da classe word automaticamente realiza os seguintes passos.
//seta o nome da palavra;
//encontra o tamanho da palavra.
//define a pontuação da palavra.
//definindo a puntuação da palavra - aqui, injetamos a palavra, a pontuação das letras contidas no repositório e a posição bonus, o processo é realizado de maneira simples.
//transformamos essa palavra em um array de letras, para cara letra, somamos a pontuação a posição daquela letra no array de letras (repositório).
//aqui também fazemos para cada letra a comparação se aquela posição de letra é a bonus, caso seja aquela posição é multiplicada por 2.
//executamos o método setNonUsedLetters que transforma o array de matches em uma string e através de regex encontramos as letras do input que não fazem parte de nenhuma palavra, guardamos esses caracteres na propriedade nonUsedLetters.
//
//
//definidos as palavras e seus valores, agora precisamos rankear as palavras.
//No método showResult chamamos o método ranking que é populado pelo método getRankedResult (é aqui que a mágica acontece :] )
//pegamos o array de matches e executamos o médodo usort, que compara todas as chaves=>valores de um array, trazendo pra dentro da função anonima as posições sendo comparadas, aqui chamadas de match1 e match2.
//
//passo 1 - verificar utilizando o operador spaceship se há diferença entre as duas pontuações (lembra que já definimos isso quando estanciamos a palavra?) caso retorne 0 quer dizer que é igual, -1 que o primeiro termo é maior e 1 que o segundo termo é maior.
//caso eles sejam do mesmo tamanho, precisamos ir para o segundo critério que é o tamanho da string (já definimos isso no objeto também).
//fazemos a verificação exatamente igual, porém com as posições invertidas, aqui queremos achar a menor palavra.
//Caso retorne 0, indica que o tamanho também é igual, então executamos a função do php strnatcmp(algo compo, comparando duas strings por ordem alfaabética).
//dessa forma conseguimos uma lista rankeada de acordo com os critérios.
//
//Tudo isso é retornado para a classe Ranking onde é só printar na tela as informações, aqui eu adicionei também a propriedade record pra aumentar a gameficação do aplicativo.
//
//então o método init é chamado novamente pronto para reiniciar a partida.
//
//*a limpeza aqui é meramente ilustrativa pois realizei manualmente a remoção de acentuação por conta do charset do linux, decidi fazer isso pela facilidade em um programa que roda em cima de http não haveria esse problema.
//
//** o regex tem a seguinte lógica, seleciona uma ou mais palavras que todas suas letras façam parte da entrada.
//
//ps: eu sei que a arquitetura não está ótima, mas eu nunca fiz um aplicativo pra rodar no terminal então fiquei limitado a algumas coisas e tentei simplificar o máximo possível pra garantir que vai rodar aí na máquina de vocês.


new Game(new IO());
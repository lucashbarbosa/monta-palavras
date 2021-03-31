# Monta Palavras - Letras
## Este é um programa que faz parte do processo de contratação do site letras.com.br

## Requerimentos
Computador com Windows ou Linux, acesso administrador ao CMD.
Docker ou PHP + Composer instalado.

## Download
#### Git
Caso você possua o Github instalado no seu computador execute.
```sh
git clone https://github.com/lucashbarbosa/monta-palavras.git
```
Caso não possua o Github instalado clique [AQUI](https://github.com/lucashbarbosa/monta-palavras/archive/refs/heads/master.zip)

#### Google Drive
Para download direto pelo Google Drive, clique [AQUI](https://github.com/lucashbarbosa/monta-palavras/archive/refs/heads/master.zip)


## Instalação e execução
#
##### PHP + Composer
Caso tenha composer instalado, no cmd, vá até a pasta do arquivo baixado e execute os comandos a seguir

```sh
composer install
php -r index.php
```
##### Docker
Caso tenha o docker instalado na pasta baixada, execute:
```sh
docker build -t app . && docker run -it app
``````



### Como jogar?
- Digite uma série de letras, acentos não são permitidos.
- Digite um número para dobrar o valor da letra naquela posição.
- O jogo irá retornar as palavras mais bem pontuadas em forma de um ranking.


### Autor
Lucas Barbosa

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

O projeto tem por objetivo interagir com o ChatGPT via API utilizando o Laravel.
Para o uso da API é necessário criar um chave no site da [OPENAI](https://openai.com/)

# Funcionalidades

## Chat

Via termianl, com o command 
```
php artisan chat
```
é possível conversar com o ChatGPT de forma tradicional.

## Criação de Áudios

Acessando via browser na URL http://localhost:8081 é possível solicitar que o ChatGPT crie um áudio sobre qualquer tema. O arquivo .mp3 será disponibilizado via download.

## Geração de Imagens
Acessando via browser na URL http://localhost:8081/image é possível solicitar que o ChatGPT crie imagens sobre qualquer tema.


## Detecção de Spam em Post.

Acessando via browser na URL http://localhost:8081/replies é possível fazer um Post e o ChatGPR verifica se o post é um SPAM ou não.
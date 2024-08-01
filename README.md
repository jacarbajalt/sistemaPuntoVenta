# sistemaPuntoVenta

sistemaPuntoVenta es una aplicación basada en [Yii 2](https://www.yiiframework.com/) diseñada para gestionar ventas y puntos de venta. Este proyecto incluye características básicas como inicio de sesión de usuario, gestión de contactos y funciones específicas para ventas.

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![build](https://github.com/yiisoft/yii2-app-basic/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-basic/actions?query=workflow%3Abuild)

## ESTRUCTURA DE DIRECTORIOS

      assets/             contiene la definición de activos
      commands/           contiene comandos de consola (controladores)
      config/             contiene configuraciones de la aplicación
      controllers/        contiene clases de controladores Web
      mail/               contiene archivos de vista para correos electrónicos
      models/             contiene clases de modelos
      runtime/            contiene archivos generados durante la ejecución
      tests/              contiene varias pruebas para la aplicación
      vendor/             contiene paquetes de terceros dependientes
      views/              contiene archivos de vista para la aplicación Web
      web/                contiene el script de entrada y recursos Web

## REQUISITOS

El requisito mínimo para este proyecto es que tu servidor Web soporte PHP 7.4.

## INSTALACIÓN

### Instalación desde Git y Composer

Clona el repositorio y navega al directorio del proyecto:

```bash
git clone https://github.com/jacarbajalt/sistemaPuntoVenta.git
cd sistemaPuntoVenta
composer install

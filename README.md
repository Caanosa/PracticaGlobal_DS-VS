# 🧩 PracticaGlobal_DS-VS

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![PHP](https://img.shields.io/badge/PHP-8.x-blue)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-blue.svg)](https://www.mysql.com/)
[![VS Code](https://img.shields.io/badge/IDE-VS--Code-blue)](https://code.visualstudio.com/)

Este repositorio contiene una práctica global para el módulo de Desarrollo de Software, centrada en la creación de una aplicación web de gestión de cartas Pokémon. El proyecto utiliza tecnologías como PHP, HTML, CSS, JavaScript y SCSS, y está diseñado para ser desarrollado en Visual Studio Code.

---

## 📚 Tabla de Contenidos

- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Tecnologías Utilizadas](#-tecnologías-utilizadas)
- [Requisitos Previos](#️-requisitos-previos)
- [Configuración del Entorno](#️-configuración-del-entorno)
- [Pruebas](#-pruebas)
- [Licencia](#-licencia)
- [Contribuciones](#-contribuciones)

---

## 📁 Estructura del Proyecto

- `Pokemoncard_shop/`: Contiene el código fuente de la aplicación web.
- `documentacion/`: Incluye documentación relacionada con el proyecto.
- `BBDD_PokemonCard.txt`: Script SQL para la creación de la base de datos.
- `.phpdoc/`: Archivos generados por phpDocumentor para la documentación del código.
- `phpDocumentor.phar`: Archivo ejecutable de phpDocumentor para generar documentación.

## 🚀 Tecnologías Utilizadas

- **Frontend**: HTML, CSS, SCSS, JavaScript
- **Backend**: PHP
- **Base de Datos**: MySQL
- **Documentación**: phpDocumentor

## ⚙️ Requisitos Previos

- [XAMPP](https://www.apachefriends.org/index.html) o similar para ejecutar Apache y MySQL
- [Visual Studio Code](https://code.visualstudio.com/) con extensiones para PHP y SCSS
- [phpDocumentor](https://www.phpdoc.org/) para generar documentación del código

## 🛠️ Configuración del Entorno

1. **Clonar el repositorio:**

   ```bash
   git clone https://github.com/Caanosa/PracticaGlobal_DS-VS.git

2. **Configurar el servidor web:**

   - Copia la carpeta `Pokemoncard_shop/` al directorio `htdocs/` de XAMPP.
   - Asegúrate de que Apache y MySQL estén en ejecución.

3. **Importar la base de datos:**

   - Accede a phpMyAdmin.
   - Crea una nueva base de datos, por ejemplo, `pokemoncard_db`.
   - Importa el archivo `BBDD_PokemonCard.txt` para crear las tablas necesarias.

4. **Configurar la conexión a la base de datos:**

   - Abre el archivo de configuración de la base de datos en `Pokemoncard_shop/` (por ejemplo, `config.php`).
   - Actualiza los parámetros de conexión (`host`, `usuario`, `contraseña`, `nombre de la base de datos`) según tu configuración local.

5. **Generar la documentación del código:**

   ```bash
   php phpDocumentor.phar run -d Pokemoncard_shop -t documentacion
   ```
   (La documentación generada estará disponible en la carpeta documentacion/.)


## 🧪 Pruebas

Actualmente, no se han implementado pruebas automatizadas. Se recomienda realizar pruebas manuales de las funcionalidades principales de la aplicación y considerar la integración de un framework de pruebas como PHPUnit en el futuro.

## 📄 Licencia

Este proyecto se distribuye bajo la licencia MIT. Consulta el archivo `LICENSE` para más información.

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor, abre un *issue* para discutir cambios importantes antes de enviar un *pull request*.



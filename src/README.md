# generar_excel
- PHP es: 8.1.17
- Composer version 2.3.5 2022-04-13
- XAMPP v3.3.0
1. Descargar composer para windows desde:
https://getcomposer.org/download/ 
2. Hacer clic en "Composer-Setup.exe", para instalar el composer
3. Modificar el archivo php.ini(XAMMP), quitar punto y coma de la linea: ;extension=gd 
4. Ejecutar en una terminal:
          composer update --ignore-platform-req=ext-gd
          composer update

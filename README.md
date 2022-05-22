# ReadArticlesScript
![api-rest-model](https://user-images.githubusercontent.com/89544871/169689272-e681b40b-59a1-4027-97e6-5decb00a06b0.png)
Un mini langage de programmation qui permet une lecture des articles dans les sites Web et l'extraction des informations contenus dans ces endroits. Actuellement dans ce projet j'essaie de faire ce script pour la lecture des articles à partir de site "BBC", et bien sûr il peut extraire les articles d'après plusieurs autres sites. 
Le script peut donc rassembler les articles qui se trouvent dans les sites externes et les afficher dans noter propre site Web, alors que les articles obtenus sont rassemblées, combinées, analysées ou enregistrées pour une utilisation ultérieure.

## Usage
Install the dependencies
```bash
composer install
```
Start script
```bash
symfony serve
```

## Routes

### Index articles
```bash
http://127.0.0.1:8000/?start=2&end=50
```
```@@start@@``` : start from article {start}. | defualt 1
```@@end@@``` : end in article {end}. | defualt 1

### Show article
```bash
http://127.0.0.1:8000/id
```
```@@id@@``` : id or link of the article

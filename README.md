# ReadArticlesScript
![api-rest-model](https://user-images.githubusercontent.com/89544871/169689272-e681b40b-59a1-4027-97e6-5decb00a06b0.png)
A mini script that allows reading articles in websites and extracting information from these places. Currently in this project I am trying to make this script for reading articles from "BBC" site, and of course it can extract articles from several other sites.
The script can therefore gather articles that are in external sites and display them in note own website, while the obtained articles are collected, combined, analyzed or saved for later use.

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
```start``` : start from article {start}. | defualt 1
\
```end``` : end in article {end}. | defualt 1

### Show article
```bash
http://127.0.0.1:8000/id
```
```id``` : id or link of the article

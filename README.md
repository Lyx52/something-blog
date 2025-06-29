# Something blog
Starter template used: https://github.com/refactorian/laravel-docker/tree/laravel_11x (For easy docker setup) 


# Setup

1. First copy environment file .env.example to .env and modify configuration such as db passwords etc.
2. Start production container using:
```bash
docker compose up --build -d
```
Or run dev container using:
```bash
docker compose -f docker-compose.dev.yml up --build -d
```
4. To configure xdebug, set host to _, port to 9000 and set **project path** relative to container **/var/www** path

Libraries used:
* CKEditor5 for text editor
* Purify to escape post/comment HTML
* Postgresql as DB
* HTMX for added interactivity (Load more/search)
* Tailwind for styling


**PS: Google Gemini WAS used for general component style mockup**

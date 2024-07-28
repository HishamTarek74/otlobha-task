
## Otlobha-Task
-  search profile fit on a property 

### Task Installation
- follow the instructions and run following commands
```
clone the repo
```
```
RUN composer install
```
```
RUN copy .env.example .env
```
```
RUN php artisan key:generate
```
```
RUN php artisan migrate --seed
```
```
RUN php artisan serve
```
- To Run Test

```
RUN php artisan test
```
- visit : http://localhost:8000

- Hit endpoint  : http://localhost:8000/api/v1/match/{property}



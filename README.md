Cześć,
Przesyłam udostępniam moją propozycję rozwiązania.

Środowisko na którym pracowałem:
Windows + WSL 2 (ubuntu 20) z zaintalowanym dockerem.

docker-compose w katalogu głównym za pierwszy razm chwilę potrwa (ok 1h na 6 letnim kompie).
W tym czasie zbuduje aplikacje w skłąd której wchodzi:
- baza mysql
- nginx
- phpmyadmin
- rabbitmq
- publisher (app), tutaj jest główne API. Do prawidłowego działania dostęp przez ngixa jest udostępniony jako contests.loc.
	Aby mieć dostęp do zasobów api/tests oraz api/categories należy najpierw pobrać token z endpointa api/login:
	Login: admin@patient.com 
	Hasło: patient

	W zasobach mamy:
	Listy (GET): api/tests oraz api/categories
	Detal (GET): api/tests/{id} oraz api/categories/{id}
	Zapis (POST): api/tests oraz api/categories
	Aktualizacja (PUT): api/tests/{id} oraz api/categories/{id}
	Usunięcie (DELETE): api/tests/{id} oraz api/categories/{id}

	Token jest sprawdzany w middleware 'BearerToken'

	Requesty do POST i PUT są sprawdzane przez  'StoreCategoryRequest' i 'StoreTestRequest'

	Zwracane dane są ograniczane przez klasy w app/Http/Resources

	Połączenie testów z kategoriami jest przy uzyciu relacji many to many

	W seeder'ach dodane są podstawowe dane: user, kategorie i kilka testów. Podczas uruchomienie przez docker-compose uruchamiane jest polecenie migrate:fresh --seed

	Kategorie poprzez API dodawane są bezpośrednio do bazy
	Testy poprzez API dodawane są przy użyciu kolejki. Request jest sprawdzany i dodawany na kolejkę do rabbitmq.
	
	Testy można uruchomieć poleceniem 'composer test' z poziomu kontenera pacjent_app_1 (docker exec -it pacjent_app_1 /bin/bash). Po zakończeniu testów baza jest czyszczona

- reciver (app), tutaj mamy nasłuchiwanie na kolejnce w rabbitmq i dodawanie/update testów jeżeli pojawi się wpis.


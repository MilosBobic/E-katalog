# eKatalog — E-katalog za poručivanje robe

Web aplikacija za pregled i poručivanje robe.
Korisnici mogu pregledati katalog proizvoda, dodavati ih u korpu i poručivati,
dok administratori upravljaju sadržajem kroz poseban admin panel.

---

## Tehnologije

- **Laravel 12** — PHP framework
- **PHP 8.4+** — backend
- **MySQL** — baza podataka
- **Blade** — HTML šabloni
- **Tailwind CSS** — stilizovanje

---

## Funkcionalnosti

### Korisnici
- Pregled kataloga sa pretragom i filterom po kategoriji
- Detaljna stranica svakog proizvoda (slika, opis, cena, zalihe)
- Registracija i prijava
- Korpa za kupovinu (dodavanje, izmena količine, uklanjanje)
- Poručivanje sa unosom podataka za dostavu
- Pregled istorije porudžbina i statusa (na čekanju / u obradi / isporučeno)

### Administratori
- Dashboard sa statistikama (broj porudžbina, prihod, porudžbine na čekanju)
- Upravljanje kategorijama (dodavanje, uređivanje, brisanje)
- Upravljanje proizvodima (dodavanje, uređivanje, brisanje, upload slike)
- Pregled svih porudžbina i promena statusa

---

## Instalacija

### Zahtevi
- PHP 8.4+
- MySQL
- Composer
- Node.js

### Koraci

```bash
# 1. Kloniraj projekat
git clone https://github.com/tvoj-nalog/ekatalog.git
cd ekatalog

# 2. Instaliraj PHP zavisnosti
composer install

# 3. Instaliraj JS zavisnosti
npm install

# 4. Napravi .env fajl
cp .env.example .env
php artisan key:generate
```

Otvori `.env` i podesi bazu podataka:

```env
DB_DATABASE=ekatalog
DB_USERNAME=root
DB_PASSWORD=
```


# 5. Kreiraj bazu u MySQL
# (u phpMyAdmin ili terminalu)
# CREATE DATABASE ekatalog;

# 6. Pokreni migracije i seedere
`php artisan migrate`
`php artisan db:seed`

# 7. Poveži storage za slike
`php artisan storage:link`

# 8. Pokreni aplikaciju
```
php artisan serve
npm run dev
```

## Admin nalog

Nakon registracije, otvori phpMyAdmin - tabela `users` - postavi `is_admin = 1` za odgovarajuci nalog.

Seeder automatski dodaje admin nalog - admin@